<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'full_name'     => 'Syafitra Alfa Ridzi',
                'username'      => 'admin',
                'email'         => 'ia1alfaridzi@gmail.com',
                'password'      => Hash::make('123'),
                'role'          => 'Admin Soal',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'full_name'     => 'Guru I',
                'username'      => 'gurusatu',
                'email'         => 'gurusatu@gmail.com',
                'password'      => Hash::make('123'),
                'role'          => 'Guru',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'full_name'     => 'Guru II',
                'username'      => 'gurudua',
                'email'         => 'gurudua@gmail.com',
                'password'      => Hash::make('123'),
                'role'          => 'Guru',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'full_name'     => 'Admin Soal I',
                'username'      => 'adminsoalsatu',
                'email'         => 'adminsoalsatu@gmail.com',
                'password'      => Hash::make('123'),
                'role'          => 'Admin Soal',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ]);
    }
}
