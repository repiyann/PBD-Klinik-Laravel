<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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

// 2 kode di bawah untuk check role dan hanya bisa membuka halaman dashboard sesuai role masing-masing
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'loginPage')->name('loginPage');
    Route::get('register', 'registerPage')->name('registerPage');
    Route::post('loginUser', 'login')->name('loginUser');
    Route::post('createUser', 'create')->name('createUser');
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'viewProfile')->name('viewProfile');
    });
});