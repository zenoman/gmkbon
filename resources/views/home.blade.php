@extends('layouts.appadmin')

@section('content')
@if(Auth::user()->level=='super admin' || Auth::user()->level=='admin')
<div class="notika-status-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$notalunas}}</span></h2>
                            <p>Nota Lunas</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$notabelumlunas}}</span></h2>
                            <p>Nota Belum Lunas</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$notapengajuan}}</span></h2>
                            <p>Pengajuan Nota</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="notika-email-post-area">
        <div class="container">
            <div class="row">
               
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="recent-post-wrapper notika-shadow sm-res-mg-t-30 tb-res-ds-n dk-res-ds">
                        <div class="recent-post-ctn">
                            <div class="recent-post-title">
                                <h2>Pengajuan Nota</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="recent-post-items">
                            @foreach($listpengajuan as $lp)
                            <div class="recent-post-signle rct-pt-mg-wp">
                                <a href="#">
                                    <div class="recent-post-flex">
                                        <div class="recent-post-img">
                                            <i class="fa fa-circle"></i>
                                        </div>
                                        <div class="recent-post-it-ctn">
                                            <h2>{{$lp->username}}</h2>
                                            <p>Pengajuan Nota '<b>{{$lp->kode}}</b>'</p>
                                            <span class="text-muted"><i class="fa fa-calendar"></i> {{$lp->tgl}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            <div class="recent-post-signle">
                                <a href="{{url('pengajuan/nota')}}">
                                    <div class="recent-post-flex rc-ps-vw">
                                        <div class="recent-post-line rct-pt-mg">
                                            <p>Lihat Semua</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                    <div class="recent-post-wrapper notika-shadow sm-res-mg-t-30 tb-res-ds-n dk-res-ds">
                        <div class="recent-post-ctn">
                            <div class="recent-post-title">
                                <h2>Pengajuan Edit Nota</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="recent-post-items">
                            @foreach($listpengajuanubah as $lpu)
                            <div class="recent-post-signle rct-pt-mg-wp">
                                <a href="#">
                                    <div class="recent-post-flex">
                                        <div class="recent-post-img">
                                            <i class="fa fa-circle"></i>
                                        </div>
                                        <div class="recent-post-it-ctn">
                                            <h2>{{$lpu->username}}</h2>
                                            <p>Menambah <b>{{$lpu->jumlah}} Pcs </b> jumlah terjual <b>{{$lpu->barang}}</b> di nota <b>{{$lpu->kode_nota}}</b></p>
                                            <span class="text-muted">
                                                <i class="fa fa-calendar"></i> {{$lpu->tgl}}
                                                <i class="fa fa-clock-o"></i> {{$lpu->jam}} 
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            <div class="recent-post-signle">
                                <a href="{{url('pengajuan/editnota')}}">
                                    <div class="recent-post-flex rc-ps-vw">
                                        <div class="recent-post-line rct-pt-mg">
                                            <p>Lihat Semua</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
                        <div class="rc-it-ltd">
                            <div class="recent-items-ctn">
                                <div class="recent-items-title">
                                    <h2>Hutang Terbanyak</h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="recent-items-inn">
                                <table class="table table-inner table-vmiddle">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th style="text-align: right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hutang as $htg)
                                        <tr>
                                            <td>{{$htg->username}}</td>
                                            <td align="right">
                                                <b>{{"Rp ". number_format($htg->totalkekurangan,0,',','.')}}</b>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="notika-status-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$notalunas}}</span></h2>
                            <p>Nota Lunas</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$notabelumlunas}}</span></h2>
                            <p>Nota Belum Lunas</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$notapengajuan}}</span></h2>
                            <p>Pengajuan Nota</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="notika-status-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="statistic-right-area notika-shadow mg-tb-30 sm-res-mg-t-0">
                        <div class="past-day-statis">
                            <p>Total Hutang</p>
                            @foreach($hutang as $htg)
                            <h1>{{"Rp ". number_format($htg->totalkekurangan,0,',','.')}}</h1>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
@endif
@endsection
@section('js')

@endsection