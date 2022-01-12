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

Route::resource('/data-asuh', App\Http\Controllers\RencanaAsuhanController::class);
Route::get('generate-pdf/{id}', [App\Http\Controllers\PDFController::class, 'generatePDF']);
Route::get('generate-pdf/view/{id}', [App\Http\Controllers\PDFController::class, 'preview']);
Route::get('generate-pdf/print/{id}',  [App\Http\Controllers\PDFController::class, 'preview']);
Route::group(['prefix'=>'/api'],function(){
    Route::get('/penyebab/{id}',  [App\Http\Controllers\ApiController::class, 'getPenyebab']);
    Route::get('/obj/{id}',  [App\Http\Controllers\ApiController::class, 'getObj']);
    Route::get('/sbj/{id}',  [App\Http\Controllers\ApiController::class, 'getSbj']);
    Route::get('/kriteria/{id}',  [App\Http\Controllers\ApiController::class, 'getKriteria']);
    Route::get('/intervensi/{id}',  [App\Http\Controllers\ApiController::class, 'getIntervensi']);
});


