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
            'nama_lengkap' => 'Admin Papa',
            'username' => 'admin',
            'no_telepon' => '085607287517',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'Admin',
            'created_at' => Carbon::now('GMT+7'),
            'email_verified_at' => Carbon::now('GMT+7'),            
            'updated_at' => Carbon::now('GMT+7'),
        ]);
        DB::table('users')->insert([
            'nama_lengkap' => 'Kasir Papa',
            'username' => 'kasir',
            'no_telepon' => '085102286217',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'Kasir',
            'created_at' => Carbon::now('GMT+7'),
            'email_verified_at' => Carbon::now('GMT+7'),
        ]);
        DB::table('users')->insert([
            'nama_lengkap' => 'Developer Papa',
            'username' => 'developer',
            'no_telepon' => '082257229963',
            'email' => 'developer@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'Developer',
            'created_at' => Carbon::now('GMT+7'),
            'email_verified_at' => Carbon::now('GMT+7'),
        ]);
        DB::table('users')->insert([
            'nama_lengkap' => 'Supervisor Papa',
            'username' => 'supervisor',
            'no_telepon' => '082257229913',
            'email' => 'supervisor@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'Supervisor',
            'created_at' => Carbon::now('GMT+7'),
            'email_verified_at' => Carbon::now('GMT+7'),
        ]);
    }
}
