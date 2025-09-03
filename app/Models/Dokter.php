<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokters';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'idDokter',
        'namaDokter',
        'tanggalLahir',
        'jenisKelamin',
        'spesialisasi',
        'jamPraktik',
    ];

    // Relasi ke ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'lokasiPraktik', 'id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
