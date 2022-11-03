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
            ['nama' => 'Aldebaran', 'username' => 'aldebaran', 'password' => 'aldebaranloveandin','clearance'=>'User'],
            ['nama' => 'Dian', 'username' => 'Dian', 'password' => '$2y$10$qspfvv/36ezAsiQZpVANv.0t3mrCzXQHGQ9sW.0pj0BBsrWnZXtTC','clearance'=>'Admin'],
            ['nama' => 'Albert', 'username' => 'Albert21', 'password' => '$2y$10$ya1Gh.oPGCJxAnT.ewhP8.rM/mRR9ref9W1nKyLp67IMjevl1rvG6','clearance'=>'Admin'],
        ];

        for ($i = 0; $i < count($user); $i++) {
            $password=$user[$i]['password'];
            if ($user[$i]['username']!=='Dian' || $user[$i]['username']!=='Albert21') {
                $password=bcrypt($password);
            }
            DB::table('users')->insert([
                'nama' => $user[$i]['nama'],
                'username' => $user[$i]['username'],
                'password' => $password,
                'clearance' => $user[$i]['clearance'],
            ]);
        }
    }
}
