<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $notalunas = DB::table('nota')->where('status','=','lunas')->count();
        $notabelumlunas = DB::table('nota')->where('status','=','belum lunas')->count();
        $notapengajuan = DB::table('nota')->where('status','=','pengajuan')->count();
        $listpengajuan = DB::table('nota')
        ->select(DB::raw('nota.*,users.username'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->where('status','=','pengajuan')
        ->orderby('nota.id','desc')
        ->limit(10)
        ->get();

        $listpengajuanubah = DB::table('pengajuan')
        ->select(DB::raw('pengajuan.*,users.username,detail_nota.barang'))
        ->leftjoin('users','users.id','=','pengajuan.pembeli')
        ->leftjoin('detail_nota','detail_nota.id','=','pengajuan.kode_barang')
        ->where('pengajuan.konfirmasi','=','N')
        ->orderby('pengajuan.id','desc')
        ->limit(10)
        ->get();

        $hutang = DB::table('nota')
        ->select(DB::raw('SUM(kekurangan) as totalkekurangan,users.username'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->groupby('nota.pembeli')
        ->orderby('totalkekurangan','desc')
        ->get();

        return view('home',['notalunas'=>$notalunas,'notabelumlunas'=>$notabelumlunas,'notapengajuan'=>$notapengajuan,'listpengajuan'=>$listpengajuan,'listpengajuanubah'=>$listpengajuanubah,'hutang'=>$hutang]);
    }
}
