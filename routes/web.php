<?php

use App\Http\Controllers\Admin\apartments\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Route::get('/Admin/dashboard', function () {
//     return view('Admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// FOR TESTING

Route::middleware(['auth', 'verified'])
    ->prefix("Admin")
    ->name("Admin.")
    ->group(function () {
        Route::get("/dashboard", [DashboardController::class, 'userInfo'])->name('dashboard');
        Route::get("/dashboard/messages", [DashboardController::class, 'userMessages'])->name('dashboard.messages');
        Route::resource("/apartments", ApartmentController::class);
    });
