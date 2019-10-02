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
Route::get('nota/tampilsemua','notacontroller@tampilsemuanota')->name('tampil-nota');
Route::post('nota','notacontroller@store');
Route::get('nota/caridata','notacontroller@caridata');
Route::post('nota/hapuspilihan','notacontroller@hapuspilihan');