<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SMB APP</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
    ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- font awesome CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <!-- owl.carousel CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.transitions.css')}}">
    <!-- meanmenu CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/meanmenu/meanmenu.min.css')}}">
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/normalize.css')}}">
  <!-- wave CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/wave/waves.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/wave/button.css')}}">
    <!-- mCustomScrollbar CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <!-- jvectormap CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/jvectormap/jquery-jvectormap-2.0.3.css')}}">
    <!-- Notika icon CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/notika-custom-icon.css')}}">
    <!-- main CSS
    ============================================ -->
    @yield('css')
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <!-- modernizr JS
    ============================================ -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
  
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a style="color:white;"><h3 style="margin-bottom: 0px;"><i class="fa fa-money"></i> SMB</h3></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            
                            <li class="nav-item nc-al"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="fa fa-user"></i></span> {{ Auth::user()->username }}</a>
                                <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
                                    
                                    <div class="hd-message-info text-center">
                                        
                                        <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <div class="hd-message-sn">
                                                
                                                <div class="hd-mg-ctn">
                                                    <h3><i class="fa fa-sign-out"></i> Logout</h3>
                                                </div>
                                            </div>
                                        </a>
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li>
                                    <a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a>
                                </li>
                                <li>
                                    <a href="{{url('admin')}}"><i class="fa fa-child"></i> Admin</a>
                                </li>
                                <li>
                                    <a data-toggle="collapse" data-target="#Pagemob" href="#"><i class="fa fa-file"></i> Transaksi</a>
                                    <ul id="Pagemob" class="collapse dropdown-header-top">
                                        <li><a href="{{url('transaksi/tambahdata')}}">Tambah Transaksi</a>
                                </li>
                                <li><a href="{{url('transaksi/listdata')}}">Daftar Transaksi</a>
                                </li>
                                <li><a href="{{url('transaksi/listdatadikirim')}}">Daftar Transaksi Terkirim</a>
                                </li>
                                <li><a href="{{url('transaksi/listdatacancel')}}">Daftar Transaksi Dicancel</a>
                                </li>
                                <li><a href="{{url('transaksi/listdatasukses')}}">Daftar Transaksi Sukses</a>
                                </li>
                                    </ul>
                                </li>
                        <li><a href="{{url('laporan/caridata')}}"><i class="fa fa-file"></i> Laporan</a>
                        </li>
                        <li><a href="{{url('backup/caridata')}}"><i class="fa fa-download"></i> Backup</a>
                        </li>
                                
                                
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a>
                        </li>
                        <li><a href="{{url('admin')}}"><i class="fa fa-child"></i> Admin</a>
                        </li>
                        <li><a href="{{url('user')}}"><i class="fa fa-users"></i> User</a>
                        </li>
                        <li><a data-toggle="tab" href="#Interface"><i class="fa fa-list"></i> Nota</a>
                        </li>
                        <li><a href="#"><i class="fa fa-file"></i> Laporan</a>
                        </li>
                        <li><a href="#"><i class="fa fa-download"></i> Backup</a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        
                        <div id="Interface" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="#">Tambah Nota</a>
                                </li>
                                <li><a href="#">List Nota</a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @yield('content')
    <!-- jquery
    ============================================ -->
    <script src="{{asset('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- bootstrap JS
    ============================================ -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- wow JS
    ============================================ -->
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <!-- price-slider JS
    ============================================ -->
    <script src="{{asset('assets/js/jquery-price-slider.js')}}"></script>
    <!-- owl.carousel JS
    ============================================ -->
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <!-- scrollUp JS
    ============================================ -->
    <script src="{{asset('assets/js/jquery.scrollUp.min.js')}}"></script>
    <!-- meanmenu JS
    ============================================ -->
    <script src="{{asset('assets/js/meanmenu/jquery.meanmenu.js')}}"></script>
    <!-- counterup JS
    ============================================ -->
    <script src="{{asset('assets/js/counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/counterup/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/counterup/counterup-active.js')}}"></script>
    <!-- mCustomScrollbar JS
    ============================================ -->
    <script src="{{asset('assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- sparkline JS
    ============================================ -->
    <script src="{{asset('assets/js/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/js/sparkline/sparkline-active.js')}}"></script>
    <!-- flot JS
    ============================================ -->
    <script src="{{asset('assets/js/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/js/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/js/flot/flot-active.js')}}"></script>
    <!-- knob JS
    ============================================ -->
    <script src="{{asset('assets/js/knob/jquery.knob.js')}}"></script>
    <script src="{{asset('assets/js/knob/jquery.appear.js')}}"></script>
    <script src="{{asset('assets/js/knob/knob-active.js')}}"></script>
    <!--  Chat JS
    ============================================ -->
    <script src="{{asset('assets/js/chat/jquery.chat.js')}}"></script>
    <!--  todo JS
    ============================================ -->
    <script src="{{asset('assets/js/todo/jquery.todo.js')}}"></script>
  <!--  wave JS
    ============================================ -->
    <script src="{{asset('assets/js/wave/waves.min.js')}}"></script>
    <script src="{{asset('assets/js/wave/wave-active.js')}}"></script>
    <!-- plugins JS
    ============================================ -->
    
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <!-- main JS
    ============================================ -->
    @yield('js')
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>