<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/doctors/{category}', [DoctorController::class, 'index']);
Route::get('/doctor/{id}', [DoctorController::class, 'show']);

Route::post('/debug-middleware', function () {
    return response()->json(request()->route()->gatherMiddleware());
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile']);
    Route::put('/profile', [ProfileController::class, 'updateProfile']);
    
    Route::get('/logs', [UserLogController::class, 'index']);
    Route::post('/logs', [UserLogController::class, 'store']);

    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/appointments/{id}', [AppointmentController::class, 'show']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::patch('/appointments/{id}/cancel', [AppointmentController::class, 'cancel']);
});