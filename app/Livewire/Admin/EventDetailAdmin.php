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
use ZipArchive;

class EventDetailAdmin extends Component
{
    use WithFileUploads;

    public $event;
    public $eventId;
    public $showTable = false;
    public $eventDate;
    public $csvFile;
    public $showReuploadForm = false;

    protected $queryString = ['eventId'];

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $this->loadEvent();
    }

    public function loadEvent()
    {
        $this->event = Event::with('participantList')->findOrFail($this->eventId);
        $this->showTable = !$this->event->participantList->isEmpty();

        $start = \Carbon\Carbon::parse($this->event->start_date);
        $end = $start->copy()->addDays($this->event->duration_days);
        $this->eventDate = $start->translatedFormat('j F') . ' - ' . $end->translatedFormat('j F Y');
    }

    public function handleUploadCSV()
    {
        $this->validate([
            'csvFile' => 'required|file|mimes:csv,xlsx,xls|max:2048',
        ]);

        try {
            $this->event->participantList()->delete();
            Excel::import(new ParticipantsImport($this->eventId), $this->csvFile);
            $this->loadEvent();
            $this->showReuploadForm = false;
            $this->dispatch('notify', 'CSV berhasil diunggah.');
        } catch (\Exception $e) {
            $this->dispatch('notify', 'Gagal mengunggah CSV: ' . $e->getMessage());
        }
    }

    public function downloadBarcode($participantId = null)
    {
        // Generate barcode(s) first
        $generateResult = $this->generateBarcodes($this->eventId, $participantId);
        if (!$generateResult['success']) {
            $this->dispatch('notify', $generateResult['message']);
            return;
        }

        // Download single barcode
        if ($participantId) {
            $filePath = public_path("barcodes/{$this->eventId}/{$participantId}.png");

            if (!file_exists($filePath)) {
                $this->dispatch('notify', 'Barcode not found');
                return;
            }

            return response()->download($filePath);
        }

        // Download all barcodes in zip
        $zipFileName = "barcodes_{$this->eventId}.zip";
        $zipFilePath = public_path("barcodes/{$zipFileName}");

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            $this->dispatch('notify', 'Failed to create zip file');
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