<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'nama_lengkap' => 'Admin Papa',
            'username' => 'admin',
            'no_telepon' => '085607287537',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'Admin',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'nama_lengkap' => 'Kasir Papa',
            'username' => 'kasir',
            'no_telepon' => '085102286217',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'Kasir',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
    }
}
