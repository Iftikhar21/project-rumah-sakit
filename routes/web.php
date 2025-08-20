<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DokterController;

Route::get('/dokter', function () {
    return redirect()->route('dktr.index');
})->name('dokter');

Route::get('/landing', function () {
    return view('dktr.landing');
})->middleware('auth'); 

Route::get('/landingpage', [DokterController::class, 'landingpage'])->name('landing')->middleware('auth');

Route::resource('dktr',DokterController::class);


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('register', [LoginController::class, 'register'])->name('register');

Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::post('create', [LoginController::class, 'create'])->name('create');

Route::post('logout', [LoginController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');

Route::get('reset-password', [LoginController::class, 'resetPass'])->name('resetPass');

Route::post('forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');

Route::get('reset-password/{token}', [LoginController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('reset-password', [LoginController::class, 'resetPassword'])->name('password.update');

Route::get('profile', [LoginController::class, 'profile'])->name('profile')->middleware('auth');

Route::put('/profile/update-photo', [LoginController::class, 'updatePhoto'])->name('profile.updatePhoto')->middleware('auth');