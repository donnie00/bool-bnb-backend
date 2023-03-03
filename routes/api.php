<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\Admin\ApartmentController as AdminApartmentController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')
    ->get(
        '/user',
        function (Request $request) {
            return $request->user();
        }
    );


//Da gestire l'autenticazione
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('/apartments', AdminApartmentController::class)->except(
            'index',
            'show'
        );
    });

Route::resource('/apartments', ApartmentController::class)->only(
    'index',
    'show'
);
