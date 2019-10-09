@extends('layouts.appadmin')
@section('css')
 <link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')
<div class="breadcomb-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-xs-12">
          <div class="breadcomb-list">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="breadcomb-wp">
                  <div class="breadcomb-icon">
                    <i class="fa fa-list-ul"></i>
                  </div>
                  <div class="breadcomb-ctn">
                    <h2>Pengajuan</h2>
                    <p>List Pengajuan Edit Nota</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-xs-6 col-xs-3 text-right">
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
                <div class="col-lg-12 col-md-12 col-xs-12 col-xs-12">
                    <div class="data-table-list">
                       @if (session('status'))
                        <div class="alert alert-success alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('status') }}
                            </div>
                            @endif
                             @if (session('statuserror'))
                        <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('statuserror') }}
                            </div>
                            @endif
                        <div class="table-responsive">
                          <form action="{{url('/pengajuan/hapuspilihan')}}" method="post">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Pembeli</th>
                                      <th>No. Nota</th>
                                      <th>Barang</th>
                                      <th>Jumlah</th>
                                      <th>Tanggal</th>
                                      <th>Jam</th>
                                      <th class="text-center">Aksi</th>
                                      <th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1;?>
                                  @foreach($data as $row)
                                  <tr>

                                      <td>{{$i++}}</td>
                                      <td>{{$row->namauser}}</td>
                                      <td>{{$row->kode_nota}}</td>
                                      <td>{{$row->barang}}</td>

                                      <td>{{$row->jumlah}} Pcs</td>
                                      <td>
                                        {{$row->tgl}}
                                      </td>
                                      <td>
                                        {{$row->jam}}</td>
                                      <td class="text-center">
                                        @if($row->konfirmasi=='N')
                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#pencarian{{$row->id}}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        @else
                                        -
                                        @endif
                                        
                                     </td>
                                      <td align="center">&nbsp;&nbsp;&nbsp;<input name="pilihid[]" type="checkbox" id="checkbox[]" value="{{$row->id}}"></td>
                                  </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>Pembeli</th>
                                    <th>No. Nota</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th class="text-center">Aksi</th>
                                    <th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
                                  </tr>
                                </tfoot>
                            </table>
                            <hr>
                                <div class="nk-int-st" align="right">
                                <div class="bootstrap-select fm-cmp-mg">
                                     <button onclick="return confirm('Yakin nih datanya udah bener ?')" type="submit" class="btn btn-danger">Hapus Data Terpilih</button>
                                </div>
                                </div>
                           
         
            {{csrf_field()}}
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($data as $row)
      <div class="modal fade" id="pencarian{{$row->id}}" role="dialog">
            <div class="modal-dialog modals-default">
              <div class="modal-content">
                <div class="modal-body">
                  <h2>Kenfirmasi Nota</h2>
                  <p>Konfirmasi dan terima perubahan nota yang diajukan pelanggan ?</p>
                    <div class="form-example-int mg-t-15">
                        <a href="{{url('terimaeditnota/'.$row->id)}}" class="btn btn-success notika-btn-success waves-effect">
                            Terima
                        </a>
                        <button type="button" class="btn btn-danger notika-btn-danger waves-effect" data-dismiss="modal">
                            Tidak
                        </button>
                    </div>
                </div>
              </div>
            </div>
          </div>
      @endforeach
@endsection
@section('js')
<script src="{{asset('assets/js/data-table/jquery.dataTables.min.js')}}"></script>
<script>
 $(document).ready(function() {
     $('#data-table-basic').DataTable({
            responsive: true,
            "paging":true
        });
  });
 function toggle(source) {
  checkboxes = document.getElementsByName('pilihid[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
  }</script>
@endsection