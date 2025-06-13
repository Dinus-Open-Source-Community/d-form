<?php

namespace App\Livewire\Admin;

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

    protected $queryString = ['eventId'];

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $this->loadEvent();

        if (session()->has('saved')) {
            LivewireAlert::title(session('saved.title'))
                ->text(session('saved.text'))
                ->success()
                ->show();
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
        // Generate barcode(s) first
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

        // Download single barcode
        if ($participantId) {
            $filePath = public_path("barcodes/{$this->eventId}/{$participantId}.png");

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

            return response()->download($filePath);
        }

        // Download all barcodes in zip
        $zipFileName = "barcodes_{$this->eventId}.zip";
        $zipFilePath = public_path("barcodes/{$zipFileName}");

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            LivewireAlert::title('Error')
                ->text('Failed to create zip file')
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

        $barcodeDir = public_path("barcodes/{$this->eventId}/");
        foreach (File::files($barcodeDir) as $file) {
            $zip->addFile($file->getRealPath(), $file->getFilename());
        }
        $zip->close();

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
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
            $filePath = "{$folderPath}{$participant->id}.png";

            if (!file_exists($filePath)) {
                QrCode::format('png')
                    ->backgroundColor(255, 255, 255)
                    ->color(20, 35, 50)
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


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.event-detail-admin');
    }
}