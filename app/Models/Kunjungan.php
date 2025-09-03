<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_rekam_medis',
        'user_id',
        'pasien_id',
        'operator_id',
        'dokter_id',
        'keluhan',
        'jenis_perawatan',
        'tanggal_kunjungan',
        'status_kunjungan',
    ];

    protected $dates = [
        'tanggal_kunjungan',
        'created_at',
        'updated_at',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    public function riwayat()
    {
        return $this->hasOne(Riwayat::class, 'kunjungan_id', 'id');
    }
}
