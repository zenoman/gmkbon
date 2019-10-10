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
    public function __construct()
    {
        $this->middleware('auth');
    }
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

    public function hapusnota(Request $request){
        if(!$request->pilihid){
            return back()->with('statuserror','Tidak ada data yang dipilih');
        }else{
            foreach($request->pilihid as $id){
                DB::table('nota')->where('id',$id)->delete();
            }
        }
        return back()->with('status','Data Berhasil Hapus');
    
    }

    public function hapusdetailnota(Request $request){
        if(!$request->pilihid){
            return back()->with('statuserror','Tidak ada data yang dipilih');
        }else{
            foreach($request->pilihid as $id){
                DB::table('detail_nota')->where('id',$id)->delete();
            }
        }
        return back()->with('status','Data Berhasil Hapus');
    }
}
