<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <meta content="UTF-8">
        <meta name="theme-color" content="#014760">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta name="description" content="booking system">
        <meta name="keywords" content="booking system">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic&display=swap" rel="stylesheet">
        <link rel="stylesheet"  href="{{ url('assest/finallfront/css/all.css') }}">
        <link rel="stylesheet" href="{{ url('assest/finallfront/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ url('assest/finallfront/css/stylesheet.css') }}">
        <link rel="stylesheet" href="{{ url('assest/finallfront/css/style2.css') }}">
        <link rel="shortcut icon" type="image/x-png" href="{{ url('/logo.png')}}" />

        @yield('css')
    </head>

    <body>
<style>
        .card-title-me{
            color:red
        }
        .avatar {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: red;
            }
            .logo{
                color: white;
                display: inline;
            }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger mg-b ">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
        <h5 class='logo'> JOONAY</h5>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                @guest
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-regular fa-user"></i> حسابي
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (Route::has('login'))
                    <a class="dropdown-item" href="{{ route('login') }}" >تسجيل الدخول</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    @if (Route::has('register'))
                    <a class="dropdown-item" href="{{ route('register') }}" >انشاء حساب</a>
                    @endif
                </div>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-regular fa-user"></i>   {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('userHotelOrder')}}"  >      <span>                <img src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/000000/external-hotel-summertime-wanicon-lineal-wanicon.png"/>
                            <span class="nav-link-text"> حجز الفنادق  </span>  </a>
                            <a class="dropdown-item" href="{{ route('userTaxiOrder')}}"  >      <span>                <img src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/000000/external-car-rental-car-repair-smashingstocks-detailed-outline-smashing-stocks.png"/>                            </span>
                                <span class="nav-link-text">   حجز تاكسي  </span>  </a>
                                <a class="dropdown-item" href="{{ route('userCarOrder')}}"  >      <span>  <img src="https://img.icons8.com/ios-filled/20/000000/cab-stand.png"/></span>
                                    <span class="nav-link-text">    حجز السيارات </span>  </a>
                                    <a class="dropdown-item" href="{{ route('userMeetOrder')}}"  >      <span><img src="https://img.icons8.com/external-smashingstocks-mixed-smashing-stocks/20/000000/external-meeting-industrial-revolution-smashingstocks-mixed-smashing-stocks.png"/>                                    </span>
                                        <span class="nav-link-text">    حجز الاجتماعات </span>  </a>
                                        <a class="dropdown-item" href="{{ route('userAppartOrder')}}"  >      <span>  <img src="https://img.icons8.com/external-out-line-pongsakorn-tan/20/000000/external-apartment-travel-out-line-pongsakorn-tan.png"/></span>
                                            <span class="nav-link-text">    حجز الشقق  </span>  </a>
                                            <a class="dropdown-item" href="{{ route('userVillaOrder')}}"  >      <span><img src="https://img.icons8.com/external-xnimrodx-lineal-xnimrodx/20/000000/external-house-real-estate-xnimrodx-lineal-xnimrodx.png"/></span>
                                                <span class="nav-link-text">    حجز الفلل </span>  </a>
                        <div class="dropdown-divider"></div>
                        @if (Route::has('register'))
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         تسجيل  خروج
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                        @endif
                    </div>
                    </li>
                @endguest


                <li class="nav-item lattel">
                    <a class="nav-link" style="
                    font-weight: 100;" href="https://wa.me/+9647507776549?text=أهلاً،  السلام عليكم أبغى استفسر عن شئ فى موقعكم  "><i class="fab fa-whatsapp"> &nbsp &nbsp &nbsp</i> تواصل معنا</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

@yield('moving-image')
                <!-- Page cursor
                		================================================== -->

                <div class='cursor' id="cursor"></div>
                <div class='cursor2' id="cursor2"></div>
                <div class='cursor3' id="cursor3"></div>

                <!-- Link to page
                	================================================== -->
                    <div class="home">
                        @yield('content')
                    </div>

                    <footer class="footer">
                        <div class="container">
                            <div class="aboute-us">
                                تمت برمجة هذا الموقع من قبل <a href="#">M.A.Y</a> جميع الحقوق محفوظة
                            </div>
                        </div>

                  </footer>



        <script src="{{ url('assest/finallfront/js/all.js')  }}"></script>
        <script src="{{ url('assest/finallfront/js/jquery-3.6.0.js') }}"></script>
        <script src="{{ url('assest/finallfront/js/popper.js') }}"></script>
        <script src="{{ url('assest/finallfront/js/bootstrap.js')  }}"></script>
        <script src="{{ url('assest/finallfront/js/main2.js')  }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @yield('js')

    </body>
</html>
