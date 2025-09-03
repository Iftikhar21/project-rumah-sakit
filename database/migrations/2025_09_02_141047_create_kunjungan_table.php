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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->string("no_rekam_medis")->unique();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade');
            $table->foreignId('operator_id')->nullable()->constrained('operator')->onDelete('set null');
            $table->foreignId('dokter_id')->nullable()->constrained('dokters')->onDelete('set null');

            $table->text('keluhan');
            $table->string('jenis_perawatan')->nullable();
            $table->date('tanggal_kunjungan');

            $table->enum('status_kunjungan', ['pending', 'diproses', 'diterima', 'ditolak', 'selesai', 'dibatalkan'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
