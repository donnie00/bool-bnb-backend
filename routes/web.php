<?php

use App\Http\Controllers\Api\Admin\ApartmentController;
use App\Http\Controllers\Api\ApartmentController as ApiApartmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// FOR TESTING

Route::middleware('auth')->group(function () {
    Route::get('/apartment/create', function(){
        return view('apartment.create');
    })->name('apartment.create');
    Route::post('/apartment/store',[ApartmentController::class,  'store'])->name('apartment.test.store');
    Route::get('/apartment/{id}/edit', [ApartmentController::class, "edit"])->name('apartment.edit');
    Route::get('/apartment/index',[ApartmentController::class, "index"])->name('apartment.index');
    Route::get("/apartment/{id}/show", [ApartmentController::class, "show"])->name('apartment.show');
    Route::post("/apartment/{id}/update", [ApartmentController::class, "update"])->name('apartment.update');
});



