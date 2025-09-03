<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\OperatorController;
use App\Models\Pasien;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Redirect routes
|--------------------------------------------------------------------------
*/

Route::get('/dokter', fn() => redirect()->route('dktr.index'))->name('dokter');
Route::get('/ruangan-view', fn() => redirect()->route('ruangan.index'))->name('ruangan');
Route::get('/pasien-view', fn() => redirect()->route('pasien.index'))->name('pasien');



// Pasien routes
Route::get('/pasien-view', [PasienController::class, 'index'])
    ->name('pasien-view')
    ->middleware('auth');
Route::get('/register-pasien', [PasienController::class, 'register'])->name('register-pasien');
Route::post('/action-register-pasien', [PasienController::class, 'actionRegister'])->name('action-register-pasien');
Route::middleware('auth')->group(function () {
    Route::get('pasien/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('pasien/update', [PasienController::class, 'update'])->name('pasien.update');
});
Route::get('/profile-pasien', [PasienController::class, 'profile'])->name('profile-pasien');
// Pasien - Kunjungan
Route::get('/kunjungan-view', [PasienController::class, 'kunjungan'])
    ->name('kunjungan-view')
    ->middleware('auth');
Route::get('/pasien/kunjungan/{id}', [PasienController::class, 'kunjunganDetail'])->name('kunjungan-view-detail');
Route::middleware('auth')->group(function () {
    Route::get('pasien/add-data-kunjungan-view', [PasienController::class, 'addDataKunjungan'])->name('pasien-add-data-kunjungan-view');
    Route::post('pasien/create-data-kunjungan', [PasienController::class, 'createDataKunjungan'])->name('pasien-add-data-kunjungan');
});
Route::middleware('auth')->group(function () {
    Route::get('pasien/edit-data-kunjungan-view/{id}', [PasienController::class, 'editDataKunjungan'])->name('pasien-edit-data-kunjungan-view');
    Route::put('pasien/update-data-kunjungan', [PasienController::class, 'updateDataKunjungan'])->name('pasien-edit-data-kunjungan');
});
Route::delete('/pasien/data-kunjungan/{id}', [PasienController::class, 'destroyDataKunjungan'])
    ->name('pasien-delete-data-kunjungan');
Route::patch('/pasien/batal-kunjungan/{id}', [PasienController::class, 'batalDataKunjungan'])
    ->name('pasien-batal-kunjungan');



// Operator routes
Route::get('/operator-view', [OperatorController::class, 'index'])
    ->name('operator-view')
    ->middleware('auth');

Route::get('/profile-operator', [OperatorController::class, 'profile'])->name('profile-operator');
Route::middleware('auth')->group(function () {
    Route::get('operator/edit', [OperatorController::class, 'edit'])->name('operator.edit');
    Route::put('operator/update', [OperatorController::class, 'update'])->name('operator.update');
});
// Operator - Pasien
Route::get('/data-pasien', [OperatorController::class, 'dataPasien'])->name('data-pasien');
Route::middleware('auth')->group(function () {
    Route::get('operator/add-data-pasien-view', [OperatorController::class, 'addDataPasien'])->name('operator-add-data-pasien-view');
    Route::post('operator/create-data-pasien', [OperatorController::class, 'createDataPasien'])->name('operator-add-data-pasien');
});
Route::middleware('auth')->group(function () {
    Route::get('operator/edit-data-pasien-view/{id}', [OperatorController::class, 'editDataPasien'])->name('operator-edit-data-pasien-view');
    Route::put('operator/update-data-pasien/{id}', [OperatorController::class, 'updateDataPasien'])->name('operator-edit-data-pasien');
});
Route::delete('/operator/data-pasien/{id}', [OperatorController::class, 'destroyDataPasien'])
    ->name('operator-delete-data-pasien');
Route::delete('/operator/data-pasien-all/{id}', [OperatorController::class, 'destroyAllDataPasien'])
    ->name('operator-delete-all-data-pasien');
// Operator - Dokter
Route::get('/data-dokter', [OperatorController::class, 'dataDokter'])->name('data-dokter');
Route::middleware('auth')->group(function () {
    Route::get('operator/add-data-dokter-view', [OperatorController::class, 'addDataDokter'])->name('operator-add-data-dokter-view');
    Route::post('operator/create-data-dokter', [OperatorController::class, 'createDataDokter'])->name('operator-add-data-dokter');
});
Route::middleware('auth')->group(function () {
    Route::get('operator/edit-data-dokter-view/{id}', [OperatorController::class, 'editDataDokter'])->name('operator-edit-data-dokter-view');
    Route::put('operator/update-data-dokter/{id}', [OperatorController::class, 'updateDataDokter'])->name('operator-edit-data-dokter');
});
Route::delete('/operator/data-dokter/{id}', [OperatorController::class, 'destroyDataDokter'])
    ->name('operator-delete-data-dokter');
Route::delete('/operator/data-dokter-all/{id}', [OperatorController::class, 'destroyAllDataDokter'])
    ->name('operator-delete-all-data-dokter');
// Operator - Ruangan
Route::get('/data-ruangan', [OperatorController::class, 'dataRuangan'])->name('data-ruangan');
Route::middleware('auth')->group(function () {
    Route::get('operator/add-data-ruangan-view', [OperatorController::class, 'addDataRuangan'])->name('operator-add-data-ruangan-view');
    Route::post('operator/create-data-ruangan', [OperatorController::class, 'createDataRuangan'])->name('operator-add-data-ruangan');
});
Route::middleware('auth')->group(function () {
    Route::get('operator/edit-data-ruangan-view/{id}', [OperatorController::class, 'editDataRuangan'])->name('operator-edit-data-ruangan-view');
    Route::post('operator/update-data-ruangan/{id}', [OperatorController::class, 'updateDataRuangan'])->name('operator-edit-data-ruangan');
});
Route::delete('/operator/data-ruangan/{id}', [OperatorController::class, 'destroyDataRuangan'])
    ->name('operator-delete-data-ruangan');
// Operator - Kunjungan
Route::get('/kunjungan-operator-view', [OperatorController::class, 'kunjunganOperator'])
    ->name('kunjungan-operator-view')
    ->middleware('auth');
Route::get('/operator/kunjungan/{id}', [OperatorController::class, 'kunjunganOperatorDetail'])->name('operator-kunjungan-view-detail');
Route::put('/operator/kunjungan/{id}/pilih-dokter', [OperatorController::class, 'pilihDokterKunjungan'])
    ->name('operator-pilih-dokter-kunjungan');
Route::put('/operator/kunjungan/{id}/setujui', [OperatorController::class, 'setujuiKunjungan'])
    ->name('operator-setujui-kunjungan');
Route::put('/operator/kunjungan/{id}/tolak', [OperatorController::class, 'tolakKunjungan'])
    ->name('operator-tolak-kunjungan');
Route::middleware('auth')->group(function () {
    Route::get('operator/edit-data-kunjungan-view/{id}', [OperatorController::class, 'editDataKunjungan'])->name('operator-edit-data-kunjungan-view');
    Route::post('operator/update-data-kunjungan/{id}', [OperatorController::class, 'updateDataKunjungan'])->name('operator-edit-data-kunjungan');
});



Route::get('/dokter-view', [DokterController::class, 'index'])
    ->name('dokter-view')
    ->middleware('auth');
Route::get('/profile-dokter', [DokterController::class, 'profile'])->name('profile-dokter');
Route::middleware('auth')->group(function () {
    Route::get('dokter/edit', [DokterController::class, 'edit'])->name('dokter-edit');
    Route::post('dokter/update', [DokterController::class, 'update'])->name('dokter-update');
});
Route::get('/kunjungan-view-dokter', [DokterController::class, 'kunjungan'])
    ->name('kunjungan-view-dokter')
    ->middleware('auth');
Route::get('/dokter/kunjungan/{id}', [DokterController::class, 'kunjunganDetail'])->name('kunjungan-dokter-view-detail');
Route::middleware('auth')->group(function () {
    Route::get('dokter/add-data-riwayat-view/{id}', [DokterController::class, 'addDataRiwayat'])->name('dokter-add-data-riwayat-view');
    Route::post('dokter/create-data-riwayat/{id}', [DokterController::class, 'createDataRiwayat'])->name('dokter-add-data-riwayat');
});
Route::middleware('auth')->group(function () {
    Route::get('dokter/edit-data-riwayat-view/{id}', [DokterController::class, 'editDataRiwayat'])->name('dokter-edit-data-riwayat-view');
    Route::put('dokter/update-data-riwayat/{id}', [DokterController::class, 'updateDataRiwayat'])->name('dokter-edit-data-riwayat');
});
/*
|--------------------------------------------------------------------------
| Protected routes (hanya untuk user login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Operator routes
    Route::get('/ruangan', function () {
        if (Auth::user()->role !== 'operator') {
            abort(403, 'Unauthorized');
        }
        return app(RuanganController::class)->index();
    })->name('ruangan.index');

    Route::get('/pasien', function () {
        if (Auth::user()->role !== 'operator') {
            abort(403, 'Unauthorized');
        }
        return app(PasienController::class)->index();
    })->name('pasien.index');

    // Dokter routes
    Route::get('/dokter-dashboard', function () {
        if (Auth::user()->role !== 'dokter') {
            abort(403, 'Unauthorized');
        }
        return app(DokterController::class)->index();
    })->name('dokter.dashboard');

    // Profile
    // Route::get('profile', [LoginController::class, 'profile'])->name('profile');
    Route::put('/profile/update-photo', [LoginController::class, 'updatePhoto'])->name('profile.updatePhoto');

    // Logout
    Route::post('logout', [LoginController::class, 'actionLogout'])->name('actionLogout');
});

/*
|--------------------------------------------------------------------------
| Public routes (bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/
Route::resource('dktr', DokterController::class)->only(['show']); // misalnya publik hanya bisa lihat
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::post('create', [LoginController::class, 'create'])->name('create');

// Reset password
Route::get('reset-password', [LoginController::class, 'resetPass'])->name('resetPass');
Route::post('forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [LoginController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
