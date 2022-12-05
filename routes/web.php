<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login_action'])->name('login.login_action');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect('home');
//    return view('welcome');
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tindak-lanjut', [App\Http\Controllers\HomeController::class, 'tindak_lanjut'])->name('tindak_lanjut');
Route::get('/tindak-lanjut-create', [App\Http\Controllers\HomeController::class, 'tindak_lanjut_create'])->name('tindak_lanjut_create');
Route::post('/tindak-lanjut-create', [App\Http\Controllers\HomeController::class, 'tindak_lanjut_store'])->name('tindak_lanjut_store');
Route::get('/pengajuan_tl', [App\Http\Controllers\HomeController::class, 'pengajuan_tl'])->name('pengajuan_tl');
Route::get('/pengajuan_tl/{id}', [App\Http\Controllers\HomeController::class, 'pengajuan_tl_edit'])->name('pengajuan_tl_edit');
Route::post('/pengajuan_tl/{id}', [App\Http\Controllers\HomeController::class, 'pengajuan_tl_update'])->name('pengajuan_tl_update');

Route::get('/setting-pegawai', [App\Http\Controllers\SettingPegawaiController::class, 'index'])->name('setting-pegawai.index');
Route::get('/setting-pegawai/create', [App\Http\Controllers\SettingPegawaiController::class, 'create'])->name('setting-pegawai.create');
Route::post('/setting-pegawai', [App\Http\Controllers\SettingPegawaiController::class, 'store'])->name('setting-pegawai.store');
Route::get('/setting-pegawai/destroy', [App\Http\Controllers\SettingPegawaiController::class, 'destroy'])->name('setting-pegawai.destroy');
