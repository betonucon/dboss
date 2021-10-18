<?php

namespace App\Http\Controllers\Authapi;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;


class AbsController extends Controller
{
    
    public function proses_absen() {
        $data =User::where('username',Auth::user()->username)->first();
        return response()->json($data, 200);
    }
}
