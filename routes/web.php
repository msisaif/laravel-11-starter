<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::redirect('/admin', '/dashboard');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => view('dashboard'))->name('dashboard');

    Route::name('dashboard.')->group(function () {
        Route::get('/settings', [SettingController::class, 'form']);
        Route::put('/settings', [SettingController::class, 'save']);

        Route::resource('/users', UserController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
