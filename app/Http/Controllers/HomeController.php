<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(request $request){
       
            $menu='Dashboard';
            if($request->tanggal==''){
                $tgl=date('Y-m-d');
            }else{
                $tgl=$request->tanggal;
            }
            return view('welcome',compact('menu','tgl'));
        
    }
}
