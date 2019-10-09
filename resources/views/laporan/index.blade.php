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
                    <i class="fa fa-file"></i>
                  </div>
                  <div class="breadcomb-ctn">
                    <h2>Laporan</h2>
                    <p>Pilih Tanggal Laporan</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">

               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="form-element-list">
                      <form action="{{url('laporan/tampil')}}" method="post">
                         @if(session('status'))
                        <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('status') }}
                            </div>
                            @endif
                            <br>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <label>Tanngal Mulai</label>
                                    <div class="nk-int-st">
                                        <input type="date" class="form-control" name="tglmulai" required>
                                    </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <label>Sampai Tanggal</label>
                                    <div class="nk-int-st">
                                        <input type="date" class="form-control" name="tglselesai" required autocomplete="new-username">
                                    </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <label>Kategori</label>
                                    <div class="nk-int-st">
                                      <select name="kategori" class="form-control">
                                        <option value="nota">Nota</option>
                                        <option value="detail nota">Detail Nota</option>
                                      </select>
                                    </div>
                            </div>
                        @csrf
                        </div><br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <button class="btn btn-primary btn-lg" type="submit">
                              Tampilkan
                            </button>
                            <button class="btn btn-danger btn-lg" onclick="history.go(-1)">
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