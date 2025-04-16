<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\ParticipantsImport;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ParticipantController extends Controller
{
    public function uploadParticipants(Request $request, $eventId)
    {
        $event = Event::find($eventId);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }

        if ($event->participants()->count() > 0) {
            Event::find($eventId)->participants()->delete();
        }

        $request->validate([
            'data' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        $file = $request->file('data');

        $importedData = Excel::import(new ParticipantsImport($eventId), $file);

        if ($importedData) {
            return response()->json([
                'success' => true,
                'message' => 'Participants imported successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to import participants',
            ], 500);
        }
    }

    public function handleBarcodeDownload($eventId, $participantId = null)
    {
        // Generate barcode(s) first
        $generateResult = $this->generateBarcodes($eventId, $participantId);
        if (!$generateResult['success']) {
            return response()->json($generateResult, $generateResult['code']);
        }

        // Download single barcode
        if ($participantId) {
            $filePath = public_path("barcodes/{$eventId}/{$participantId}.png");

            if (!file_exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Barcode not found',
                ], 404);
            }

            return response()->download($filePath);
        }

        // Download all barcodes in zip
        $zipFileName = "barcodes_{$eventId}.zip";
        $zipFilePath = public_path("barcodes/{$zipFileName}");

        $zip = new \ZipArchive();
        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create zip file',
            ], 500);
        }

        $barcodeDir = public_path("barcodes/{$eventId}/");
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
            ? $event->participants()->where('id', $participantId)->get()
            : $event->participants;

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
}
