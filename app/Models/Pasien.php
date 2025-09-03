<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pasien';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'user_id',
        'id_pasien',
        'nama_pasien',
        'tanggal_lahir',
        'jenis_kelamin',   // L / P
        'alamat_pasien',
        'kota_pasien',
        'nomor_telepon',
        'usia_pasien',
    ];

    // Kolom yang dianggap tanggal
    protected $dates = [
        'tanggal_lahir',
        'created_at',
        'updated_at',
    ];

    // Casting tipe data
    protected $casts = [
        'usia_pasien' => 'integer',
    ];

    /**
     * Aturan validasi
     */
    public static function rules()
    {
        return [
            'id_pasien'     => 'required|string|max:20|unique:pasien,id_pasien',
            'nama_pasien'   => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_pasien' => 'nullable|string|max:255',
            'kota_pasien'   => 'nullable|string|max:100',
            'nomor_telepon' => 'nullable|string|max:20',
            'usia_pasien'   => 'nullable|integer|min:0',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'pasien_id', 'id');
    }
}
