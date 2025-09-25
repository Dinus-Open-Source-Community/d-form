<?php

namespace App\Http\Livewire\Admin\Recruitment;

use Livewire\Component;

class Modals extends Component
{
  public $showDetailModal = false;
  public $selectedRecruitment = null;

  protected $listeners = [
    'showDetail' => 'showDetail',
    'closeDetailModal' => 'closeDetailModal',
  ];

  public function showDetail($recruitment)
  {
    $this->selectedRecruitment = $recruitment;
    $this->showDetailModal = true;
  }

  public function closeDetailModal()
  {
    $this->showDetailModal = false;
    $this->selectedRecruitment = null;
  }

  public function render()
  {
    return view('livewire.admin.recruitment.modals');
  }
}
