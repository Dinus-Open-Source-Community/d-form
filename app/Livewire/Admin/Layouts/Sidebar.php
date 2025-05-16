<?php

namespace App\Livewire\Admin\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public bool $showMenu = false;

    public function toggleMenu()
    {
        $this->showMenu = !$this->showMenu;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    
    public function render()
    {
        return view('livewire.admin.layouts.sidebar');
    }
}
