<?php

use App\Http\Controllers\Admin\McpKpk\AreaIntervensiController;
use App\Http\Controllers\Admin\McpKpk\DocumentSubIndikatorController;
use App\Http\Controllers\Admin\McpKpk\IndikatorController;
use App\Http\Controllers\Admin\McpKpk\SubIndikatorController;
use App\Http\Controllers\Admin\McpKpk\TindakLanjutController;
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
    if (Auth::guest()) {
        return view('home.pegawai');
    } else {
        return redirect()->route('home');
    }
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        /*
         * IMTAK PENGAWASAN
         */
        Route::prefix('imtak-pengawasan')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'index'])
                ->name('admin.imtak-pengawasan.index');
            Route::get('/request', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'request'])
                ->name('admin.imtak-pengawasan.request');
            Route::get('{id}/edit', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'edit'])
                ->name('admin.imtak-pengawasan.edit');
            Route::get('{id}/approve', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'approve'])
                ->name('admin.imtak-pengawasan.approve');
            Route::put('{id}', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'update'])
                ->name('admin.imtak-pengawasan.update');
            Route::delete('{id}', [App\Http\Controllers\Admin\ImtakPengawasanController::class, 'destroy'])
                ->name('admin.imtak-pengawasan.destroy');
        });

        Route::prefix('mcp-kpk')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\McpController::class, 'index'])
                ->name('admin.mcp-kpk.index');

            /*
             * MCP-KPK MASTER DATA
             */
            Route::resource('area-intervensi', AreaIntervensiController::class, ['as' => 'admin.mcp-kpk']);
            Route::resource('indikator', IndikatorController::class, ['as' => 'admin.mcp-kpk']);
            Route::get('sub-indikator/{sub_indikator}/show-doc', [DocumentSubIndikatorController::class, 'showSubIndikator'])
                ->name('admin.mcp-kpk.show-document');
            Route::post('sub-indikator/{sub_indikator}/show-doc', [DocumentSubIndikatorController::class, 'store'])
                ->name('admin.mcp-kpk.store-document');
            Route::delete('sub-indikator/{sub_indikator}/destroy/{mcp_document}', [DocumentSubIndikatorController::class, 'destroy'])
                ->name('admin.mcp-kpk.destroy-document');
            Route::resource('sub-indikator', SubIndikatorController::class, ['as' => 'admin.mcp-kpk']);

            /*
             * TINDAK LANJUT
             */
            Route::get('tindak-lanjut', [TindakLanjutController::class, 'index'])
                ->name('admin.mcp-kpk.tindak-lanjut.index');
            Route::get('proses-tindak-lanjut', [TindakLanjutController::class, 'proses_tindak_lanjut'])
                ->name('admin.mcp-kpk.tindak-lanjut.proses_tindak_lanjut');

        });

        /*
         * PEMANTAUAN TINDAK LANJUT
         */
        Route::prefix('pemantauan-tindak-lanjut')->group(function () {

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
        Route::resource(
            'imtak-pengawasan',
            \App\Http\Controllers\Pegawai\ImtakPengawasanController::class,
            ['except' => ['show'], 'as' => 'pegawai']
        );

        /*
         * PEMANTAUAN TINDAK LANJUT
         */
        Route::prefix('pemantauan-tindak-lanjut')->group(function () {
            Route::get('/', [App\Http\Controllers\Pegawai\PemantauanTindakLanjutController::class, 'index'])
                ->name('pemantauan-tindak-lanjut.index');

            Route::get('/tindak-lanjut', [App\Http\Controllers\Pegawai\PemantauanTindakLanjutController::class, 'tindak_lanjut'])
                ->name('tindak_lanjut');
            Route::get('/tindak-lanjut-create', [App\Http\Controllers\Pegawai\PemantauanTindakLanjutController::class, 'tindak_lanjut_create'])
                ->name('tindak_lanjut_create');
            Route::post('/tindak-lanjut-create', [App\Http\Controllers\Pegawai\PemantauanTindakLanjutController::class, 'tindak_lanjut_store'])
                ->name('tindak_lanjut_store');
        });

        /*
         * MCP KPK
         */
        Route::prefix('mcp-kpk')->group(function () {
            Route::get('/', [App\Http\Controllers\Pegawai\McpKpkController::class, 'index'])
                ->name('pegawai.mcp-kpk.index');
            Route::get('/upload-bukti', [App\Http\Controllers\Pegawai\McpKpkController::class, 'upload_bukti'])
                ->name('pegawai.mcp-kpk.upload_bukti');
            Route::post('/upload-bukti', [App\Http\Controllers\Pegawai\McpKpkController::class, 'store_upload_bukti'])
                ->name('pegawai.mcp-kpk.store_upload_bukti');
            Route::get('/delete-bukti', [App\Http\Controllers\Pegawai\McpKpkController::class, 'destroy_upload_bukti'])
                ->name('pegawai.mcp-kpk.destroy_upload_bukti');
        });
    });
});
