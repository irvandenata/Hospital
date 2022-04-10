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

Route::get('/', function () {
    return redirect('/dashboard');
});
Route::resource('/data-asuh', App\Http\Controllers\RencanaAsuhanController::class);
Route::resource('/dashboard', App\Http\Controllers\DashboardController::class);

Route::resource('/diagnosa', App\Http\Controllers\DiagnosaController::class);
Route::resource('/luaran', App\Http\Controllers\LuaranController::class);
Route::resource('/intervensi', App\Http\Controllers\IntervensiController::class);

Route::get('generate-pdf/{id}', [App\Http\Controllers\PDFController::class, 'generatePDF']);
Route::get('generate-pdf/view/{id}', [App\Http\Controllers\PDFController::class, 'preview']);
Route::get('generate-pdf/print/{id}', [App\Http\Controllers\PDFController::class, 'preview']);
Route::group(['prefix' => '/api'], function () {
    Route::get('/penyebab/{id}', [App\Http\Controllers\ApiController::class, 'getPenyebab']);
    Route::get('/obj/{id}', [App\Http\Controllers\ApiController::class, 'getObj']);
    Route::get('/sbj/{id}', [App\Http\Controllers\ApiController::class, 'getSbj']);
    Route::get('/kriteria/{id}', [App\Http\Controllers\ApiController::class, 'getKriteria']);
    Route::get('/intervensi/{id}', [App\Http\Controllers\ApiController::class, 'getIntervensi']);

    //PENYEGBAB
    Route::post('/penyebab-table', [App\Http\Controllers\ApiController::class, 'getTablePenyebab']);
    Route::post('/simpan-penyebab', [App\Http\Controllers\ApiController::class, 'storePenyebab']);
    Route::delete('/hapus-penyebab/{id}', [App\Http\Controllers\ApiController::class, 'deletePenyebab']);
    Route::put('/update-penyebab/{id}', [App\Http\Controllers\ApiController::class, 'updatePenyebab']);

    //SUBJEKTIF
    Route::post('/subjektif-table', [App\Http\Controllers\ApiController::class, 'getTableSubjektif']);
    Route::post('/simpan-subjektif', [App\Http\Controllers\ApiController::class, 'storeSubjektif']);
    Route::delete('/hapus-subjektif/{id}', [App\Http\Controllers\ApiController::class, 'deleteSubjektif']);
    Route::put('/update-subjektif/{id}', [App\Http\Controllers\ApiController::class, 'updateSubjektif']);

    //OBJEKTIF
    Route::post('/objektif-table', [App\Http\Controllers\ApiController::class, 'getTableObjektif']);
    Route::post('/simpan-objektif', [App\Http\Controllers\ApiController::class, 'storeObjektif']);
    Route::delete('/hapus-objektif/{id}', [App\Http\Controllers\ApiController::class, 'deleteObjektif']);
    Route::put('/update-objektif/{id}', [App\Http\Controllers\ApiController::class, 'updateObjektif']);

    //KRITERIA
    Route::post('/kriteria-table', [App\Http\Controllers\ApiController::class, 'getTableKriteria']);
    Route::post('/simpan-kriteria', [App\Http\Controllers\ApiController::class, 'storeKriteria']);
    Route::put('/update-kriteria', [App\Http\Controllers\ApiController::class, 'updateKriteria']);
    Route::delete('/hapus-kriteria/{id}', [App\Http\Controllers\ApiController::class, 'deleteKriteria']);
    Route::put('/update-kriteria/{id}', [App\Http\Controllers\ApiController::class, 'updateKriteria']);

    //TERAPEUTIK
    Route::post('/terapeutik-table', [App\Http\Controllers\ApiController::class, 'getTableTerapeutik']);
    Route::post('/simpan-terapeutik', [App\Http\Controllers\ApiController::class, 'storeTerapeutik']);
    Route::put('/update-terapeutik', [App\Http\Controllers\ApiController::class, 'updateTerapeutik']);
    Route::delete('/hapus-terapeutik/{id}', [App\Http\Controllers\ApiController::class, 'deleteTerapeutik']);
    Route::put('/update-terapeutik/{id}', [App\Http\Controllers\ApiController::class, 'updateTerapeutik']);

    //KOLABORASI
    Route::post('/kolaborasi-table', [App\Http\Controllers\ApiController::class, 'getTableKolaborasi']);
    Route::post('/simpan-kolaborasi', [App\Http\Controllers\ApiController::class, 'storeKolaborasi']);
    Route::put('/update-kolaborasi', [App\Http\Controllers\ApiController::class, 'updateKolaborasi']);
    Route::delete('/hapus-kolaborasi/{id}', [App\Http\Controllers\ApiController::class, 'deleteKolaborasi']);
    Route::put('/update-kolaborasi/{id}', [App\Http\Controllers\ApiController::class, 'updateKolaborasi']);

    //OBSERVASI
    Route::post('/observasi-table', [App\Http\Controllers\ApiController::class, 'getTableObservasi']);
    Route::post('/simpan-observasi', [App\Http\Controllers\ApiController::class, 'storeObservasi']);
    Route::put('/update-observasi', [App\Http\Controllers\ApiController::class, 'updateObservasi']);
    Route::delete('/hapus-observasi/{id}', [App\Http\Controllers\ApiController::class, 'deleteObservasi']);
    Route::put('/update-observasi/{id}', [App\Http\Controllers\ApiController::class, 'updateObservasi']);

//EDUKASI
    Route::post('/edukasi-table', [App\Http\Controllers\ApiController::class, 'getTableEdukasi']);
    Route::post('/simpan-edukasi', [App\Http\Controllers\ApiController::class, 'storeEdukasi']);
    Route::put('/update-edukasi', [App\Http\Controllers\ApiController::class, 'updateEdukasi']);
    Route::delete('/hapus-edukasi/{id}', [App\Http\Controllers\ApiController::class, 'deleteEdukasi']);
    Route::put('/update-edukasi/{id}', [App\Http\Controllers\ApiController::class, 'updateEdukasi']);

});
