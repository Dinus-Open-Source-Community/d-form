<?php

use App\Livewire\Admin\RecruitmentExportController;
use App\Livewire\Admin\RecruitmentConvert;
use App\Livewire\Client\RecruitmentForm;
use App\Livewire\Client\RecruitmentEditForm;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EventCreateAdmin;
use App\Livewire\Admin\EventDetailAdmin;
use App\Livewire\Admin\EventEditAdmin;
use App\Livewire\Admin\EventsAdmin;
use App\Livewire\Admin\CompletedEventsAdmin;
use App\Livewire\Admin\LoginForm;
use App\Livewire\Admin\ScanQr;
use App\Livewire\Client\Home;
use App\Livewire\Client\Events;
use App\Livewire\Client\EventDetail;
use App\Livewire\Client\About;
use App\Livewire\Client\Recruitment;
use App\Livewire\Client\RecruitmentEdit;
use Illuminate\Support\Facades\Route;

// Redirect /admin ke dashboard
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
        Route::get('/recruitment', Recruitment::class)->name('recruitment');
        Route::get('/recruitment/edit/{short_uuid}', RecruitmentEdit::class)->name('recruitment.edit');
        Route::get('/about', About::class)->name('about');
        Route::get('/test-mail', function () {
            return view('emails.recruitment.group-invite', [
                'nama_lengkap' => 'Contoh Nama',
                'short_uuid' => 'ABCDEFGH',
                'nim' => 'A11.2022.12345',
            ]);
        });
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

    // Event Management
    Route::get('/events', EventsAdmin::class)->name('events');
    Route::get('/events/create', EventCreateAdmin::class)->name('events-create');
    Route::get('/events/{eventId}', EventDetailAdmin::class)->name('event-detail');
    Route::get('/events/{eventId}/edit', EventEditAdmin::class)->name('event-edit');
    Route::get('/completed-events', CompletedEventsAdmin::class)->name('completed-events');
    Route::get('/scanqr/{eventId}', ScanQr::class)->name('scanqr');
    Route::get('/recruitment-convert', RecruitmentConvert::class)->name('recruitment-convert'); // <-- ini yang benar
});

Route::get('/admin/recruitments', function () {
    return view('admin.recruitments');
})->middleware(['auth'])->name('admin.recruitments');

// Route::get('/recruitments', RecruitmentForm::class)->name('client.recruitments');

// Route::get('/recruitments/edit/{short_uuid}', RecruitmentEditForm::class)->name('client.recruitments.edit');