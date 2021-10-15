<?php

namespace App\Http\Controllers;
use App\Vendor;
use App\User;
use App\Karyawan;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class KaryawanController extends Controller
{
    public function index(request $request){
        if(Auth::user()['role_id']==4){
            $menu='Karyawan';
            $data=Karyawan::where('LIFNR',Auth::user()->username)->orderBy('name','Asc')->get();
            return view('karyawan.index',compact('menu','data'));
        }else{
            if(Auth::user()['role_id']==1){
                $menu='Verifikasi Karyawan';
                $data=Karyawan::where('sts',1)->orderBy('name','Asc')->get();
                return view('karyawan.index_verifikasi',compact('menu','data'));
            }else{
                return view('error');
            }
        }
        
    }

    public function cek_hash(request $request){
        echo Hash::make($request->id);
    }
    public function index_admin(request $request){
        
        if(Auth::user()['role_id']==1 || Auth::user()['role_id']==2){
            $menu='Karyawan';
            $data=Karyawan::where('sts',2)->orderBy('name','Asc')->get();
            return view('karyawan.index_terverifikasi',compact('menu','data'));
        }else{
            return view('error');
        }
        
        
    }

    public function ubah(request $request){
        $data=Karyawan::where('nik_ktp',$request->nik_ktp)->first();
        if(Auth::user()['role_id']==4){
            echo'
                <input type="hidden" name="id" value="'.$data['id'].'">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#expl-tab-1" data-toggle="tab" class="nav-link active">
                            <span class="d-sm-none">Tab 1</span>
                            <span class="d-sm-block d-none">Profil Diri</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#expl-tab-2" data-toggle="tab" class="nav-link">
                            <span class="d-sm-none">Tab 2</span>
                            <span class="d-sm-block d-none">Profil Karyawan</span>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content" style="margin-bottom:0px;padding:1%">
                    <div class="tab-pane fade active show" id="expl-tab-1">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Name</b></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input type="text"  name="name"  value="'.$data['name'].'" placeholder="Enter....." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>NIK & Nomor KTP</b></label>
                                <div class="col-lg-9 col-xl-3">
                                    <input type="text"  name="nik" value="'.$data['nik'].'" onkeypress="return hanyaAngka(event)"  placeholder="Enter....." class="form-control">
                                </div>
                                <div class="col-lg-9 col-xl-5">
                                    <input type="text"   disabled value="'.$data['nik_ktp'].'" onkeypress="return cekktp(event,this.value)" placeholder="Enter....." class="form-control">
                                    <ul class="parsley-errors-list filled" id="notifktp" aria-hidden="false"><li class="parsley-required"></li></ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Alamat</b></label>
                                <div class="col-lg-9 col-xl-8">
                                    <textarea  name="alamat"  placeholder="Enter....." class="form-control" rows="3">'.$data['alamat'].'</textarea>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Tempat & Tgl Lahir</b></label>
                                <div class="col-lg-9 col-xl-5">
                                    <input type="text"  name="tempat_lahir" value="'.$data['tempat_lahir'].'" placeholder="Enter....." class="form-control">
                                </div>
                                <div class="col-lg-9 col-xl-3">
                                    <input type="text"  name="tgl_lahir" value="'.$data['tgl_lahir'].'" id="datepicker" placeholder="Enter....." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Jenis Kelamin & Gol darah</b></label>
                                <div class="col-lg-9 col-xl-5">
                                    <select  name="jenis_kelamin" placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="Laki-laki"'; if($data['jenis_kelamin']=='Laki-laki'){echo'selected';} echo'>- Laki-laki</option>
                                        <option value="Perempuan"'; if($data['jenis_kelamin']=='Perempuan'){echo'selected';} echo'>- Perempuan</option>
                                    
                                    </select>
                                </div>
                                <div class="col-lg-9 col-xl-2">
                                    <select  name="golongan_darah" placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="A" '; if($data['golongan_darah']=='A'){echo'selected';} echo'>- A</option>
                                        <option value="A+" '; if($data['golongan_darah']=='A+'){echo'selected';} echo'>- A+</option>
                                        <option value="B" '; if($data['golongan_darah']=='B'){echo'selected';} echo'>- B</option>
                                        <option value="B+" '; if($data['golongan_darah']=='B+'){echo'selected';} echo'>- B+</option>
                                        <option value="O" '; if($data['golongan_darah']=='O'){echo'selected';} echo'>- O</option>
                                        <option value="O+" '; if($data['golongan_darah']=='O+'){echo'selected';} echo'>- O+</option>
                                        <option value="AB" '; if($data['golongan_darah']=='AB'){echo'selected';} echo'>- AB</option>
                                        <option value="AB+" '; if($data['golongan_darah']=='AB+'){echo'selected';} echo'>- AB+</option>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Status Penikahan</b></label>
                                <div class="col-lg-9 col-xl-5">
                                    <select  name="sts_nikah" placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="Menikah" '; if($data['sts_nikah']=='Menikah'){echo'selected';} echo'>- Menikah</option>
                                        <option value="Belum Menikah" '; if($data['sts_nikah']=='Belum Menikah'){echo'selected';} echo'>- Belum Menikah</option>
                                        <option value="Janda/Duda" '; if($data['sts_nikah']=='Janda/Duda'){echo'selected';} echo'>- Janda/Duda</option>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="expl-tab-2">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Waktu Bekerja(Mulai & Sampai)</b></label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="text"  name="mulai" value="'.$data['mulai'].'" id="datepicker5"  placeholder="Enter....." class="form-control">
                                </div>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="text"  name="sampai" value="'.$data['sampai'].'" id="datepicker6" placeholder="Enter....." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Jenis Pekerjaan</b></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input type="text"  name="jenis_pekerjaan"  value="'.$data['jenis_pekerjaan'].'" placeholder="Enter....." class="form-control">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Lokasi Pekerjaan</b></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input type="text"  name="lokasi_pekerjaan" value="'.$data['lokasi_pekerjaan'].'" placeholder="Enter....." class="form-control">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Status Karyawan & Jadwal</b></label>
                                <div class="col-lg-9 col-xl-5">
                                    <select  name="status" placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="PKWTT"  '; if($data['status']=='PKWTT'){echo'selected';} echo'>- PKWTT</option>
                                        <option value="PKWT"  '; if($data['status']=='PKWT'){echo'selected';} echo'>- PKWT</option>
                                    
                                    </select>
                                </div>
                                <div class="col-lg-9 col-xl-3">
                                    <select  name="jadwal" placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="Shift" '; if($data['jadwal']=='Shift'){echo'selected';} echo'>- Shift</option>
                                        <option value="Non Shift" '; if($data['jadwal']=='Non Shift'){echo'selected';} echo'>- Non Shift</option>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
        
            ';
        }else{
            echo'
                <input type="hidden" name="id" value="'.$data['id'].'">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#expl-tab-1" data-toggle="tab" class="nav-link active">
                            <span class="d-sm-none">Tab 1</span>
                            <span class="d-sm-block d-none">Profil Diri</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#expl-tab-2" data-toggle="tab" class="nav-link">
                            <span class="d-sm-none">Tab 2</span>
                            <span class="d-sm-block d-none">Profil Karyawan</span>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content" style="margin-bottom:0px;padding:1%">
                    <div class="tab-pane fade active show" id="expl-tab-1">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Name</b></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input type="text" disabled name="name"  value="'.$data['name'].'" placeholder="Enter....." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>NIK & Nomor KTP</b></label>
                                <div class="col-lg-9 col-xl-3">
                                    <input type="text" disabled name="nik" value="'.$data['nik'].'" onkeypress="return hanyaAngka(event)"  placeholder="Enter....." class="form-control">
                                </div>
                                <div class="col-lg-9 col-xl-5">
                                    <input type="text"   disabled value="'.$data['nik_ktp'].'" onkeypress="return cekktp(event,this.value)" placeholder="Enter....." class="form-control">
                                    <ul class="parsley-errors-list filled" id="notifktp" aria-hidden="false"><li class="parsley-required"></li></ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Alamat</b></label>
                                <div class="col-lg-9 col-xl-8">
                                    <textarea  name="alamat" disabled placeholder="Enter....." class="form-control" rows="3">'.$data['alamat'].'</textarea>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Tempat & Tgl Lahir</b></label>
                                <div class="col-lg-9 col-xl-5">
                                    <input type="text" disabled name="tempat_lahir" value="'.$data['tempat_lahir'].'" placeholder="Enter....." class="form-control">
                                </div>
                                <div class="col-lg-9 col-xl-3">
                                    <input type="text" disabled name="tgl_lahir" value="'.$data['tgl_lahir'].'" id="datepicker" placeholder="Enter....." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Jenis Kelamin & Gol darah</b></label>
                                <div class="col-lg-9 col-xl-5">
                                    <select  name="jenis_kelamin" disabled placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="Laki-laki"'; if($data['jenis_kelamin']=='Laki-laki'){echo'selected';} echo'>- Laki-laki</option>
                                        <option value="Perempuan"'; if($data['jenis_kelamin']=='Perempuan'){echo'selected';} echo'>- Perempuan</option>
                                    
                                    </select>
                                </div>
                                <div class="col-lg-9 col-xl-2">
                                    <select  name="golongan_darah" placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="A" '; if($data['golongan_darah']=='A'){echo'selected';} echo'>- A</option>
                                        <option value="A+" '; if($data['golongan_darah']=='A+'){echo'selected';} echo'>- A+</option>
                                        <option value="B" '; if($data['golongan_darah']=='B'){echo'selected';} echo'>- B</option>
                                        <option value="B+" '; if($data['golongan_darah']=='B+'){echo'selected';} echo'>- B+</option>
                                        <option value="O" '; if($data['golongan_darah']=='O'){echo'selected';} echo'>- O</option>
                                        <option value="O+" '; if($data['golongan_darah']=='O+'){echo'selected';} echo'>- O+</option>
                                        <option value="AB" '; if($data['golongan_darah']=='AB'){echo'selected';} echo'>- AB</option>
                                        <option value="AB+" '; if($data['golongan_darah']=='AB+'){echo'selected';} echo'>- AB+</option>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Status Penikahan</b></label>
                                <div class="col-lg-9 col-xl-5">
                                    <select  name="sts_nikah" placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="Menikah" '; if($data['sts_nikah']=='Menikah'){echo'selected';} echo'>- Menikah</option>
                                        <option value="Belum Menikah" '; if($data['sts_nikah']=='Belum Menikah'){echo'selected';} echo'>- Belum Menikah</option>
                                        <option value="Janda/Duda" '; if($data['sts_nikah']=='Janda/Duda'){echo'selected';} echo'>- Janda/Duda</option>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="expl-tab-2">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Waktu Bekerja(Mulai & Sampai)</b></label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="text" disabled name="mulai" value="'.$data['mulai'].'" id="datepicker5"  placeholder="Enter....." class="form-control">
                                </div>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="text" disabled name="sampai" value="'.$data['sampai'].'" id="datepicker6" placeholder="Enter....." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Jenis Pekerjaan</b></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input type="text" disabled name="jenis_pekerjaan"  value="'.$data['jenis_pekerjaan'].'" placeholder="Enter....." class="form-control">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Lokasi Pekerjaan</b></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input type="text" disabled  name="lokasi_pekerjaan" value="'.$data['lokasi_pekerjaan'].'" placeholder="Enter....." class="form-control">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xl-10 offset-xl-1">
                            <div class="form-group row m-b-10">
                                <label class="col-lg-4 text-lg-right col-form-label"><b>Status Karyawan & Jadwal</b></label>
                                <div class="col-lg-9 col-xl-5">
                                    <select  name="status" disabled placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="PKWTT"  '; if($data['status']=='PKWTT'){echo'selected';} echo'>- PKWTT</option>
                                        <option value="PKWT"  '; if($data['status']=='PKWT'){echo'selected';} echo'>- PKWT</option>
                                    
                                    </select>
                                </div>
                                <div class="col-lg-9 col-xl-3">
                                    <select  name="jadwal" disabled placeholder="Enter....." class="form-control">
                                        <option value="">--Pilih-----</option>
                                        <option value="Shift" '; if($data['jadwal']=='Shift'){echo'selected';} echo'>- Shift</option>
                                        <option value="Non Shift" '; if($data['jadwal']=='Non Shift'){echo'selected';} echo'>- Non Shift</option>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
        
            ';
        }
        echo'
            <script>
                $(document).ready(function() {
                    
                    $("#datepicker5").datepicker({
                        format: "yyyy-mm-dd",
                        autoclose: true,
                        
                    });
                    $("#datepicker6").datepicker({
                        format: "yyyy-mm-dd",
                        autoclose: true,
                        
                    });
                });
            </script>

        ';
        
    }
    public function cek_ktp(request $request){
        echo'sdsdsdsd';
        
    }

    public function verifikasi(request $request){
        error_reporting(0);
        $jumlah=count($request->nik_ktp);
        if($jumlah>0){
            for($x=0;$x<$jumlah;$x++){
                $cekvaksin=Karyawan::where('nik_ktp',$request->nik_ktp)->update([
                    'sts'=>2,
                ]);
            }
            echo'ok';
        }else{
            echo'-&nbsp; Pilih Data yang akan direset ';
        }
    }

    public function cek_qrcode(request $request){
        $data=Karyawan::where('nik_ktp',$request->nik_ktp)->first();
        $echo=barcode('https://app.krakatausteel.com/?nik='.Hash::make($data['nik_ktp']),60);
        echo $echo.'<br><br><h2>('.$data['name'].')</h2><h2>'.$data['nik_ktp'].'</h2>';
    }

    public function save(request $request){
        error_reporting(0);
        
        $rules = [
            'name'=> 'required',
            'nik'=> 'required|numeric',
            'nik_ktp'=> 'required|numeric',
            'alamat'=> 'required',
            'tempat_lahir'=> 'required',
            'tgl_lahir'=> 'required|date',
            'jenis_kelamin'=> 'required',
            'golongan_darah'=> 'required',
            'sts_nikah'=> 'required',
            'mulai'=> 'required|date',
            'sampai'=> 'required|date',
            'jenis_pekerjaan'=> 'required',
            'lokasi_pekerjaan'=> 'required',
            'status'=> 'required',
            'jadwal'=> 'required',
        ];

        $messages = [
            'name.required'=> 'Isi Nama Karyawan', 
            'nik.required'=> 'Isi NIK Karyawan', 
            'nik_ktp.required'=> 'Isi Nomor KTP Karyawan', 
            'alamat.required'=> 'Isi Alamat', 
            'tempat_lahir.required'=> 'Isi Tempat Lahir', 
            'tgl_lahir.required'=> 'Isi Tanggal Lahir', 
            'jenis_kelamin.required'=> 'Pilih Jenis Kelamin', 
            'golongan_darah.required'=> 'Pilih Golongan Darah', 
            'sts_nikah.required'=> 'Pilih Status Pernikahan', 
            'mulai.required'=> 'Isi Tanggal Mulai Berkerja', 
            'sampai.required'=> 'Isi Tanggal Sampai Berkerja', 
            'jenis_pekerjaan.required'=> 'Isi Jenis Pekerjaan',  
            'lokasi_pekerjaan.required'=> 'Isi Lokasi Pekerjaan',  
            'status.required'=> 'Pilih Status Karyawan',  
            'jadwal.required'=> 'Pilih Jadwal Pekerjaan',  
            
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
            $cek=Karyawan::where('nik_ktp',$request->nik_ktp)->count();
            if($cek>0){
                echo'-&nbsp; Nomor KTP Sudah Terdaftar ';
            }else{
                $data=Karyawan::create([
                    'LIFNR'=>Auth::user()['username'],
                    'nik'=>$request->nik,
                    'name'=>$request->name,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'tgl_lahir'=>$request->tgl_lahir,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'golongan_darah'=>$request->golongan_darah,
                    'sts_nikah'=>$request->sts_nikah,
                    'nik_ktp'=>$request->nik_ktp,
                    'alamat'=>$request->alamat,
                    'jenis_pekerjaan'=>$request->jenis_pekerjaan,
                    'jadwal'=>$request->jadwal,
                    'status'=>$request->status,
                    'lokasi_pekerjaan'=>$request->lokasi_pekerjaan,
                    'mulai'=>$request->mulai,
                    'selesai'=>$request->sampai,
                    'sts'=>1,
                ]);

                echo'ok';
            }
        }
    }

    public function update(request $request){
        error_reporting(0);
        
        $rules = [
            'name'=> 'required',
            'nik'=> 'required|numeric',
            'alamat'=> 'required',
            'tempat_lahir'=> 'required',
            'tgl_lahir'=> 'required|date',
            'jenis_kelamin'=> 'required',
            'golongan_darah'=> 'required',
            'sts_nikah'=> 'required',
            'mulai'=> 'required|date',
            'sampai'=> 'required|date',
            'jenis_pekerjaan'=> 'required',
            'lokasi_pekerjaan'=> 'required',
            'status'=> 'required',
            'jadwal'=> 'required',
        ];

        $messages = [
            'name.required'=> 'Isi Nama Karyawan', 
            'nik.required'=> 'Isi NIK Karyawan', 
            'alamat.required'=> 'Isi Alamat', 
            'tempat_lahir.required'=> 'Isi Tempat Lahir', 
            'tgl_lahir.required'=> 'Isi Tanggal Lahir', 
            'jenis_kelamin.required'=> 'Pilih Jenis Kelamin', 
            'golongan_darah.required'=> 'Pilih Golongan Darah', 
            'sts_nikah.required'=> 'Pilih Status Pernikahan', 
            'mulai.required'=> 'Isi Tanggal Mulai Berkerja', 
            'sampai.required'=> 'Isi Tanggal Sampai Berkerja', 
            'jenis_pekerjaan.required'=> 'Isi Jenis Pekerjaan',  
            'lokasi_pekerjaan.required'=> 'Isi Lokasi Pekerjaan',  
            'status.required'=> 'Pilih Status Karyawan',  
            'jadwal.required'=> 'Pilih Jadwal Pekerjaan',  
            
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
            
                $data=Karyawan::where('id',$request->id)->update([
                    'LIFNR'=>Auth::user()['username'],
                    'nik'=>$request->nik,
                    'name'=>$request->name,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'tgl_lahir'=>$request->tgl_lahir,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'golongan_darah'=>$request->golongan_darah,
                    'sts_nikah'=>$request->sts_nikah,
                    'alamat'=>$request->alamat,
                    'jenis_pekerjaan'=>$request->jenis_pekerjaan,
                    'jadwal'=>$request->jadwal,
                    'status'=>$request->status,
                    'lokasi_pekerjaan'=>$request->lokasi_pekerjaan,
                    'mulai'=>$request->mulai,
                    'selesai'=>$request->sampai,
                ]);

                echo'ok';
            
        }
    }
}
