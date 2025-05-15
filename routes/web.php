<?php

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::group([
    'prefix' => 'admin',
    // 'middleware' => 'auth',
    'as' => 'admin.'
], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});
