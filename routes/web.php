<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LoginController;

// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('kelas/add', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('kelas/add', [KelasController::class, 'store'])->name('kelas.store');

    Route::get('kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::patch('kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('siswa/add', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('siswa/add', [SiswaController::class, 'store'])->name('siswa.store');

    Route::get('siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::patch('siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
});