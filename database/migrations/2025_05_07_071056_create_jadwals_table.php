<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->string('jadwal_id', 14)->primary();
            $table->enum('hari', ['Senin','
                                                    Selasa', 
                                                    'Rabu', 
                                                    'Kamis', 
                                                    'Jumat',
                                                    'Sabtu',
                                                    'Minggu']);
            $table->string('Lokasi', 50);
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('tim_lawan', 50);
            $table->enum('status', ['Buka', 'Tutup']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
