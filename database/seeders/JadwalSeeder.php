<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jadwal::create([
            'jadwal_id' => 'REG0000RAB',
            'hari' => 'Rabu',
            'lokasi' => 'Andi Futsal',
            'tanggal' => NULL,
            'waktu_mulai' => '15:00:00',
            'waktu_selesai' => '18:00:00',
            'tim_lawan' => NULL,
            'status' => 'Tutup'
        ]);

        Jadwal::create([
            'jadwal_id' => 'REG0000JUM',
            'hari' => 'Jumat',
            'lokasi' => 'Andi Futsal',
            'tanggal' => NULL,
            'waktu_mulai' => '15:00:00',
            'waktu_selesai' => '18:00:00',
            'tim_lawan' => NULL,
            'status' => 'Tutup'
        ]);

        Jadwal::create([
            'jadwal_id' => 'REG0000MIN',
            'hari' => 'Minggu',
            'lokasi' => 'Andi Futsal',
            'tanggal' => NULL,
            'waktu_mulai' => '15:00:00',
            'waktu_selesai' => '18:00:00',
            'tim_lawan' => NULL,
            'status' => 'Tutup'
        ]);
    }
}
