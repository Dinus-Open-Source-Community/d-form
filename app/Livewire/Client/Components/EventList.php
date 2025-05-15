<?php

namespace App\Livewire\Client\Components;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class EventList extends Component
{
    public $showToday = true;
    public $todayEvents = [];
    public $upcomingEvents = [];
    public $isLoading = true;
    public $hasError = false;
    public $statusCode = 200;

    public function mount($showToday = true)
    {
        $this->showToday = $showToday;
        $this->fetchEvents();
    }

    public function fetchEvents()
    {
        try {
            $this->isLoading = true;
            
            if ($this->showToday) {
                $this->todayEvents = Event::query()
                    ->whereDate('start_date', Carbon::today())
                    ->orderBy('start_time')
                    ->take(3)
                    ->get();
            }
            
            $this->upcomingEvents = Event::query()
                ->whereDate('start_date', '>', Carbon::today())
                ->orderBy('start_date')
                ->take(5)
                ->get();
                
            $this->hasError = false;
            $this->statusCode = 200;
        } catch (\Exception $e) {
            $this->hasError = true;
            $this->statusCode = 404;
            logger()->error('Error fetching events: ' . $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.client.components.event-list');
    }
}