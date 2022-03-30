<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkspedisiBaru;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\EkspedisiEdit;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganBaruController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganEditController;
use App\Http\Controllers\PelangganEkspedisiController;
use App\Http\Controllers\RegisterController;
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

// LOGIN & REGISTER
Route::get('/login', [LoginController::class, "index"])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, "authenticate"]);
Route::get('/register', [RegisterController::class, "index"])->middleware('guest');
Route::post('/register', [RegisterController::class, "store"]);
Route::get('/dashboard', [DashboardController::class, "index"])->middleware('auth');

Route::post('/logout', [LoginController::class, "logout"])->middleware('auth');

// PELANGGAN
Route::controller(PelangganController::class)->group(function ()
{
    Route::get('/pelanggan', 'index');
    Route::get('/pelanggan/pelanggan-detail', 'pelanggan_detail');
});
Route::controller(PelangganBaruController::class)->group(function ()
{
   Route::get('/pelanggan/pelanggan-baru', 'pelanggan_baru')->middleware('auth');
   Route::post('/pelanggan/pelanggan-baru-db', 'create')->middleware('auth');
});
Route::controller(PelangganEditController::class)->group(function ()
{
   Route::get('/pelanggan/pelanggan-edit', 'pelanggan_edit')->middleware('auth');
   Route::post('/pelanggan/pelanggan-edit-db', 'edit_db')->middleware('auth');
   Route::post('/pelanggan/hapus', 'destroy')->middleware('auth');
});
// Route::delete('/pelanggan/hapus/{id}', PelangganEditController::class, 'destroy')->name('pelanggan.hapus');

/**
 * EKSPEDISI
 */
// Route::get('/ekspedisi', [EkspedisiController::class, "index"]);
Route::controller(EkspedisiController::class)->group(function () {
    Route::get('/ekspedisi', "index");
    Route::get('/ekspedisi/detail', 'ekspedisi_detail');
});

/**
 * PELANGGAN EKSPEDISI
 */
Route::controller(PelangganEkspedisiController::class)->group(function ()
{
    Route::get('pelanggan/pelanggan-ekspedisi', 'index');
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
