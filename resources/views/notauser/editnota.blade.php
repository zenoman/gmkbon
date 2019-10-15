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
                    <h2>Nota Saya</h2>
                    <p>Ajukan Edit Data Nota</p>
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
                    @foreach($data as $row)
                      <form action="{{url('nota')}}" method="post">
                         @if(session('status'))
                        <div class="alert alert-success alert-dismissible alert-mg-b-0" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('status') }}
                            </div>
                            @endif
                            <br>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>No. Nota</label>
                                  <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nota" value="{{$row->kode}}" readonly required>
                                    <br>
                                  </div>
                           </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>User</label>
                                <div class="nk-int-st">
                                  <input type="text" value="{{$row->namauser}}" class="form-control"readonly>
                                   <br>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Barang</th>
                                <th class="text-center">Jml</th>
                                <th class="text-center">Jml Dibayar</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Total</th>
                                <th class="text-right">Dibayar</th>
                                <th class="text-right">Kekurangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>    
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($datadetail as $row2)
                                <tr>
                                    <td class="text-center">{{$i++}}</td>
                                    <td>{{$row2->barang}}</td>
                                    <td class="text-center">{{$row2->jumlah}} Pcs</td>
                                    <td class="text-center">{{$row2->jumlah_dibayar}} Pcs</td>
                                    <td class="text-right">{{"Rp ". number_format($row2->harga,0,',','.')}}</td>
                                    <td class="text-right">{{"Rp ". number_format($row2->subtotal,0,',','.')}}</td>
                                    <td class="text-right">{{"Rp ". number_format($row2->dibayar,0,',','.')}}</td>
                                    <td class="text-right">{{"Rp ". number_format($row2->kekurangan,0,',','.')}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#myModalone{{$row2->id}}"><i class="fa fa-wrench"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <br>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Total Harga</label>
                                <div class="nk-int-st">
                                    <input type="text" id="total_harganya" class="form-control" name="total_harga" value="{{$row->total}}" readonly>
                                    <br>
                                  </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Total Bayar</label>
                                <div class="nk-int-st">
                                    <input type="text" id="total_bayar" class="form-control" name="total_bayar" value="{{$row->dibayar}}" readonly>
                                    <input type="hidden" value="{{$row->kekurangan}}" name="kembalianya" id="kembalianya">
                                    <input type="hidden" value="belum lunas" name="status" id="status">
                                    <br>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        		 <label>Kekurangan</label>
								<h3 id="kembalian">{{"Rp ". number_format($row->kekurangan,0,',','.')}}</h3>
                        	</div>
                        </div>
                          @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <a href="{{route('list-nota-user')}}" class="btn btn-danger">
                              Kembali
                            </a>
                            </div>
                        </div>
                      </form>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @foreach($datadetail as $row2)
    <div class="modal fade" id="myModalone{{$row2->id}}" role="dialog">
          <div class="modal-dialog modals-default">
            <div class="modal-content">
              <div class="modal-body">
                <h2>Edit Jumlah Dibayar Barang</h2>
                <form action="{{url('notauser/editdata')}}" method="post">
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Nama Barang</label>
                            <input type="text" name="barang" class="form-control input-xs" value="{{$row2->barang}}" required readonly>
                            <input type="hidden" name="id" value="{{$row2->id}}">
                            <input type="hidden" name="kodenota"value="{{$row2->kode_nota}}">
                            <input type="hidden" name="jumlah" value="{{$row2->jumlah}}">
                            <input type="hidden" name="kodeuser" value="{{Auth::user()->id}}">
                          </div>
                      </div>
                  </div>
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Jumlah Dibayar Terbaru</label>
                            <input type="number" name="jumlahbayar" class="form-control input-xs" value="{{$row2->jumlah_dibayar}}" required>
                          </div>
                      </div>
                  </div>
                  @csrf
                  <div class="form-example-int mg-t-15">
                      <button type="submit" class="btn btn-success notika-btn-success waves-effect">Simpan</button>
                        <button type="button" class="btn btn-danger notika-btn-danger waves-effect" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    @endforeach
@endsection
@section('js')
<script src="{{asset('assets/js/bootstrap-select/bootstrap-select.js')}}"></script>
@endsection