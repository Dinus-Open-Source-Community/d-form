<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class StatCard extends Component
{
    public string $title;
    public int $count;
    public string $bgColor;
    
    public function render()
    {
        return view('livewire.admin.components.stat-card');
    }
}
