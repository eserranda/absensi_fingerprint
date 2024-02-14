<?php

use App\Models\FingerprintGuru;
use App\Models\FingerprintSiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatpelController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\DataAbsensiGuruController;
use App\Http\Controllers\FingerprintGuruController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\DataAbsensiSiswaController;
use App\Http\Controllers\FingerprintModulController;
use App\Http\Controllers\FingerprintSiswaController;
use App\Http\Controllers\FingerprintStatusController;
use App\Http\Controllers\RoleController;

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

Route::get('/login', [AuthController::class, 'loginForm'])->name("login")->middleware('guest'); // Form login
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest'); // Login
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth'); // Login


Route::prefix('role')->controller(RoleController::class)->group(function () {
    Route::get('', 'index')->name("data_role.data");
    Route::POST('/store', 'store')->name("save_role");
    Route::delete('/delete/{id}', 'destroy')->name("delete_role");

    // Route::get('/data_matpel/getid/{id}', 'getID')->name("getid_data_matpel");
    // Route::POST('/update_data_matpel', 'update')->name("update_data_matpel");
    // Route::get('/get_data_matpel', 'getDataMatpel')->name("get_data_matpel");
});


Route::prefix('akun')->controller(UserController::class)->group(function () {
    Route::get('/siswa', 'akun_siswa')->name("akun_siswa");
    Route::get('/guru', 'akun_guru')->name("akun_guru");
    // Route::get('/add', 'addUser')->name("add_users");
    Route::post('/store_user_guru', 'storeUserGuru')->name("store_user_guru");
    Route::delete('/delete/{id}', 'destroy')->name("delete_users");

    Route::get('/data_user_guru', 'dataUserGuru')->name("data_user.guru");
    Route::get('/get_roles', 'roles')->name("data_user.roles");
});


Route::controller(MatpelController::class)->group(function () {
    Route::get('matpel', 'index')->name("data_matpel.data");
    Route::POST('/simpan_data_matpel', 'store')->name("simpan_data_matpel");
    Route::get('/data_matpel/getid/{id}', 'getID')->name("getid_data_matpel");
    Route::POST('/update_data_matpel', 'update')->name("update_data_matpel");
    Route::delete('/data_matpel/delete/{id}', 'destroy')->name("hapus_data_matpel");
    Route::get('/get_data_matpel', 'getDataMatpel')->name("get_data_matpel");
});


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
    Route::get('/get_nuptk_guru/{id}', 'getNUPTKGuru')->name("get_nuptk_guru");
});

Route::controller(DataSiswaController::class)->group(function () {
    Route::get('/data_siswa', 'index')->name("data_siswa.data");
    Route::POST('/simpan_data_siswa', 'store')->name("simpan_data_siswa");
    Route::POST('/update_data_siswa', 'update')->name("update_data_siswa");
    Route::get('/data_siswa/edit/{id}', 'edit')->name("simpan_data_siswa");
    Route::get('/data_siswa/getid/{id}', 'getID')->name("getid_data_siswa");
    Route::delete('/data_siswa/delete/{id}', 'destroy')->name("hapus_data_siswa");
    Route::get('/data_siswa_tes', 'tes');
    Route::get('/get_data_siswa', 'getDataSiswa')->name("get_data_siswa");
});

Route::controller(JadwalPelajaranController::class)->group(function () {
    Route::get('/jadwal_pelajaran', 'index')->name("jadwal_pelajaran.data");
    Route::get('/jadwal_pelajaran/getid/{id}', 'getID')->name("getid_jadwal_pelajaran");
    Route::POST('/simpan_jadwal_pelajaran', 'store')->name("simpan_jadwal_pelajaran");
    Route::POST('/jadwal_pelajaran/update_jadwal_pelajaran', 'update')->name("update_jadwal_pelajaran");
    Route::delete('/jadwal_pelajaran/delete/{id}', 'destroy')->name("hapus_jadwal_pelajaran");
});

Route::controller(KelasController::class)->group(function () {
    Route::get('/kelas', 'index')->name("kelas.data");
    Route::POST('/simpan_data_kelas', 'store')->name("simpan_data_kelas");
    Route::get('/data_kelas/getid/{id}', 'getID')->name("getid_data_kelas");
    Route::POST('/update_data_kelas', 'update')->name("update_data_kelas");
    Route::delete('/data_kelas/delete/{id}', 'destroy')->name("hapus_data_kelas");
    Route::get('/get_data_kelas', 'getDataKelas')->name("get_data_kelas");
});

Route::controller(FingerprintGuruController::class)->group(function () {
    Route::get('/fingerprint_guru', 'index')->name("fingerprint_guru.data");
    Route::get('/fingerprint_guru/add', 'create')->name("fingerprint_guru.add");
    Route::post('/fingerprint_guru/store', 'store')->name("fingerprint_guru.store");
    Route::delete('/fingerprint_guru/delete/{id}', 'destroy')->name("fingerprint_guru.delete");
});

Route::controller(FingerprintSiswaController::class)->group(function () {
    Route::get('/fingerprint_siswa', 'index')->name("fingerprint_siswa.data");
    Route::get('/fingerprint_siswa/add', 'create')->name("fingerprint_siswa.add");
    Route::post('/fingerprint_siswa/store', 'store')->name("fingerprint_siswa.store");
    Route::delete('/fingerprint_siswa/delete/{id}', 'destroy')->name("fingerprint_siswa.delete");
});

Route::controller(FingerprintModulController::class)->group(function () {
    Route::get('/fingerprint', 'index')->name("fingerprint.data");
    Route::post('/fingerprint/store', 'store')->name("fingerprint.store");
    Route::delete('/fingerprint/delete/{id}', 'destroy')->name("fingerprint.delete");

    Route::post('/finger-status/update-status', 'updateStatus')->name("fingerprint.update_status");
    Route::get('/fingerprint/get-finger-id/{apiKey}', 'getFingerID');
});

// Route::controller(FingerprintStatusController::class)->group(function () {
//     Route::post('/finger-status/update-status', 'updateStatus')->name("fingerprint.update_status");
// });