<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class pengajuanusercontroller extends Controller
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
        ->where([['nota.status','=','pengajuan'],['nota.pembeli','=',Auth::user()->id]])
        ->orderby('nota.id','desc')
        ->get();
        return view('pengajuanuser.index',['data'=>$data]);
    }
    //=========================================================================
   	public function create(){
        $tanggal  = date('dmy');
        
        $kode = DB::table('nota')
        ->where('kode','like','%N'.$tanggal.'%')
        ->max('kode');

        if(!$kode){
            $finalkode = "N".$tanggal."-0001";
        }else{
            $newkode    = explode("-", $kode);
            $nomer      = sprintf("%04s",$newkode[1]+1);
            $finalkode  = "N".$tanggal."-".$nomer;
        }
        return view('pengajuanuser.create',['kode'=>$finalkode]);
    }
    //=========================================================================
    public function store(Request $request){
    $i=0;
    foreach ($request->jumlah as $jumlah){
        $harga  = $request->harga[$i];
        $subtotal   = $request->total[$i];
        $barang     = $request->barang[$i];
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
                    'jumlah_dibayar' =>$jumlahbayar,
                    'idpembeli'=>Auth::user()->username
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
        'status'=>'pengajuan',
        'pembuat'=>Auth::user()->username
        ]);
    return redirect('pengajuannotauser')
    ->with('status','Input Data Sukses');    
    }
    //=======================================================
    public function listpengajuanedit(){
       $data = DB::table('pengajuan')
        ->select(DB::raw('pengajuan.*,users.username as namauser,detail_nota.barang'))
        ->leftjoin('users','users.id','=','pengajuan.pembeli')
        ->leftjoin('detail_nota','detail_nota.id','=','pengajuan.kode_barang')
        ->where('pengajuan.pembeli','=',Auth::user()->id)
        ->orderby('pengajuan.id','desc')
        ->get();
        return view('pengajuanuser.pengajuaneditnota',['data'=>$data]);
    }
}
