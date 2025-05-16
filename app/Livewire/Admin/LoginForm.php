<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
    public string $email = '';
    public string $password = '';

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        $this->addError('email', 'Invalid credentials.');
    }

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
    }

    public function render()
    {
        return view('livewire.admin.login-form');
    }
}
