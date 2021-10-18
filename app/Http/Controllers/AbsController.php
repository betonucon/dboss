<?php

namespace App\Http\Controllers;
use App\Vendor;
use App\User;
use App\Covid;
use App\Karyawan;
use App\Absensi;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AbsController extends Controller
{
    public function index(request $request){
        if(Auth::user()['role_id']==4){
            $menu='Riwayat Covid';
            $data=Covid::select('nik_ktp')->where('LIFNR',Auth::user()->username)->groupBy('nik_ktp')->orderBy('nik_ktp','Asc')->get();
            return view('covid.index',compact('menu','data'));
        }else{
            return view('error');
        }
    }

    public function cek_ktp(request $request){
        echo'sdsdsdsd';
        
    }

    

    public function proses_absen(request $request){
        error_reporting(0);
        
        $rules = [
            'nik_ktp'=> 'required|numeric',
            'tgl_mulai'=> 'required|date',
            'tgl_sampai'=> 'required|date',
            
        ];

        $messages = [
            'nik_ktp.required'=> 'Pilih Karyawan', 
            'tgl_mulai.required'=> 'Isi Tanggal Mulai', 
            'tgl_sampai.required'=> 'Isi Tanggal Sampai', 
            
            
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
        }else{
            
        }
    }
}
