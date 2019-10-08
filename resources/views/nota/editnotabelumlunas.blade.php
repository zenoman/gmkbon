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
                    <i class="fa fa-list-ul"></i>
                  </div>
                  <div class="breadcomb-ctn">
                    <h2>Nota</h2>
                    <p>Edit Data Nota</p>
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
                                <label>Cari User</label>
                                <div class="nk-int-st">
                                  <input type="text" value="{{$row->namauser}}" class="form-control"readonly>
                                    <!-- <select class="selectpicker" data-live-search="true" name="usernya">
                                    @foreach($datauser as $data)
                                    <option value="{{$data->id}}" @if($row->pembeli==$data->id) selected @endif>{{$data->name}}</option>
                                    @endforeach
                                  </select> -->
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
                                        <a href="{{url('hapusdetailnota/'.$row2->id.'/'.$row2->kode_nota)}}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data ?')">
                                          <i class="fa fa-trash"></i>
                                        </a>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formtambahbarang">Tambah Barang</button>
                            <a href="{{route('tampil-nota-belumlunas')}}" class="btn btn-danger">
                              Kembali
                            </a>
                            </div>
                        </div>
                      </form>
                      <div class="modal fade" id="formtambahbarang" role="dialog">
          <div class="modal-dialog modals-default">
            <div class="modal-content">
              <div class="modal-body">
                <h2>Tambah Data Barang</h2>
                <form action="{{url('nota/tambahdetailnya')}}" method="post">
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Nama Barang</label>
                            <input type="text" name="barang" class="form-control input-xs" required>
                          
                            <input type="hidden" name="kodenota" class="form-control input-xs" value="{{$row->kode}}" required>
                          </div>
                      </div>
                  </div>
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control input-xs" required>
                          </div>
                      </div>
                  </div>
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Jumlah Dibayar</label>
                            <input type="number" name="jumlahbayar" class="form-control input-xs" required>
                          </div>
                      </div>
                  </div>
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control input-xs" required>
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
                <h2>Edit Data Barang</h2>
                <form action="{{url('nota/editdata')}}" method="post">
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Nama Barang</label>
                            <input type="text" name="barang" class="form-control input-xs" value="{{$row2->barang}}" required>
                            <input type="hidden" name="id" class="form-control input-xs" value="{{$row2->id}}" required>
                            <input type="hidden" name="kodenota" class="form-control input-xs" value="{{$row2->kode_nota}}" required>
                          </div>
                      </div>
                  </div>
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control input-xs" value="{{$row2->jumlah}}" required>
                          </div>
                      </div>
                  </div>
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Jumlah Dibayar</label>
                            <input type="number" name="jumlahbayar" class="form-control input-xs" value="{{$row2->jumlah_dibayar}}" required>
                          </div>
                      </div>
                  </div>
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control input-xs" value="{{$row2->harga}}" required>
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