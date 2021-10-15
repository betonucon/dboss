<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nik_ktp',
        'tanggal',
        'jam',
        'waktu',
        'LIFNR',
    ];
}
