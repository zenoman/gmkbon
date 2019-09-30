<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class notacontroller extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    //=========================================================================
    public function create(){
    	$datauser = DB::table('users')->where('level','=','pengguna')->get();
    	return view('nota.create',['datauser'=>$datauser]);
    }
}
