<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = [
            '100',
            '200',
            '300'
        ];

        $roles = [
            'Admin',
            'Pelatih',
            'Pemain'
        ];

        foreach ($id as $index => $role_id) {
            Roles::create([
                'role_id' => $role_id,
                'role' => $roles[$index]
            ]);
        }
    }
}
