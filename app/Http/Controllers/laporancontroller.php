<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NotaExport;
use App\Exports\DetailNotaExport;

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
    		return view('laporan.tampilnota',['data'=>$data,'tglmulai'=>$request->tglmulai,'tglselesai'=>$request->tglselesai]);
    	}else{
    		$data = DB::table('detail_nota')
    		->select(DB::raw('detail_nota.*,nota.tgl'))
    		->leftjoin('nota','nota.kode','=','detail_nota.kode_nota')
    		->whereBetween('nota.tgl',[$request->tglmulai,$request->tglselesai])
    		->get();
    		return view('laporan.tampildetailnota',['data'=>$data,'tglmulai'=>$request->tglmulai,'tglselesai'=>$request->tglselesai]);
    	}
    }

    public function exsportnota($tglmulai,$tglselesai){
        $namafile = "Nota Tgl ".$tglmulai." sampai ".$tglselesai.".xlsx";
        return Excel::download(new NotaExport($tglmulai,$tglselesai),$namafile);    
    }

    public function exsportdetailnota($tglmulai,$tglselesai){
        $namafile = "Detail Nota Tgl ".$tglmulai." sampai ".$tglselesai.".xlsx";
        return Excel::download(new DetailNotaExport($tglmulai,$tglselesai),$namafile);    
    }
}
