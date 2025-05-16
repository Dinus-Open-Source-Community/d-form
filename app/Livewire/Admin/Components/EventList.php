<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class EventList extends Component
{
    public bool $showToday = false;
    public bool $showOngoing = true;
    public bool $showUpcoming = true;
    public bool $showSeeAll = true;
    public bool $useQR = false;

    public function render()
    {
        return view('livewire.admin.components.event-list');
    }
}
