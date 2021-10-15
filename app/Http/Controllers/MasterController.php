<?php

namespace App\Http\Controllers;
use App\Vendor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class MasterController extends Controller
{
    public function get_vendor(request $request){
        $data=User::orderBy('username','Asc')->get();
        foreach($data as $o){
            $usr=User::where('id',$o['id'])->update([
                'password' => Hash::make($o['username']),
            ]);
        }
    }
}
