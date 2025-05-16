<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Client\Home;
use App\Livewire\Client\Events;
use App\Livewire\Client\EventDetail;
use App\Livewire\Client\About;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->name('admin');

// Client routes
Route::group(
    [
        'as' => 'client.'
    ],
    function () {
        Route::get('/', Home::class)->name('home');
        Route::get('/events', Events::class)->name('events');
        Route::get('/events/{eventId}', EventDetail::class)->name('event-detail');
        Route::get('/about', About::class)->name('about');
    }
);

// Admin routes
Route::group([
    'prefix' => 'admin',
    // 'middleware' => 'auth',
    'as' => 'admin.'
], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});
