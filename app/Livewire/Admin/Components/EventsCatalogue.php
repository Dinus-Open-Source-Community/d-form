<?php

namespace App\Livewire\Admin\Components;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class EventsCatalogue extends Component
{
    public string $timestamp;
    public string $title;
    public bool $showSeeAll = true;
    public bool $useQR = false;
    public array $events = [];
    public bool $notFound = false;

    public function mount($timestamp, $title, $showSeeAll = true, $useQR = false)
    {
        $this->timestamp = $timestamp;
        $this->title = $title;
        $this->showSeeAll = $showSeeAll;
        $this->useQR = $useQR;

        $this->fetchEvents();
    }

    public function fetchEvents()
    {
        $query = Event::query();

        if ($this->timestamp === 'today') {
            $query->whereDate('start_date', Carbon::today());
        } elseif ($this->timestamp === 'upcoming') {
            $query->where('start_date', '>', Carbon::now());
        } elseif ($this->timestamp === 'ongoing') {
            $query->where('start_date', '<=', Carbon::now())
                ->whereRaw('DATE_ADD(start_date, INTERVAL duration_days DAY) >= NOW()');
        }

        $this->events = $query->orderByDesc('created_at')->limit(3)->get()->toArray();
        $this->notFound = empty($this->events);
    }

    public function render()
    {
        return view('livewire.admin.components.events-catalogue');
    }
}
