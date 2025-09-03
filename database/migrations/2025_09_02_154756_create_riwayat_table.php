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
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->references('id')->on('kunjungan')->onDelete('cascade');
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangan')->onDelete('set null');
            $table->foreignId('pasien_id')->references('id')->on('pasien')->onDelete('cascade');
            $table->string('penyakit');
            $table->string('obat');
            $table->enum('dosis', ['1x Sehari', '2x Sehari', '3x Sehari'])->default('1x Sehari');
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->enum('status_pasien', ['Sudah Sembuh', 'Masih Sakit'])->default('Masih Sakit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat');
    }
};
