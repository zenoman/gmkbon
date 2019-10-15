@extends('layouts.appadmin')
@section('css')
 <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select/bootstrap-select.css')}}">
@endsection
@section('content')

<div class="breadcomb-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="breadcomb-list">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="breadcomb-wp">
                  <div class="breadcomb-icon">
                    <i class="fa fa-comment"></i>
                  </div>
                  <div class="breadcomb-ctn">
                    <h2>Pengajuan</h2>
                    <p>Tambah Data Pengajuan Nota</p>
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
                      <form action="{{url('tambahpengajuannota')}}" method="post">
                         @if(session('status'))
                        <div class="alert alert-success alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('status') }}
                            </div>
                            @endif
                            <br>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>No. Nota</label>
                                  <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nota" value="{{$kode}}" readonly required>
                                    <br>
                                  </div>
                           </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>User</label>
                                <div class="bootstrap-select nk-int-st">
                                    <input type="hidden" value="{{Auth::user()->id}}" name="usernya">
                                    <input type="text" value="{{Auth::user()->username}}" class="form-control" readonly>
                                   <br>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="dynamicInput"></div>
                        <br>
                        <hr>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Total Harga</label>
                                <div class="nk-int-st">
                                    <input type="text" id="total_harganya" class="form-control" name="total_harga" value="0" readonly>
                                    <br>
                                  </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Total Bayar</label>
                                <div class="nk-int-st">
                                    <input type="text" id="total_bayar" class="form-control" name="total_bayar" value="0" readonly>
                                    <input type="hidden" value="0" name="kembalianya" id="kembalianya">
                                    <input type="hidden" value="belum lunas" name="status" id="status">
                                    <br>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        		 <label>Kekurangan</label>
								<h3 id="kembalian"></h3>
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
<script src="{{asset('assets/js/custom/createnota.js')}}"></script>
@endsection