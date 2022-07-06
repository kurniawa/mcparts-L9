<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            SiteSettingSeeder::class,
            NegaraSeeder::class,
            PulauSeeder::class,
            DaerahSeeder::class,
            EkspedisiSeeder::class,
            PelangganSeeder::class,
            PelangganEkspedisiSeeder::class,
            BahanSeeder::class,
            VariasiSeeder::class,
            // UkuranSeeder::class,
            // JahitSeeder::class,
            // KombiSeeder::class,
            KombinasiSeeder::class,
            TsixpackSeeder::class,
            JapstyleSeeder::class,
            MotifSeeder::class,
            // TspjapSeeder::class,
            StandarSeeder::class,
            TankpadSeeder::class,
            StikerSeeder::class,
            BusastangSeeder::class,
            ProdukSeeder::class,
            // SpkSeeder::class,
            SpecSeeder::class,
            VarianSeeder::class,
            AttsjvariasiSeeder::class,
            ProdukBahanSeeder::class,
            ProdukSpecSeeder::class,
            ProdukKombinasiSeeder::class,
            ProdukTsixpackSeeder::class,
            ProdukJapstyleSeeder::class,
            ProdukMotifSeeder::class,
            ProdukStandarSeeder::class,
            ProdukTankpadSeeder::class,
            ProdukStikerSeeder::class,
            ProdukBusastangSeeder::class,
        ]);
    }
}
