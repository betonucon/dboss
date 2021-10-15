<?php

namespace App\Http\Controllers;
use App\Vendor;
use App\User;
use App\Vaksin;
use App\Karyawan;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class VaksinController extends Controller
{
    public function index(request $request){
        if(Auth::user()['role_id']==4){
            $menu='List Vaksin';
            $data=Karyawan::where('LIFNR',Auth::user()->username)->orderBy('name','Asc')->get();
            return view('vaksin.index',compact('menu','data')); 
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
                $cekvaksin=Vaksin::where('nik_ktp',$request->nik_ktp)->delete();
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
            'name'=> 'required',
            'tgl_vaksin'=> 'required|date',
            
        ];

        $messages = [
            'nik_ktp.required'=> 'Pilih Karyawan', 
            'name.required'=> 'Pilih Infomasi Vaksin', 
            'tgl_vaksin.required'=> 'Isi Tanggal', 
            
            
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
                $cekvaksin=Vaksin::where('nik_ktp',$request->nik_ktp)->count();
                if($cekvaksin>2){
                    echo'-&nbsp; Karyawan sudah menyelesaikan vaksin ';
                }else{
                    $cekperiode=Vaksin::where('nik_ktp',$request->nik_ktp)->where('name',$request->name)->count();
                    if($cekperiode>0){
                        echo'-&nbsp; '.$request->name.' Sudah didaftarkan  ';
                    }else{
                        $data=Vaksin::create([
                            'nik_ktp'=>$request->nik_ktp,
                            'name'=>$request->name,
                            'tgl_vaksin'=>$request->tgl_vaksin,
                            'tgl_create'=>date('Y-m-d'),
                            'LIFNR'=>Auth::user()['username'],
                        ]);
    
                        echo'ok';
                    }
                }
                    
                
            }else{
                echo'-&nbsp; Nomor KTP Tidak Tersedia ';
            }
        }
    }
}
