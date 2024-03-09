<?php

use App\Models\JamAbsensi;
use GuzzleHttp\Middleware;
use App\Models\FingerprintGuru;
use App\Models\DataAbsensiSiswa;
use App\Models\FingerprintSiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatpelController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\JamAbsensiController;
use App\Http\Controllers\DataAbsensiGuruController;
use App\Http\Controllers\FingerprintGuruController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\DataAbsensiSiswaController;
use App\Http\Controllers\FingerprintModulController;
use App\Http\Controllers\FingerprintSiswaController;
use App\Http\Controllers\FingerprintStatusController;

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
Route::post('/login', [AuthController::class, 'authenticate'])->name("login")->middleware('guest'); // Login
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth'); // Login


Route::prefix('rekap-absensi-guru')->controller(DataAbsensiGuruController::class)->group(function () {
    Route::get("", 'index')->name("data_absensi_guru.data")->middleware('auth');
    Route::get('/absensi/{id}', 'show')->name("daftar_absensi.show");
    Route::POST('/store', 'store')->name("data_absensi_guru.store")->middleware('auth');

    Route::get('/edit/{id}', 'edit')->name("data_absensi_guru.edit");
    Route::POST('/update', 'update')->name("data_absensi_guru.update")->middleware('auth');

    Route::POST('/filter-bulan', 'filterAbsensi')->name("rekap-absensi-guru.filter-bulan")->middleware('auth');
    Route::delete('/delete/{id}', 'destroy')->name("hapus_rekap_absensi_guru")->middleware('auth');
});

Route::prefix('rekap-absensi-siswa')->controller(DataAbsensiSiswaController::class)->group(function () {
    Route::get("", 'index')->name("data_absensi_siswa.data")->middleware('auth');
    Route::get('/absensi/{id}', 'show')->name("daftar_absensi.show");
    Route::POST('/store', 'store')->name("data_absensi_siswa.store")->middleware('auth');
    Route::POST('/filter-bulan', 'filterAbsensi')->name("rekap-absensi-siswa.filter-bulan")->middleware('auth');
    Route::delete('/delete/{id}', 'destroy')->name("hapus_rekap_absensi_siswa")->middleware('auth');


    // Route::get('/data-absensi/{id}', 'absensi')->name("rekap-absensi-siswa.data-absensi")->middleware('auth');
    // Route::get('/count-absensi/{id}', 'countAbsensi')->name("rekap-absensi-siswa.count-absensi")->middleware('auth');

    // Route::POST('/store', 'store')->name("save_role")->middleware('auth');
    // Route::delete('/delete/{id}', 'destroy')->name("delete_role")->middleware('auth');
});


Route::prefix('role')->controller(RoleController::class)->group(function () {
    Route::get('', 'index')->name("data_role.data")->middleware('auth');
    Route::POST('/store', 'store')->name("save_role")->middleware('auth');
    Route::delete('/delete/{id}', 'destroy')->name("delete_role")->middleware('auth');
});


Route::prefix('akun')->controller(UserController::class)->group(function () {
    Route::get('/siswa', 'akun_siswa')->name("akun_siswa")->middleware('auth');
    Route::post('/store_user_siswa', 'storeUserSiswa')->name("store_user_siswa")->middleware('auth');
    Route::get('/data_user_siswa', 'dataUserSiswa')->name("data_user.siswa")->middleware('auth');
    Route::post('/update_akun_siswa', 'updateAkunSiswa')->name("update_data_siswa")->middleware('auth');

    Route::get('/guru', 'akun_guru')->name("akun_guru")->middleware('auth');
    Route::post('/store_user_guru', 'storeUserGuru')->name("store_user_guru")->middleware('auth');
    Route::get('/data_user_guru', 'dataUserGuru')->name("data_user.guru")->middleware('auth');
    Route::get('/get_roles', 'roles')->name("data_user.roles")->middleware('auth');
    Route::get('/show/{id}', 'show')->name("data_user.ids")->middleware('auth');

    Route::delete('/delete/{id}', 'destroy')->name("delete_users")->middleware('auth');
});


Route::controller(MatpelController::class)->group(function () {
    Route::get('matpel', 'index')->name("data_matpel.data")->middleware('auth');
    Route::POST('/simpan_data_matpel', 'store')->name("simpan_data_matpel")->middleware('auth');
    Route::get('/data_matpel/getid/{id}', 'getID')->name("getid_data_matpel")->middleware('auth');
    Route::POST('/update_data_matpel', 'update')->name("update_data_matpel")->middleware('auth');
    Route::delete('/data_matpel/delete/{id}', 'destroy')->name("hapus_data_matpel")->middleware('auth');
    Route::get('/get_data_matpel', 'getDataMatpel')->name("get_data_matpel")->middleware('auth');
});

Route::controller(AbsensiController::class)->group(function () {
    Route::get('/absensi', 'index')->name("absensi.data");
    // Route::get('/dashboard/count_data', 'count_data')->name("dashboard.count_data");
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name("dashboard.data")->middleware('auth');
    Route::get('/dashboard', 'index')->name("dashboard.data")->middleware('auth');
    Route::get('/dashboard/count_data', 'count_data')->name("dashboard.count_data")->middleware('auth');

    // Route::POST('/detail', 'detail')->name("daftar_absensi.detail");
});

Route::controller(DataGuruController::class)->group(function () {
    Route::get('/data_guru', 'index')->name("data_guru.data")->middleware('auth');
    Route::POST('/simpan_data_guru', 'store')->name("simpan_data_guru")->middleware('auth');
    Route::get('/data_guru/getID/{id}', 'getID')->name("getid_data_guru")->middleware('auth');
    Route::POST('/update_data_guru', 'update')->name("update_data_guru")->middleware('auth');
    Route::delete('/data_guru/delete/{id}', 'destroy')->name("hapus_data_guru")->middleware('auth');
    Route::get('/get_data_guru', 'getDataGuru')->name("get_data_guru")->middleware('auth');
    Route::get('/get_nuptk_guru/{id}', 'getNUPTKGuru')->name("get_nuptk_guru")->middleware('auth');
});

Route::controller(DataSiswaController::class)->group(function () {
    Route::get('/data_siswa', 'index')->name("data_siswa.data")->middleware('auth');
    Route::POST('/simpan_data_siswa', 'store')->name("simpan_data_siswa")->middleware('auth');
    Route::POST('/update_data_siswa', 'update')->name("update_data_siswa")->middleware('auth');
    Route::get('/data_siswa/edit/{id}', 'edit')->name("simpan_data_siswa")->middleware('auth');
    Route::get('/data_siswa/getid/{id}', 'getID')->name("getid_data_siswa")->middleware('auth');

    Route::get('/siswa/get_kelas_siswa/{id}', 'getKelasSiswa')->name("get_kelas_siswa")->middleware('auth');

    Route::delete('/data_siswa/delete/{id}', 'destroy')->name("hapus_data_siswa")->middleware('auth');
    Route::get('/data_siswa_tes', 'tes');
    Route::get('/get_data_siswa', 'getDataSiswa')->name("get_data_siswa")->middleware('auth');
    Route::get('/get_nisn_siswa/{id}', 'getNISNSiswa')->name("get_nisn_siswa")->middleware('auth');
});

Route::controller(JadwalPelajaranController::class)->group(function () {
    Route::get('/jadwal_pelajaran', 'index')->name("jadwal_pelajaran.data")->middleware('auth');
    Route::get('/jadwal_pelajaran/getid/{id}', 'getID')->name("getid_jadwal_pelajaran")->middleware('auth');
    Route::POST('/simpan_jadwal_pelajaran', 'store')->name("simpan_jadwal_pelajaran")->middleware('auth');
    Route::POST('/jadwal_pelajaran/update_jadwal_pelajaran', 'update')->name("update_jadwal_pelajaran")->middleware('auth');
    Route::delete('/jadwal_pelajaran/delete/{id}', 'destroy')->name("hapus_jadwal_pelajaran")->middleware('auth');
});

Route::controller(KelasController::class)->group(function () {
    Route::get('/kelas', 'index')->name("kelas.data")->middleware('auth');
    Route::get('/get_all_data_kelas', 'getAll')->name("get_all_data_kelas")->middleware('auth');
    Route::POST('/simpan_data_kelas', 'store')->name("simpan_data_kelas")->middleware('auth');
    Route::get('/data_kelas/getid/{id}', 'getID')->name("getid_data_kelas")->middleware('auth');
    Route::POST('/update_data_kelas', 'update')->name("update_data_kelas")->middleware('auth');
    Route::delete('/data_kelas/delete/{id}', 'destroy')->name("hapus_data_kelas")->middleware('auth');

    Route::get('/get_data_kelas', 'getDataKelas')->name("get_data_kelas")->middleware('auth'); // kayaknya tidak terpakai
});

Route::controller(JamAbsensiController::class)->group(function () {
    Route::get('/jam_absensi', 'index')->name("jam_absensi.data")->middleware('auth');
    Route::POST('/simpan_data_jam_absensi', 'store')->name("simpan_data_jam_absensi")->middleware('auth');
    Route::get('/jam_absensi/getid/{id}', 'getID')->name("getid_data_kelas")->middleware('auth');
    Route::POST('/update_jam_absensi', 'update')->name("update_jam_absensi")->middleware('auth');
    Route::delete('/jam_absensi/delete/{id}', 'destroy')->name("hapus_jam_absensi")->middleware('auth');
    // Route::get('/get_data_kelas', 'getDataKelas')->name("get_data_kelas")->middleware('auth');
});

Route::controller(FingerprintGuruController::class)->group(function () {
    Route::get('/fingerprint_guru', 'index')->name("fingerprint_guru.data")->middleware('auth');
    Route::get('/fingerprint_guru/add', 'create')->name("fingerprint_guru.add")->middleware('auth');
    Route::post('/fingerprint_guru/store', 'store')->name("fingerprint_guru.store")->middleware('auth');
    Route::delete('/fingerprint_guru/delete/{id}', 'destroy')->name("fingerprint_guru.delete")->middleware('auth');
});

Route::controller(FingerprintSiswaController::class)->group(function () {
    Route::get('/fingerprint_siswa', 'index')->name("fingerprint_siswa.data")->middleware('auth');
    Route::get('/fingerprint_siswa/add', 'create')->name("fingerprint_siswa.add")->middleware('auth');

    Route::get('/fingerprint_siswa/detail/{id}', 'show')->name("fingerprint_siswa.detail")->middleware('auth');

    Route::post('/fingerprint_siswa/store', 'store')->name("fingerprint_siswa.store")->middleware('auth');
    Route::delete('/fingerprint_siswa/delete/{id}', 'destroy')->name("fingerprint_siswa.delete")->middleware('auth');

    Route::post('/fingerprint_moduls/deleted_id', 'deleted_id')->name("fingerprint_deleted_id")->middleware('auth');
    Route::get('/fingerprint_moduls/status_deleted/{modul}/{id_finger}', 'status_deleted')->name("fingerprint_status_deleted")->middleware('auth');
});

Route::controller(FingerprintModulController::class)->group(function () {
    Route::get('/fingerprint', 'index')->name("fingerprint.data")->middleware('auth');
    Route::post('/fingerprint/store', 'store')->name("fingerprint.store")->middleware('auth');
    Route::delete('/fingerprint/delete/{id}', 'destroy')->name("fingerprint.delete")->middleware('auth');

    Route::post('/finger-status/update-status-finger-guru', 'updateStatusFingerGuru')->name("fingerprint.update_status")->middleware('auth');
    Route::post('/finger-status/update-status-finger-siswa', 'updateStatusFingerSiswa')->name("fingerprint.update_status")->middleware('auth');
    Route::get('/fingerprint/get-finger-id/{apiKey}', 'getFingerID')->middleware('auth');
    Route::get('/fingerprint/get-finger-id-siswa/{apiKey}', 'getFingerIDSiswa')->middleware('auth');
});

// Route::controller(FingerprintStatusController::class)->group(function () {
//     Route::post('/finger-status/update-status', 'updateStatus')->name("fingerprint.update_status")->middleware('auth');
// });