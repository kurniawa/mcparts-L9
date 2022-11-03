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
            // NegaraSeeder::class,deleted
            // PulauSeeder::class,deleted
            // DaerahSeeder::class,deleted
            EkspedisiSeeder::class,
            PelangganSeeder::class,
            // PelangganEkspedisiSeeder::class, deleted
            BahanSeeder::class,
            VariasiSeeder::class,
            // UkuranSeeder::class,deleted
            // JahitSeeder::class,deleted
            // KombiSeeder::class,deleted
            KombinasiSeeder::class,
            TsixpackSeeder::class,
            // JapstyleSeeder::class,deleted
            MotifSeeder::class,
            // TspjapSeeder::class,
            StandarSeeder::class,
            TankpadSeeder::class,
            StikerSeeder::class,
            BusastangSeeder::class,
            SpecSeeder::class,
            VarianSeeder::class,
            JokassySeeder::class,
            RolSeeder::class,
            RotanSeeder::class,
            ProdukSeeder::class,
            // SpkSeeder::class,
            // AttsjvariasiSeeder::class, deleted
            // ProdukBahanSeeder::class, deleted
            // ProdukSpecSeeder::class, deleted
            // ProdukKombinasiSeeder::class, deleted
            // ProdukTsixpackSeeder::class, deleted
            // ProdukJapstyleSeeder::class, deleted
            // ProdukMotifSeeder::class, deleted
            // ProdukStandarSeeder::class, deleted
            // ProdukTankpadSeeder::class,deleted
            // ProdukStikerSeeder::class,deleted
            // ProdukBusastangSeeder::class,deleted
        ]);
    }
}
