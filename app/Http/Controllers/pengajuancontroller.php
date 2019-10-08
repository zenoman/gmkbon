<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class pengajuancontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //==================================================================
    public function listnota(){
        $data = DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('nota.status','pengajuan')
        ->get();
        return view('pengajuan.pengajuannota',['data'=>$data]);
    }

    //===============================================================
    public function terimanota($kode){
        $data = DB::table('nota')
        ->where('kode',$kode)
        ->get();

        $totalbayar = 0;
        $total = 0;
        $status='';

        foreach($data as $row){
            $totalbayar += $row->dibayar;
            $total += $row->total;
        }

        if($totalbayar < $total){
            $status='belum lunas';
        }else if($totalbayar >= $total){
            $status='lunas';
        }

        DB::table('nota')
        ->where('kode',$kode)
        ->update([
            'status'=>$status,
            'pembuat'=>Auth::user()->username
        ]);

        return back()->with('status','Data Berhasil Disimpan');
    }
}
