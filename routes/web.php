<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasi;
use App\Http\Controllers\Admin\ProjekController as AdminProjek;
use App\Http\Controllers\Admin\JurnalController as AdminJurnal;
use App\Http\Controllers\Admin\HkiController as AdminHki;
use App\Http\Controllers\Admin\ProfilController as AdminProfil;
use App\Http\Controllers\Admin\SosmedController as AdminSosmed;
use App\Http\Controllers\Admin\PengalamanController as AdminPengalaman;
use App\Http\Controllers\Admin\UserController as AdminUser;

// ── Public ──
Route::get('/', [PublicController::class, 'index']);
Route::get('/cv', [PublicController::class, 'downloadCv'])->name('cv.download');

// ── Storage fallback (serves files through Laravel — works without symlink) ──
Route::get('/storage/{path}', [StorageController::class, 'serve'])
    ->where('path', '.*')
    ->name('storage.serve');

// ── Admin ──
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AdminAuth::class, 'showLogin'])
        ->name('login')->middleware('guest');
    Route::post('login', [AdminAuth::class, 'login'])
        ->name('login.post')->middleware('guest');
    Route::post('logout', [AdminAuth::class, 'logout'])
        ->name('logout')->middleware('auth');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('prestasi', AdminPrestasi::class)->except(['show']);
        Route::resource('projek', AdminProjek::class)->except(['show']);
        Route::resource('jurnal', AdminJurnal::class)->except(['show']);
        Route::resource('hki', AdminHki::class)->except(['show']);
        Route::resource('sosmed', AdminSosmed::class)->except(['show']);
        Route::resource('pengalaman', AdminPengalaman::class)->except(['show']);
        Route::resource('users', AdminUser::class)->except(['show']);
        Route::get('profil', [AdminProfil::class, 'edit'])->name('profil.edit');
        Route::put('profil', [AdminProfil::class, 'update'])->name('profil.update');
    });
});
