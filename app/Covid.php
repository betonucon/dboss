<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    protected $table = 'covid';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nik_ktp',
        'name',
        'tgl_vaksin',
        'tgl_mulai',
        'tgl_sampai',
        'tgl_create',
        'LIFNR',
    ];

    function karyawan(){
        return $this->belongsTo('App\Karyawan','nik_ktp','nik_ktp');
    }
}
