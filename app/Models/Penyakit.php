<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'penyakit_id');
    }
}
