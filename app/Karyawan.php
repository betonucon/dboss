<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'LIFNR',
        'nik',
        'name',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'golongan_darah',
        'sts_nikah',
        'nik_ktp',
        'alamat',
        'jenis_pekerjaan',
        'jadwal',
        'status',
        'lokasi_pekerjaan',
        'mulai',
        'selesai',
        'sts',


    ];

    function user(){
        return $this->belongsTo('App\User','LIFNR','username');
    }
}
