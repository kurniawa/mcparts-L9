<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site_settings = [
            ['setting' => 'load_num', 'value' => 0]
        ];
        // for ($i = 0; $i < count($site_settings); $i++) {
        //     SiteSetting::create([
        //         'setting' => $site_settings[$i]['setting'],
        //         'value' => $site_settings[$i]['value'],
        //     ]);
        // }
        for ($i = 0; $i < count($site_settings); $i++) {
            DB::table('site_settings')->insert([
                'setting' => $site_settings[$i]['setting'],
                'value' => $site_settings[$i]['value'],
            ]);
        }
    }
}
