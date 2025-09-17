<?php

namespace App\Livewire\Client\Components\Animations;

use Livewire\Component;

class BlurText extends Component
{
    public $text;
    public $animateBy;
    public $direction;
    public $class;

    public function mount($text, $animateBy = 'words', $direction = 'top', $class = '')
    {
        $this->text = $text;
        $this->animateBy = $animateBy;
        $this->direction = $direction;
        $this->class = $class;
    }

    public function render()
    {
        return view('livewire.client.components.animations.blur-text');
    }
}
