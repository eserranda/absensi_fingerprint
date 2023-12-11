<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\DataAbsensiGuruController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\DataAbsensiSiswaController;

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


Route::controller(DataAbsensiSiswaController::class)->group(function () {
    Route::get('data_absensi_siswa', 'index')->name("data_absensi_siswa.data");
});

Route::controller(DataAbsensiGuruController::class)->group(function () {
    Route::get('/data_absensi_guru', 'index')->name("data_absensi_guru.data");
});

Route::controller(AbsensiController::class)->group(function () {
    Route::get('/absensi', 'index')->name("absensi.data");
    // Route::get('/dashboard/count_data', 'count_data')->name("dashboard.count_data");
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name("dashboard.data");
    Route::get('/dashboard', 'index')->name("dashboard.data");
    Route::get('/dashboard/count_data', 'count_data')->name("dashboard.count_data");
});

Route::controller(DataGuruController::class)->group(function () {
    Route::get('/data_guru', 'index')->name("data_guru.data");
    Route::POST('/simpan_data_guru', 'store')->name("simpan_data_guru");
    Route::get('/data_guru/getID/{id}', 'getID')->name("getid_data_guru");
    Route::POST('/update_data_guru', 'update')->name("update_data_guru");
    Route::delete('/data_guru/delete/{id}', 'destroy')->name("hapus_data_guru");
    Route::get('/get_data_guru', 'getDataGuru')->name("get_data_guru");
});

Route::controller(DataSiswaController::class)->group(function () {
    Route::get('/data_siswa', 'index')->name("data_siswa.data");
    Route::POST('/simpan_data_siswa', 'store')->name("simpan_data_siswa");
    Route::POST('/update_data_siswa', 'update')->name("update_data_siswa");
    Route::get('/data_siswa/edit/{id}', 'edit')->name("simpan_data_siswa");
    Route::get('/data_siswa/getid/{id}', 'getID')->name("getid_data_siswa");
    Route::delete('/data_siswa/delete/{id}', 'destroy')->name("hapus_data_siswa");
    Route::get('/data_siswa_tes', 'tes');
});

Route::controller(JadwalPelajaranController::class)->group(function () {
    Route::get('/jadwal_pelajaran', 'index')->name("jadwal_pelajaran.data");
    Route::POST('/simpan_jadwal_pelajaran', 'store')->name("simpan_jadwal_pelajaran");
    Route::delete('/jadwal_pelajaran/delete/{id}', 'destroy')->name("hapus_jadwal_pelajaran");
});
