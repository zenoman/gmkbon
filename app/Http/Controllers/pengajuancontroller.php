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
    
    //==================================================================
    public function pengajuan(){
        $data = DB::table('pengajuan')
        ->select(DB::raw('pengajuan.*,users.username as namauser,detail_nota.barang'))
        ->leftjoin('users','users.id','=','pengajuan.pembeli')
        ->leftjoin('detail_nota','detail_nota.id','=','pengajuan.kode_barang')
        ->orderby('pengajuan.id','desc')
        ->get();
        return view('pengajuan.pengajuaneditnota',['data'=>$data]);
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

    public function terimaeditnota($id){
        
        $jumlahbaru = 0;
        $kodebarang = 0;
        $kodenota = '';

        $data = DB::table('pengajuan')->where('id',$id)->get();
        foreach($data as $row){
            $kodenota = $row->kode_nota;
            $jumlahbaru = $row->jumlah;
            $databarang = DB::table('detail_nota')->where('id',$row->kode_barang)->get();

            foreach($databarang as $row2){
                $newjumlah = $jumlahbaru;
                $newdibayar = $newjumlah*$row2->harga;
                $newkekurangan = $row2->subtotal - $newdibayar;

                DB::table('detail_nota')
                ->where('id',$row->kode_barang)
                ->update([
                    'jumlah_dibayar'=>$newjumlah,
                    'dibayar'=>$newdibayar,
                    'kekurangan'=>$newkekurangan,
                ]);

                DB::table('pengajuan')
                ->where('id',$id)
                ->update([
                    'admin'=>Auth::user()->username,
                    'konfirmasi'=>'Y'
                ]);
            }
        }
        $data2 = DB::table('detail_nota')
        ->where('kode_nota',$kodenota)
        ->get();

        $totalbayar = 0;
        $total = 0;
        $totalkekurangan =0;
        $status='';

        foreach($data2 as $row3){
            $totalbayar += $row3->dibayar;
            $total += $row3->subtotal;
            $totalkekurangan += $row3->kekurangan;
        }

        if($totalbayar < $total){
            $status='belum lunas';
        }else if($totalbayar >= $total){
            $status='lunas';
        }

        DB::table('nota')
        ->where('kode',$kodenota)
        ->update([
            'status'=>$status,
            'total'=>$total,
            'dibayar'=>$totalbayar,
            'kekurangan'=>$totalkekurangan,
            'pembuat'=>Auth::user()->username
        ]);

        return back()->with('status','Data Berhasil Disimpan');
        
    }

    public function hapuspilihan(Request $request){
        if(!$request->pilihid){
            return back()->with('statuserror','Tidak ada data yang dipilih');
        }else{
            foreach($request->pilihid as $id){
                DB::table('pengajuan')->where('id',$id)->delete();
            }
        }
        return back()->with('status','Data Berhasil Dimanipulasi');
    }

    public function hapusnotapilihan(Request $request){
         if(!$request->pilihid){
            return back()->with('statuserror','Tidak ada data yang dipilih');
        }else{
            foreach($request->pilihid as $id){
                DB::table('nota')->where('id',$id)->delete();
            }
        }
        return back()->with('status','Data Berhasil Dimanipulasi');
    }
}
