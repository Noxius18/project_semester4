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
        Schema::create('absen', function (Blueprint $table) {
            $table->string('absen_id', 6)->primary();
            $table->enum('status', ['Hadir', 'Tidak Hadir']);
            $table->string('user_id', 6);
            $table->string('jadwal_id', 14);
            
            // Foreign Key
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('jadwal_id')->references('jadwal_id')->on('jadwal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens');
    }
};
