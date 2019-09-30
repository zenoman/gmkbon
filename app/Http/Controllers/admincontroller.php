<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class admincontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //=========================================================================
    public function index()
    {
        $data = DB::table('users')->where('level','!=','pengguna')->get();
        return view('admin.index',['data'=>$data]);
    }
    
    //=========================================================================
    public function create()
    {
        return view('admin.create');
    }
    
    //=========================================================================
    public function store(Request $request)
    {
    $rules = [
                    'nama'      => 'required|',
                    'username'  => 'required|alpha_dash',
                    'password'  => 'required|',
                    'konfirmasi_password'=>'required|same:password',
                    'email'     => 'required|email'
                    ];

    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alfabet',
        'same'      => 'Maaf, Pastikan :attribute dan :other sama',
        'email'     => 'Maaf, data harus email'
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
            'email'     => $request->email,
            'level'     => $request->level
        ]);

        return redirect('admin')
        ->with('status','Input Data Sukses');
        }
    }
    
    //=========================================================================
    public function show($id)
    {
      $dataadmin = DB::table('users')->where('id',$id)->get();
        return view('admin.edit',['data'=>$dataadmin]);
    }

    //=========================================================================
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
            'email'     => $request->email,
            'level'     => $request->level]);
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
            'email'     => $request->email,
            'level'     => $request->level
            ]);
        }
        return redirect('admin')
        ->with('status','Edit Data Sukses');
    }

    //=========================================================================
    public function destroy($id)
    {
         DB::table('users')->where('id',$id)->delete();
         return redirect('admin')
        ->with('status','Hapus Data Sukses');
    }
}
