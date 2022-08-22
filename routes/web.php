<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\BusastangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkspedisiBaru;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\EkspedisiEdit;
use App\Http\Controllers\InsertingGeneralController;
use App\Http\Controllers\JapstyleController;
use App\Http\Controllers\KombinasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PelangganBaruController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganEditController;
use App\Http\Controllers\PelangganEkspedisiController;
use App\Http\Controllers\PelangganResellerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\SpkBaruController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\SrjalanController;
use App\Http\Controllers\StandarController;
use App\Http\Controllers\StikerController;
use App\Http\Controllers\TankpadController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TsixpackController;
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

Route::get('/', function () {return view('home');})->name('home');
Route::get('/home', function () {return view('home');})->name('home');
Route::get('/about', function () {return view('about.about');});

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
    Route::get('/spk/spk-detail', 'spk_detail');
    Route::post('/spk/delete-item-from-spk-detail', 'delete_item_from_spk_detail')->middleware('auth');
    Route::get('/spk/edit-kop-spk', 'edit_kop_spk')->middleware('auth');
    Route::post('/spk/edit-kop-spk-db', 'edit_kop_spk_db')->middleware('auth');
    Route::post('/spk/print-out-spk', 'print_out_spk')->middleware('auth');
    Route::post('/spk/hapus-spk', 'hapus_spk')->middleware('auth');
    Route::get('/spk/tetapkan-item-selesai', 'tetapkan_item_selesai')->middleware('auth');
    Route::post('/spk/tetapkan-item-selesai-db', 'tetapkan_item_selesai_db')->middleware('auth');
});

Route::controller(SpkBaruController::class)->group(function ()
{
    Route::get('/spk/spk-baru', 'index');
    Route::get('/spk/spk_baru-spk_review', 'spk_review')->middleware('auth');
    Route::post('/spk/spkBaru-spkItem-editDelete', 'spkBaru_spkItem_editDelete')->middleware('auth');
    Route::post('/spk/proceed-spk', 'proceed_spk')->middleware('auth');
});
Route::controller(InsertingGeneralController::class)->group(function ()
{
    Route::get('/spk/inserting-general', "inserting_general")->middleware('auth');
    Route::post('/spk/inserting-general-db', "inserting_general_db")->middleware('auth');
});

Route::controller(NotaController::class)->group(function ()
{
    Route::get('/nota', 'index');
    Route::get('/nota/nota_baru-pilih_spk', 'notaBaru_pilihSPK')->middleware('auth');
    Route::get('/nota/notaBaru-pSPK-pItem', 'notaBaru_pSPK_pItem')->middleware('auth');
    Route::post('/nota/notaBaru-pSPK-pItem-DB', 'notaBaru_pSPK_pItem_DB')->middleware('auth');
    Route::get('/nota/nota-detail', 'nota_detail');
    Route::get('/nota/nota-print-out', 'nota_print_out');
    Route::post('/nota/nota-hapus', 'nota_hapus')->middleware('auth');
    Route::get('/nota/edit-item-nota', 'edit_item_nota')->middleware('auth');
    Route::post('/nota/edit-item-nota-DB', 'edit_item_nota_db')->middleware('auth');
    Route::post('/nota/hapus-item-nota', 'hapus_item_nota')->middleware('auth');
    Route::get('/nota/tambah-item', 'tambah_item')->middleware('auth');
    Route::get('/nota/tambah-item-pilih-item', 'tambah_item_pilih_item')->middleware('auth');
    Route::post('/nota/tambah-item-db', 'tambah_item_db')->middleware('auth');
});

/**
 * SURAT JALAN
 */
Route::controller(SrjalanController::class)->group(function ()
{
    Route::get('/sj', 'index');
    Route::get('/sj/sjBaru-pCust', 'sjBaru_pCust')->middleware('auth');
    Route::get('/sj/sjBaru-pPelanggan-pProduk', 'sjBaru_pPelanggan_pProduk')->middleware('auth');
    Route::post('/sj/sjBaru-pNota-pProduk-DB', 'sjBaru_pNota_pProduk_DB')->middleware('auth');
    Route::get('/sj/sj-detailSJ', 'sj_detailSJ');
    Route::get('/srjalan/srjalan-printOut', 'sj_printOut');
    Route::post('/srjalan/srjalan-hapus', 'sj_hapus')->middleware('auth');
});

/**
 * TESTING CONTROLLER
 */
Route::controller(TestController::class)->group(function ()
{
    Route::get('/test', 'index');
});

/**
 * PRODUK
 */
Route::controller(ProdukController::class)->group(function ()
{
    Route::get('/produk', 'index');
    Route::get('/produk/tipe-variasi', 'tipe_variasi');
    Route::get('/produk/tambah-produk', function () {return view('produk.tambah-produk');})->name('tambah-produk')->middleware('auth');
    Route::get('/produk/tambah-produk/{tipe}', 'tambahProduk')->name('tambahProduk')->middleware('auth');
    Route::post('/produk/tambah-produk-db', 'tambahProdukDB')->name('tambahProdukDB')->middleware('auth');
    Route::get('/produk/cek-produk', 'cekProduk')->name('cekProduk')->middleware('auth');
});

/**
 * AJAX CONTROLLER
 */
Route::get('/bahan-from-produk-id', [BahanController::class, "bahanFromProdukID"]);
Route::get('/specs-from-produk-id', [SpecController::class, 'specsFromProdukID']);
Route::get('/kombinasi-from-produk-id', [KombinasiController::class, 'kombinasiFromProdukID']);
Route::get('/tsixpack-from-produk-id', [TsixpackController::class, 'tsixpackFromProdukID']);
Route::get('/japstyle-from-produk-id', [JapstyleController::class, 'japstyleFromProdukID']);
Route::get('/motif-from-produk-id', [MotifController::class, 'motifFromProdukID']);
Route::get('/standar-from-produk-id', [StandarController::class, 'standarFromProdukID']);
Route::get('/tankpad-from-produk-id', [TankpadController::class, 'tankpadFromProdukID']);
Route::get('/stiker-from-produk-id', [StikerController::class, 'stikerFromProdukID']);
Route::get('/busastang-from-produk-id', [BusastangController::class, 'busastangFromProdukID']);
