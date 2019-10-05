@extends('layouts.appadmin')
@section('css')
 <link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
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
                    <p>List Data Admin</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3 text-right">
                @if(Auth::user()->level=='super admin')
                <a href="{{url('admin/create')}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Tambah Data</a>
                @endif
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
                    <div class="data-table-list">
                       @if (session('status'))
                        <div class="alert alert-success alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('status') }}
                            </div>
                            @endif
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Email</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1;?>
                                  @foreach($data as $row)
                                  <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->username}}</td>
                                    <td>{{$row->level}}</td>
                                    <td>{{$row->email}}</td>
                                    <td class="text-center">
                                      @if($row->id==Auth::user()->id)
                                        <a href="{{url('admin/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-wrench"></i> Edit</a>
                                      @else
                                     
                                     <form method="post" action="admin/{{$row->id}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                             <a href="{{url('admin/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-wrench"></i> Edit</a>

                                            <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</button>
                                        </form>
                                        @endif
                                        </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Email</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </tfoot>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
 <script src="{{asset('assets/js/data-table/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/data-table/data-table-act.js')}}"></script>
@endsection