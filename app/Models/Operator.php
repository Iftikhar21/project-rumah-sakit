<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table = 'operator';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'kode_operator',
        'nama_operator',
    ];
}
