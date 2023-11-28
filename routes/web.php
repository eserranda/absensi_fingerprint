<?php

use App\Http\Controllers\DataSiswaController;
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

Route::get('/', function () {
    return view('index');
});

Route::get('/data_guru', function () {
    return view('data_guru.data');
});


Route::controller(DataSiswaController::class)->group(function () {
    Route::get('/data_siswa', 'index');
    Route::POST('/simpan_data_siswa', 'store')->name("simpan_data_siswa");
});
