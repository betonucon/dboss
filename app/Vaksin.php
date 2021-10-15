<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaksin extends Model
{
    protected $table = 'vaksin';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nik_ktp',
        'name',
        'tgl_vaksin',
        'tgl_create',
        'LIFNR',
    ];
}
