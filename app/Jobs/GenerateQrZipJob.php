<?php

namespace App\Jobs;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use ZipArchive;

class GenerateQrZipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $eventId;
    public $zipFilePath;
    public $timeout = 1800; // 30 minutes (30 * 60 seconds)

    public function __construct($eventId, $zipFilePath)
    {
        $this->eventId = $eventId;
        $this->zipFilePath = $zipFilePath;
    }    public function handle()
    {
        $event = Event::find($this->eventId);
        if (!$event) return;

        // Create barcodes folder
        $folderPath = public_path("barcodes/{$this->eventId}/");
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        // Generate all QR codes first
        foreach ($event->participantList()->get() as $participant) {
            $safeName = preg_replace('/[^A-Za-z0-9 _-]/', '', $participant->name);
            $filePath = $folderPath . $safeName . '.png';

            // Always regenerate to ensure fresh codes
            QrCode::format('png')
                ->color(20, 35, 50)
                ->backgroundColor(255, 255, 255)
                ->margin(1)
                ->size(200)
                ->generate($participant->id, $filePath);
        }

        // Create zip file with all generated QR codes
        $zip = new ZipArchive();
        if ($zip->open($this->zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return;
        }

        foreach ($event->participantList()->get() as $participant) {
            $safeName = preg_replace('/[^A-Za-z0-9 _-]/', '', $participant->name);
            $filePath = $folderPath . $safeName . '.png';
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $safeName . '.png');
            }
        }
        $zip->close();
    }
}
