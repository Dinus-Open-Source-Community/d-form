<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class Recruitment extends Component
{
  #[Layout('components.layouts.client', ['title' => 'Recruitment'])]
  #[Title('Recruitment - D-Form')]

  public function render()
  {
    return view('livewire.client.recruitment');
  }
}
