<?php

namespace App\Livewire\Client\Components;

use App\Http\Helpers\DateHelper;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class EventCard extends Component
{
    public Event $event;
    public array $eventDate = [];

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->formatEventDate();
    }

    public function formatEventDate()
    {
        $startDate = Carbon::parse($this->event->start_date);
        $endDate = Carbon::parse($this->event->start_date)
            ->addDays($this->event->duration_days);
        
        $this->eventDate = DateHelper::formatRangedDate($startDate, $endDate);
    }

    public function handleClick()
{
    return redirect()->route('client.event-detail', ['eventId' => $this->event->id]);
}

    public function render()
    {
        return view('livewire.client.components.event-card');
    }
}