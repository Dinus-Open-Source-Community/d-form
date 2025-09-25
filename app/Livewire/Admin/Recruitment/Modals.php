<?php

namespace App\Livewire\Admin\Recruitment;

use Livewire\Component;

class Modals extends Component
{
  public $showDetailModal = false;
  public $selectedRecruitment = null;
  public string $reviewAction = '';
  public string $reviewNote = '';
  public array $selectedIds = [];
  public string $bulkAction = '';
  public string $bulkNote = '';

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
