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
                    <h2>Nota</h2>
                    <p>List Nota Lunas</p>
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
                          <form action="{{url('/nota/hapuspilihan')}}" method="post">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                      
                                        <th>No</th>
                                        <th>Kode Nota</th>
                                        <th>Tgl Buat</th>
                                        <th>Tgl Edit</th>
                                        <th>Pembeli</th>
                                        <th>Total</th>
                                        <th>Dibayar</th>
                                        <th>Kekurangan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                        <th  class="text-center"><input type="checkbox" onclick="toggle(this)"/></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1;?>
                                  @foreach($data as $row)
                                  <tr>

                                      <td>{{$i++}}</td>
                                      <td>{{$row->kode}}</td>
                                      <td>{{$row->tgl}}</td>
                                      <td>{{$row->tgl_edit}}</td>
                                      <td>{{$row->namauser}}</td>
                                      <td>
                                        {{"Rp ". number_format($row->total,0,',','.')}}
                                      </td>
                                      <td>
                                        {{"Rp ". number_format($row->dibayar,0,',','.')}}</td>
                                      <td>{{"Rp ". number_format($row->kekurangan,0,',','.')}}</td>
                                      <td class="text-center">
                                        @if($row->status=='lunas')
                                          {{$row->status}}
                                        @else
                                          {{$row->status}}
                                        @endif
                                      </td>
                                      <td class="text-center">
                                        <button
                                        type="button" 
                                        class="btn btn-xs btn-primary tampil"
                                        data-kodenota="{{$row->kode}}"
                                        data-tanggal="{{$row->tgl}}"
                                        data-status="{{$row->status}}"
                                        data-pembeli="{{$row->namauser}}"
                                        data-total="{{$row->total}}"
                                        data-dibayar="{{$row->dibayar}}"
                                        data-kekurangan="{{$row->kekurangan}}">
                                          <i class="fa fa-eye"></i>
                                        </button>
                                        <a href="{{url('cetaknota/'.$row->kode)}}" class="btn btn-xs btn-success" target="blank()"><i class="fa fa-print"></i></a>
                                     </td>
                                      <td align="center">&nbsp;&nbsp;&nbsp;<input name="pilihid[]" type="checkbox" id="checkbox[]" value="{{$row->id}}"></td>
                                  </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Nota</th>
                                        <th>Tgl Buat</th>
                                        <th>Tgl Edit</th>
                                        <th>Pembeli</th>
                                        <th>Total</th>
                                        <th>Dibayar</th>
                                        <th>Kekurangan</th>
                                        <th class="text-center">Status</th>
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

    <div class="modal fade" id="myModalthree" role="dialog">
      <div class="modal-dialog modal-large">
        <div class="modal-content">
          <div class="modal-body">
            <h2>Detail Nota</h2>
            <hr>
            <table border="0" width="100%">
              <tr>
                <td>
                  <b>Kode Nota</b>
                </td>
                <td>&nbsp;:&nbsp;</td>
                <td>
                  <p id="printkode">-</p>
                </td>
                <td width="15%"></td>
                <td><b>Pembeli</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>
                  <p id="printpembeli">-</p>
                </td>
              </tr>
              <tr>
                <td><b>Tanggal</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>
                  <p id="printtgl">-</p>
                </td>
                <td></td>
                <td><b>Status</b></td>
                <td>&nbsp;:&nbsp;</td>
                <td>
                  <p id="printstatus">-</p>
                </td>
              </tr>
            </table>
            <hr>      
            <table class="table table-bordered">
              <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Jumlah Terbayar</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Dibayar</th>
                    <th>Kekurangan</th>
                  </tr>
              </thead>
              <tbody id="tubuhnya">
                <tr>
                  <td colspan="7" class="text-center">
                    <p style="color:grey;">Loading...</p>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="text-center">
                    <th colspan="5">Total</th>
                    <th><b id="totalnota"></b></th>
                    <th><b id="dibayarnota"></b></th>
                    <th><b id="kekurangannota"></b></th>
                  </tr>
              </tfoot>
             </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close
              </button>
            </div>
          </div>
        </div>
      </div>
        <div class="modal fade" id="myModalone" role="dialog">
          <div class="modal-dialog modals-default">
            <div class="modal-content">
              <div class="modal-body">
                <h2>Cari dari semua data</h2>
                <form action="{{url('nota/caridata')}}" method="get">
                  <div class="form-example-int mg-t-15">
                      <div class="form-group">
                          <div class="nk-int-st">
                            <input type="text" name="cari" class="form-control input-xs" placeholder="Masukan kode nota / pembeli / tanggal " required>
                          </div>
                      </div>
                  </div>
                  @csrf
                  <div class="form-example-int mg-t-15">
                      <button type="submit" class="btn btn-success notika-btn-success waves-effect">Cari</button>
                        <button type="button" class="btn btn-danger notika-btn-danger waves-effect" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('js')
<script src="{{asset('assets/js/data-table/jquery.dataTables.min.js')}}"></script>
<script>

$(document).ready(function() {
 $('#data-table-basic').DataTable({
        responsive: true,
        "paging":false
    });
});

$('.tampil').on('click', function(){
 $('#tubuhnya').html('<td colspan="7" class="text-center"><p style="color:grey;">Loading...</p></td>');
var kodenota = $(this).data('kodenota');
var tanggal = $(this).data('tanggal');
var status = $(this).data('status');
var pembeli = $(this).data('pembeli');
var total = $(this).data('total');
var dibayar = $(this).data('dibayar');
var kekurangan = $(this).data('kekurangan');
//------------------------------------------------

//------------------------------------------------
$('#printkode').html(kodenota);
$('#printpembeli').html(pembeli);
$('#printtgl').html(tanggal);
$('#printstatus').html(status);
$('#totalnota').html('Rp.'+rupiah(total));
$('#dibayarnota').html('Rp.'+rupiah(dibayar));
$('#kekurangannota').html('Rp.'+rupiah(kekurangan));
//-------------------------------------------------
$.ajax({
            type:'GET',
            dataType:'json',
            url: '/detailnota/'+kodenota,
            success:function(data){
            var rows ='';
            var no=0;
                $.each(data,function(key, value){
                    no +=1;
                    rows = rows + '<tr>';
                    rows = rows + '<td class="text-center">' +no+'</td>';
                    rows = rows + '<td class="text-center">' +value.barang+'</td>';
                    rows = rows + '<td class="text-center">'+value.jumlah+' Pcs</td>';
                    rows = rows + '<td class="text-center">' +value.jumlah_dibayar+' Pcs</td>';
                    rows = rows + '<td class="text-right"> Rp. ' +rupiah(value.harga)+'</td>';
                    rows = rows + '<td class="text-right"> Rp. ' +rupiah(value.subtotal)+'</td>';
                    rows = rows + '<td class="text-right"> Rp. ' +rupiah(value.dibayar)+'</td>';
                    rows = rows + '<td class="text-right"> Rp. ' +rupiah(value.kekurangan)+'</td>';
                    rows = rows + '</tr>';
            });
                 $('#tubuhnya').html(rows);
            }
        });
$('#myModalthree').modal('toggle');
});
function toggle(source) {
checkboxes = document.getElementsByName('pilihid[]');
for(var i=0, n=checkboxes.length;i<n;i++) {
  checkboxes[i].checked = source.checked;
}
}
//=================================================================
function rupiah(bilangan){
  var number_string = bilangan.toString(),
  sisa  = number_string.length % 3,
  rupiah  = number_string.substr(0, sisa),
  ribuan  = number_string.substr(sisa).match(/\d{3}/gi);
  
if (ribuan) {
  separator = sisa ? '.' : '';
  rupiah += separator + ribuan.join('.');
}

  return rupiah;
}
</script>
@endsection