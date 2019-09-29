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

    public function index()
    {
        $data = DB::table('users')->where('level','=','pengguna')->get();
        return view('user.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
         return redirect('user')
        ->with('status','Hapus Data Sukses');
    }
}
