<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            UkuranSeeder::class,
            JahitSeeder::class,
            KombiSeeder::class,
            TspjapSeeder::class,
            StandarSeeder::class,
            TankpadSeeder::class,
            BusastangSeeder::class,
            StikerSeeder::class,
            ProdukSeeder::class,
            // SpkSeeder::class,
            VarianSeeder::class,
            AttsjvariasiSeeder::class,
        ]);
    }
}
