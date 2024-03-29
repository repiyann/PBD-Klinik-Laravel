<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
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

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('home', 'index')->name('home');
        Route::get('login', 'loginPage')->name('loginPage');
        Route::get('register', 'registerPage')->name('registerPage');
        Route::post('loginUser', 'loginUser')->name('loginUser');
        Route::post('createUser', 'create')->name('createUser');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(AppointmentController::class)->group(function () {
        Route::get('dashboard/records/{id}', 'getRecordData');
        Route::get('dashboard', 'showRecordAndDoctor')->name('dashboard');
        Route::get('dashboard/{service}', 'getAvailableDates');
        Route::get('dashboard/{service}/{date}', 'getAvailableDoctors');
        Route::post('dashboard/timeSlot', 'getAvailableTimes');
        Route::post('check', 'makeAppointment')->name('tesCok');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'viewProfile')->name('viewProfile');
        Route::put('profile/updateProfile', 'updateProfile')->name('updateProfile');
        Route::put('profile/updatePassword', 'updatePassword')->name('updatePassword');
        Route::delete('profile/deleteProfile', 'deleteAccount')->name('deleteAccount');
    });

    Route::controller(RecordController::class)->group(function () {
        Route::get('record', 'index')->name('viewRecord');
        Route::get('record/addRecord', 'create')->name('addRecord');
        Route::post('record/store', 'storeRecord')->name('storeRecord');
        Route::get('record/{recordId}/edit', 'editRecord')->name('editRecord');
        Route::put('record/{recordId}/update', 'updateRecord')->name('updateRecord');
        Route::delete('record/{recordId}/delete', 'deleteRecord')->name('deleteRecord');
    });
});
