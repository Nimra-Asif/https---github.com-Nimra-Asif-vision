<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\TailorController;
use App\Http\Controllers\PackageController;

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

// Corrected route
Route::get('/', [WebController::class, 'index'])->name('homepage');
Route::get('/choice', [WebController::class, 'regChoice'])->name('choice');
Route::get('/tailors', [WebController::class, 'showTailors'])->name('tailor.all');




// tailor routes
Route::get('/register-tailor', [TailorController::class, 'showRegistrationForm'])->name('tailor.form');
Route::post('/register-tailor', [TailorController::class, 'registerAsTailor'])->name('tailor.register');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // packages routes
Route::get('/packages', [PackageController::class, 'pkgForm'])->name('packages.page');
Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
Route::get('/tailors/{id}', [WebController::class, 'showTailorProfile'])->name('tailor.show');
});
