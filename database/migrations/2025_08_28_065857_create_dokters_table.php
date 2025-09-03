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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('idDokter')->unique(); // misal D001, D002
            $table->string('namaDokter');
            $table->date('tanggalLahir');
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->string('spesialisasi');
            $table->string('jamPraktik')->nullable(); // bisa ganti ke time kalau fix format
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
