<?php

namespace App\Livewire\Client\Layouts;

use Livewire\Component;

class Navbar extends Component
{
    public $isMenuOpen = false;
    
    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }
    
    public function render()
    {
        return view('livewire.client.layouts.navbar');
    }
}
