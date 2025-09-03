<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            
            // relasi ke users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('id_pasien')->unique()->index();
            $table->string('nama_pasien')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->text('alamat_pasien')->nullable();
            $table->string('kota_pasien')->nullable();
            $table->string('nomor_telepon')->nullable();

            // opsional (sebenarnya bisa dihitung dari tanggal_lahir)
            $table->unsignedInteger('usia_pasien')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasien'); // ini disamain aja, jangan "pasiens"
    }
};
