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
        Schema::create("jadwal_pelatih", function (Blueprint $table) {
            $table->string('pelatih_id', 6);
            $table->string('jadwal_id',20);

            // Foreign Key
            $table->foreign('pelatih_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('jadwal_id')->references('jadwal_id')->on('jadwal')->onDelete('cascade');

            $table->primary(['pelatih_id', 'jadwal_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelatih');
    }
};
