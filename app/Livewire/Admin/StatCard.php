<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class StatCard extends Component
{
    public string $title;
    public int $count;
    public string $bgColor;
    public ?string $icon = null;
    public ?string $subtitle = null;

    public function mount(string $title, int $count, string $bgColor, ?string $icon = null, ?string $subtitle = null)
    {
        $this->title = $title;
        $this->count = $count;
        $this->bgColor = $bgColor;
        $this->icon = $icon;
        $this->subtitle = $subtitle;
    }

    public function render()
    {
        return view('livewire.admin.components.stat-card');
    }
}