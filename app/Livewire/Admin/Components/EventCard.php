<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class EventCard extends Component
{
    public array $event;
    
    public function render()
    {
        return view('livewire.admin.components.event-card');
    }
}
