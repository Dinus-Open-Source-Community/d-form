<?php

namespace App\Livewire\Client;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Http\Helpers\DateHelper;

class EventDetail extends Component
{
    public $eventId;
    public $event;
    public $eventDate = [];
    public $activeTab = 'overview';
    public $showEmailInput = false;
    public $email = '';

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $this->fetchEvent();
        $this->eventDate = DateHelper::formatRangedDate($this->event->start_date, $this->event->end_date);
    }

    public function fetchEvent()
    {
        $this->event = Event::findOrFail($this->eventId);
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function toggleEmailInput()
    {
        $this->showEmailInput = !$this->showEmailInput;
    }

    public function submitEmail()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        // Logic untuk menyimpan email atau notifikasi
        $this->showEmailInput = false;
        $this->email = '';

        session()->flash('message', 'Anda akan mendapatkan notifikasi saat pendaftaran dibuka!');
    }

    #[Layout('components.layouts.client', ['title' => 'Event Detail'])]
    public function render()
    {
        return view('livewire.client.event-detail');
    }
}
