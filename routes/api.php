<?php

use App\Http\Controllers\Api\DocController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\RecruitmentController;
use App\Http\Controllers\Api\ParticipantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// System Routes
Route::get('/ping', [DocController::class, 'ping']);

// Event Routes
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::get('/{id}', [EventController::class, 'show']);
    Route::post('/', [EventController::class, 'store']);
    Route::put('/{id}', [EventController::class, 'update']);
    Route::delete('/{id}', [EventController::class, 'destroy']);
});

// Recruitment Routes
Route::prefix('recruitments')->group(function () {
    Route::get('/', [RecruitmentController::class, 'index']);
    Route::get('/statistics', [RecruitmentController::class, 'statistics']);
    Route::get('/division-statistics', [RecruitmentController::class, 'divisionStatistics']);
    Route::get('/{shortUuid}', [RecruitmentController::class, 'show']);
    Route::post('/', [RecruitmentController::class, 'store']);
    Route::put('/{shortUuid}', [RecruitmentController::class, 'update']);
    Route::patch('/{shortUuid}/review', [RecruitmentController::class, 'review']);
    Route::delete('/{shortUuid}', [RecruitmentController::class, 'destroy']);
});

// Participant Routes
Route::prefix('participants')->group(function () {
    Route::get('/', [ParticipantController::class, 'index']);
    Route::get('/{id}', [ParticipantController::class, 'show']);
    Route::post('/', [ParticipantController::class, 'store']);
    Route::put('/{id}', [ParticipantController::class, 'update']);
    Route::patch('/{id}/presence', [ParticipantController::class, 'markPresence']);
    Route::delete('/{id}', [ParticipantController::class, 'destroy']);
});
