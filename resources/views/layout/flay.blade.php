<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <meta content="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta name="description" content="hotels">
        <meta name="keywords" content="hotels">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic&display=swap" rel="stylesheet">
        <link rel="stylesheet"  href="{{ url('assest/finallfront/css/all.css') }}">
        <link rel="stylesheet" href="{{ url('assest/finallfront/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ url('assest/finallfront/css/stylesheet.css') }}">
        @yield('css')
    </head>

    <body>



        <nav class="navbar navbar-expand-lg navbar-dark bg-danger mg-b ">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <img src="https://c8.alamy.com/compfr/2g52jjg/maison-hotel-logo-inspiration-2g52jjg.jpg" alt=""
                        width="30" height="24">
                    فنادق
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">


                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-regular fa-user"></i> حسابي
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">تسجيل الدخول</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">انشاء حساب</a>
                        </div>
                        </li>
                        <li class="nav-item lattel">
                            <a class="nav-link" style="
                            font-weight: 100;" href="#">اتصل بنا</a>
                            </li>
                    </ul>

                </div>
            </div>
        </nav>
                <div class="section">
                    <div class="moving-image"  @yield('background')></div>
                </div>

                <!-- Page cursor
                		================================================== -->

                <div class='cursor' id="cursor"></div>
                <div class='cursor2' id="cursor2"></div>
                <div class='cursor3' id="cursor3"></div>

                <!-- Link to page
                	================================================== -->
                    <div class="home">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-4 text-center">
                                    <a href="{{ route('userIndexhotel')}}">
                                        <img src="{{ url('assest/finallfront/images/otel.png') }}" alt="" width="50" height="50">
                                        <p class="jo-title">
                                            حجز فنادق
                                        </p>
                                    </a>

                                </div>
                                <div class="col-lg-2 col-4 text-center">
                                    <a href="{{ route('userIndexApartement')}}">
                                        <img src="{{ url('assest/finallfront/images/house.png') }}" alt="" width="50" height="50">
                                        <p class="jo-title">
                                            حجز شقق
                                        </p>
                                    </a>

                                </div>
                                <div class="col-lg-2 col-4 text-center border-none">
                                    <a href="{{ route('userIndexVilla')}}">
                                        <img src="{{ url('assest/finallfront/images/castel.png') }}" alt="" width="50" height="50">
                                        <p class="jo-title">
                                            فلل
                                        </p>
                                    </a>

                                </div>
                                <div class="col-lg-2 col-4 text-center">
                                    <a href="{{ route('meetinguserindex')}}">
                                        <img src="{{ url('assest/finallfront/images/toblanti.png') }}" alt="" width="50" height="50"">
                                        <p class="jo-title">
                                            حجز قاعات اجتماع
                                        </p>
                                    </a>

                                </div>
                                <div class="col-lg-2 col-4 text-center">
                                    <a href="{{ route('userIndexCar')}}">
                                        <img src="{{ url('assest/finallfront/images/car.png')}}" alt="" width="50" height="50">
                                        <p class="jo-title">
                                            تأجير سيارات
                                        </p>
                                    </a>

                                </div>
                                <div class="col-lg-2 col-4 text-center border-none">
                                    <a href="{{ route('userIndexTax')}}">
                                        <img src="{{ url('assest/finallfront/images/taxi.png ') }}" alt="" width="50" height="50">
                                        <p class="jo-title">
                                            تاكسي المطار
                                        </p>
                                    </a>

                                </div>

                            </div>
                            <hr>
                        </div>
                        <div class="title">
                            @yield('pagetitle')
                        </div>
                        @yield('content')

                    </div>


        <footer>
            <div class="container">
                copy Right
            </div>
        </footer>
        <script src="{{ url('assest/finallfront/js/all.js')  }}"></script>
        <script src="{{ url('assest/finallfront/js/jquery-3.6.0.js') }}"></script>
        <script src="{{ url('assest/finallfront/js/popper.js') }}"></script>
        <script src="{{ url('assest/finallfront/js/bootstrap.js')  }}"></script>
        {{-- <script src="{{ url('assest/finallfront/js/main.js')  }}"></script> --}}
        @yield('js')
    </body>
</html>
