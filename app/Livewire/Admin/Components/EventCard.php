<?php

namespace App\Livewire\Admin\Components;

use Carbon\Carbon;
use Livewire\Component;

class EventCard extends Component
{
    public array $event;
    
    public function getEventStatus()
    {
        $startDate = Carbon::parse($this->event['start_date']);
        $endDate = $startDate->copy()->addDays($this->event['duration_days']);
        $now = Carbon::now();

        if ($now->greaterThan($endDate)) {
            return 'completed';
        } elseif ($now->between($startDate, $endDate)) {
            return 'ongoing';
        } elseif ($now->lessThan($startDate)) {
            return 'upcoming';
        } else {
            return 'today';
        }
    }
    
    public function render()
    {
        return view('livewire.admin.components.event-card');
    }
}
