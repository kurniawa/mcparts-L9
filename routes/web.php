<?php

use App\Http\Controllers\EkspedisiBaru;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\EkspedisiEdit;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('/about/about');
});

// PELANGGAN
Route::get('/pelanggan', [PelangganController::class, "index"]);
Route::get('/pelanggan/pelanggan-detail', [PelangganController::class, "pelanggan_detail"]);
Route::get('/pelanggan/pelanggan-baru', [PelangganController::class, "pelanggan_baru"])->middleware('auth');

/**
 * EKSPEDISI
 */
// Route::get('/ekspedisi', [EkspedisiController::class, "index"]);
Route::controller(EkspedisiController::class)->group(function () {
    Route::get('/ekspedisi', "index");
    Route::get('/ekspedisi/detail', 'ekspedisi_detail');
});
// group route by controller. Dapat dilakukan mulai dari Laravel 9:
Route::controller(EkspedisiBaru::class)->group(function () {
    Route::get('/ekspedisi/ekspedisi-baru', "index");
    Route::post('/ekspedisi/ekspedisi-baru-db', "ekspedisi_baru_db");
});
Route::controller(EkspedisiEdit::class)->group(function () {
    Route::get('/ekspedisi/edit', "ekspedisi_edit");
    Route::post('/ekspedisi/edit-db', "ekspedisi_edit_db");
    Route::post('/ekspedisi/hapus', "ekspedisi_hapus");
});
