<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//admin
Route::resource('admin','admincontroller');

//user
Route::resource('user','usercontroller');

//nota
Route::get('nota/tambahdata','notacontroller@create')->name('tambah-nota');
Route::get('detailnota/{kode}','notacontroller@detailnota');
Route::get('cetaknota/{kode}','notacontroller@cetaknota');
Route::get('nota/tampilsemua','notacontroller@tampilsemuanota')->name('tampil-nota');
Route::get('nota/tampillunas','notacontroller@tampillunas')->name('tampil-nota-lunas');
Route::get('nota/tampilbelumlunas','notacontroller@tampilbelumlunas')->name('tampil-nota-belumlunas');
Route::get('nota/tampilcancel','notacontroller@tampilcancel')->name('tampil-nota-cancel');
Route::post('nota','notacontroller@store');
Route::get('nota/caridata','notacontroller@caridata');
Route::post('nota/hapuspilihan','notacontroller@hapuspilihan');
Route::get('editnota/{kode}','notacontroller@editnota');
Route::get('editnotabelumlunas/{kode}','notacontroller@editnotabelumlunas');
Route::post('nota/editdata','notacontroller@updatenota');
Route::get('hapusdetailnota/{id}/{nota}','notacontroller@hapusdetailnota');
Route::post('nota/tambahdetailnya','notacontroller@tambahdetailbarang');

//pengajuan
Route::get('pengajuan/nota','pengajuancontroller@listnota')->name('pengajuan-nota');
Route::get('pengajuan/editnota','pengajuancontroller@pengajuan')->name('pengajuan-edit');
Route::get('terimanota/{kode}','pengajuancontroller@terimanota');
Route::get('terimaeditnota/{id}','pengajuancontroller@terimaeditnota');
Route::post('pengajuan/hapuspilihan','pengajuancontroller@hapuspilihan');
Route::post('/pengajuan/hapusnotapilihan','pengajuancontroller@hapusnotapilihan');

//laporan
Route::get('laporan','laporancontroller@index');
Route::get('laporan/tampil','laporancontroller@tampil');
Route::get('exsportnota/{tglmulai}/{tglselesai}','laporancontroller@exsportnota');
Route::get('exsportdetailnota/{tglmulai}/{tglselesai}','laporancontroller@exsportdetailnota');
Route::post('/laporan/hapusnota','laporancontroller@hapusnota');
Route::post('/laporan/hapusdetailnota','laporancontroller@hapusdetailnota');

//pengajuan user
Route::get('pengajuannotauser','pengajuanusercontroller@index')->name('pengajuan-nota-user');
Route::get('tambahpengajuannotauser','pengajuanusercontroller@create')->name('tambah-pengajuan-nota-user');
Route::post('tambahpengajuannota','pengajuanusercontroller@store');
Route::get('pengajuaneditnotauser','pengajuanusercontroller@listpengajuanedit')->name('pengajuan-edit-nota-user');


//nota user
Route::get('notauser','notausercontroller@index')->name('list-nota-user');
Route::get('ajukaneditnota/{kode}','notausercontroller@edit');
Route::post('notauser/editdata','notausercontroller@pengajuanedit');