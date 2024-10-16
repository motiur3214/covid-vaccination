<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VaccinationCenterController;


Route::middleware('throttle:60,1')->get('/', [SearchController::class, 'index'])->name('search');


Route::get('/vaccination-centers', [VaccinationCenterController::class, 'index']);

Route::middleware(['throttle:60,1','auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/schedule-vaccination', [ScheduleController::class, 'store'])
        ->name('schedule.vaccination');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';




