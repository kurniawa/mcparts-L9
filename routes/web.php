<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkspedisiAlamatController;
use App\Http\Controllers\EkspedisiBaru;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\EkspedisiEdit;
use App\Http\Controllers\EkspedisiKontakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\NotaDetailController;
use App\Http\Controllers\NotaItemController;
use App\Http\Controllers\PelangganAlamatController;
use App\Http\Controllers\PelangganBaruController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganEditController;
use App\Http\Controllers\PelangganEkspedisiController;
use App\Http\Controllers\PelangganKontakController;
use App\Http\Controllers\PelangganResellerController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukSpecController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SjDetailController;
use App\Http\Controllers\SjItemController;
use App\Http\Controllers\SpkBaruController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\SpkItemController;
use App\Http\Controllers\SrjalanController;
use App\Http\Controllers\TempSpkController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->group(function ()
{
    Route::get('/', 'home')->name('Home');
    Route::get('/home', 'home');
    Route::get('/about', 'about')->name('About');
    Route::get('/admin', 'adminControlCenter')->name('adminControlCenter')->middleware('admin');
    Route::get('/page-in-dev', 'pageInDev')->name('pageInDev')->middleware('admin');
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
    Route::get('/pelanggan', 'index')->name('Pelanggans');
    Route::get('/pelanggan/pelanggan-detail', 'pelanggan_detail')->name('pelanggan_detail')->middleware('auth');
});
Route::controller(PelangganBaruController::class)->group(function ()
{
   Route::get('/pelanggan/pelanggan-baru', function (){return view('pelanggan.pelanggan-baru');})->name('pelanggan_baru')->middleware('auth');
   Route::post('/pelanggan/pelanggan-baru-db', 'create')->name('pelanggan_baru_db')->middleware('auth');
});
Route::controller(PelangganEditController::class)->group(function ()
{
   Route::get('/pelanggan/pelanggan-edit', 'pelanggan_edit')->name('pelanggan_edit')->middleware('auth');
   Route::post('/pelanggan/pelanggan-edit-db', 'edit_db')->name('pelanggan_edit_db')->middleware('auth');
   Route::post('/pelanggan/hapus', 'destroy')->name('pelanggan_hapus')->middleware('auth');
});
Route::controller(PelangganResellerController::class)->group(function ()
{
   Route::get('/pelanggan/tambah-reseller', 'index')->name('pelanggan_tambah_reseller')->middleware('auth');
   Route::post('/pelanggan/tambah-reseller-db', 'tambah_reseller_db')->middleware('auth');
   Route::post('/pelanggan/hapus-reseller', 'hapus_reseller')->middleware('auth');
});
Route::controller(PelangganAlamatController::class)->group(function ()
{
   Route::get('/pelanggan/edit-alamat', 'edit_alamat')->name('pelanggan_edit_alamat')->middleware('auth');
   Route::post('/pelanggan/edit-alamat-db', 'edit_alamat_db')->name('pelanggan_edit_alamat_db')->middleware('auth');
   Route::get('/pelanggan/tambah-alamat', 'tambah_alamat')->name('pelanggan_tambah_alamat')->middleware('auth');
   Route::post('/pelanggan/tambah-alamat', 'tambah_alamat_db')->name('pelanggan_tambah_alamat_db')->middleware('auth');
   Route::post('/pelanggan/hapus-alamat', 'hapus_alamat')->name('pelanggan_hapus_alamat')->middleware('auth');
});
Route::controller(PelangganKontakController::class)->group(function ()
{
   Route::get('/pelanggan/edit-kontak', 'edit_kontak')->name('pelanggan_edit_kontak')->middleware('auth');
   Route::post('/pelanggan/edit-kontak-db', 'edit_kontak_db')->name('pelanggan_edit_kontak_db')->middleware('auth');
   Route::get('/pelanggan/tambah-kontak', 'tambah_kontak')->name('pelanggan_tambah_kontak')->middleware('auth');
   Route::post('/pelanggan/tambah-kontak-db', 'tambah_kontak_db')->name('pelanggan_tambah_kontak_db')->middleware('auth');
   Route::post('/pelanggan/hapus-kontak', 'hapus_kontak')->name('pelanggan_hapus_kontak')->middleware('auth');
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
    Route::post('/ekspedisi/hapus', "ekspedisi_hapus")->name('HapusEkspedisi')->middleware('auth');
});
Route::controller(EkspedisiAlamatController::class)->group(function ()
{
    Route::get('/ekspedisi/tambah_alamat', "tambah_alamat")->name('ekspedisi_tambah_alamat')->middleware('auth');
    Route::post('/ekspedisi/tambah_alamat_db', "tambah_alamat_db")->name('ekspedisi_tambah_alamat_db')->middleware('auth');
    Route::get('/ekspedisi/edit_alamat', "edit_alamat")->name('ekspedisi_edit_alamat')->middleware('auth');
    Route::post('/ekspedisi/edit_alamat_db', "edit_alamat_db")->name('ekspedisi_edit_alamat_db')->middleware('auth');
    Route::post('/ekspedisi/hapus_alamat', "hapus_alamat")->name('ekspedisi_hapus_alamat')->middleware('auth');
});
Route::controller(EkspedisiKontakController::class)->group(function ()
{
    Route::get('/ekspedisi/tambah_kontak', "tambah_kontak")->name('ekspedisi_tambah_kontak')->middleware('auth');
    Route::post('/ekspedisi/tambah_kontak_db', "tambah_kontak_db")->name('ekspedisi_tambah_kontak_db')->middleware('auth');
    Route::get('/ekspedisi/edit_kontak', "edit_kontak")->name('ekspedisi_edit_kontak')->middleware('auth');
    Route::post('/ekspedisi/edit_kontak_db', "edit_kontak_db")->name('ekspedisi_edit_kontak_db')->middleware('auth');
    Route::post('/ekspedisi/hapus_kontak', "hapus_kontak")->name('ekspedisi_hapus_kontak')->middleware('auth');
});

/**
 * PELANGGAN EKSPEDISI
 */
Route::controller(PelangganEkspedisiController::class)->group(function ()
{
    Route::get('/pelanggan/tambah-ekspedisi', 'index')->name('pelanggan_tambah_ekspedisi')->middleware('auth');
    Route::post('/pelanggan/tambah-ekspedisi-db', 'tambah_ekspedisi_db')->name('pelanggan_tambah_ekspedisi_db')->middleware('auth');
    Route::post('/pelanggan/hapus-relasi-ekspedisi', 'hapus_relasi_ekspedisi')->middleware('auth');
    Route::get('/pelanggan/pelanggan-ekspedisi-edit', 'pelanggan_ekspedisi_edit')->name('pelanggan_ekspedisi_edit')->middleware('auth');
    Route::get('/pelanggan/pelanggan-ekspedisi-hapus', 'pelanggan_ekspedisi_hapus')->name('pelanggan_ekspedisi_hapus')->middleware('auth');
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
    Route::get('/temp_spk/spk-seeder', "SPKSeeder")->name('SPKSeeder')->middleware('auth');
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
    Route::get('/spk/spk-selesai', 'spkSelesai')->name('spkSelesai')->middleware('auth');
    Route::post('/spk/spk-selesai-db', 'spkSelesaiDB')->name('spkSelesaiDB')->middleware('auth');
    Route::post('/spk/spk-fix-data', 'spkFixData')->name('spkFixData')->middleware('auth');
});

Route::controller(TreeController::class)->group(function ()
{
    Route::get('/tree/tree', 'index')->name('Tree')->middleware('auth');
    Route::get('/tree/tree2', 'index2')->name('Tree2')->middleware('auth');
});

Route::controller(NotaController::class)->group(function ()
{
    Route::get('/nota', 'index')->name('daftar_nota');
    Route::get('/nota/NotaAll', 'NotaAll')->name('NotaAll')->middleware('auth');
    Route::post('/nota/NotaAll_DB', 'NotaAll_DB')->name('NotaAll_DB')->middleware('auth');
    Route::get('/nota/nota-detail', 'nota_detail')->name('Nota-Detail');
    Route::get('/nota/nota-print-out', 'nota_print_out')->name('PrintOutNota')->middleware('auth');
    Route::post('/nota/nota-hapus', 'nota_hapus')->middleware('auth')->name('hapusNota');
    Route::get('/nota/edit-harga-item-nota', 'edit_harga_item_nota')->name('edit_harga_item_nota')->middleware('auth');
    Route::post('/nota/edit-harga-item-nota-input-baru', 'edit_harga_item_nota_input_baru')->name('edit_harga_item_nota_input_baru')->middleware('auth');
    Route::post('/nota/edit-harga-item-nota-pilih-dari-histori', 'edit_harga_item_nota_pilih_dari_histori')->name('edit_harga_item_nota_pilih_dari_histori')->middleware('auth');
});

Route::controller(NotaItemController::class)->group(function ()
{
    Route::post('/nota/NotaItemBaru_DB', 'NotaItemBaru_DB')->name('NotaItemBaru_DB')->middleware('auth');
    Route::post('/nota/NotaItemAva_DB', 'NotaItemAva_DB')->name('NotaItemAva_DB')->middleware('auth');
    Route::post('/nota/newSpkProN_to_avaN', 'newSpkProN_to_avaN')->name('newSpkProN_to_avaN')->middleware('auth');
    Route::post('/nota/editJmlSpkPN', 'editJmlSpkPN')->name('editJmlSpkPN')->middleware('auth');
    Route::post('/nota/delSpkPN', 'delSpkPN')->name('delSpkPN')->middleware('auth');
    Route::get('/nota/edit-nama-item-nota', 'edit_nama_item_nota')->name('edit_nama_item_nota')->middleware('auth');
    Route::post('/nota/input-nama-nota_item', 'input_nama_nota_item')->name('input_nama_nota_item')->middleware('auth');
    Route::post('/nota/pilih-nama-nota_item', 'pilih_nama_nota_item')->name('pilih_nama_nota_item')->middleware('auth');
});

Route::controller(NotaDetailController::class)->group(function ()
{
    Route::post('/nota/delItNoFrDet', 'delItNoFrDet')->name('delItNoFrDet')->middleware('auth');
    Route::get('/nota/notaSelesai', 'notaSelesai')->name('notaSelesai')->middleware('auth');
    Route::post('/nota/notaSelesaiDB', 'notaSelesaiDB')->name('notaSelesaiDB')->middleware('auth');
    Route::get('/nota/assign-alamat', 'notaDetail_assignAlamat')->name('notaDetail_assignAlamat')->middleware('auth');
    Route::post('/nota/assign-alamat-db', 'notaDetail_assignAlamatDB')->name('notaDetail_assignAlamatDB')->middleware('auth');
});


/**
 * SURAT JALAN
 */
Route::controller(SrjalanController::class)->group(function ()
{
    Route::get('/sj', 'index')->name('srjalans');
    Route::get('/sj/sj-detailSJ', 'sj_detailSJ')->name('SJ-Detail')->middleware('auth');
    Route::get('/sj/sj-printOut', 'sj_printOut')->name('SJ-PrintOut')->middleware('auth');
    Route::post('/sj/sj-hapus', 'sj_hapus')->name('sj_hapus')->middleware('auth');
    Route::get('/sj/SjAll', 'SjAll')->name('SjAll')->middleware('auth');
    Route::post('/sj/SjAll_DB', 'SjAll_DB')->name('SjAll_DB')->middleware('auth');
});

Route::controller(SjItemController::class)->group(function ()
{
    Route::post('/srjalan/SjItemBaru_DB', 'SjItemBaru_DB')->name('SjItemBaru_DB')->middleware('auth');
    Route::post('/srjalan/SjItemAva_DB', 'SjItemAva_DB')->name('SjItemAva_DB')->middleware('auth');
    Route::post('/sj/editJmlSpkPNSJ', 'editJmlSpkPNSJ')->name('editJmlSpkPNSJ')->middleware('auth');
    Route::post('/sj/delSpkPNSJ', 'delSpkPNSJ')->name('delSpkPNSJ')->middleware('auth');
});

Route::controller(SjDetailController::class)->group(function ()
{
    Route::get('/sj/editColly', 'editColly')->name('editColly')->middleware('auth');
    Route::post('/sj/editCollyDB', 'editCollyDB')->name('editCollyDB')->middleware('auth');
    Route::get('/sj/sjSelesai', 'sjSelesai')->name('sjSelesai')->middleware('auth');
    Route::post('/sj/sjSelesaiDB', 'sjSelesaiDB')->name('sjSelesaiDB')->middleware('auth');
    // Route::post('/sj/delSpkPNSJ', 'delSpkPNSJ')->name('delSpkPNSJ')->middleware('auth');
    Route::get('/sj/sjEditEkspedisi', 'sjEditEkspedisi')->name('sjEditEkspedisi')->middleware('auth');
    Route::post('/sj/sjEditEkspedisiDB', 'sjEditEkspedisiDB')->name('sjEditEkspedisiDB')->middleware('auth');
    Route::get('/sj/assign-alamat', 'sjDetail_assignAlamat')->name('sjDetail_assignAlamat')->middleware('auth');
    Route::post('/sj/assign-alamat-db', 'sjDetail_assignAlamatDB')->name('sjDetail_assignAlamatDB')->middleware('auth');
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
    Route::get('/produk/tambah-produk/{tipe}', 'tambahProduk')->name('tambahProduk')->middleware('auth');
    Route::post('/produk/tambah-produk-db', 'tambahProdukDB')->name('tambahProdukDB')->middleware('auth');
    Route::get('/produk/cek-produk', 'cekProduk')->name('cekProduk')->middleware('auth');
    Route::get('/produk/produk-detail', 'produk_detail')->name('produk_detail')->middleware('auth');
    Route::post('/produk/delete-produk', 'deleteProduct')->name('deleteProduct')->middleware('auth');
});
Route::controller(ProdukSpecController::class)->group(function ()
{
    Route::get('/produk/produk-dan-specs', 'produkDanSpecs')->name('produkDanSpecs')->middleware('auth');
    Route::get('/produk/daftar-spec', 'daftarSpec')->name('daftarSpec')->middleware('auth');
    Route::post('/produk/tambah-spec-db', 'tambahSpecDB')->name('tambahSpecDB')->middleware('auth');
    Route::get('/produk/edit-spec', 'editSpec')->name('editSpec')->middleware('auth');
    Route::post('/produk/hapus-spec', 'hapusSpec')->name('hapusSpec')->middleware('auth');
});


/**PENJUALAN */
Route::controller(PenjualanController::class)->group(function ()
{
    Route::get('/penjualan', 'index')->name('penjualan');
    Route::get('/penjualan/saleBasedOnFilter', 'saleBasedOnFilter')->name('saleBasedOnFilter')->middleware('auth');
});
/**
 * AJAX CONTROLLER
 */
Route::get('/get-spesifikasi_produk', [ProdukController::class, 'getSpesifikasiProduk'])->name('getSpesifikasiProduk')->middleware('auth');
