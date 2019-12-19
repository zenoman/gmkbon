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
    	$datauser = DB::table('users')->where('level','=','pengguna')->get();
    	return view('nota.create',['datauser'=>$datauser,'kode'=>$finalkode]);
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
                    'jumlah_dibayar' =>$jumlahbayar,
                    'idpembeli'=>$request->usernya
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
        'pembuat'=>Auth::user()->username
		]);
    return redirect('nota/tambahdata')
    ->with('status','Input Data Sukses');
    }

    //==========================================================================
    public function tampilsemuanota(){
        $data = DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('status','!=','pengajuan')
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

        return view('nota.pencarian',['data'=>$data,'cari'=>$request->cari]);
    }

    //==============================================================================
    public function hapuspilihan(Request $request){
        if(!$request->pilihid){
            return back()->with('statuserror','Tidak ada data yang dipilih');
        }else{
            foreach($request->pilihid as $id){
                DB::table('nota')->where('id',$id)->delete();
            }
        }
        return back()->with('status','Data Berhasil Dimanipulasi');
    }

    //=======================================================================
    public function tampillunas(){
         $data = DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('status','lunas')
        ->orderby('id','desc')
        ->get();
        return view('nota.tampilsukses',['data'=>$data]);
    }

     //======================================================================
    public function tampilbelumlunas(){
        $data = DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('status','belum lunas')
        ->orderby('id','desc')
        ->get();
        return view('nota.tampilbelumsukses',['data'=>$data]);
    }

    //======================================================================
    public function tampilcancel(){
        $data = DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('status','cancel')
        ->orderby('id','desc')
        ->get();
        return view('nota.tampilcancel',['data'=>$data]);
    }

    //======================================================================
    public function cetaknota($id){
        $data = DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('kode',$id)
        ->get();

        $datadetail = DB::table('detail_nota')->where('kode_nota',$id)->get();
        return view('nota.cetakulang',['data'=>$data,'datadetail'=>$datadetail]);

    }

    //======================================================================
    public function editnota($kode){
        $data = 
        DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('nota.kode',$kode)
        ->get();
        $datadetail = DB::table('detail_nota')->where('kode_nota',$kode)->get();
        $datauser = DB::table('users')->where('level','=','pengguna')->get();
        return view('nota.editnota',['datauser'=>$datauser,'data'=>$data,'datadetail'=>$datadetail]);
    }

    //======================================================================
    public function editnotabelumlunas($kode){
        $data = 
        DB::table('nota')
        ->select(DB::raw('nota.*,users.username as namauser,users.name as namapembeli'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('nota.kode',$kode)
        ->get();
        $datadetail = DB::table('detail_nota')->where('kode_nota',$kode)->get();
        $datauser = DB::table('users')->where('level','=','pengguna')->get();
        return view('nota.editnotabelumlunas',['datauser'=>$datauser,'data'=>$data,'datadetail'=>$datadetail]);
    }

    //=========================================================================
    public function updatenota(Request $request){
        $jumlah = $request->jumlah;
        $harga = $request->harga;
        $jumlahbayar = $request->jumlahbayar;
        //----------------------------------------------
        $subtotal = $jumlah * $harga;
        $dibayar = $jumlahbayar * $harga;
        $kekurangan = $subtotal - $dibayar;
        DB::table('detail_nota')
        ->where('id',$request->id)
        ->update([
            'barang'=>$request->barang,
            'jumlah'=>$jumlah,
            'jumlah_dibayar'=>$jumlahbayar,
            'harga'=>$harga,
            'dibayar'=>$dibayar,
            'kekurangan'=>$kekurangan,
            'subtotal'=>$subtotal
        ]);
        //-----------------------------------------------------
        $totalnya = 0;
        $totaldibayar = 0;
        $totalkekurangan = 0;
        $status ='';

        $data = DB::table('detail_nota')->where('kode_nota',$request->kodenota)->get();
        foreach ($data as $row) {
        $totalnya += $row->subtotal;
        $totaldibayar +=$row->dibayar;
        $totalkekurangan +=$row->kekurangan;    
        }
        if($totaldibayar < $totalnya){
            $status='belum lunas';
        }else if($totaldibayar >= $totalnya){
            $status='lunas';
        }
        DB::table('nota')->where('kode',$request->kodenota)
        ->update([
            'pembuat'=>Auth::user()->username,
            'total'=>$totalnya,
            'dibayar'=>$totaldibayar,
            'kekurangan'=>$totalkekurangan,
            'status'=>$status
        ]);
        return back()->with('status','Data berhasil diubah');
        //return redirect('editnota/'.$request->kodenota)->with('status','Data Berhasil Diubah');
    }

    //======================================================================
    public function hapusdetailnota($id,$kode){
        DB::table('detail_nota')->where('id',$id)->delete();

        //-----------------------------------------------------
        $totalnya = 0;
        $totaldibayar = 0;
        $totalkekurangan = 0;
        $status ='';

        $data = DB::table('detail_nota')->where('kode_nota',$kode)->get();
        foreach ($data as $row) {
        $totalnya += $row->subtotal;
        $totaldibayar +=$row->dibayar;
        $totalkekurangan +=$row->kekurangan;    
        }
        if($totaldibayar < $totalnya){
            $status='belum lunas';
        }else if($totaldibayar >= $totalnya){
            $status='lunas';
        }

        DB::table('nota')->where('kode',$kode)
        ->update([
            'pembuat'=>Auth::user()->username,
            'total'=>$totalnya,
            'dibayar'=>$totaldibayar,
            'kekurangan'=>$totalkekurangan,
            'status'=>$status
        ]);
        return back()->with('status','Data berhasil diubah');
        //return redirect('editnota/'.$kode)->with('status','Data Berhasil Diubah');
    }

    //============================================================================
    public function tambahdetailbarang(Request $request){
        $jumlah = $request->jumlah;
        $harga = $request->harga;
        $jumlahbayar = $request->jumlahbayar;
        //----------------------------------------------
        $subtotal = $jumlah * $harga;
        $dibayar = $jumlahbayar * $harga;
        $kekurangan = $subtotal - $dibayar;
        DB::table('detail_nota')
        ->insert([
            'kode_nota'=>$request->kodenota,
            'barang'=>$request->barang,
            'jumlah'=>$jumlah,
            'jumlah_dibayar'=>$jumlahbayar,
            'harga'=>$harga,
            'dibayar'=>$dibayar,
            'kekurangan'=>$kekurangan,
            'subtotal'=>$subtotal
        ]);

        //-----------------------------------------------------
        $totalnya = 0;
        $totaldibayar = 0;
        $totalkekurangan = 0;
        $status ='';

        $data = DB::table('detail_nota')->where('kode_nota',$request->kodenota)->get();
        foreach ($data as $row) {
        $totalnya += $row->subtotal;
        $totaldibayar += $row->dibayar;
        $totalkekurangan += $row->kekurangan;    
        }
        if($totaldibayar < $totalnya){
            $status='belum lunas';
        }else if($totaldibayar >= $totalnya){
            $status='lunas';
        }
        DB::table('nota')->where('kode',$request->kodenota)
        ->update([
            'pembuat'=>Auth::user()->username,
            'total'=>$totalnya,
            'dibayar'=>$totaldibayar,
            'kekurangan'=>$totalkekurangan,
            'status'=>$status
        ]);
        return back()->with('status','Data berhasil diubah');
        //return redirect('editnota/'.$request->kodenota)->with('status','Data Berhasil Diubah');       
    }
}
