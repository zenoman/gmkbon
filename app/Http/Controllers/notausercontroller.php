<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class notausercontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	//=========================================================================
    public function index(){
    	$data = DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where([
        	['nota.status','!=','pengajuan'],
        	['nota.pembeli','=',Auth::user()->id]])
        ->orderby('nota.id','desc')
        ->get();
        return view('notauser.index',['data'=>$data]);
    }

    //===========================================================================
    public function edit($kode){
         $data = 
        DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('nota.kode',$kode)
        ->get();
        $datadetail = DB::table('detail_nota')->where('kode_nota',$kode)->get();
        return view('notauser.editnota',['data'=>$data,'datadetail'=>$datadetail]);
    }

    //============================================================================
    public function pengajuanedit(Request $request){
        DB::table('pengajuan')
        ->insert([
            'pembeli'=>$request->kodeuser,
            'kode_nota'=>$request->kodenota,
            'kode_barang'=>$request->id,
            'jumlah'=>$request->jumlahbayar,
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s')
        ]);
        return back()->with('status','Data berhasil diubah, Perubahan final menunggu persetujuan admin, lihat data di pengajuan edit nota');
    }
}
