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
                    <i class="fa fa-child"></i>
                  </div>
                  <div class="breadcomb-ctn">
                    <h2>Admin</h2>
                    <p>Edit Data Admin</p>
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
                      @foreach($data as $row)
                      <form action="{{url('admin/'.$row->id)}}" method="post">
                         @if(session('status'))
                        <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('status') }}
                            </div>
                            @endif
                            <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Nama</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="nama" required value="{{$row->name}}">
                                    </div>
                              @if($errors->has('nama'))
                              <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ $errors->first('nama')}}
                            </div>
                                        @endif
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Username</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="username" required value="{{$row->username}}">
                                    </div>
                                    @if($errors->has('username'))
                              <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ $errors->first('username')}}
                            </div>
                                        @endif
                            </div>
                        @csrf
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Email</label>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="email" required value="{{$row->email}}">
                                    </div>
                                  @if($errors->has('email'))
                              <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ $errors->first('email')}}
                            </div>
                                        @endif
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Level</label>
                                <div class="nk-int-st">
                                <div class="bootstrap-select fm-cmp-mg">
                                    <select class="selectpicker" name="level">
                                      <option value="admin" <?php if($row->level=='admin'){echo "selected";}?>>Admin</option>
                                      <option value="super admin" <?php if($row->level=='super admin'){echo "selected";}?>>Super Admin</option>
                                      
                                    </select>
                                </div>
                                </div>
                              @if($errors->has('level'))
                              <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ $errors->first('level')}}
                            </div>
                                        @endif
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Password</label>
                                    <div class="nk-int-st">
                                        <input type="password" class="form-control" name="password" autocomplete="new-password">
                                    </div>
                                    <p class="text-muted">*isi password apabila ingin mengganti password</p>
                              @if($errors->has('password'))
                              <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ $errors->first('password')}}
                            </div>
                                        @endif  
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Konfirmasi Password</label>
                                    <div class="nk-int-st">
                                        <input type="password" class="form-control" name="konfirmasi_password">
                                    </div>
                                    <p class="text-muted">*isi konfirmasi password apabila ingin mengganti password</p>
                              @if($errors->has('konfirmasi_password'))
                              <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ $errors->first('konfirmasi_password')}}
                            </div>
                                        @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                           {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <button class="btn btn-primary" type="submit">
                              Simpan
                            </button>
                            <button class="btn btn-danger" onclick="history.go(-1)">
                              Kembali
                            </button>
                            </div>
                        </div>
                      </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/bootstrap-select/bootstrap-select.js')}}"></script>
@endsection