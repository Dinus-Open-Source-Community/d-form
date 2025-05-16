<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EventCreateAdmin;
use App\Livewire\Admin\EventDetailAdmin;
use App\Livewire\Admin\EventsAdmin;
use App\Livewire\Admin\LoginForm;
use App\Livewire\Admin\ScanQr;
use App\Livewire\Client\Home;
use App\Livewire\Client\Events;
use App\Livewire\Client\EventDetail;
use App\Livewire\Client\About;
use Illuminate\Support\Facades\Auth;
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
Route::get('/admin/login', LoginForm::class)->name('login');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth'],
    'as' => 'admin.'
], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/events', EventsAdmin::class)->name('events');
    Route::get('/events/create', EventCreateAdmin::class)->name('events-create');
    Route::get('/events/{eventId}', EventDetailAdmin::class)->name('event-detail');
    Route::get('/scanqr/{eventId}', ScanQr::class)->name('scanqr');
});
