<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayat';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kunjungan_id',
        'ruangan_id',
        'pasien_id',
        'penyakit',
        'obat',
        'dosis',
        'tanggal_masuk',
        'tanggal_keluar',
        'status_pasien',
    ];

    protected $dates = [
        'tanggal_masuk',
        'tanggal_keluar',
        'created_at',
        'updated_at',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id', 'id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
