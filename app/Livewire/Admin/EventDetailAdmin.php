<?php

namespace App\Livewire\Admin;

use App\Exports\ParticipantsPresenceExport;
use App\Imports\ParticipantsImport;
use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithPagination;
use ZipArchive;
use App\Jobs\GenerateQrZipJob;

class EventDetailAdmin extends Component
{
    use WithFileUploads, WithPagination;

    public $event;
    public $eventId;
    public $showTable = false;
    public $eventDate;
    public $csvFile;
    public $showReuploadForm = false;
    public $perPage = 10;
    public $zipStatus = null; // 'processing', 'ready', 'error'
    public $zipFileName = null;
    public $zipJobId = null; // Store job ID for tracking

    protected $queryString = ['eventId'];

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $this->loadEvent();

        // Check for ongoing zip generation
        $this->checkOngoingZipGeneration();

        if (session()->has('saved')) {
            LivewireAlert::title(session('saved.title'))
                ->text(session('saved.text'))
                ->success()
                ->show();
        }
    }

    public function checkOngoingZipGeneration()
    {
        // Check if there's an ongoing zip generation for this event
        $zipFileName = "barcodes_{$this->eventId}.zip";
        $zipFilePath = public_path("barcodes/{$zipFileName}");
        
        // Check session for ongoing job
        $ongoingJob = session("zip_job_{$this->eventId}");
        
        if ($ongoingJob) {
            $this->zipFileName = $zipFileName;
            $this->zipJobId = $ongoingJob['job_id'];
            
            // Check if file is ready
            if (file_exists($zipFilePath)) {
                $this->zipStatus = 'ready';
                session()->forget("zip_job_{$this->eventId}");
                
                LivewireAlert::title('Download Starting!')
                    ->text('Your QR codes zip file is ready. Download will start automatically in 2 seconds.')
                    ->timer(4000)
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->withOptions(['timerProgressBar' => true])
                    ->show();
                    
                $this->dispatch('zipReadyOnMount', url: asset('barcodes/' . $this->zipFileName));
            } else {
                $this->zipStatus = 'processing';
                
                LivewireAlert::title('Processing Continues...')
                    ->text('Your QR codes are still being generated in the background.')
                    ->timer(3000)
                    ->info()
                    ->toast()
                    ->position('top-end')
                    ->withOptions(['timerProgressBar' => true])
                    ->show();
                    
                $this->dispatch('continueZipPolling');
            }
        }
    }

    public function loadEvent()
    {
        $this->event = Event::findOrFail($this->eventId);
        $this->showTable = $this->event->participantList()->exists();

        $start = \Carbon\Carbon::parse($this->event->start_date);
        $end = $start->copy()->addDays($this->event->duration_days);
        $this->eventDate = $start->translatedFormat('j F') . ' - ' . $end->translatedFormat('j F Y');
    }

    public function getParticipantsProperty()
    {
        return $this->event
            ? $this->event->participantList()->paginate($this->perPage)
            : collect();
    }

    public function handleUploadCSV()
    {
        $this->validate([
            'csvFile' => 'required|file|mimes:csv,xlsx,xls|max:2048',
        ], [
            'csvFile.required' => 'Please upload a CSV file.',
            'csvFile.file' => 'The uploaded file must be a valid file.',
            'csvFile.mimes' => 'The file must be a CSV, XLSX, or XLS format.',
            'csvFile.max' => 'The file size must not exceed 2MB.',
        ]);

        try {
            // Hitung jumlah row pada file
            $rows = Excel::toArray(null, $this->csvFile);
            $dataRows = $rows[0];
            $rowCount = count($dataRows) - 1; // Kurangi header

            if ($rowCount > $this->event->participants) {
                LivewireAlert::title('Over Capacity')
                    ->text("Jumlah peserta di CSV ($rowCount) melebihi kapasitas maksimal ({$this->event->participants}).")
                    ->timer(4000)
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->withOptions(['timerProgressBar' => true])
                    ->show();
                return;
            }

            // Hapus folder barcodes jika ada
            $barcodeDir = public_path("barcodes/{$this->eventId}");
            if (File::exists($barcodeDir)) {
                File::deleteDirectory($barcodeDir);
            }

            // Hapus file zip jika ada
            $zipFilePath = public_path("barcodes/barcodes_{$this->eventId}.zip");
            if (File::exists($zipFilePath)) {
                File::delete($zipFilePath);
            }

            // Jika valid, baru dihapus dan import
            $this->event->participantList()->delete();
            Excel::import(new ParticipantsImport($this->eventId), $this->csvFile);
            

            $this->loadEvent();
            $this->showReuploadForm = false;

            LivewireAlert::title('Success')
                ->text('CSV file uploaded successfully')
                ->timer(3000)
                ->success()
                ->toast()
                ->position('top-end')
                ->withOptions(['timerProgressBar' => true])
                ->show();

        } catch (\Exception $e) {
            $this->dispatch('notify', 'Gagal mengunggah CSV: ' . $e->getMessage());
            LivewireAlert::title('Error')
                ->text('Failed to upload CSV: ' . $e->getMessage())
                ->timer(3000)
                ->error()
                ->toast()
                ->position('top-end')
                ->withOptions(['timerProgressBar' => true])
                ->show();
        }
    }

    public function downloadBarcode($participantId = null)
    {
        // Download single barcode
        if ($participantId) {
            // Generate single barcode if not exists
            $generateResult = $this->generateBarcodes($this->eventId, $participantId);
            if (!$generateResult['success']) {
                LivewireAlert::title('Error')
                    ->text($generateResult['message'])
                    ->timer(3000)
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->withOptions([
                        'timerProgressBar' => true,
                    ])
                    ->show();
                return;
            }

            $participant = $this->event->participantList()->where('id', $participantId)->first();
            $safeName = preg_replace('/[^A-Za-z0-9 _-]/', '', $participant->name);
            $filePath = public_path("barcodes/{$this->eventId}/{$safeName}.png");

            if (!file_exists($filePath)) {
                LivewireAlert::title('Error')
                    ->text('Barcode not found')
                    ->timer(3000)
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->withOptions([
                        'timerProgressBar' => true,
                    ])
                    ->show();
                return;
            }

            return response()->download($filePath, $safeName.'.png');
        }

        // Batch download: Use queue job for both generate and zip
        $this->startBatchZipGeneration();
    }

    public function startBatchZipGeneration()
    {
        $zipFileName = "barcodes_{$this->eventId}.zip";
        $zipFilePath = public_path("barcodes/{$zipFileName}");
        
        $this->zipFileName = $zipFileName;
        $this->zipStatus = 'processing';
        
        // Delete existing zip if exists
        if (file_exists($zipFilePath)) {
            unlink($zipFilePath);
        }
        
        // Delete existing barcodes folder to regenerate fresh
        $barcodeDir = public_path("barcodes/{$this->eventId}");
        if (File::exists($barcodeDir)) {
            File::deleteDirectory($barcodeDir);
        }
        
        // Dispatch job to generate QR codes and create zip
        $job = GenerateQrZipJob::dispatch($this->eventId, $zipFilePath);
        $this->zipJobId = $job->id ?? uniqid();
        
        // Store job info in session for persistence across page navigation
        session([
            "zip_job_{$this->eventId}" => [
                'job_id' => $this->zipJobId,
                'started_at' => now()->toDateTimeString(),
                'zip_file' => $zipFileName
            ]
        ]);
        
        // Show processing toast
        LivewireAlert::title('Processing...')
            ->text('Generating all QR codes and creating zip file. You can navigate away, we\'ll notify you when ready.')
            ->timer(0)
            ->info()
            ->toast()
            ->position('top-end')
            ->show();
            
        $this->dispatch('startZipPolling');
    }

    public function checkZipStatus()
    {
        if (!$this->zipFileName) return false;
        
        $zipFilePath = public_path("barcodes/{$this->zipFileName}");
        if (file_exists($zipFilePath)) {
            $this->zipStatus = 'ready';
            
            // Clear session job info
            session()->forget("zip_job_{$this->eventId}");
            
            LivewireAlert::title('Download Starting!')
                ->text('QR codes zip file is ready. Download will start automatically in 2 seconds.')
                ->timer(4000)
                ->success()
                ->toast()
                ->position('top-end')
                ->withOptions(['timerProgressBar' => true])
                ->show();
                
            $this->dispatch('zipReady', url: asset('barcodes/' . $this->zipFileName));
            return true;
        }
        return false;
    }

    public function downloadZipFile()
    {
        if ($this->zipStatus === 'ready' && $this->zipFileName) {
            $zipFilePath = public_path("barcodes/{$this->zipFileName}");
            if (file_exists($zipFilePath)) {
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            }
        }
        return null;
    }

    private function generateBarcodes($eventId, $participantId = null)
    {
        $event = Event::find($eventId);
        if (!$event) {
            return [
                'success' => false,
                'message' => 'Event not found',
                'code' => 404,
            ];
        }

        $participants = $participantId
            ? $event->participantList()->where('id', $participantId)->get()
            : $event->participantList()->get();

        if ($participants->isEmpty()) {
            return [
                'success' => false,
                'message' => 'No participants found',
                'code' => 404,
            ];
        }

        $folderPath = public_path("barcodes/{$eventId}/");
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        foreach ($participants as $participant) {
            $filePath = "{$folderPath}{$participant->name}.png";

            if (!file_exists($filePath)) {
                QrCode::format('png')
                    ->color(20, 35, 50)
                    ->backgroundColor(255, 255, 255)
                    ->margin(1)
                    ->size(200)
                    ->generate($participant->id, $filePath);
            }
        }

        return [
            'success' => true,
            'message' => 'Barcodes generated successfully',
            'code' => 200,
        ];
    }

    public function markPresence($participantId)
    {
        $this->dispatch('confirmMarkPresence', participantId: $participantId);
    }

    public function doMarkPresence($participantId)
    {
        $participant = $this->event->participantList()->where('id', $participantId)->first();
        if ($participant) {
            $participant->is_presence = true;
            $participant->presence_at = now();
            $participant->save();
            $this->loadEvent();
            \Jantinnerezo\LivewireAlert\Facades\LivewireAlert::title('Success')
                ->text('Participant marked as present.')
                ->timer(2000)
                ->success()
                ->toast()
                ->position('top-end')
                ->withOptions(['timerProgressBar' => true])
                ->show();
        }
    }

    public function unmarkPresence($participantId)
    {
        $this->dispatch('confirmUnmarkPresence', participantId: $participantId);
    }

    public function doUnmarkPresence($participantId)
    {
        $participant = $this->event->participantList()->where('id', $participantId)->first();
        if ($participant) {
            $participant->is_presence = false;
            $participant->presence_at = null;
            $participant->save();
            $this->loadEvent();
            \Jantinnerezo\LivewireAlert\Facades\LivewireAlert::title('Success')
                ->text('Presence status removed.')
                ->timer(2000)
                ->success()
                ->toast()
                ->position('top-end')
                ->withOptions(['timerProgressBar' => true])
                ->show();
        }
    }

    public function downloadExcelPresence()
    {
        $participants = $this->event->participantList()->get(['name', 'school', 'is_presence', 'presence_at']);
        $csvData = $participants->map(function ($p) {
            return [
                'Name' => $p->name,
                'School' => $p->school,
                'Presence' => $p->is_presence ? 'Present' : 'Absent',
                'Presence At' => $p->presence_at ? \Carbon\Carbon::parse($p->presence_at)->format('d/m/Y H:i') : '-',
            ];
        });
        $filename = 'participants-presence-' . $this->event->id . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new ParticipantsPresenceExport($csvData), $filename);
    }

    public function generateZip()
    {
        $this->zipStatus = 'processing';

        // Dispatch job to generate QR code zip
        GenerateQrZipJob::dispatch($this->eventId)
            ->then(function ($job) {
                $this->zipStatus = 'ready';
                $this->zipFileName = "barcodes_{$this->eventId}.zip";
                LivewireAlert::title('Success')
                    ->text('QR code zip file is ready to download.')
                    ->timer(3000)
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->withOptions(['timerProgressBar' => true])
                    ->show();
            })
            ->catch(function ($exception) {
                $this->zipStatus = 'error';
                LivewireAlert::title('Error')
                    ->text('Failed to generate zip file: ' . $exception->getMessage())
                    ->timer(3000)
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->withOptions(['timerProgressBar' => true])
                    ->show();
            });
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.event-detail-admin');
    }
}