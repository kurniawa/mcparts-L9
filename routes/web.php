<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkspedisiBaru;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\EkspedisiEdit;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\NotaItemController;
use App\Http\Controllers\PelangganBaruController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganEditController;
use App\Http\Controllers\PelangganEkspedisiController;
use App\Http\Controllers\PelangganResellerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SjItemController;
use App\Http\Controllers\SpkBaruController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\SpkItemController;
use App\Http\Controllers\SrjalanController;
use App\Http\Controllers\TempSpkController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TreeController;
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

Route::get('/', function () {return view('home');})->name('Home');
Route::get('/home', function () {return view('home');})->name('Home');
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
    Route::get('/ekspedisi', "index")->name('Ekspedisis');
    Route::get('/ekspedisi/detail', 'ekspedisi_detail')->name('DetailEkspedisi')->middleware('auth');
});

// group route by controller. Dapat dilakukan mulai dari Laravel 9:
Route::controller(EkspedisiBaru::class)->group(function () {
    Route::get('/ekspedisi/ekspedisi-baru', "index")->name('NewEkspedisi')->middleware('auth');
    Route::post('/ekspedisi/ekspedisi-baru-db', "ekspedisi_baru_db")->name('NewEkspedisiDB')->middleware('auth');
});
Route::controller(EkspedisiEdit::class)->group(function () {
    Route::get('/ekspedisi/edit', "ekspedisi_edit")->name('EditEkspedisi')->middleware('auth');
    Route::post('/ekspedisi/edit-db', "ekspedisi_edit_db")->name('EditEkspedisiDB')->middleware('auth');
    Route::get('/ekspedisi/tambah_alamat', "tambah_alamat")->name('ekspedisi_tambah_alamat')->middleware('auth');
    Route::post('/ekspedisi/tambah_alamat_db', "tambah_alamat_db")->name('ekspedisi_tambah_alamat_db')->middleware('auth');
    Route::get('/ekspedisi/tambah_kontak', "tambah_kontak")->name('ekspedisi_tambah_kontak')->middleware('auth');
    Route::post('/ekspedisi/tambah_kontak_db', "tambah_kontak_db")->name('ekspedisi_tambah_kontak_db')->middleware('auth');
    Route::get('/ekspedisi/edit_alamat', "edit_alamat")->name('ekspedisi_edit_alamat')->middleware('auth');
    Route::post('/ekspedisi/edit_alamat_db', "edit_alamat_db")->name('ekspedisi_edit_alamat_db')->middleware('auth');
    Route::post('/ekspedisi/hapus_alamat', "hapus_alamat")->name('ekspedisi_hapus_alamat')->middleware('auth');
    Route::get('/ekspedisi/edit_kontak', "edit_kontak")->name('ekspedisi_edit_kontak')->middleware('auth');
    Route::post('/ekspedisi/edit_kontak_db', "edit_kontak_db")->name('ekspedisi_edit_kontak_db')->middleware('auth');
    Route::post('/ekspedisi/hapus_kontak', "hapus_kontak")->name('ekspedisi_hapus_kontak')->middleware('auth');
    Route::post('/ekspedisi/hapus', "ekspedisi_hapus")->name('HapusEkspedisi')->middleware('auth');
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
    Route::get('/spk', 'index')->name('SPK');
    Route::get('/spk/spk-detail', 'spk_detail')->name('SPK-Detail');
    Route::post('/spk/delete-item-from-spk-detail', 'delete_item_from_spk_detail')->middleware('auth');
    Route::get('/spk/edit-kop-spk', 'edit_kop_spk')->name('EditKopSPK')->middleware('auth');
    Route::post('/spk/edit-kop-spk-db', 'edit_kop_spk_db')->middleware('auth');
    Route::get('/spk/print-out-spk', 'print_out_spk')->name('PrintOutSPK')->middleware('auth');
    Route::post('/spk/hapus-spk', 'hapus_spk')->name('HapusSPK')->middleware('auth');
    Route::post('/spk/tetapkan-item-selesai-db', 'tetapkan_item_selesai_db')->middleware('auth');

});

Route::controller(SpkBaruController::class)->group(function ()
{
    Route::get('/spk/spk-baru', 'index')->name('SPKBaru')->middleware('auth');
    Route::post('/spk/spk-baru-db', 'SPKBaruDB')->name('SPKBaruDB')->middleware('auth');
    Route::get('/spk/spk_baru-spk_review', 'spk_review')->name('SPK-Review')->middleware('auth');
    Route::post('/spk/spkBaru-spkItem-editDelete', 'spkBaru_spkItem_editDelete')->middleware('auth');
    Route::post('/spk/proceed-spk', 'proceed_spk')->name('ProceedSPK')->middleware('auth');
    Route::get('/spk/SPK_AddItems', "SPK_AddItems")->name('SPK_AddItems')->middleware('auth');
    Route::post('/spk/SPK_AddItems-DB', "SPK_AddItems_DB")->name('SPK_AddItems-DB')->middleware('auth');
});

Route::controller(TempSpkController::class)->group(function ()
{
    Route::post('/temp_spk/hapus_temp_spk', "delete_temp_spk")->name('delete_temp_spk')->middleware('auth');
});

Route::controller(SpkItemController::class)->group(function ()
{
    Route::get('/spk/deviasi', 'deviasi')->name('Deviasi')->middleware('auth');
    Route::post('/spk/deviasi-db', 'deviasi_db')->name('DeviasiDB')->middleware('auth');
    Route::post('/spk/item-selesai-all', 'ItemSelesai_All')->name('ItemSelesai_All')->middleware('auth');
    // Route::post('/spk/item-selesai', 'ItemSelesai')->name('ItemSelesai')->middleware('auth');
    // ItemSelesai_DB diatur oleh DeviasiDB
    // Route::post('/spk/item-selesai-db', 'ItemSelesai_DB')->name('ItemSelesai_DB')->middleware('auth');
    Route::post('/spk/hapus-item-spk', 'hapusItemSPK')->name('hapusItemSPK')->middleware('auth');
});

Route::controller(TreeController::class)->group(function ()
{
    Route::get('/tree/tree', 'index')->name('Tree')->middleware('auth');
});

Route::controller(NotaController::class)->group(function ()
{
    Route::get('/nota', 'index');
    // Route::get('/nota/nota_baru-pilih_spk', 'notaBaru_pilihSPK')->middleware('auth');
    // Route::get('/nota/notaBaru-pSPK-pItem', 'notaBaru_pSPK_pItem')->middleware('auth');
    // Route::post('/nota/notaBaru-pSPK-pItem-DB', 'notaBaru_pSPK_pItem_DB')->middleware('auth');
    Route::get('/nota/NotaAll', 'NotaAll')->name('NotaAll')->middleware('auth');
    Route::post('/nota/NotaAll_DB', 'NotaAll_DB')->name('NotaAll_DB')->middleware('auth');
    Route::get('/nota/nota-detail', 'nota_detail')->name('Nota-Detail');
    Route::get('/nota/nota-print-out', 'nota_print_out')->name('PrintOutNota')->middleware('auth');
    Route::post('/nota/nota-hapus', 'nota_hapus')->middleware('auth');
    Route::get('/nota/edit-harga-item-nota', 'edit_harga_item_nota')->name('edit_harga_item_nota')->middleware('auth');
    Route::post('/nota/edit-harga-item-nota-DB', 'edit_harga_item_nota_db')->name('edit_harga_item_nota_db')->middleware('auth');
    // Route::post('/nota/hapus-item-nota', 'hapus_item_nota')->middleware('auth');
    // Route::get('/nota/tambah-item', 'tambah_item')->middleware('auth');
    // Route::get('/nota/tambah-item-pilih-item', 'tambah_item_pilih_item')->middleware('auth');
    // Route::post('/nota/tambah-item-db', 'tambah_item_db')->middleware('auth');
});

Route::controller(NotaItemController::class)->group(function ()
{
    // Route::get('/nota/NotaItemBaru', 'NotaItemBaru')->name('NotaItemBaru')->middleware('auth');
    Route::post('/nota/NotaItemBaru_DB', 'NotaItemBaru_DB')->name('NotaItemBaru_DB')->middleware('auth');
    // Route::get('/nota/NotaItemAva', 'NotaItemAva')->name('NotaItemAva')->middleware('auth');
    Route::post('/nota/NotaItemAva_DB', 'NotaItemAva_DB')->name('NotaItemAva_DB')->middleware('auth');
    Route::post('/nota/newSpkProN_to_avaN', 'newSpkProN_to_avaN')->name('newSpkProN_to_avaN')->middleware('auth');
    Route::post('/nota/editJmlSpkPN', 'editJmlSpkPN')->name('editJmlSpkPN')->middleware('auth');
    Route::post('/nota/delSpkPN', 'delSpkPN')->name('delSpkPN')->middleware('auth');
});

/**
 * SURAT JALAN
 */
Route::controller(SrjalanController::class)->group(function ()
{
    Route::get('/sj', 'index');
    // Route::get('/sj/sjBaru-pCust', 'sjBaru_pCust')->middleware('auth');
    // Route::get('/sj/sjBaru-pPelanggan-pProduk', 'sjBaru_pPelanggan_pProduk')->middleware('auth');
    // Route::post('/sj/sjBaru-pNota-pProduk-DB', 'sjBaru_pNota_pProduk_DB')->middleware('auth');
    Route::get('/sj/sj-detailSJ', 'sj_detailSJ')->name('SJ-Detail')->middleware('auth');
    Route::get('/sj/sj-printOut', 'sj_printOut')->name('SJ-PrintOut')->middleware('auth');
    Route::post('/sj/sj-hapus', 'sj_hapus')->middleware('auth');
    Route::get('/sj/SjAll', 'SjAll')->name('SjAll')->middleware('auth');
    Route::post('/sj/SjAll_DB', 'SjAll_DB')->name('SjAll_DB')->middleware('auth');
});

Route::controller(SjItemController::class)->group(function ()
{
    // Route::get('/srjalan/SjItemBaru', 'SjItemBaru')->name('SjItemBaru')->middleware('auth');
    Route::post('/srjalan/SjItemBaru_DB', 'SjItemBaru_DB')->name('SjItemBaru_DB')->middleware('auth');
    // Route::get('/srjalan/SjItemBaru_DB', 'SjItemBaru_DB')->name('SjItemBaru_DB')->middleware('auth');
    // Route::get('/srjalan/SjItemAva', 'SjItemAva')->name('SjItemAva')->middleware('auth');
    Route::post('/srjalan/SjItemAva_DB', 'SjItemAva_DB')->name('SjItemAva_DB')->middleware('auth');
    Route::post('/sj/editJmlSpkPNSJ', 'editJmlSpkPNSJ')->name('editJmlSpkPNSJ')->middleware('auth');
    // Route::get('/sj/editJmlSpkPNSJ', 'editJmlSpkPNSJ')->name('editJmlSpkPNSJ')->middleware('auth');
    Route::post('/sj/delSpkPNSJ', 'delSpkPNSJ')->name('delSpkPNSJ')->middleware('auth');
    // Route::get('/sj/delSpkPNSJ', 'delSpkPNSJ')->name('delSpkPNSJ')->middleware('auth');
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
    Route::get('/produk', 'index')->name('produks');
    Route::get('/produk/tipe-variasi', 'tipe_variasi');
    Route::get('/produk/tambah-produk', function () {return view('produk.tambah-produk');})->name('tambah-produk')->middleware('auth');
    Route::get('/produk/tambah-produk/{tipe}', 'tambahProduk')->name('tambahProduk')->middleware('auth');
    Route::post('/produk/tambah-produk-db', 'tambahProdukDB')->name('tambahProdukDB')->middleware('auth');
    Route::get('/produk/cek-produk', 'cekProduk')->name('cekProduk')->middleware('auth');
});

/**
 * AJAX CONTROLLER
 */
Route::get('/get-spesifikasi_produk', [ProdukController::class, 'getSpesifikasiProduk'])->name('getSpesifikasiProduk')->middleware('auth');
