<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class usercontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================================
    public function index()
    {
        $data = DB::table('users')->where('level','=','pengguna')->get();
        return view('user.index',['data'=>$data]);
    }

    //=================================================================================
    public function create()
    {
        return view('user.create');
    }

    //=================================================================================
    public function store(Request $request)
    {
        $rules = [
                    'nama'      => 'required|',
                    'username'  => 'required|alpha_dash',
                    'password'  => 'required|',
                    'konfirmasi_password'=>'required|same:password',
                    'alamat'     => 'required',
                    'telp'     => 'required'
                    ];

    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alfabet',
        'same'      => 'Maaf, Pastikan :attribute dan :other sama'
    ];
        $this->validate($request,$rules,$customMessages);
        $dataadmin = DB::table('users')->where('username',$request->username)->count();
        if($dataadmin>0){
            return back()
            ->with('status','Maaf, username telah di pakai');
        }else{
            DB::table('users')->insert([
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'name'      => $request->nama,
            'notelp'     => $request->telp,
            'alamat'     => $request->alamat
        ]);

        return redirect('user')
        ->with('status','Input Data Sukses');
        }
    }

    //=================================================================================
    public function show($id)
    {
        $datauser = DB::table('users')->where('id',$id)->get();
        return view('user.edit',['data'=>$datauser]);
    }

    //=================================================================================
    public function update(Request $request, $id)
    {
        if($request->password!=''){
            if($request->password==$request->konfirmasi_password){
             DB::table('users')
             ->where('id',$id)
             ->update([
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'name'      => $request->nama,
            'alamat'     => $request->alamat,
            'notelp'     => $request->telp]);
            }else{
            return back()
            ->with('status','Maaf, Konfirmasi Password Salah');
            }
           
        }else{
            DB::table('users')
            ->where('id',$id)
            ->update([
            'username'  => $request->username,
            'name'      => $request->nama,
            'alamat'     => $request->alamat,
            'notelp'     => $request->telp
        ]);
        }
        return redirect('user')
        ->with('status','Edit Data Sukses');
    }
    
    //=================================================================================
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
         return redirect('user')
        ->with('status','Hapus Data Sukses');
    }
}
