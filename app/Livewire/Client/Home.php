<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Home extends Component
{
    
    #[Layout('components.layouts.client', ['title' => 'Welcome to D Form'])]

    public function render()
    {
        return view('livewire.client.home');
    }
}
