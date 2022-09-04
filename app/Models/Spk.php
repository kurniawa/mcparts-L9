<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // public $timestamps = false; tidak perlu false, karena memang terpakai
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'spk_produks');
    }

    public function spk_produks()
    {
        return $this->hasMany(SpkProduk::class);
    }

    public function spk_produk_selesais()
    {
        return $this->hasMany(SpkProdukSelesai::class);
    }

    public function get_available_spks_dan_pelanggan_terkait()
    {
        $show_dump = false;

        $pelanggan_ids = Spk::select('pelanggan_id')
        ->groupBy('pelanggan_id')
        // ->groupBy('id','no_spk', 'pelanggan_id', 'reseller_id', 'status', 'judul', 'jumlah_total', 'harga_total', 'created_by', 'updated_by', 'created_at', 'finished_at', 'updated_at')
        ->where('status', 'SEBAGIAN')->orWhere('status', 'SELESAI')
        ->get()->toArray();

        // dd($pelanggan_ids);

        $pelanggans = $daerahs = $arr_resellers = $available_spks = $list_arr_spk_produks = $list_arr_produks = array();
        for ($i=0; $i < count($pelanggan_ids); $i++) {
            $pelanggan = Pelanggan::find($pelanggan_ids[$i]['pelanggan_id'])->toArray();
            // $daerah = Daerah::find($pelanggan['daerah_id'])->toArray();

            $spk_selesai_or_sebagian = Spk::where(function ($query)
            {
                $query->where('status', 'SEBAGIAN')->orWhere('status', 'SELESAI');
            })->where('pelanggan_id', $pelanggan_ids[$i]['pelanggan_id'])->get()->toArray();

            /**
             * CEK, APAKAH ITEM YANG ADA PADA SPK INI, SUDAH ADA YANG DIBUAT NOTA NYA.
             */
            $av_spks = array();
            foreach ($spk_selesai_or_sebagian as $spk) {
                $spk_produks = SpkProduk::where('spk_id', $spk['id'])->where(function ($query) {
                    $query->where('status', 'SELESAI')
                        ->orWhere('status', 'SEBAGIAN');
                })->get()->toArray();

                // dump('$spk_produks', $spk_produks);

                $item_sudah_nota = 0;

                foreach ($spk_produks as $spk_produk) {
                    $jumlah_sudah_nota = $spk_produk['jml_sdh_nota'];
                    if ($jumlah_sudah_nota === null) {
                        $jumlah_sudah_nota = 0;
                    }

                    if ($jumlah_sudah_nota === $spk_produk['jml_selesai']) {
                        $item_sudah_nota++;
                    }
                }

                if ($item_sudah_nota < count($spk_produks)) {
                    $av_spks[] = $spk;
                }
            }

            if (count($av_spks) !== 0) {
                array_push($pelanggans, $pelanggan);
                // array_push($daerahs, $daerah);
                array_push($available_spks, $av_spks);

                // dd('$av_spks', $av_spks);

                $resellers = $arr_produks = $arr_spk_produks = array();

                foreach ($av_spks as $av_spk) {
                    $arr_produk = $arr_spk_produk = array();
                    // foreach ($av_spks as $av_spk) {
                    $spk_produks = SpkProduk::where('spk_id', $av_spk['id'])->get()->toArray();
                    $produks = array();
                    foreach ($spk_produks as $spk_produk) {
                        $produk = Produk::find($spk_produk['produk_id'])->toArray();
                        // dump('$produk:', $produk);
                        array_push($produks, $produk);
                    }
                    array_push($arr_produks, $produks);
                    array_push($arr_spk_produks, $spk_produks);

                    // dump('$av_spk', $av_spk);
                    // dump('$arr_produks', $arr_produks);
                    // dump('$arr_spk_produks', $arr_spk_produks);

                    $reseller = null;
                    if ($av_spk['reseller_id'] !== null) {
                        $reseller = Pelanggan::find($av_spk['reseller_id'])->toArray();
                    }

                    array_push($resellers, $reseller);
                    // }

                    // array_push($arr_spk_produks, $spk_produks);
                    // array_push($arr_produks, $arr_produk);

                }
                array_push($arr_resellers, $resellers);
                array_push($list_arr_produks, $arr_produks);
                array_push($list_arr_spk_produks, $arr_spk_produks);

                // dump('$list_arr_produks', $list_arr_produks);
                // dump('$list_arr_spk_produks', $list_arr_spk_produks);
            }

        }

        // dump('$list_arr_produks', $list_arr_produks);
        // dump('$list_arr_spk_produks', $list_arr_spk_produks);

        if ($show_dump) {
            dump('$pelanggans', $pelanggans);
            dd('$available_spks', $available_spks);
        }
        return array($pelanggans, $daerahs, $arr_resellers, $available_spks, $list_arr_spk_produks, $list_arr_produks);
    }

    /**
     * Update status_nota pada spk, berdasarkan jumlah_sudah_nota pada spk_produks pada spk yang terkait
     */
    public function updateStatusNota($spk_id)
    {
        $spk = Spk::find($spk_id);
        $spk_produks = SpkProduk::where('spk_id', $spk['id'])->get()->toArray();
        $jumlahSudahNotaDariSPKProduks = 0;

        foreach ($spk_produks as $spk_produk) {
            $jumlahSudahNotaDariSPKProduks += $spk_produk['jml_sdh_nota'];
        }

        $status_nota = 'BELUM';
        if ($jumlahSudahNotaDariSPKProduks !== 0) {
            if ($jumlahSudahNotaDariSPKProduks === $spk['jumlah_total']) {
                $status_nota = 'SEMUA';
            } else {
                $status_nota = 'SEBAGIAN';
            }
        }

        return array($spk, $status_nota, $jumlahSudahNotaDariSPKProduks);
    }

    public function updateStatusNota_JumlahSudahNota($spk_id)
    {
        $run_db = true;

        $spk = Spk::find($spk_id);
        $spk_produks = SpkProduk::where('spk_id', $spk['id'])->get()->toArray();
        $jumlahSudahNotaDariSPKProduks = 0;

        foreach ($spk_produks as $spk_produk) {
            $jumlahSudahNotaDariSPKProduks += $spk_produk['jml_sdh_nota'];
        }

        $status_nota = 'BELUM';
        if ($jumlahSudahNotaDariSPKProduks !== 0) {
            if ($jumlahSudahNotaDariSPKProduks === $spk['jumlah_total']) {
                $status_nota = 'SEMUA';
            } else {
                $status_nota = 'SEBAGIAN';
            }
        }

        if ($run_db) {
            $spk->status_nota = $status_nota;
            $spk->jumlah_sudah_nota = $jumlahSudahNotaDariSPKProduks;
            $spk->save();

            $msg = 'Update spk->status_nota dan jumlah_sudah_nota';
        }

        return $msg;
    }

    public function UpdateDataSPK_All($spk_id)
    {
        $spk_produks = SpkProduk::where('spk_id',$spk_id)->get();
        $jumlah_total=0;
        $harga_total=0;
        $jumlah_selesai_spk=0;

        foreach ($spk_produks as $spk_produk) {
            $jml_t = $spk_produk['jumlah'] + $spk_produk['deviasi_jml'];
            // dd($jml_t);
            $spk_produk->jml_t = $jml_t;
            $spk_produk->jml_blm_sls=$jml_t-$spk_produk['jml_selesai'];

            if ($spk_produk['jml_selesai']===$jml_t) {
                $spk_produk->status='SELESAI';
            } else if ($spk_produk['jml_selesai']!==0) {
                $spk_produk->status='SEBAGIAN';
            } else if ($spk_produk['jml_selesai']===0) {
                $spk_produk->status='PROSES';
            }

            $spk_produk->save();
            $jumlah_total+=$jml_t;
            $harga_total+=$jml_t*$spk_produk['harga'];
            $jumlah_selesai_spk+=$spk_produk['jml_selesai'];
        }

        $spk = Spk::find($spk_id);
        $spk->jumlah_total=$jumlah_total;
        $spk->harga_total=$harga_total;
        $spk->jumlah_selesai=$jumlah_selesai_spk;
        if ($jumlah_selesai_spk===$jumlah_total) {$spk->status='SELESAI';}
        else if ($jumlah_selesai_spk!==0) { $spk->status='SEBAGIAN';}
        else if ($jumlah_selesai_spk===0){ $spk->status = 'PROSES'; }
        $spk->save();
    }

}
