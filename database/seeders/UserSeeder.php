<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_id' => '100100',
            'nama' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'jenis_kelamin' => 'L',
            'role_id' => '100'
        ]);

        User::create([
            'user_id' => '200100',
            'nama' => 'Pelatih',
            'username' => 'Pelatih',
            'password' => bcrypt('password'),
            'jenis_kelamin' => 'L',
            'role_id' => '200'
        ]);

        User::create([
            'user_id' => '300100',
            'nama' => 'Pemain',
            'username' => 'pemain',
            'password' => bcrypt('password'),
            'jenis_kelamin' => 'L',
            'role_id' => '300'
        ]);
    }
}
