<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ScanQr extends Component
{
    public $isSettingsOpen = false;
    public $inputSource = '';
    public $cameraDevices = [];
    public $showSuccessModal = false;
    public $scannedUser = '';
    public $hasPermission = null;
    public $isScanning = false;
    public $errorMessage = '';
    public $eventId = null;
    public $event;
    public $checkedInCount = 0;
    public $totalParticipants = 0;
    public $latestCheckIns = [];

    public function mount($eventId)
    {
        $this->cameraDevices = [];
        $this->eventId = $eventId;

        $this->event = Event::find($eventId);
        if (!$this->event) {
            return redirect()->route('admin.events');
        }

        $this->updateParticipantStats();
    }

    public function updateParticipantStats()
    {
        $this->totalParticipants = Participant::where('event_id', $this->eventId)->count();
        $this->checkedInCount = Participant::where('event_id', $this->eventId)
            ->where('is_presence', true)
            ->count();
        $this->latestCheckIns = Participant::where('event_id', $this->eventId)
            ->where('is_presence', true)
            ->orderBy('presence_at', 'desc')
            ->get(['name', 'presence_at'])
            ->map(function ($participant) {
                return [
                    'name' => $participant->name,
                    'time' => $participant->presence_at ? Carbon::parse($participant->presence_at)->format('H:i') : null,
                ];
            })
            ->toArray();
    }

    public function toggleSettings()
    {
        $this->isSettingsOpen = !$this->isSettingsOpen;
    }

    public function startScanning()
    {
        $this->isScanning = true;
        $this->hasPermission = true;
        $this->errorMessage = '';
        $this->dispatch('start-scanning');
    }

    public function stopScanning()
    {
        $this->isScanning = false;
        $this->hasPermission = null;
        $this->dispatch('stop-scanning');
    }

    public function updateCameraDevices($devices)
    {
        $this->cameraDevices = $devices;
        if (!empty($devices) && empty($this->inputSource)) {
            $this->inputSource = $devices[0]['deviceId'];
        }
    }

    public function checkIn($barcode)
    {
        try {
            $participant = Participant::where('id', $barcode)
                ->where('event_id', $this->eventId)
                ->first();

            if (!$participant) {
                $this->errorMessage = 'Participant not found or not registered for this event';
                return;
            }

            if ($participant->is_presence === true) {
                $this->errorMessage = 'Participant already checked in';
                return;
            }

            $participant->is_presence = true;
            $participant->presence_at = now();
            $participant->save();

            $this->scannedUser = $participant->name ?? 'Participant';
            // $this->showSuccessModal = true;
            $this->updateParticipantStats();
        } catch (\Exception $e) {
            Log::error('Check-in error: ' . $e->getMessage());
            $this->errorMessage = 'Error processing check-in';
        }
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
        $this->scannedUser = '';
    }

    public function render()
    {
        return view('livewire.admin.scan-qr', [
            'event' => $this->event,
            'checkedInCount' => $this->checkedInCount,
            'totalParticipants' => $this->totalParticipants,
            'latestCheckIns' => $this->latestCheckIns,
        ]);
    }
}