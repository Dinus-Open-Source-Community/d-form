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
    public string $timeRange = '';

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->formatEventDate();
        $this->formatTimeRange();
    }

    public function formatEventDate()
    {
        $startDate = Carbon::parse($this->event->start_date);
        $endDate = $this->event->end_date
            ? Carbon::parse($this->event->end_date)
            : $startDate->copy()->addDays($this->event->duration_days);

        $this->eventDate = DateHelper::formatEventDateRange($startDate, $endDate);
    }

    public function formatTimeRange()
    {
        $start = Carbon::parse($this->event->start_time);
        $end = Carbon::parse($this->event->end_time);

        $this->timeRange = $start->format('H:i') . ' - ' . $end->format('H:i');
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
