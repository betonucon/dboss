<?php

namespace App\Http\Controllers;
use App\Vendor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class VendorController extends Controller
{
    public function index(request $request){
        $menu='Dashboard';
        $data=User::where('role_id',4)->orderBy('name','Asc')->get();
        return view('vendor.index',compact('menu','data'));
    }
}
