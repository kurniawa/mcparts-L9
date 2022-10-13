<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            ['nama' => 'Adi Kurniawan', 'username' => 'cibinongguy', 'password' => 'ddloveakunsomuch','clearance'=>'Developer'],
            ['nama' => 'Adi Kurniawan', 'username' => 'kuruniawa', 'password' => 'ddloveakunsomuch','clearance'=>'SuperAdmin'],
            ['nama' => 'Aldebaran', 'username' => 'aldebaran', 'password' => 'aldebaran','clearance'=>'User'],
        ];

        for ($i = 0; $i < count($user); $i++) {
            DB::table('users')->insert([
                'nama' => $user[$i]['nama'],
                'username' => $user[$i]['username'],
                'password' => bcrypt($user[$i]['password']),
                'clearance' => $user[$i]['clearance'],
            ]);
        }
    }
}
