<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Layout;

class About extends Component
{
    #[Layout('components.layouts.client', ['title' => 'About Us'])]
    
    public function render()
    {
        return view('livewire.client.about');
    }
}