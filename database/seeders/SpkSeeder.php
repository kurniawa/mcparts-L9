<?php

namespace Database\Seeders;

use App\Models\Nota;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spks=[
            ["id"=>1,"no_spk"=>"SPK-1","pelanggan_id"=>1,"reseller_id"=>null,"status"=>"SELESAI","status_nota"=>"BELUM","status_sj"=>"BELUM","status_tree"=>"BELUM","judul"=>null,"jumlah_selesai"=>300,"jumlah_total"=>300,"harga_total"=>5700000,"jumlah_sudah_nota"=>0,"jumlah_sudah_sj"=>0,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>"2022-10-13 09:36:15","created_at"=>"2022-09-01T02:34:56.000000Z","updated_at"=>"2022-10-13T02:36:15.000000Z"],
            ["id"=>2,"no_spk"=>"SPK-2","pelanggan_id"=>4,"reseller_id"=>3,"status"=>"SELESAI","status_nota"=>"BELUM","status_sj"=>"BELUM","status_tree"=>"BELUM","judul"=>null,"jumlah_selesai"=>300,"jumlah_total"=>300,"harga_total"=>5250000,"jumlah_sudah_nota"=>0,"jumlah_sudah_sj"=>0,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>"2022-10-13 09:39:21","created_at"=>"2022-09-06T02:37:44.000000Z","updated_at"=>"2022-10-13T02:39:21.000000Z"],
            ["id"=>3,"no_spk"=>"SPK-3","pelanggan_id"=>12,"reseller_id"=>null,"status"=>"SELESAI","status_nota"=>"BELUM","status_sj"=>"BELUM","status_tree"=>"BELUM","judul"=>null,"jumlah_selesai"=>300,"jumlah_total"=>300,"harga_total"=>5400000,"jumlah_sudah_nota"=>0,"jumlah_sudah_sj"=>0,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>"2022-10-13 09:41:09","created_at"=>"2022-10-07T02:40:02.000000Z","updated_at"=>"2022-10-13T02:41:09.000000Z"],
            ["id"=>4,"no_spk"=>"SPK-4","pelanggan_id"=>13,"reseller_id"=>null,"status"=>"SELESAI","status_nota"=>"BELUM","status_sj"=>"BELUM","status_tree"=>"BELUM","judul"=>null,"jumlah_selesai"=>300,"jumlah_total"=>300,"harga_total"=>5850000,"jumlah_sudah_nota"=>0,"jumlah_sudah_sj"=>0,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>"2022-10-13 09:42:20","created_at"=>"2022-10-13T02:41:43.000000Z","updated_at"=>"2022-10-13T02:42:20.000000Z"]];
        $arr_spk_produk=
        [
            [
                ["id"=>1,"spk_id"=>1,"produk_id"=>3,"keterangan"=>null,"jumlah"=>150,"deviasi_jml"=>0,"jml_t"=>150,"jml_selesai"=>150,"jml_blm_sls"=>0,"jml_sdh_nota"=>150,"jumlah_sudah_srjalan"=>150,"harga"=>20500,"koreksi_harga"=>null,"status"=>"SELESAI","data_selesai"=>null,"data_nota"=>null,"data_srjalan"=>null,"status_nota"=>"SELESAI","status_srjalan"=>"SELESAI","finished_at"=>"2022-10-13 09:36:15","created_at"=>null,"updated_at"=>"2022-10-13T02:36:29.000000Z"],
                ["id"=>2,"spk_id"=>1,"produk_id"=>2,"keterangan"=>null,"jumlah"=>150,"deviasi_jml"=>0,"jml_t"=>150,"jml_selesai"=>150,"jml_blm_sls"=>0,"jml_sdh_nota"=>150,"jumlah_sudah_srjalan"=>150,"harga"=>17500,"koreksi_harga"=>null,"status"=>"SELESAI","data_selesai"=>null,"data_nota"=>null,"data_srjalan"=>null,"status_nota"=>"SELESAI","status_srjalan"=>"SELESAI","finished_at"=>"2022-10-13 09:36:15","created_at"=>null,"updated_at"=>"2022-10-13T02:36:29.000000Z"]
            ],
            [
                ["id"=>3,"spk_id"=>2,"produk_id"=>2,"keterangan"=>null,"jumlah"=>150,"deviasi_jml"=>0,"jml_t"=>150,"jml_selesai"=>150,"jml_blm_sls"=>0,"jml_sdh_nota"=>150,"jumlah_sudah_srjalan"=>150,"harga"=>17500,"koreksi_harga"=>null,"status"=>"SELESAI","data_selesai"=>null,"data_nota"=>null,"data_srjalan"=>null,"status_nota"=>"SELESAI","status_srjalan"=>"SELESAI","finished_at"=>"2022-10-13 09:39:21","created_at"=>null,"updated_at"=>"2022-10-13T02:39:30.000000Z"],
                ["id"=>4,"spk_id"=>2,"produk_id"=>4,"keterangan"=>null,"jumlah"=>150,"deviasi_jml"=>0,"jml_t"=>150,"jml_selesai"=>150,"jml_blm_sls"=>0,"jml_sdh_nota"=>150,"jumlah_sudah_srjalan"=>150,"harga"=>17500,"koreksi_harga"=>null,"status"=>"SELESAI","data_selesai"=>null,"data_nota"=>null,"data_srjalan"=>null,"status_nota"=>"SELESAI","status_srjalan"=>"SELESAI","finished_at"=>"2022-10-13 09:39:21","created_at"=>null,"updated_at"=>"2022-10-13T02:39:31.000000Z"]
            ],
            [
                ["id"=>5,"spk_id"=>3,"produk_id"=>5,"keterangan"=>null,"jumlah"=>150,"deviasi_jml"=>0,"jml_t"=>150,"jml_selesai"=>150,"jml_blm_sls"=>0,"jml_sdh_nota"=>150,"jumlah_sudah_srjalan"=>150,"harga"=>17500,"koreksi_harga"=>null,"status"=>"SELESAI","data_selesai"=>null,"data_nota"=>null,"data_srjalan"=>null,"status_nota"=>"SELESAI","status_srjalan"=>"SELESAI","finished_at"=>"2022-10-13 09:41:09","created_at"=>null,"updated_at"=>"2022-10-13T02:41:17.000000Z"],
                ["id"=>6,"spk_id"=>3,"produk_id"=>6,"keterangan"=>null,"jumlah"=>150,"deviasi_jml"=>0,"jml_t"=>150,"jml_selesai"=>150,"jml_blm_sls"=>0,"jml_sdh_nota"=>150,"jumlah_sudah_srjalan"=>150,"harga"=>18500,"koreksi_harga"=>null,"status"=>"SELESAI","data_selesai"=>null,"data_nota"=>null,"data_srjalan"=>null,"status_nota"=>"SELESAI","status_srjalan"=>"SELESAI","finished_at"=>"2022-10-13 09:41:09","created_at"=>null,"updated_at"=>"2022-10-13T02:41:18.000000Z"]
            ],
            [
                ["id"=>7,"spk_id"=>4,"produk_id"=>7,"keterangan"=>null,"jumlah"=>150,"deviasi_jml"=>0,"jml_t"=>150,"jml_selesai"=>150,"jml_blm_sls"=>0,"jml_sdh_nota"=>150,"jumlah_sudah_srjalan"=>150,"harga"=>17500,"koreksi_harga"=>null,"status"=>"SELESAI","data_selesai"=>null,"data_nota"=>null,"data_srjalan"=>null,"status_nota"=>"SELESAI","status_srjalan"=>"SELESAI","finished_at"=>"2022-10-13 09:42:20","created_at"=>null,"updated_at"=>"2022-10-13T02:42:31.000000Z"],
                ["id"=>8,"spk_id"=>4,"produk_id"=>8,"keterangan"=>null,"jumlah"=>150,"deviasi_jml"=>0,"jml_t"=>150,"jml_selesai"=>150,"jml_blm_sls"=>0,"jml_sdh_nota"=>150,"jumlah_sudah_srjalan"=>150,"harga"=>21500,"koreksi_harga"=>null,"status"=>"SELESAI","data_selesai"=>null,"data_nota"=>null,"data_srjalan"=>null,"status_nota"=>"SELESAI","status_srjalan"=>"SELESAI","finished_at"=>"2022-10-13 09:42:20","created_at"=>null,"updated_at"=>"2022-10-13T02:42:31.000000Z"]
            ]
        ];
        $arr_spk_produk_nota=[[["id"=>1,"spk_id"=>1,"produk_id"=>3,"spk_produk_id"=>1,"nota_id"=>1,"jumlah"=>150,"harga"=>20500,"produk_harga_id"=>null,"pelanggan_produk_id"=>null,"namaproduk_id"=>null,"harga_t"=>3075000,"is_price_updated"=>"no","created_at"=>"2022-10-13T02:36:21.000000Z","updated_at"=>"2022-10-13T02:36:21.000000Z"],["id"=>2,"spk_id"=>1,"produk_id"=>2,"spk_produk_id"=>2,"nota_id"=>1,"jumlah"=>150,"harga"=>17500,"produk_harga_id"=>null,"pelanggan_produk_id"=>null,"namaproduk_id"=>null,"harga_t"=>2625000,"is_price_updated"=>"no","created_at"=>"2022-10-13T02:36:21.000000Z","updated_at"=>"2022-10-13T02:36:21.000000Z"]],[["id"=>3,"spk_id"=>2,"produk_id"=>2,"spk_produk_id"=>3,"nota_id"=>2,"jumlah"=>150,"harga"=>17500,"produk_harga_id"=>null,"pelanggan_produk_id"=>null,"namaproduk_id"=>null,"harga_t"=>2625000,"is_price_updated"=>"no","created_at"=>"2022-10-13T02:39:25.000000Z","updated_at"=>"2022-10-13T02:39:25.000000Z"],["id"=>4,"spk_id"=>2,"produk_id"=>4,"spk_produk_id"=>4,"nota_id"=>2,"jumlah"=>150,"harga"=>17500,"produk_harga_id"=>null,"pelanggan_produk_id"=>null,"namaproduk_id"=>null,"harga_t"=>2625000,"is_price_updated"=>"no","created_at"=>"2022-10-13T02:39:25.000000Z","updated_at"=>"2022-10-13T02:39:25.000000Z"]],[["id"=>5,"spk_id"=>3,"produk_id"=>5,"spk_produk_id"=>5,"nota_id"=>3,"jumlah"=>150,"harga"=>17500,"produk_harga_id"=>null,"pelanggan_produk_id"=>null,"namaproduk_id"=>null,"harga_t"=>2625000,"is_price_updated"=>"no","created_at"=>"2022-10-13T02:41:13.000000Z","updated_at"=>"2022-10-13T02:41:13.000000Z"],["id"=>6,"spk_id"=>3,"produk_id"=>6,"spk_produk_id"=>6,"nota_id"=>3,"jumlah"=>150,"harga"=>18500,"produk_harga_id"=>null,"pelanggan_produk_id"=>null,"namaproduk_id"=>null,"harga_t"=>2775000,"is_price_updated"=>"no","created_at"=>"2022-10-13T02:41:13.000000Z","updated_at"=>"2022-10-13T02:41:13.000000Z"]],[["id"=>7,"spk_id"=>4,"produk_id"=>7,"spk_produk_id"=>7,"nota_id"=>4,"jumlah"=>150,"harga"=>17500,"produk_harga_id"=>null,"pelanggan_produk_id"=>null,"namaproduk_id"=>null,"harga_t"=>2625000,"is_price_updated"=>"no","created_at"=>"2022-10-13T02:42:26.000000Z","updated_at"=>"2022-10-13T02:42:26.000000Z"],["id"=>8,"spk_id"=>4,"produk_id"=>8,"spk_produk_id"=>8,"nota_id"=>4,"jumlah"=>150,"harga"=>21500,"produk_harga_id"=>null,"pelanggan_produk_id"=>null,"namaproduk_id"=>null,"harga_t"=>3225000,"is_price_updated"=>"no","created_at"=>"2022-10-13T02:42:26.000000Z","updated_at"=>"2022-10-13T02:42:26.000000Z"]]];

        $notas=[["id"=>1,"no_nota"=>"N-1","pelanggan_id"=>1,"reseller_id"=>null,"status_bayar"=>"BELUM","status_sj"=>"BELUM","jumlah_sj"=>0,"jumlah_total"=>300,"harga_total"=>5700000,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>null,"created_at"=>"2022-09-01T02:36:21.000000Z","updated_at"=>"2022-10-13T02:36:21.000000Z"],["id"=>2,"no_nota"=>"N-2","pelanggan_id"=>4,"reseller_id"=>3,"status_bayar"=>"BELUM","status_sj"=>"BELUM","jumlah_sj"=>0,"jumlah_total"=>300,"harga_total"=>5250000,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>null,"created_at"=>"2022-09-06T02:39:25.000000Z","updated_at"=>"2022-10-13T02:39:26.000000Z"],["id"=>3,"no_nota"=>"N-3","pelanggan_id"=>12,"reseller_id"=>null,"status_bayar"=>"BELUM","status_sj"=>"BELUM","jumlah_sj"=>0,"jumlah_total"=>300,"harga_total"=>5400000,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>null,"created_at"=>"2022-10-08T02:41:13.000000Z","updated_at"=>"2022-10-13T02:41:13.000000Z"],["id"=>4,"no_nota"=>"N-4","pelanggan_id"=>13,"reseller_id"=>null,"status_bayar"=>"BELUM","status_sj"=>"BELUM","jumlah_sj"=>0,"jumlah_total"=>300,"harga_total"=>5850000,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>null,"created_at"=>"2022-10-07T02:42:26.000000Z","updated_at"=>"2022-10-13T02:42:26.000000Z"]];

        $arr_spk_produk_nota_sj=[[["id"=>1,"spk_id"=>1,"produk_id"=>3,"nota_id"=>1,"srjalan_id"=>1,"spk_produk_id"=>1,"spk_produk_nota_id"=>1,"jumlah"=>150,"tipe_packing"=>"colly","jml_packing"=>1,"created_at"=>"2022-10-13T02:36:28.000000Z","updated_at"=>"2022-10-13T02:36:28.000000Z"],["id"=>2,"spk_id"=>1,"produk_id"=>2,"nota_id"=>1,"srjalan_id"=>1,"spk_produk_id"=>2,"spk_produk_nota_id"=>2,"jumlah"=>150,"tipe_packing"=>"colly","jml_packing"=>1,"created_at"=>"2022-10-13T02:36:29.000000Z","updated_at"=>"2022-10-13T02:36:29.000000Z"]],[["id"=>3,"spk_id"=>2,"produk_id"=>2,"nota_id"=>2,"srjalan_id"=>2,"spk_produk_id"=>3,"spk_produk_nota_id"=>3,"jumlah"=>150,"tipe_packing"=>"colly","jml_packing"=>1,"created_at"=>"2022-10-13T02:39:30.000000Z","updated_at"=>"2022-10-13T02:39:30.000000Z"],["id"=>4,"spk_id"=>2,"produk_id"=>4,"nota_id"=>2,"srjalan_id"=>2,"spk_produk_id"=>4,"spk_produk_nota_id"=>4,"jumlah"=>150,"tipe_packing"=>"colly","jml_packing"=>1,"created_at"=>"2022-10-13T02:39:30.000000Z","updated_at"=>"2022-10-13T02:39:30.000000Z"]],[["id"=>5,"spk_id"=>3,"produk_id"=>5,"nota_id"=>3,"srjalan_id"=>3,"spk_produk_id"=>5,"spk_produk_nota_id"=>5,"jumlah"=>150,"tipe_packing"=>"colly","jml_packing"=>1,"created_at"=>"2022-10-13T02:41:17.000000Z","updated_at"=>"2022-10-13T02:41:17.000000Z"],["id"=>6,"spk_id"=>3,"produk_id"=>6,"nota_id"=>3,"srjalan_id"=>3,"spk_produk_id"=>6,"spk_produk_nota_id"=>6,"jumlah"=>150,"tipe_packing"=>"colly","jml_packing"=>1,"created_at"=>"2022-10-13T02:41:18.000000Z","updated_at"=>"2022-10-13T02:41:18.000000Z"]],[["id"=>7,"spk_id"=>4,"produk_id"=>7,"nota_id"=>4,"srjalan_id"=>4,"spk_produk_id"=>7,"spk_produk_nota_id"=>7,"jumlah"=>150,"tipe_packing"=>"colly","jml_packing"=>1,"created_at"=>"2022-10-13T02:42:31.000000Z","updated_at"=>"2022-10-13T02:42:31.000000Z"],["id"=>8,"spk_id"=>4,"produk_id"=>8,"nota_id"=>4,"srjalan_id"=>4,"spk_produk_id"=>8,"spk_produk_nota_id"=>8,"jumlah"=>150,"tipe_packing"=>"colly","jml_packing"=>1,"created_at"=>"2022-10-13T02:42:31.000000Z","updated_at"=>"2022-10-13T02:42:31.000000Z"]]];

        $sjs=[["id"=>1,"no_srjalan"=>"SJ-1","pelanggan_id"=>1,"ekspedisi_id"=>4,"ekspedisi_transit_id"=>null,"reseller_id"=>null,"status"=>"PROSES KIRIM","jml_colly"=>1,"jml_dus"=>0,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>null,"created_at"=>"2022-09-01T02:36:28.000000Z","updated_at"=>"2022-10-13T02:36:29.000000Z"],["id"=>2,"no_srjalan"=>"SJ-2","pelanggan_id"=>4,"ekspedisi_id"=>7,"ekspedisi_transit_id"=>null,"reseller_id"=>3,"status"=>"PROSES KIRIM","jml_colly"=>1,"jml_dus"=>0,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>null,"created_at"=>"2022-09-06T02:39:30.000000Z","updated_at"=>"2022-10-13T02:39:30.000000Z"],["id"=>3,"no_srjalan"=>"SJ-3","pelanggan_id"=>12,"ekspedisi_id"=>22,"ekspedisi_transit_id"=>null,"reseller_id"=>null,"status"=>"PROSES KIRIM","jml_colly"=>1,"jml_dus"=>0,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>null,"created_at"=>"2022-10-08T02:41:17.000000Z","updated_at"=>"2022-10-13T02:41:17.000000Z"],["id"=>4,"no_srjalan"=>"SJ-4","pelanggan_id"=>13,"ekspedisi_id"=>20,"ekspedisi_transit_id"=>null,"reseller_id"=>null,"status"=>"PROSES KIRIM","jml_colly"=>1,"jml_dus"=>0,"created_by"=>"cibinongguy","updated_by"=>"cibinongguy","finished_at"=>null,"created_at"=>"2022-10-07T02:42:31.000000Z","updated_at"=>"2022-10-13T02:42:31.000000Z"]];

        for ($i = 0; $i < count($spks); $i++) {
            Spk::create($spks[$i]);
            foreach ($arr_spk_produk[$i] as $spk_produks) {
                SpkProduk::create($spk_produks);
            }
        }

        for ($j=0; $j < count($notas); $j++) {
            Nota::create($notas[$j]);
            foreach ($arr_spk_produk_nota[$j] as $spk_produk_notas) {
                SpkProdukNota::create($spk_produk_notas);
            }
        }

        for ($k=0; $k < count($sjs); $k++) {
            Srjalan::create($sjs[$k]);
            foreach ($arr_spk_produk_nota_sj[$k] as $spk_produk_nota_sjs) {
                SpkProdukNotaSrjalan::create($spk_produk_nota_sjs);
            }
        }

    }
}
