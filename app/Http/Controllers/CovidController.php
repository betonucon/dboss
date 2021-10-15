<?php

namespace App\Http\Controllers;
use App\Vendor;
use App\User;
use App\Covid;
use App\Karyawan;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class CovidController extends Controller
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

    public function reset(request $request){
        error_reporting(0);
        $jumlah=count($request->nik_ktp);
        if($jumlah>0){
            for($x=0;$x<$jumlah;$x++){
                $cekvaksin=Covid::where('nik_ktp',$request->nik_ktp)->delete();
            }
            echo'ok';
        }else{
            echo'-&nbsp; Pilih Data yang akan direset ';
        }
    }

    public function save(request $request){
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
            $cek=Karyawan::where('nik_ktp',$request->nik_ktp)->where('LIFNR',Auth::user()['username'])->count();
            if($cek>0){
                
                $data=Covid::create([
                    'nik_ktp'=>$request->nik_ktp,
                    'tgl_mulai'=>$request->tgl_mulai,
                    'tgl_selesai'=>$request->tgl_sampai,
                    'tgl_create'=>date('Y-m-d'),
                    'LIFNR'=>Auth::user()['username'],
                ]);

                echo'ok';
              
            }else{
                echo'-&nbsp; Nomor KTP Tidak Tersedia ';
            }
        }
    }
}
