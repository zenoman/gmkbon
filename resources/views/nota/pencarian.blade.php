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
                                    <p>Hasil Pencarian "<b>{{$cari}}</b>"</p>
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
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (session('statuserror'))
                    <div class="alert alert-danger alert-dismissible alert-mg-b-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>
                        {{ session('statuserror') }}
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
                                        <th class="text-center"><input type="checkbox" onclick="toggle(this)" /></th>
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
                                            <button type="button" class="btn btn-primary btn-xs tampil"
                                                data-kodenota="{{$row->kode}}" data-tanggal="{{$row->tgl}}"
                                                data-status="{{$row->status}}" data-pembeli="{{$row->namauser}}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <a href="{{url('cetaknota/'.$row->kode)}}" class="btn btn-xs btn-success"
                                                target="blank()"><i class="fa fa-print"></i></a>
                                            <a href="{{url('editnota/'.$row->kode)}}" class="btn btn-xs btn-warning"><i
                                                    class="fa fa-wrench"></i></a>
                                        </td>
                                        <td align="center">&nbsp;&nbsp;&nbsp;<input name="pilihid[]" type="checkbox"
                                                id="checkbox[]" value="{{$row->id}}"></td>
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
                                        <th class="text-center"><input type="checkbox" onclick="toggle(this)" /></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <hr>
                            <div class="nk-int-st" align="right">
                                <div class="bootstrap-select fm-cmp-mg">
                                    <button onclick="history.go(-1)" type="button"
                                        class="btn btn-warning">Kembali</button>
                                    <button onclick="return confirm('Yakin nih datanya udah bener ?')" type="submit"
                                        class="btn btn-danger">Hapus Data Terpilih</button>
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
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                </button>
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
        "paging": true
    });
});

$('.tampil').on('click', function() {
    $('#tubuhnya').html('<td colspan="7" class="text-center"><p style="color:grey;">Loading...</p></td>');
    var kodenota = $(this).data('kodenota');
    var tanggal = $(this).data('tanggal');
    var status = $(this).data('status');
    var pembeli = $(this).data('pembeli');
    //------------------------------------------------

    //------------------------------------------------
    $('#printkode').html(kodenota);
    $('#printpembeli').html(pembeli);
    $('#printtgl').html(tanggal);
    $('#printstatus').html(status);
    //-------------------------------------------------
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/detailnota/' + kodenota,
        success: function(data) {
            var rows = '';
            var no = 0;
            $.each(data, function(key, value) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td class="text-center">' + no + '</td>';
                rows = rows + '<td class="text-center">' + value.barang + '</td>';
                rows = rows + '<td class="text-center">' + value.jumlah + ' Pcs</td>';
                rows = rows + '<td class="text-center">' + value.jumlah_dibayar +
                    ' Pcs</td>';
                rows = rows + '<td class="text-right">' + value.harga + '</td>';
                rows = rows + '<td class="text-right">' + value.subtotal + '</td>';
                rows = rows + '<td class="text-right">' + value.dibayar + '</td>';
                rows = rows + '<td class="text-right">' + value.kekurangan + '</td>';
                rows = rows + '</tr>';
            });
            $('#tubuhnya').html(rows);
        }
    });
    $('#myModalthree').modal('toggle');
});

function toggle(source) {
    checkboxes = document.getElementsByName('pilihid[]');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}
</script>
@endsection