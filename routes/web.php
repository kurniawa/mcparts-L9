<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkspedisiBaru;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\EkspedisiEdit;
use App\Http\Controllers\InsertingVariaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganBaruController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganEditController;
use App\Http\Controllers\PelangganEkspedisiController;
use App\Http\Controllers\PelangganResellerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpkBaruController;
use App\Http\Controllers\SpkController;
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
Route::controller(PelangganResellerController::class)->group(function ()
{
   Route::get('/pelanggan/tetapkan-reseller', 'index');
   Route::post('/pelanggan/tetapkan-reseller-db', 'tetapkan_reseller_db')->middleware('auth');
   Route::post('/pelanggan/hapus-reseller', 'hapus_reseller')->middleware('auth');
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

// group route by controller. Dapat dilakukan mulai dari Laravel 9:
Route::controller(EkspedisiBaru::class)->group(function () {
    Route::get('/ekspedisi/ekspedisi-baru', "index");
    Route::post('/ekspedisi/ekspedisi-baru-db', "ekspedisi_baru_db")->middleware('auth');
});
Route::controller(EkspedisiEdit::class)->group(function () {
    Route::get('/ekspedisi/edit', "ekspedisi_edit");
    Route::post('/ekspedisi/edit-db', "ekspedisi_edit_db")->middleware('auth');
    Route::post('/ekspedisi/hapus', "ekspedisi_hapus")->middleware('auth');
});

/**
 * PELANGGAN EKSPEDISI
 */
Route::controller(PelangganEkspedisiController::class)->group(function ()
{
    Route::get('/pelanggan/pelanggan-ekspedisi', 'index');
    Route::post('/pelanggan/tambah-ekspedisi-db', 'tambah_ekspedisi_db')->middleware('auth');
    Route::post('/pelanggan/hapus-relasi-ekspedisi', 'hapus_relasi_ekspedisi')->middleware('auth');
});


/**
 * SPK
 */
Route::controller(SpkController::class)->group(function ()
{
    Route::get('/spk', 'index');
});

Route::controller(SpkBaruController::class)->group(function ()
{
    Route::get('/spk/spk-baru', 'index');
    Route::get('/spk/spk_baru-inserting_spk_items', 'inserting_spk_items')->middleware('auth');
    Route::post('/spk/spk_baru-inserting_spk_items-db', "inserting_spk_items_db")->middleware('auth');
    Route::get('/spk/inserting_kombi', [SpkController::class, "inserting_kombi"])->middleware('auth');
    Route::get('/spk/inserting_std', [SpkController::class, "inserting_std"])->middleware('auth');
    Route::get('/spk/inserting_tankpad', [SpkController::class, "inserting_tankpad"])->middleware('auth');
    Route::get('/spk/inserting_busastang', [SpkController::class, "inserting_busastang"])->middleware('auth');
    Route::get('/spk/inserting_spjap', [SpkController::class, "inserting_spjap"])->middleware('auth');
    Route::get('/spk/inserting_stiker', [SpkController::class, "inserting_stiker"])->middleware('auth');
    Route::post('/spk/proceed_spk', [SpkBaru::class, "proceed_spk"])->middleware('auth');
});

Route::controller(InsertingVariaController::class)->group(function ()
{
    Route::get('/spk/inserting_varia', "inserting_varia")->middleware('auth');
});
Route::get('/spk/detail_spk', [DetailSPKController::class, "index"]);
Route::get('/spk/edit_spk_item', [DetailSPKController::class, "editSPKItem"])->middleware('auth');
Route::post('/spk/edit_spk_item-db', [EditSPKFDetail::class, "index"])->middleware('auth');
Route::post('/spk/hapus-SPK', [DetailSPKController::class, "hapus_SPK"])->middleware('auth');
Route::post('/spk/delete_spk_item', [EditSPKFDetail::class, "deleteSPKItem"])->middleware('auth');
Route::get('/spk/penetapan_item_selesai', [SPKItemSelesai::class, "index"])->middleware('auth');
Route::post('/spk/penetapan_item_selesai-db', [SPKItemSelesai::class, "setItemSelesai"])->middleware('auth');
// Print SPK
Route::get('/spk/print_out_spk', [PrintOutSPK::class, "index"]);
