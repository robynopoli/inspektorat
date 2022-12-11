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

//Auth::routes();

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login_action'])->name('login.login_action');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    if (Auth::guest()){
        return view('home.pegawai');
    }else{
        return redirect()->route('home');
    }
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function (){

    Route::prefix('admin')->group(function () {

        /*
         * IMTAK PENGAWASAN
         */
        Route::prefix('imtak-pengawasan')->group(function (){
            Route::get('/', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'index'])
                ->name('admin.imtak-pengawasan.index');
            Route::get('/request', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'request'])
                ->name('admin.imtak-pengawasan.request');
            Route::get('{id}/edit', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'edit'])
                ->name('admin.imtak-pengawasan.edit');
            Route::put('{id}', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'update'])
                ->name('admin.imtak-pengawasan.update');
            Route::delete('{id}', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'destroy'])
                ->name('admin.imtak-pengawasan.destroy');
        });

        /*
         * PEMANTAUAN TINDAK LANJUT
         */
        Route::prefix('pemantauan-tindak-lanjut')->group(function (){

            Route::get('/', [App\Http\Controllers\Admin\PemantauanTindakLanjutController::class, 'index'])
                ->name('admin.pemantauan-tindak-lanjut.index');

            Route::get('/pengajuan_tl', [App\Http\Controllers\Admin\PemantauanTindakLanjutController::class, 'pengajuan_tindak_lanjut'])
                ->name('pengajuan_tl');
            Route::get('/pengajuan_tl/{id}', [App\Http\Controllers\Admin\PemantauanTindakLanjutController::class, 'pengajuan_tindak_lanjut_edit'])
                ->name('pengajuan_tl_edit');
            Route::post('/pengajuan_tl/{id}', [App\Http\Controllers\Admin\PemantauanTindakLanjutController::class, 'pengajuan_tindak_lanjut_update'])
                ->name('pengajuan_tl_update');


            /*
            * SETTING PEGAWAI DENGAN OBRIK
            */
            Route::get('/setting-pegawai', [App\Http\Controllers\Admin\SettingPegawaiController::class, 'index'])
                ->name('setting-pegawai.index');
            Route::get('/setting-pegawai/create', [App\Http\Controllers\Admin\SettingPegawaiController::class, 'create'])
                ->name('setting-pegawai.create');
            Route::post('/setting-pegawai', [App\Http\Controllers\Admin\SettingPegawaiController::class, 'store'])
                ->name('setting-pegawai.store');
            Route::get('/setting-pegawai/destroy', [App\Http\Controllers\Admin\SettingPegawaiController::class, 'destroy'])
                ->name('setting-pegawai.destroy');

        });

    });

    Route::prefix('pegawai')->group(function () {
        /*
        * IMTAK PENGAWASAN
        */
        Route::resource('imtak-pengawasan', \App\Http\Controllers\Pegawai\ImtakPengawasanController::class,
            ['except' => ['show'], 'as'=>'pegawai']);

        /*
         * PEMANTAUAN TINDAK LANJUT
         */
        Route::prefix('pemantauan-tindak-lanjut')->group(function (){
            Route::get('/', [App\Http\Controllers\Pegawai\PemantauanTindakLanjutController::class, 'index'])
                ->name('pemantauan-tindak-lanjut.index');

            Route::get('/tindak-lanjut', [App\Http\Controllers\Pegawai\PemantauanTindakLanjutController::class, 'tindak_lanjut'])
                ->name('tindak_lanjut');
            Route::get('/tindak-lanjut-create', [App\Http\Controllers\Pegawai\PemantauanTindakLanjutController::class, 'tindak_lanjut_create'])
                ->name('tindak_lanjut_create');
            Route::post('/tindak-lanjut-create', [App\Http\Controllers\Pegawai\PemantauanTindakLanjutController::class, 'tindak_lanjut_store'])
                ->name('tindak_lanjut_store');
        });
    });

});

