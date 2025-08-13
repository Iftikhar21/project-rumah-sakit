<?php

use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dktr.index');
});

Route::resource('dktr',DokterController::class);