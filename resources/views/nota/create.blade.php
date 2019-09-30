@extends('layouts.appadmin')
@section('css')
 <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select/bootstrap-select.css')}}">
@endsection
@section('content')
<script language="Javascript" type="text/javascript">
//fungsi remove html
//====================================================
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
//====================================================

var counter = 1; //variabel nomor inputan
var limit = 16;
//fungsi tambah input
function addInput(divName){

 if (counter == limit)  {
    alert("Limit hanya 15 inputan");
 }
 else {
    var newdiv = document.createElement('div');
    newdiv.innerHTML ='<div class="row" id="input'+counter+'">'+
                          '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">'+
                              '<label>Nama Barang</label>'+
                                    '<div class="nk-int-st">'+
                                        '<input type="text" class="form-control">'+
                                        '<br>'+
                                    '</div>'+
                          '</div>'+
                          '<div class="row">'+
                          '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">'+
                              '<label>Jumlah</label>'+
                                    '<div class="nk-int-st">'+
                                        '<input type="text" class="form-control">'+
                                        '<br>'+
                                    '</div>'+
                          '</div>'+
                          '<div class="row">'+
                          '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">'+
                              '<label>Harga</label>'+
                                    '<div class="nk-int-st">'+
                                        '<input type="text" class="form-control">'+
                                        '<br>'+
                                    '</div>'+
                          '</div>'+
                          '<div class="row">'+
                          '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
                              '<label>Total</label>'+
                                    '<div class="nk-int-st">'+
                                        '<input type="text" class="form-control">'+
                                        '<br>'+
                                    '</div>'+
                          '</div>'+
                          '<div class="row">'+
                          '<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">'+
                          '<br>'+
                          '<a href="#" onclick="del('+counter+')"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button></a>'+
                          '</div>'+
                          '</div>'+
                        '</div>';
    document.getElementById(divName).appendChild(newdiv);
    counter++;
 }
}
//fungsi hapus input
function del(no) {
  document.getElementById('input'+no).remove();
  counter = counter - 1;
  for(i=no;i<=limit;i++){
    var id = document.getElementById('input'+i);
    if (id === null){

    } else {

    }
  }
}
</script>
<div class="breadcomb-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="breadcomb-list">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="breadcomb-wp">
                  <div class="breadcomb-icon">
                    <i class="fa fa-child"></i>
                  </div>
                  <div class="breadcomb-ctn">
                    <h2>Nota</h2>
                    <p>Tambah Data Nota</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="data-table-area">
        <div class="container">
            <div class="row">

               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="form-element-list">
                      <form action="{{url('admin')}}" method="post">
                         @if(session('status'))
                        <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('status') }}
                            </div>
                            @endif
                            <br>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>No. Resi</label>
                                  <div class="nk-int-st">
                                    <input type="text" class="form-control">
                                    <br>
                                  </div>
                           </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Cari User</label>
                                <div class="bootstrap-select nk-int-st">
                                    <select class="selectpicker" data-live-search="true">
                                    @foreach($datauser as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                  </select>
                                   <br>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="dynamicInput"></div>
                        <br>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Total Jumlah</label>
                                  <div class="nk-int-st">
                                    <input type="text" class="form-control">
                                    <br>
                                  </div>
                           </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Total Harga</label>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control">
                                    <br>
                                  </div>
                            </div>
                        </div>
                          @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <button type="button" onClick="addInput('dynamicInput');" class="btn btn-success">Tambah Barang</button>
                            <button class="btn btn-primary" type="submit">
                              Simpan
                            </button>
                            <button class="btn btn-danger" onclick="history.go(-1)">
                              Kembali
                            </button>
                            </div>
                        </div>
                      </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/bootstrap-select/bootstrap-select.js')}}"></script>
@endsection