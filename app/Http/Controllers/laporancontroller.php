<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class laporancontroller extends Controller
{
    public function index()
    {
    	return view('laporan.index');
    }

    public function tampil(Request $request){
    	if ($request->kategori=='nota') {
    		$data = DB::table('nota')
    		->select(DB::raw('nota.*,users.name as namapembeli,users.username as namauser'))
    		->leftjoin('users','users.id','=','nota.pembeli')
    		->whereBetween('tgl',[$request->tglmulai,$request->tglselesai])
    		->get();
    		return view('laporan.tampilnota',['data'=>$data]);
    	}else{
    		$data = DB::table('detail_nota')
    		->select(DB::raw('detail_nota.*,nota.tgl'))
    		->leftjoin('nota','nota.kode','=','detail_nota.kode_nota')
    		->whereBetween('nota.tgl',[$request->tglmulai,$request->tglselesai])
    		->get();
    		return view('laporan.tampildetailnota',['data'=>$data]);
    	}
    }
}
