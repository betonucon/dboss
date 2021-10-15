<?php

function barcoderider($id,$w,$h){
   $d = new Milon\Barcode\DNS2D();
   $d->setStorPath(__DIR__.'/cache/');
   return $d->getBarcodeHTML($id, 'QRCODE',$w,$h);
}
function barcode($id,$wid){
   $d = new Milon\Barcode\DNS2D();
   $code='<img src="data:image/png;base64,' .DNS2D::getBarcodePNG($id, 'QRCODE'). '" style="width:'.$wid.'%" alt="barcode"   />';
   return $code;
}
function name(){
    return 'DB Outsourcing';
}
function company(){
    return 'PT KRAKATAU STEEL';
}

function parsing_validator($url){
   $content=utf8_encode($url);
   $data = json_decode($content,true);

   return $data;
}

function bulan($bulan)
{
   Switch ($bulan){
      case '01' : $bulan="Januari";
         Break;
      case '02' : $bulan="Februari";
         Break;
      case '03' : $bulan="Maret";
         Break;
      case '04' : $bulan="April";
         Break;
      case '05' : $bulan="Mei";
         Break;
      case '06' : $bulan="Juni";
         Break;
      case '07' : $bulan="Juli";
         Break;
      case '08' : $bulan="Agustus";
         Break;
      case '09' : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}
function warna($bulan)
{
   Switch ($bulan){
      case '0' : $bulan="Yellow";
         Break;
      case 1 : $bulan="#F0F8FF";
         Break;
      case 2 : $bulan="#FAEBD7";
         Break;
      case 3 : $bulan="#00FFFF";
         Break;
      case 4 : $bulan="#7FFFD4";
         Break;
      case 5 : $bulan="#F0FFFF";
         Break;
      case 6 : $bulan="#8A2BE2";
         Break;
      case 7 : $bulan="#A52A2A";
         Break;
      case 8 : $bulan="#DEB887";
         Break;
      case 9 : $bulan="#5F9EA0";
         Break;
      case 10 : $bulan="#7FFF00";
         Break;
      case 11 : $bulan="#D2691E";
         Break;
      case 12 : $bulan="#FF7F50";
         Break;
      }
   return $bulan;
}

function hari_ini($tgl){
    $hari=date('D',strtotime($tgl));
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
 
}

function selisih_jam($tgl1,$tgl2){
    $waktu_awal        =strtotime($tgl1);
    $waktu_akhir    =strtotime($tgl2); 
    $diff    =$waktu_akhir - $waktu_awal;
    $jam    =floor($diff / (60 * 60));
    $menit    =$diff - $jam * (60 * 60);
    $selisih=$jam.'.'.$menit;
    return $selisih;
}

function tgl_indo($id){
    $exp=explode('-',$id);
    $data=$exp[2].' '.bulan($exp[1]).' '.$exp[0];
    return $data;
}

function get_karyawan($lifnr){
   $data=App\Karyawan::where('LIFNR',$lifnr)->orderBy('name','Asc')->get();
   return $data;

}

function count_absensi($nik_ktp,$tgl){
   $data=App\Absensi::where('nik_ktp',$nik_ktp)->where('tanggal',$tgl)->count();
   return $data;

}

function app_get_karyawan(){
   $data=App\Karyawan::where('sts',1)->count();
   if($data>0){
      $not='<span class="label label-theme label-yellow">'.$data.'</span>';
   }else{
      $not="";
   }
   return $not;

}

function hasil_vaksin($nik_ktp){
   $data=App\Vaksin::where('nik_ktp',$nik_ktp)->count();
   if($data>0){
      if($data==1){
         $hasil='<span class="label label-green">VAKSIN PERTAMA</span>';
      }else{
         $hasil='<span class="label label-primary">VAKSIN KEDUA</span>';
      }
   }else{
      $hasil='<i style="color:red">Belum Vaksin</i>';
   }
   return $hasil;

}
function tanggal_vaksin($nik_ktp){
   $data=App\Vaksin::where('nik_ktp',$nik_ktp)->count();
   if($data>0){
      if($data==1){
         $vaksin=App\Vaksin::where('nik_ktp',$nik_ktp)->where('name','Vaksin Pertama')->first();
         $hasil='<i style="color:#000">'.$vaksin['tgl_vaksin'].'</i>';
      }else{
         $vaksin=App\Vaksin::where('nik_ktp',$nik_ktp)->where('name','Vaksin Kedua')->first();
         $hasil='<i style="color:#000">'.$vaksin['tgl_vaksin'].'</i>';
      }
   }else{
      $hasil='<i style="color:red">0000-00-00</i>';
   }
   return $hasil;

}

function ubah_bulan($id){
    if($id>9){
       $data=$id;
    }else{
       $data='0'.$id;
    }
    return $data;
 }
function ubah_jam($id){
    return date('H:i',strtotime($id));
 }


?>