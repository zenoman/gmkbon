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
                    <p>Tambah Data Nota</p>
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
                      <form action="{{url('nota')}}" method="post" onsubmit="return cetaknota()">
                         @if(session('status'))
                        <div class="alert alert-success alert-dismissible alert-mg-b-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button> {{ session('status') }}
                            </div>
                            @endif
                            <br>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>No. Nota</label>
                                  <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nota" value="{{$kode}}" readonly required>
                                    <br>
                                  </div>
                           </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Cari User</label>
                                <div class="bootstrap-select nk-int-st">
                                    <select class="selectpicker" data-live-search="true" name="usernya">
                                    @foreach($datauser as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                  </select>
                                   <br>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="dynamicInput"></div>
                        <br>
                        <hr>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Total Harga</label>
                                <div class="nk-int-st">
                                    <input type="text" id="total_harganya" class="form-control" name="total_harga" value="0" readonly>
                                    <br>
                                  </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Total Bayar</label>
                                <div class="nk-int-st">
                                    <input type="text" id="total_bayar" class="form-control" name="total_bayar" value="0" readonly>
                                    <input type="hidden" value="0" name="kembalianya" id="kembalianya">
                                    <input type="hidden" value="belum lunas" name="status" id="status">
                                    <br>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        		 <label>Kekurangan</label>
								<h3 id="kembalian"></h3>
                        	</div>
                        </div>
                          @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <button type="button" onClick="addInput('dynamicInput');" class="btn btn-success">Tambah Barang</button>
                            <button class="btn btn-primary" type="submit">
                              Simpan
                            </button>
                            <button class="btn btn-danger" onclick="history.go(-1)">
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
    <div id="hidden_div" style="display: none;">
            <table width="100%">
                <tr>
                    <td width="49%">
                        <table width="100%" style="margin-bottom: 5px;">
                            <tr>
                                <td style="border: 1px solid black;" width="45%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">No.Nota : {{$kode}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Pembuat : {{Auth::user()->username}}</p>
                                </td>
                                <td width="10%">
                                </td>
                                <td style="border: 1px solid black;" width="45%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">Tgl :{{date('d/m/Y')}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Tuan/Toko : Grosir Murah Kediri</p>
                                </td>   
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                               
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <thead>
                                <td align="center" style="border: 1px solid black;">
                                    No
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Jml
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Barang
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Harga
                                </td>

                                <td align="center" style="border: 1px solid black;">
                                    Jml Dibayar
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Total
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Dibayar
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Kekurangan
                                </td>
                            </thead>
                            <tbody id="datacetak">
                                
                            </tbody>
                           <tfoot>
                                <tr>
                                    <td colspan="5" style="border: 1px solid black;" align="center">total</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datatotal1"></span></td>
                                    <td align="right" style="border: 1px solid black;"><span id="datadibayar1"></span></td>
                                    <td align="right" style="border: 1px solid black;"><span id="datakekurangan1"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table width="100%">
                            <tr>
                                <td width="50%" align="center">
                                    <p style="font-size: 10;">Penerima</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                <td width="50%" align="center">
                                     <p style="font-size: 10;">Hormat Kami</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                <td align="center" bgcolor="#000000">
                                    <p style="color: white; font-size: 8;">GROSIR|ECER|DROPSHIP|PUSAT BAJU TERMURAH, TERBARU & BERKUALITAS DI KOTA KEDIRI</p>
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="2%">
                    <hr width="1" size="100%">
                    </td>
                    <td width="49%" bgcolor="#ffff99">
                         <table width="100%" style="margin-bottom: 5px;">
                            <tr>
                                <td style="border: 1px solid black;" width="45%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">No.Nota : {{$kode}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Pembuat : {{Auth::user()->username}}</p>
                                </td>
                                <td width="10%">
                                </td>
                                <td style="border: 1px solid black;" width="45%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">Tgl :{{date('d/m/Y')}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Tuan/Toko : Grosir Murah Kediri</p>
                                </td>   
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <thead>
                                <td align="center" style="border: 1px solid black;">
                                    No
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Jml
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Barang
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Harga
                                </td>

                                <td align="center" style="border: 1px solid black;">
                                    Jml Dibayar
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Total
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Dibayar
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Kekurangan
                                </td>
                            </thead>
                            <tbody id="datacetak1">
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="border: 1px solid black;" align="center">total</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datatotal"></span></td>
                                    <td align="right" style="border: 1px solid black;"><span id="datadibayar"></span></td>
                                    <td align="right" style="border: 1px solid black;"><span id="datakekurangan"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table width="100%">
                            <tr>
                                <td width="50%" align="center">
                                    <p style="font-size: 10;">Penerima</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                <td width="50%" align="center">
                                     <p style="font-size: 10;">Hormat Kami</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                <td align="center" bgcolor="#000000">
                                    <p style="color: white; font-size: 8;">GROSIR|ECER|DROPSHIP|PUSAT BAJU TERMURAH, TERBARU & BERKUALITAS DI KOTA KEDIRI</p>
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
@endsection
@section('js')
<script src="{{asset('assets/js/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/js/custom/createnota.js')}}"></script>
@endsection