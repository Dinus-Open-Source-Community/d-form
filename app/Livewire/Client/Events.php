<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class Events extends Component
{
    #[Layout('components.layouts.client', ['title' => 'Events'])]
    #[Title('Events - D-Form')]
    
    public $search = '';
    public $categoryFilter = '';

    public function mount()
    {
        $this->search = request()->get('search', '');
        $this->categoryFilter = request()->get('category', '');
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->categoryFilter = '';
        // Jangan lakukan redirect di sini, biarkan Livewire yang update state
    }

    public function render()
    {
        return view('livewire.client.events');
    }
}