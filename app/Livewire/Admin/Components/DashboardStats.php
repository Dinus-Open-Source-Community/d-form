<?php

namespace App\Livewire\Admin\Components;

use App\Models\Event;
use Livewire\Component;

class DashboardStats extends Component
{
    public int $countOngoing = 0;
    public int $countUpcoming = 0;
    public int $countCompleted = 0;

    public function mount()
    {
        $this->countOngoing = $this->getEventCount('ongoing');
        $this->countUpcoming = $this->getEventCount('upcoming');
        $this->countCompleted = $this->getEventCount('completed');
    }

    protected function getEventCount(string $timestamp): int
    {
        $query = Event::query();

        switch ($timestamp) {
            case 'completed':
                $query->whereRaw("NOW() > DATE_ADD(start_date, INTERVAL duration_days DAY)");
                break;
            case 'ongoing':
                $query->whereRaw("NOW() >= start_date AND NOW() <= DATE_ADD(start_date, INTERVAL duration_days DAY)");
                break;
            case 'upcoming':
                $query->whereRaw("NOW() < start_date");
                break;
        }

        return $query->count();
    }

    public function render()
    {
        return view('livewire.admin.components.dashboard-stats');
    }
}
