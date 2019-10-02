<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    //========================================================================
    public function store(Request $request){
    $i=0;
    foreach ($request->jumlah as $jumlah){
        $harga 	= $request->harga[$i];
        $subtotal 	= $request->total[$i];
        $barang 	= $request->barang[$i];
        $dibayar = $request->dibayar[$i];
        $kekurangan = $request->kekurangan[$i];
        $jumlahbayar = $request->jumlahbayar[$i];
        $data[] = [
                    'kode_nota'=>$request->nota,
                    'barang'=>$barang,
                    'jumlah'=>$jumlah,
                    'harga'=>$harga,
                    'subtotal' => $subtotal,
                    'dibayar' =>$dibayar,
                    'kekurangan' =>$kekurangan,
                    'jumlah_dibayar' =>$jumlahbayar
                ];
        $i++;
     }
     DB::table('detail_nota')->insert($data);
     DB::table('nota')
     ->insert([
     	'kode'=>$request->nota,
     	'total'=>$request->total_harga,
     	'pembeli'=>$request->usernya,
     	'tgl'=>date('Y-m-d'),
     	'dibayar'=>$request->total_bayar,
     	'kekurangan'=>$request->kembalianya,
        'status'=>$request->status,
        'pembuat'=>Auth::user()->id
		]);
    return redirect('nota/tambahdata')
    ->with('status','Input Data Sukses');
    }

    //==========================================================================
    public function tampilsemuanota(){
        $data = DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->orderby('id','desc')
        ->paginate(30);
        return view('nota.tampilsemua',['data'=>$data]);
    }

    //===========================================================================
    public function detailnota($kode){
        $data = DB::table('detail_nota')->where('kode_nota',$kode)->get();
        return response()->json($data);
    }

    //============================================================================
    public function caridata(Request $request){
        $data = 
        DB::table('nota')
        ->select(DB::raw('nota.*,users.name as namapembeli,users.username as namauser'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('kode','like','%'.$request->cari.'%')
        ->orwhere('users.username','like','%'.$request->cari.'%')
        ->orwhere('tgl','like','%'.$request->cari.'%')
        ->get();

        return view('nota.pencarian',['data'=>$data]);
    }

    //==============================================================================
    public function hapuspilihan(Request $request){
        
    }
}
