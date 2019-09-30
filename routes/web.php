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