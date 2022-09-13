<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Srjalan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function get_pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function get_available_notas_for_srjalan()
    {
        $show_dump = false;

        $pelanggan_id_sj_blm_kirim = Nota::select('pelanggan_id')->where('status_sj', 'BELUM')->orderByDesc('created_at')->groupBy('pelanggan_id')->get();
        if ($show_dump) {
            dump('pelanggan_id_sj_blm_kirim', $pelanggan_id_sj_blm_kirim);
        }

        $pelanggans = $daerahs = $arr_notas = $arr_resellers = $arr2_spk_produk_notas = $arr2_spk_produks = $arr2_produks = array();
        for ($i0 = 0; $i0 < count($pelanggan_id_sj_blm_kirim); $i0++) {
            $pelanggan = Pelanggan::find($pelanggan_id_sj_blm_kirim[$i0]['pelanggan_id']);
            $notas = Nota::where('pelanggan_id', $pelanggan['id'])->where('status_sj', 'BELUM')->orWhere('status_sj', 'SEBAGIAN')
            ->orderByDesc('created_at')->get();

            $pelanggans[] = $pelanggan;
            $arr_notas[] = $notas;

            $resellers = $arr_spk_produk_notas = $arr_spk_produks = array();
            for ($i = 0; $i < count($notas); $i++) {
                if ($notas[$i]['reseller_id'] !== null) {
                    $reseller = Pelanggan::find($notas[$i]['reseller_id'])->toArray();
                    $resellers[] = $reseller;
                } else {
                    $reseller[] = null;
                }

                $spk_produk_notas = SpkProdukNota::where('nota_id', $notas[$i]['id'])->get()->toArray();
                $spk_produks = $produks = array();
                foreach ($spk_produk_notas as $spk_produk_nota) {
                    $spk_produk = SpkProduk::find($spk_produk_nota['spk_produk_id'])->toArray();
                    $produk = Produk::find($spk_produk['produk_id'])->toArray();
                    $spk_produks[] = $spk_produk;
                    $produks[] = $produk;
                }

                $arr_spk_produk_notas[] = $spk_produk_notas;
                $arr_spk_produks[] = $spk_produks;
                $arr_produks[] = $produks;
            }
            $arr_resellers[] = $resellers;
            $arr2_spk_produk_notas[] = $arr_spk_produk_notas;
            $arr2_spk_produks[] = $arr_spk_produks;
            $arr2_produks[] = $arr_produks;

        }
        return array($pelanggans, $daerahs, $arr_notas, $arr_resellers, $arr2_spk_produk_notas, $arr2_spk_produks, $arr2_produks);
    }

    public function get_one_srjalan_and_components($srjalan_id)
    {
        $srjalan = Srjalan::find($srjalan_id);
        $pelanggan = Pelanggan::find($srjalan['pelanggan_id']);
        $reseller = null;
        if ($srjalan['reseller_id'] !== null) {
            $reseller = Pelanggan::find($srjalan['reseller_id']);
        }
        $ekspedisi = Ekspedisi::find($srjalan['ekspedisi_id']);
        $spk_produk_nota_srjalans = SpkProdukNotaSrjalan::where('srjalan_id', $srjalan['id'])->get()->toArray();

        $spk_produk_notas = $spk_produks = $produks = array();

        foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
            $spk_produk_nota = SpkProdukNota::find($spk_produk_nota_srjalan['spk_produk_nota_id']);
            $spk_produk = SpkProduk::find($spk_produk_nota_srjalan['spk_produk_id']);
            $produk = Produk::find($spk_produk_nota_srjalan['produk_id']);

            $spk_produk_notas[] = $spk_produk_nota;
            $spk_produks[] = $spk_produk;
            $produks[] = $produk;
        }

        return array($srjalan, $pelanggan, $reseller, $ekspedisi, $spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks);
    }



    static function newSrjalan_berdasarkan_SpkProdukID($spk_produk_id)
    {
        $success_logs=array();
        $success_logs[]="Membuat surat jalan baru berdasarkan spk_produk_id=$spk_produk_id (seharusnya loop 1)";
        $spk_produk=SpkProduk::find($spk_produk_id);
        $produk=Produk::find($spk_produk['produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        $pelanggan=Pelanggan::find($spk['pelanggan_id']);
        // cek langsung apakah ada ekspedisi transit
        $pelanggan_ekspedisi_transit=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('tipe','TRANSIT')->first();
        $ekspedisi_id=$ekspedisi_transit_id=null;
        if ($pelanggan_ekspedisi_transit!==null) {
            // ada ekspedisi transit
            $ekspedisi_transit_id=$pelanggan_ekspedisi_transit['ekspedisi_id'];
            $success_logs[]="Ditemukan ekspedisi transit ID:$ekspedisi_transit_id";
        }
        $pelanggan_ekspedisi_utama=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        if ($pelanggan_ekspedisi_utama!==null) {
            $ekspedisi_id=$pelanggan_ekspedisi_utama['ekspedisi_id'];
            $success_logs[]="Ditemukan ekspedisi utama ID:$ekspedisi_id";
        }

        $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk->id)->get();
        $srjalan_id=null;
        $user=auth()->user();
        $i=0;
        $jml_colly=$jml_dus=0;
        // dd($spk_produk_notas);
        foreach ($spk_produk_notas as $spk_produk_nota) {
            if ($i===0) {
                //Looping pertama, bikin surat jalan baru, looping berikutnya, pake ID yang udah ada.
                $success_logs[]="Masuk ke loop pertama dari spk_produk_notas";
                $new_srjalan=Srjalan::create([
                    'pelanggan_id'=>$spk['pelanggan_id'],
                    'reseller_id'=>$spk['reseller_id'],
                    'ekspedisi_id'=>$ekspedisi_id,
                    'ekspedisi_transit_id'=>$ekspedisi_transit_id,
                    'created_by'=>$user['username'],
                    'updated_by'=>$user['username'],
                ]);
                $success_logs[]="Membuat srjalan baru ID:$new_srjalan[id]";
                //update nomor surat jalan
                $new_srjalan->no_srjalan="SJ-$new_srjalan[id]";
                $new_srjalan->save();
                $success_logs[]="Update nomor srjalan baru :$new_srjalan[no_srjalan]";
                $srjalan_id=$new_srjalan['id'];
            }
            $jml_packing=ceil($spk_produk_nota['jumlah']/$produk['aturan_packing']);
            $new_spk_produk_nota_srjalan=SpkProdukNotaSrjalan::create([
                'spk_id'=>$spk['id'],
                'produk_id'=>$produk['id'],
                'nota_id'=>$spk_produk_nota['nota_id'],
                'srjalan_id'=>$srjalan_id,
                'spk_produk_id'=>$spk_produk['id'],
                'spk_produk_nota_id'=>$spk_produk_nota['id'],
                'jumlah'=>$spk_produk_nota['jumlah'],
                'tipe_packing'=>$produk['tipe_packing'],
                'jml_packing'=>$jml_packing,
            ]);
            $success_logs[]="Membuat spk_produk_nota_srjalan ID: $new_spk_produk_nota_srjalan[id]";
            if ($produk['tipe_packing']==='colly') {
                $jml_colly+=$jml_packing;
            } else if ($produk['tipe_packing']==='dus') {
                $jml_dus+=$jml_packing;
            }
            $i++;
        }
        //update jumlah packing dari srjalan
        $srjalan=Srjalan::find($srjalan_id);
        $srjalan->jml_colly=$jml_colly;
        $srjalan->jml_dus=$jml_dus;
        $srjalan->save();
        $success_logs[]="Updating jml_colly dan jml_dus pada srjalan yang barusan dibuat.";

        return array($srjalan['id'],$success_logs);
    }

    static function newSpkProdukNotaSrjalan_with_SpkProdukID_and_SrjalanID($spk_produk_id,$srjalan_id)
    {
        $success_logs=array();
        $success_logs[]="Membuat spk_produk_nota_srjalan berdasarkan spk_produk_id=$spk_produk_id dam srjalan_id=$srjalan_id";
        $spk_produk=SpkProduk::find($spk_produk_id);
        $produk=Produk::find($spk_produk['produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        $pelanggan=Pelanggan::find($spk['pelanggan_id']);
        // cek langsung apakah ada ekspedisi transit
        $pelanggan_ekspedisi_transit=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('tipe','TRANSIT')->first();
        $ekspedisi_id=$ekspedisi_transit_id=null;
        if ($pelanggan_ekspedisi_transit!==null) {
            // ada ekspedisi transit
            $ekspedisi_transit_id=$pelanggan_ekspedisi_transit['ekspedisi_id'];
            $success_logs[]="Ditemukan ekspedisi transit ID:$ekspedisi_transit_id";
        }
        $pelanggan_ekspedisi_utama=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        if ($pelanggan_ekspedisi_utama!==null) {
            $ekspedisi_id=$pelanggan_ekspedisi_utama['ekspedisi_id'];
            $success_logs[]="Ditemukan ekspedisi utama ID:$ekspedisi_id";
        }

        $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk_id)->get();
        $user=auth()->user();
        $jml_colly=$jml_dus=0;
        foreach ($spk_produk_notas as $spk_produk_nota) {
            $jml_packing=ceil($spk_produk_nota['jumlah']/$produk['aturan_packing']);
            $new_spk_produk_nota_srjalan=SpkProdukNotaSrjalan::create([
                'spk_id'=>$spk['id'],
                'produk_id'=>$produk['id'],
                'nota_id'=>$spk_produk_nota['nota_id'],
                'srjalan_id'=>$srjalan_id,
                'spk_produk_id'=>$spk_produk['id'],
                'spk_produk_nota_id'=>$spk_produk_nota['id'],
                'jumlah'=>$spk_produk_nota['jumlah'],
                'tipe_packing'=>$produk['tipe_packing'],
                'jml_packing'=>$jml_packing,
            ]);
            $success_logs[]="Membuat spk_produk_nota_srjalan ID: $new_spk_produk_nota_srjalan[id]";
            if ($produk['tipe_packing']==='colly') {
                $jml_colly+=$jml_packing;
            } else if ($produk['tipe_packing']==='dus') {
                $jml_dus+=$jml_packing;
            }
        }
        //update jumlah packing dari srjalan
        $srjalan=Srjalan::find($srjalan_id);
        $srjalan->jml_colly=$jml_colly;
        $srjalan->jml_dus=$jml_dus;
        $srjalan->updated_by=$user['username'];
        $srjalan->save();
        $success_logs[]="Updating jml_colly dan jml_dus pada srjalan terkait.";

        return $success_logs;
    }

    static function Update_SPK_JmlSj_Status_Packing($spk_produk_id)
{
    $spk_produk=SpkProduk::find($spk_produk_id);
    $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
    $jml_sdh_srjalan=0;
    // dd('spk_produk_notas',$spk_produk_notas);
    foreach ($spk_produk_notas as $spk_produk_nota) {
        $jml_colly=$jml_dus=0;
        $spkProdukNoSjs=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spk_produk_nota['id'])->get(); //setiap pake get, ga bisa akses index
        if (count($spkProdukNoSjs)!==0) {
            $srjalan_id=null;
            $i=0;
            foreach ($spkProdukNoSjs as $spkProdukNoSj) {
                if ($i===0) {
                    $srjalan_id=$spkProdukNoSj['srjalan_id'];
                }
                $jml_sdh_srjalan+=$spkProdukNoSj['jumlah'];
                if ($spkProdukNoSj['tipe_packing']==='colly') {
                    $jml_colly+=$spkProdukNoSj['jml_packing'];
                } elseif ($spkProdukNoSj['tipe_packing']==='dus') {
                    $jml_dus+=$spkProdukNoSj['jml_packing'];
                }
                $i++;
            }

            $srjalan=Srjalan::find($srjalan_id);

            if ($jml_colly!==0) {
                $srjalan->jml_colly=$jml_colly;
            }
            if ($jml_dus!==0) {
                $srjalan->jml_dus=$jml_dus;
            }

            $srjalan->save();
        }

    }

    $spk_produk->jumlah_sudah_srjalan=$jml_sdh_srjalan;
    if ($jml_sdh_srjalan===$spk_produk->jml_t) {
        $spk_produk->status_srjalan='SELESAI';
    } else if ($jml_sdh_srjalan===0) {
        $spk_produk->status_srjalan='PROSES';
    } else if ($jml_sdh_srjalan>0) {
        $spk_produk->status_srjalan='SEBAGIAN';
    }
    $spk_produk->save();
}

    static function newSrjalan_basedOn_SpkProdukNotaID_a_Jml($spk_produk_nota_id,$jumlah)
    {
        $success_logs=array();
        $success_logs[]="o) Membuat surat jalan baru berdasarkan spk_produk_id=$spk_produk_nota_id dan jumlah yang sudah ditentukan.";
        $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
        $spk_produk=SpkProduk::find($spk_produk_nota['spk_produk_id']);
        $produk=Produk::find($spk_produk['produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        $pelanggan=Pelanggan::find($spk['pelanggan_id']);
        // cek langsung apakah ada ekspedisi transit
        $pelanggan_ekspedisi_transit=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('tipe','TRANSIT')->first();
        $ekspedisi_id=$ekspedisi_transit_id=null;
        if ($pelanggan_ekspedisi_transit!==null) {
            // ada ekspedisi transit
            $ekspedisi_transit_id=$pelanggan_ekspedisi_transit['ekspedisi_id'];
            $success_logs[]="Ditemukan ekspedisi transit ID:$ekspedisi_transit_id";
        }
        $pelanggan_ekspedisi_utama=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        if ($pelanggan_ekspedisi_utama!==null) {
            $ekspedisi_id=$pelanggan_ekspedisi_utama['ekspedisi_id'];
            $success_logs[]="Ditemukan ekspedisi utama ID:$ekspedisi_id";
        }

        $user=auth()->user();
        // dd($spk_produk_notas);
        $new_srjalan=Srjalan::create([
            'pelanggan_id'=>$spk['pelanggan_id'],
            'reseller_id'=>$spk['reseller_id'],
            'ekspedisi_id'=>$ekspedisi_id,
            'ekspedisi_transit_id'=>$ekspedisi_transit_id,
            'created_by'=>$user['username'],
            'updated_by'=>$user['username'],
        ]);
        $success_logs[]="Membuat srjalan baru ID:$new_srjalan[id]";
        //update nomor surat jalan
        $new_srjalan->no_srjalan="SJ-$new_srjalan[id]";
        $new_srjalan->save();
        $success_logs[]="Update nomor srjalan baru :$new_srjalan[no_srjalan]";

        $jml_packing=ceil($jumlah/$produk['aturan_packing']);
        $new_spk_produk_nota_srjalan=SpkProdukNotaSrjalan::create([
            'spk_id'=>$spk['id'],
            'produk_id'=>$produk['id'],
            'nota_id'=>$spk_produk_nota['nota_id'],
            'srjalan_id'=>$new_srjalan['id'],
            'spk_produk_id'=>$spk_produk['id'],
            'spk_produk_nota_id'=>$spk_produk_nota['id'],
            'jumlah'=>$jumlah,
            'tipe_packing'=>$produk['tipe_packing'],
            'jml_packing'=>$jml_packing,
        ]);
        $success_logs[]="Membuat spk_produk_nota_srjalan ID: $new_spk_produk_nota_srjalan[id]";

        //update jumlah packing dari srjalan

        return array($new_srjalan['id'],$success_logs);
    }

    static function newSpkProdukNotaSrjalan_basedOn_SrJalanID_SpkProdukNotaID_a_Jml($srjalan_id,$spk_produk_nota_id,$jumlah)
    {
        $success_logs=array();
        $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
        $spk_produk=SpkProduk::find($spk_produk_nota['spk_produk_id']);
        $produk=Produk::find($spk_produk['produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);

        $jml_packing=ceil($jumlah/$produk['aturan_packing']);
        $new_spk_produk_nota_srjalan=SpkProdukNotaSrjalan::create([
            'spk_id'=>$spk['id'],
            'produk_id'=>$produk['id'],
            'nota_id'=>$spk_produk_nota['nota_id'],
            'srjalan_id'=>$srjalan_id,
            'spk_produk_id'=>$spk_produk['id'],
            'spk_produk_nota_id'=>$spk_produk_nota['id'],
            'jumlah'=>$jumlah,
            'tipe_packing'=>$produk['tipe_packing'],
            'jml_packing'=>$jml_packing,
        ]);
        $success_logs[]="Membuat spk_produk_nota_srjalan ID: $new_spk_produk_nota_srjalan[id]";

        return $success_logs;
    }

    static function SpkProdukNotaSrjalan_cek_SpkProdukNotaID_ifSama_updateJml_ifBeda_newSpkProdukNotaSrjalan($spk_produk_nota_id,$spk_produk_nota_srjalan_id,$jumlah)
    {
        $success_logs=array();
        $spk_produk_nota_srjalan=SpkProdukNotaSrjalan::find($spk_produk_nota_srjalan_id);
        if ($spk_produk_nota_srjalan['spk_produk_nota_id']==$spk_produk_nota_id) {
            // Kalo sama, update jumlah nya aja.
            $success_logs[]="spk_produk_nota sesuai dengan spk_produk_nota_srjalan -> updating jumlah (ditambah dengan jumlah yang diinput)";
            $spk_produk_nota_srjalan->jumlah=$jumlah;
            $spk_produk_nota_srjalan->save();
        } else {
            $success_logs[]="spk_produk tidak sesuai dengan spk_produk_nota_srjalan yang dipilih -> Membuat spk_produk_nota_srjalan baru";
            $success_logs2=Srjalan::newSpkProdukNotaSrjalan_basedOn_SpkProdukNotaID_a_SjID_a_Jml($spk_produk_nota_id,$spk_produk_nota_srjalan['srjalan_id'],$jumlah);
            array_merge($success_logs,$success_logs2);
        }

        return $success_logs;
    }

    static function newSpkProdukNotaSrjalan_basedOn_SpkProdukNotaID_a_SjID_a_Jml($spk_produk_nota_id,$srjalan_id,$jumlah)
    {
        $success_logs=array();
        $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
        $produk=Produk::find($spk_produk_nota['produk_id']);
        $jml_packing=ceil($jumlah/$produk['aturan_packing']);
        $new_spk_produk_nota_srjalan=SpkProdukNotaSrjalan::create([
            'spk_id'=>$spk_produk_nota['spk_id'],
            'produk_id'=>$produk['id'],
            'nota_id'=>$spk_produk_nota['nota_id'],
            'srjalan_id'=>$srjalan_id,
            'spk_produk_id'=>$spk_produk_nota['spk_produk_id'],
            'spk_produk_nota_id'=>$spk_produk_nota['id'],
            'jumlah'=>$jumlah,
            'tipe_packing'=>$produk['tipe_packing'],
            'jml_packing'=>$jml_packing,
        ]);
        $success_logs[]="Membuat spk_produk_nota_srjalan baru dengan srjalan_id yang sudah ditentukan";
        return $success_logs;
    }
}
