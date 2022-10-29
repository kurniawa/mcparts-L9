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
        $alamat=$pelanggan->alamat->first();
        // Kontak Pelanggan
        $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();

        $reseller=$reseller_kontak=null;
        if ($srjalan['reseller_id'] !== null) {
            $reseller = Pelanggan::find($srjalan['reseller_id']);
            $reseller_kontak=PelangganKontak::where('pelanggan_id',$reseller['id'])->where('is_aktual','yes')->first();
        }
        // Ekspedisi dan Transit
        // Ekspedisi Normal dan Kontak
        $ekspedisi = Ekspedisi::find($srjalan['ekspedisi_id']);
        $ekspedisi_kontak=null;
        if ($ekspedisi!==null) {
            $ekspedisi_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi['id'])->where('is_aktual','yes')->first();
        }

        // Ekspedisi Transit dan Kontak
        // Transit harus sudah di tetapkan pada kolom ekspedisi_transit_id pada srjalan. Supaya nanti ketika detail, memang muncul yang sudah diset saja.
        $transit=$alamat_transit=$transit_kontak=null;
        if ($srjalan['ekspedisi_transit_id']!==null) {
            $transit=Ekspedisi::find($srjalan['ekspedisi_transit_id']);
            $transit_alamat=EkspedisiAlamat::where('ekspedisi_id',$transit['id'])->where('tipe','UTAMA')->first();
            $alamat_transit=Alamat::find($transit_alamat['alamat_id']);
            $transit_kontak=EkspedisiKontak::where('ekspedisi_id',$transit['id'])->where('is_aktual','yes')->first();
        }
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

        return array($srjalan, $pelanggan,$alamat,$pelanggan_kontak,$reseller,$reseller_kontak,$ekspedisi,$ekspedisi_kontak,$transit,$alamat_transit,$transit_kontak,$spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks);
    }



    static function newSrjalan_berdasarkan_SpkProdukID($spk_produk_id)
    {
        $success_logs=array();
        $success_logs[]="Membuat surat jalan baru berdasarkan spk_produk_id=$spk_produk_id (seharusnya loop 1)";
        $spk_produk=SpkProduk::find($spk_produk_id);
        $produk=Produk::find($spk_produk['produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        // Data Pelanggan
        $pelanggan=Pelanggan::find($spk['pelanggan_id']);
        $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        $pelanggan_nama=$pelanggan['nama'];
        $alamat_id=$cust_long_ala=$cust_short=null;
        if ($pelanggan_alamat!==null) {
            $alamat=Alamat::find($pelanggan_alamat['alamat_id']);
            $alamat_id=$alamat['id'];
            $cust_long_ala=$alamat['long'];
            $cust_short=$alamat['short'];
        }
        $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();
        $kontak_id=$cust_kontak=null;
        if ($pelanggan_kontak!==null) {
            $kontak_id=$pelanggan_kontak['id'];
            $cust_kontak=json_encode($pelanggan_kontak->toArray());
        }
        // cek langsung apakah ada ekspedisi transit
        $pelanggan_ekspedisi_transit=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('is_transit','yes')->where('tipe','UTAMA')->first();
        $transit_kontak_id=$ekspedisi_id=$ekspedisi_transit_id=$alamat_transit_id=$transit_nama=$trans_long_ala=$trans_short=$trans_kontak=null;
        if ($pelanggan_ekspedisi_transit!==null) {
            // ada ekspedisi transit
            $transit=Ekspedisi::find($pelanggan_ekspedisi_transit['ekspedisi_id']);
            $transit_nama=$transit['nama'];
            $ekspedisi_transit_id=$pelanggan_ekspedisi_transit['ekspedisi_id'];
            $success_logs[]="Ditemukan ekspedisi transit ID:$ekspedisi_transit_id";
            $transit_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi_transit_id)->where('tipe','UTAMA')->first();
            if ($transit_alamat!==null) {
                $alamat_transit=Alamat::find($transit_alamat['alamat_id']);
                $alamat_transit_id=$alamat_transit['id'];
                $trans_long_ala=$alamat_transit['long'];
                $trans_short=$alamat_transit['short'];
            }
            $transit_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi_transit_id)->where('is_aktual','yes')->first();
            if ($transit_kontak!==null) {
                $transit_kontak_id=$transit_kontak['id'];
                $trans_kontak=json_encode($transit_kontak->toArray());
            }
        }
        $pelanggan_ekspedisi_utama=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        $ekspedisi_kontak_id=$alamat_ekspedisi_id=$ekspedisi_nama=$eks_long_ala=$eks_short=$eks_kontak=null;
        if ($pelanggan_ekspedisi_utama!==null) {
            $ekspedisi_id=$pelanggan_ekspedisi_utama['ekspedisi_id'];
            $success_logs[]="Ditemukan ekspedisi utama ID:$ekspedisi_id";
            $ekspedisi=Ekspedisi::find($ekspedisi_id);
            $ekspedisi_nama=$ekspedisi['nama'];
            $ekspedisi_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi_id)->where('tipe','UTAMA')->first();
            if ($ekspedisi_alamat!==null) {
                $alamat_ekspedisi=Alamat::find($ekspedisi_alamat['alamat_id']);
                $alamat_ekspedisi_id=$alamat_ekspedisi['id'];
                $eks_long_ala=$alamat_ekspedisi['long'];
                $eks_short=$alamat_ekspedisi['short'];
            }
            $ekspedisi_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi_id)->where('is_aktual','yes')->first();
            if ($ekspedisi_kontak!==null) {
                $ekspedisi_kontak_id=$ekspedisi_kontak['id'];
                $eks_kontak=json_encode($ekspedisi_kontak->toArray());
            }
        }
        // Data Reseller
        $reseller_id=$alamat_reseller_id=$kontak_reseller_id=$reseller_nama=$reseller_long_ala=$reseller_short=$reseller_kontak=null;
        if ($spk['reseller_id']!==null) {
            $reseller=Pelanggan::find($spk['reseller_id']);
            $reseller_id=$reseller['id'];
            $reseller_nama=$reseller['nama'];
            $reseller_alamat=PelangganAlamat::where('pelanggan_id',$reseller_id)->where('tipe','UTAMA')->first();
            if ($reseller_alamat!==null) {
                $alamat_reseller=Alamat::find($reseller_alamat['alamat_id']);
                $alamat_reseller_id=$alamat_reseller['id'];
                $reseller_long_ala=$alamat_reseller['long'];
                $reseller_short=$alamat_reseller['short'];
            }
            $kontak_reseller=PelangganKontak::where('pelanggan_id',$reseller_id)->where('is_aktual','yes')->first();
            if ($kontak_reseller!==null) {
                $kontak_reseller_id=$kontak_reseller['id'];
                $reseller_kontak=json_encode($kontak_reseller->toArray());
            }
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
                    'reseller_id'=>$reseller_id,
                    'ekspedisi_id'=>$ekspedisi_id,
                    'ekspedisi_transit_id'=>$ekspedisi_transit_id,
                    // alamat
                    'alamat_id'=>$alamat_id,
                    'alamat_reseller_id'=>$alamat_reseller_id,
                    'alamat_ekspedisi_id'=>$alamat_ekspedisi_id,
                    'alamat_transit_id'=>$alamat_transit_id,
                    // kontak
                    'kontak_id'=>$kontak_id,
                    'kontak_reseller_id'=>$kontak_reseller_id,
                    'kontak_ekspedisi_id'=>$ekspedisi_kontak_id,
                    'kontak_transit_id'=>$transit_kontak_id,
                    'created_by'=>$user['username'],
                    'updated_by'=>$user['username'],
                    // selesai
                    'pelanggan_nama'=>$pelanggan_nama,
                    'cust_long_ala'=>$cust_long_ala,
                    'cust_short'=>$cust_short,
                    'cust_kontak'=>$cust_kontak,
                    'ekspedisi_nama'=>$ekspedisi_nama,
                    'eks_long_ala'=>$eks_long_ala,
                    'eks_short'=>$eks_short,
                    'eks_kontak'=>$eks_kontak,
                    'transit_nama'=>$transit_nama,
                    'trans_long_ala'=>$trans_long_ala,
                    'trans_short'=>$trans_short,
                    'trans_kontak'=>$trans_kontak,
                    'reseller_nama'=>$reseller_nama,
                    'reseller_long_ala'=>$reseller_long_ala,
                    'reseller_short'=>$reseller_short,
                    'reseller_kontak'=>$reseller_kontak,
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

    static function Update_SPK_JmlSj_Status_Packing($spk_produks)
    {
        $jml_colly=$jml_dus=0;
        // dump($spk_produks);
        for ($i=0; $i < count($spk_produks); $i++) {
            $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produks[$i]['id'])->get();
            $jml_sdh_srjalan=0;
            // dd('spk_produk_notas',$spk_produk_notas);
            foreach ($spk_produk_notas as $spk_produk_nota) {
                $spkProdukNoSjs=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spk_produk_nota['id'])->get(); //setiap pake get, ga bisa akses index
                // dump('spkProdukNoSjs',$spkProdukNoSjs);
                if (count($spkProdukNoSjs)!==0) {
                    $srjalan_id=null;
                    $j=0;
                    foreach ($spkProdukNoSjs as $spkProdukNoSj) {
                        if ($j===0) {
                            $srjalan_id=$spkProdukNoSj['srjalan_id'];
                        }
                        $jml_sdh_srjalan+=$spkProdukNoSj['jumlah'];
                        if ($spkProdukNoSj['tipe_packing']==='colly') {
                            $jml_colly+=$spkProdukNoSj['jml_packing'];
                        } elseif ($spkProdukNoSj['tipe_packing']==='dus') {
                            $jml_dus+=$spkProdukNoSj['jml_packing'];
                        }
                        // Update status spk
                        $spk=Spk::find($spkProdukNoSj['spk_id']);
                        $spk->jumlah_sudah_sj+=$spkProdukNoSj['jumlah'];
                        $spk->save();

                        $status_sj="SEMUA";
                        if ($spk['jumlah_sudah_sj']===0) {
                            $status_sj="BELUM";
                        } else if ($spk['jumlah_sudah_sj']>0 && $spk['jumlah_sudah_sj']< $spk['jumlah_total']) {
                            $status_sj="SEBAGIAN";
                        } else if($spk['jumlah_sudah_sj']<0){
                            $status_sj="ERROR";
                        }
                        $spk->status_sj=$status_sj;
                        $spk->save();
                        $success_logs[]="spk->status_sj telah diupdate!";
                        $j++;
                    }

                }
                // dump('jml_colly',$jml_colly);
                // dump('jml_dus',$jml_dus);

            }

            $spk_produks[$i]->jumlah_sudah_srjalan=$jml_sdh_srjalan;
            if ($jml_sdh_srjalan===$spk_produks[$i]->jml_t) {
                $spk_produks[$i]->status_srjalan='SELESAI';
            } else if ($jml_sdh_srjalan===0) {
                $spk_produks[$i]->status_srjalan='PROSES';
            } else if ($jml_sdh_srjalan>0) {
                $spk_produks[$i]->status_srjalan='SEBAGIAN';
            }
            $spk_produks[$i]->save();
        }
        $srjalan=Srjalan::find($srjalan_id);

        // dump('jml_colly cek',$jml_colly);
        // dump('jml_dus cek',$jml_dus);
        if ($jml_colly!==0) {
            $srjalan->jml_colly=$jml_colly;
        }
        if ($jml_dus!==0) {
            $srjalan->jml_dus=$jml_dus;
        }

        $srjalan->save();
    }

    static function Update_SPK_JmlSj_Status_Packing_BasedOn_SPKProID($spk_produk_id)
    {
        $jml_colly=$jml_dus=0;
        // dump($spk_produks);
        $spk_produk=SpkProduk::find($spk_produk_id);
        $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
        $jml_sdh_srjalan=0;
        // dd('spk_produk_notas',$spk_produk_notas);
        $srjalan_id=null;
        foreach ($spk_produk_notas as $spk_produk_nota) {
            $spkProdukNoSjs=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spk_produk_nota['id'])->get(); //setiap pake get, ga bisa akses index
            // dump('spkProdukNoSjs',$spkProdukNoSjs);
            if (count($spkProdukNoSjs)!==0) {
                $j=0;
                foreach ($spkProdukNoSjs as $spkProdukNoSj) {
                    if ($j===0) {
                        $srjalan_id=$spkProdukNoSj['srjalan_id'];
                    }
                    $jml_sdh_srjalan+=$spkProdukNoSj['jumlah'];
                    if ($spkProdukNoSj['tipe_packing']==='colly') {
                        $jml_colly+=$spkProdukNoSj['jml_packing'];
                    } elseif ($spkProdukNoSj['tipe_packing']==='dus') {
                        $jml_dus+=$spkProdukNoSj['jml_packing'];
                    }
                    // Update status spk
                    $spk=Spk::find($spkProdukNoSj['spk_id']);
                    $spk->jumlah_sudah_sj+=$spkProdukNoSj['jumlah'];
                    $spk->save();

                    $status_sj="SEMUA";
                    if ($spk['jumlah_sudah_sj']===0) {
                        $status_sj="BELUM";
                    } else if ($spk['jumlah_sudah_sj']>0 && $spk['jumlah_sudah_sj']< $spk['jumlah_total']) {
                        $status_sj="SEBAGIAN";
                    } else if($spk['jumlah_sudah_sj']<0){
                        $status_sj="ERROR";
                    }
                    $spk->status_sj=$status_sj;
                    $spk->save();
                    $success_logs[]="spk->status_sj telah diupdate!";
                    $j++;
                }

            }
            // dump('jml_colly',$jml_colly);
            // dump('jml_dus',$jml_dus);

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

        $srjalan=Srjalan::find($srjalan_id);
        if ($srjalan!==null) {
            // dump('jml_colly cek',$jml_colly);
            // dump('jml_dus cek',$jml_dus);
            if ($jml_colly!==0) {
                $srjalan->jml_colly=$jml_colly;
            }
            if ($jml_dus!==0) {
                $srjalan->jml_dus=$jml_dus;
            }

            $srjalan->save();
        }
    }

    static function newSrjalan_basedOn_SpkProdukNotaID_a_Jml($spk_produk_nota_id,$jumlah)
    {
        $success_logs=array();
        $success_logs[]="o) Membuat surat jalan baru berdasarkan spk_produk_id=$spk_produk_nota_id dan jumlah yang sudah ditentukan.";
        $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
        $spk_produk=SpkProduk::find($spk_produk_nota['spk_produk_id']);
        $produk=Produk::find($spk_produk['produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        // Data Pelanggan
        $pelanggan=Pelanggan::find($spk['pelanggan_id']);
        $pelanggan_nama=$pelanggan['nama'];
        $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        $alamat_id=$cust_long_ala=$cust_short=null;
        if ($pelanggan_alamat!==null) {
            $alamat=Alamat::find($pelanggan_alamat['alamat_id']);
            $alamat_id=$alamat['id'];
            $cust_long_ala=$alamat['long'];
            $cust_short=$alamat['short'];
        }
        $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();
        $kontak_id=$cust_kontak=null;
        if ($pelanggan_kontak!==null) {
            $kontak_id=$pelanggan_kontak['id'];
            $cust_kontak=json_encode($pelanggan_kontak->toArray());
        }
        // cek langsung apakah ada ekspedisi transit
        $pelanggan_ekspedisi_transit=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('is_transit','yes')->where('tipe','UTAMA')->first();
        $ekspedisi_transit_id=$alamat_transit_id=$transit_kontak_id=$trans_long_ala=$trans_short=$trans_kontak=$transit_nama=null;
        if ($pelanggan_ekspedisi_transit!==null) {
            // ada ekspedisi transit
            $ekspedisi_transit_id=$pelanggan_ekspedisi_transit['ekspedisi_id'];
            $transit=Ekspedisi::find($ekspedisi_transit_id);
            $transit_nama=$transit['nama'];
            $success_logs[]="Ditemukan ekspedisi transit ID:$ekspedisi_transit_id";
            $transit_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi_transit_id)->where('tipe','UTAMA')->first();
            if ($transit_alamat!==null) {
                $alamat_transit=Alamat::find($transit_alamat['alamat_id']);
                $alamat_transit_id=$alamat_transit['id'];
                $trans_long_ala=$alamat_transit['long'];
                $trans_short=$alamat_transit['short'];
            }
            $transit_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi_transit_id)->where('is_aktual','yes')->first();
            if ($transit_kontak!==null) {
                $transit_kontak_id=$transit_kontak['id'];
                $trans_kontak=json_encode($transit_kontak->toArray());
            }
        }
        $pelanggan_ekspedisi_utama=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        $ekspedisi_id=$alamat_ekspedisi_id=$ekspedisi_kontak_id=$eks_long_ala=$eks_short=$eks_kontak=$ekspedisi_nama=null;
        if ($pelanggan_ekspedisi_utama!==null) {
            $ekspedisi_id=$pelanggan_ekspedisi_utama['ekspedisi_id'];
            $ekspedisi=Ekspedisi::find($ekspedisi_id);
            $ekspedisi_nama=$ekspedisi['nama'];
            $success_logs[]="Ditemukan ekspedisi utama ID:$ekspedisi_id";
            $ekspedisi_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi_id)->where('tipe','UTAMA')->first();
            if ($ekspedisi_alamat!==null) {
                $alamat_ekspedisi=Alamat::find($ekspedisi_alamat['alamat_id']);
                $alamat_ekspedisi_id=$alamat_ekspedisi['id'];
                $eks_long_ala=$alamat_ekspedisi['long'];
                $eks_short=$alamat_ekspedisi['short'];
            }
            $ekspedisi_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi_id)->where('is_aktual','yes')->first();
            if ($ekspedisi_kontak!==null) {
                $ekspedisi_kontak_id=$ekspedisi_kontak['id'];
                $eks_kontak=json_encode($ekspedisi_kontak->toArray());
            }
        }
        // Data Reseller
        $reseller_id=$alamat_reseller_id=$kontak_reseller_id=$reseller_nama=$reseller_long_ala=$reseller_short=$reseller_kontak=null;
        if ($spk['reseller_id']!==null) {
            $reseller=Pelanggan::find($spk['reseller_id']);
            $reseller_id=$reseller['id'];
            $reseller_alamat=PelangganAlamat::where('pelanggan_id',$reseller_id)->where('tipe','UTAMA')->first();
            if ($reseller_alamat!==null) {
                $alamat_reseller=Alamat::find($reseller_alamat['alamat_id']);
                $alamat_reseller_id=$alamat_reseller['id'];
                $reseller_long_ala=$alamat_reseller['long'];
                $reseller_short=$alamat_reseller['short'];
            }
            $reseller_kontak=PelangganKontak::where('pelanggan_id',$reseller_id)->where('is_aktual','yes')->first();
            if ($reseller_kontak!==null) {
                $kontak_reseller_id=$reseller_kontak['id'];
                $reseller_kontak=json_encode($reseller_kontak->toArray());
            }
        }

        $user=auth()->user();
        // dd($spk_produk_notas);
        $new_srjalan=Srjalan::create([
            'pelanggan_id'=>$spk['pelanggan_id'],
                    'reseller_id'=>$reseller_id,
                    'ekspedisi_id'=>$ekspedisi_id,
                    'ekspedisi_transit_id'=>$ekspedisi_transit_id,
                    // alamat
                    'alamat_id'=>$alamat_id,
                    'alamat_reseller_id'=>$alamat_reseller_id,
                    'alamat_ekspedisi_id'=>$alamat_ekspedisi_id,
                    'alamat_transit_id'=>$alamat_transit_id,
                    // kontak
                    'kontak_id'=>$kontak_id,
                    'kontak_reseller_id'=>$kontak_reseller_id,
                    'kontak_ekspedisi_id'=>$ekspedisi_kontak_id,
                    'kontak_transit_id'=>$transit_kontak_id,
                    'created_by'=>$user['username'],
                    'updated_by'=>$user['username'],
                    // selesai
                    'pelanggan_nama'=>$pelanggan_nama,
                    'cust_long_ala'=>$cust_long_ala,
                    'cust_short'=>$cust_short,
                    'cust_kontak'=>$cust_kontak,
                    'ekspedisi_nama'=>$ekspedisi_nama,
                    'eks_long_ala'=>$eks_long_ala,
                    'eks_short'=>$eks_short,
                    'eks_kontak'=>$eks_kontak,
                    'transit_nama'=>$transit_nama,
                    'trans_long_ala'=>$trans_long_ala,
                    'trans_short'=>$trans_short,
                    'trans_kontak'=>$trans_kontak,
                    'reseller_nama'=>$reseller_nama,
                    'reseller_long_ala'=>$reseller_long_ala,
                    'reseller_short'=>$reseller_short,
                    'reseller_kontak'=>$reseller_kontak,
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
        // dump('jumlah:',$jumlah);
        // dump('new_spk_produk_nota_srjalan', $new_spk_produk_nota_srjalan);
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

    public function getOneSjAndComponents($srjalan_id)
    {
        $srjalan = Srjalan::find($srjalan_id);
        // Data Pelanggan
        $pelanggan = Pelanggan::find($srjalan['pelanggan_id']);
        $pelanggan_nama=$srjalan['pelanggan_nama'];
        $cust_long_ala=$srjalan['cust_long_ala'];
        $alamat=null;
        if ($srjalan['alamat_id']!==null) {
            $alamat=Alamat::find($srjalan['alamat_id']);
        }
        $pelanggan_alamats=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->get();
        $alamat_avas=array();
        foreach ($pelanggan_alamats as $pelanggan_alamat) {
            $alamat_ava=Alamat::find($pelanggan_alamat['alamat_id']);
            $alamat_avas[]=$alamat_ava;
        }

        $cust_kontak=$srjalan['cust_kontak'];
        $kontak=null;
        if ($srjalan['kontak_id'!==null]) {
            $kontak=PelangganKontak::find($srjalan['kontak_id']);
        }
        $kontak_avas=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->get();

        // Data Reseller
        $reseller_nama=$srjalan['reseller_nama'];
        $reseller=null;
        if ($srjalan['reseller_id']!==null) {
            $reseller = Pelanggan::find($srjalan['reseller_id']);
        }
        $reseller_long_ala=$srjalan['reseller_long_ala'];
        $alamat_reseller=null;
        if ($srjalan['alamat_reseller_id']!==null) {
            $alamat_reseller=Alamat::find($srjalan['alamat_reseller_id']);
        }
        $reseller_alamats=$alamat_reseller_avas=array();
        if ($reseller!==null) {
            $reseller_alamats=PelangganAlamat::where('pelanggan_id',$reseller['id'])->get();
            if (count($reseller_alamats)!==0) {
                foreach ($reseller_alamats as $reseller_alamat) {
                    $alamat_reseller_ava=Alamat::find($reseller_alamat['alamat_id']);
                    $alamat_reseller_avas[]=$alamat_reseller_ava;
                }
            }
        }

        $reseller_kontak=$srjalan['reseller_kontak'];
        $kontak_reseller=null;
        if ($srjalan['kontak_reseller_id']!==null) {
            $kontak_reseller=PelangganKontak::find($srjalan['kontak_reseller_id']);
        }
        $kontak_reseller_avas=array();
        if ($reseller!==null) {
            $kontak_reseller_avas=PelangganKontak::where('pelanggan_id',$reseller['id'])->get();
        }



        $spk_produk_nota_sjs = SpkProdukNotaSrjalan::where('srjalan_id', $srjalan['id'])->get();
        $spk_produks = $produks = $data_items = array();
        foreach ($spk_produk_nota_sjs as $spk_produk_nota_sj) {
            $spk_produk = SpkProduk::find($spk_produk_nota_sj['spk_produk_id'])->toArray();
            $produk = Produk::find($spk_produk['produk_id'])->toArray();

            $spk_produks[] = $spk_produk;
            $produks[] = $produk;
            // dump($spk_produk_nota_sj['id'], $spk_produk['id']);

            $data_items[] = [
                'spk_produk_nota_sj_id' => $spk_produk_nota_sj['id'],
                'spk_produk_id' => $spk_produk['id'],
                'produk_id' => $produk['id'],
            ];
        }

        // dump('$spk_produk_notas:', $spk_produk_notas);
        // dump('$spk_produks:', $spk_produks);

        return array($srjalan,$pelanggan,$pelanggan_nama,$alamat,$cust_long_ala,$alamat_avas,$cust_kontak,$kontak,$kontak_avas,$reseller,$reseller_nama,$alamat_reseller,$reseller_long_ala,$alamat_reseller_avas,$reseller_kontak,$kontak_reseller,$kontak_reseller_avas,$spk_produk_nota_sjs, $spk_produks, $produks, $data_items);
    }

    public function sjDetail_getEkspedisi($srjalan)
    {
        // Data Ekspedisi -> sj Selesai
        $ekspedisi_nama=$srjalan['ekspedisi_nama'];
        $eks_long_ala=$srjalan['eks_long_ala'];
        $eks_kontak=$srjalan['eks_kontak'];
        // Data Ekspedisi -> awal
        $ekspedisi=null;
        if ($srjalan['ekspedisi_id']!==null) {
            $ekspedisi=Ekspedisi::find($srjalan['ekspedisi_id']);
        }
        $alamat_ekspedisi=null;
        if ($srjalan['alamat_ekspedisi_id']!==null) {
            $alamat_ekspedisi=Alamat::find($srjalan['alamat_ekspedisi_id']);
        }
        $kontak_ekspedisi=null;
        if ($srjalan['kontak_ekspedisi_id']!==null) {
            $kontak_ekspedisi=EkspedisiKontak::find($srjalan['kontak_ekspedisi_id']);
        }

        // Data Transit->sj Selesai
        $transit_nama=$srjalan['transit_nama'];
        $trans_long_ala=$srjalan['trans_long_ala'];
        $trans_kontak=$srjalan['trans_kontak'];

        // Data Transit-> awal
        $transit=$alamat_transit=$kontak_transit=null;
        if ($srjalan['ekspedisi_transit_id']!==null) {
            $transit=Ekspedisi::find($srjalan['ekspedisi_transit_id']);
        }
        if ($srjalan['alamat_transit_id']!==null) {
            $alamat_transit=Alamat::find($srjalan['alamat_transit_id']);
        }
        // else {
        //     $transit_alamat=EkspedisiAlamat::where('ekspedisi_id',$transit['id'])->where('tipe','UTAMA')->first();
        //     $alamat_transit=Alamat::find($transit_alamat['alamat_id']);
        // }
        if ($srjalan['kontak_transit_id']!==null) {
            $kontak_transit=EkspedisiKontak::find($srjalan['kontak_transit_id']);
        }
        // else {
        //     $kontak_transit=EkspedisiKontak::where('ekspedisi_id',$transit['id'])->where('is_aktual','yes')->first();
        // }

        return array($ekspedisi_nama,$eks_long_ala,$eks_kontak,$ekspedisi,$alamat_ekspedisi,$kontak_ekspedisi,$transit_nama,$trans_long_ala,$trans_kontak,$transit,$alamat_transit,$kontak_transit);
    }
    static function deleteSJ_basedOn_SPKProNSJID($spk_produk_nota_srjalan_id)
    {
        $success_logs="";
        $spk_produk_nota_sj=SpkProdukNotaSrjalan::find($spk_produk_nota_srjalan_id);
        $spk_produk_id=$spk_produk_nota_sj['spk_produk_id'];
        $spk_produk_nota_sj->delete();
        $success_logs.='spk_produk_nota_sj: berhasil dihapus!';

        //UPDATE spk_produk->jml_sdh_nota
        Srjalan::Update_SPK_JmlSj_Status_Packing_BasedOn_SPKProID($spk_produk_id);
        $success_logs.="Updating spk_produk->jumlah_sudah_srjalan dan status.";
        $main_log='Success';

        // cek apakah surat jalan masih memiliki spk_produk_nota_srjalan yang selain yang ini?
        $srjalan=Srjalan::find($spk_produk_nota_sj['srjalan_id']);
        $spk_produk_nota_sj_other=SpkProdukNotaSrjalan::where('srjalan_id',$srjalan['id'])->get();
        if (count($spk_produk_nota_sj_other)===0) {
            $srjalan->delete();
            $success_logs.="Srjalan tidak memiliki spk_produk_nota_srjalan yang lain. Srjalan dihapus!";
        } else {
            $success_logs.="Srjalan masih memiliki spk_produk_nota_srjalan yang lain. Srjalan tidak dihapus.";
        }

        return $success_logs;
    }
}
