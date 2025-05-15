<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Events extends Component
{

    #[Layout('components.layouts.client', ['title' => 'Events'])]
    
    public function render()
    {
        return view('livewire.client.events');
    }
}
