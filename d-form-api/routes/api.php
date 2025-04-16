<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\ParticipantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::prefix('events')->group(function () {
            Route::get('/', [EventController::class, 'index']);
            Route::post('/', [EventController::class, 'store']);
            Route::get('{id}', [EventController::class, 'show']);
            Route::put('{id}', [EventController::class, 'update']);
            Route::delete('{id}', [EventController::class, 'destroy']);
        });

        Route::prefix('participants')->group(function () {
            Route::post('upload/{eventId}', [ParticipantController::class, 'uploadParticipants']);
            Route::get('download/{eventId}/{participantId?}', [ParticipantController::class, 'handleBarcodeDownload']);
        });
    });
});