<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EkspedisiBaru extends Controller
{
    public function index()
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
        }
        $all_ekspedisi = Ekspedisi::orderBy('nama')->get();

        $data = [
            'all_ekspedisi' => $all_ekspedisi,
        ];
        return view('ekspedisi.ekspedisi-baru', $data);
    }

    /**
     * Nanti setelah selesai menjalankan fungsi dibawah ini, maka setelah menekan tombol kembali, app akan pindah ke halaman sebelumnya yang sudah ditentukan oleh developer, mesti kembali ke belakang yang ke berapa. Lalu di halaman tersebut, app akan reload, karena sudah di setting dari go-back-page terdapat javascript yang mengatur supaya session storage men set sebuah key-value pair. Key-value pair ini akan dipanggil di halaman kembali nya untuk cek apakah perlu reload atau tidak.
     */
    public function ekspedisi_baru_db(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = false;
        $ada_error = true;
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();
        $bentuk_perusahaan = null;
        if (isset($post['bentuk_perusahaan']) && $post['bentuk_perusahaan'] !== null && $post['bentuk_perusahaan'] !== '') {
            $bentuk_perusahaan = $post['bentuk_perusahaan'];
        }

        if ($show_dump) {
            dump('$post: ', $post);
        }

        // $alamat_ekspedisi = json_encode(Arr::whereNotNull($post['alamat_ekspedisi']));
        $alamat_ekspedisi = json_encode(array_filter($post['alamat_ekspedisi']));

        $keterangan = $post['keterangan'];

        if ($keterangan === null || $keterangan === '') {
            $keterangan = null;
        }

        if ($run_db === true) {
            $ekspedisi = Ekspedisi::create([
                'bentuk' => $bentuk_perusahaan,
                'nama' => $post['nama_ekspedisi'],
                'alamat' => $alamat_ekspedisi,
                'no_kontak' => $post['kontak_ekspedisi'],
                'ktrg' => $keterangan,
            ]);

            $load_num->value += 1;
            $load_num->save();

            $pesan_db = "SUCCESS: Ekspedisi Baru dengan nama $ekspedisi[nama] berhasil dibuat!";
            $ada_error = false;
            $class_div_pesan_db = 'alert-success';

        }

        $data = [
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db
        ];

        return view('layouts.go-back-page', $data);
    }
}
