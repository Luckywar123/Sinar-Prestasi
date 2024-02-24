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
                'full_name'     => 'Guru',
                'username'      => 'guru',
                'email'         => 'guru@gmail.com',
                'password'      => Hash::make('123'),
                'role'          => 'Guru',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'full_name'     => 'Siswa',
                'username'      => 'siswa',
                'email'         => 'siswa@gmail.com',
                'password'      => Hash::make('123'),
                'role'          => 'Siswa',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'full_name'     => 'Admin Soal',
                'username'      => 'adminsoal',
                'email'         => 'adminsoal@gmail.com',
                'password'      => Hash::make('123'),
                'role'          => 'Admin Soal',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ]);
    }
}
