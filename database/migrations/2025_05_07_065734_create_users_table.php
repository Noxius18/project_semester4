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
        Schema::create('user', function (Blueprint $table) {
            $table->string('user_id', 6)->primary();
            $table->string('nama', 75);
            $table->string('username',25);
            $table->string('password',60);
            $table->enum('jenis_kelamin', ['L','P'])->default('L');
            $table->char('role_id', 3);
            $table->timestamps();

            // Foreign Key
            $table->foreign('role_id')->references('role_id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
