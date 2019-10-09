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
                    <i class="fa fa-file"></i>
                  </div>
                  <div class="breadcomb-ctn">
                    <h2>Laporan</h2>
                    <p>List Data Detail Nota</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3 text-right">
                <a href="{{url('admin/create')}}" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Exsport Excel</a>
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
                                        <th>Kode Nota</th>
                                        <th>Barang</th>
                                        <th>Jml</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th>Jml Dibayar</th>
                                        <th>Total Dibayar</th>
                                        <th>Kekurangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1;?>
                                  @foreach($data as $row)
                                  <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->kode_nota}}</td>
                                    <td>{{$row->barang}}</td>
                                    <td>{{$row->jumlah}} Pcs</td>
                                    <td>{{"Rp ". number_format($row->harga,0,',','.')}}</td>
                                    <td>{{"Rp ". number_format($row->subtotal,0,',','.')}}</td>
                                    <td>{{$row->jumlah_dibayar}} Pcs</td>
                                    <td>{{"Rp ". number_format($row->dibayar,0,',','.')}}</td>
                                    <td>{{"Rp ". number_format($row->kekurangan,0,',','.')}}</td>
                                    
                                  </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                       <th>No</th>
                                        <th>Kode Nota</th>
                                        <th>Barang</th>
                                        <th>Jml</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th>Jml Dibayar</th>
                                        <th>Total Dibayar</th>
                                        <th>Kekurangan</th>
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