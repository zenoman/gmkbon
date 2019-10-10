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
                    <p>List Data Nota</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3 text-right">
                <a href="{{url('exsportnota/'.$tglmulai.'/'.$tglselesai)}}" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Exsport Excel</a>
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
                          <form action="{{url('/laporan/hapusnota')}}" method="POST">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Pembeli</th>
                                        <th>Admin</th>
                                        <th>Total</th>
                                        <th>Dibayar</th>
                                        <th>Kekurangan</th>
                                        <th>Status</th>
                                        <th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1;?>
                                  @foreach($data as $row)
                                  <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->kode}}</td>
                                    <td>{{$row->namauser}}</td>
                                    <td>{{$row->pembuat}}</td>
                                    <td>{{"Rp ". number_format($row->total,0,',','.')}}</td>
                                    <td>{{"Rp ". number_format($row->dibayar,0,',','.')}}</td>
                                    <td>{{"Rp ". number_format($row->kekurangan,0,',','.')}}</td>
                                    <td>{{$row->status}}</td>
                                    <td align="center">&nbsp;&nbsp;&nbsp;<input name="pilihid[]" type="checkbox" id="checkbox[]" value="{{$row->id}}"></td>
                                  </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                       <th>No</th>
                                        <th>Kode</th>
                                        <th>Pembeli</th>
                                        <th>Admin</th>
                                        <th>Total</th>
                                        <th>Dibayar</th>
                                        <th>Kekurangan</th>
                                        <th>Status</th>
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
@endsection
@section('js')
  <script src="{{asset('assets/js/data-table/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/js/data-table/data-table-act.js')}}"></script>
  <script>
    function toggle(source) {
    checkboxes = document.getElementsByName('pilihid[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
    }
  </script>
@endsection