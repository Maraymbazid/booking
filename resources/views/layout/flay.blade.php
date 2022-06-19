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
        <link rel="stylesheet" href="{{ url('assest/finallfront/css/style2.css') }}">
        
        @yield('css')
    </head>

    <body>
<style>
        .card-title-me{
            color:red
        }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger mg-b ">
    <div class="container">

        <a class="navbar-brand" href="{{url('/')}}">

            <img src="https://c8.alamy.com/compfr/2g52jjg/maison-hotel-logo-inspiration-2g52jjg.jpg" alt=""
                width="30" height="24">
            فنادق
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
                    
                        <a class="dropdown-item" href="{{ route('userHotelOrder')}}"  >      <span><i class="fa-solid fa-hotel"></i>
                            <span class="nav-link-text"> حجز الفنادق  </span>  </a>
                            <a class="dropdown-item" href="{{ route('userTaxiOrder')}}"  >      <span><i class="fa-solid fa-taxi"></i></span>
                                <span class="nav-link-text">   حجز تاكسي  </span>  </a>
                                <a class="dropdown-item" href="{{ route('userCarOrder')}}"  >      <span><i class="fa-solid fa-handshake-simple"></i></span>
                                    <span class="nav-link-text">    حجز السيارات </span>  </a>
                                    <a class="dropdown-item" href="{{ route('userMeetOrder')}}"  >      <span><i class="fa-solid fa-castle"></i></span>
                                        <span class="nav-link-text">    حجز الاجتماعات </span>  </a>
                                        <a class="dropdown-item" href="{{ route('userAppartOrder')}}"  >      <span><i class="fa-solid fa-castle"></i></span>
                                            <span class="nav-link-text">    حجز الشقق  </span>  </a>
                                            <a class="dropdown-item" href="{{ route('userVillaOrder')}}"  >      <span><i class="fa-solid fa-house"></i></span>
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
                    font-weight: 100;" href="https://wa.me/212680695296?text=أهلاً،  السلام عليكم أبغى استفسر عن شئ فى موقعكم  "><i class="fab fa-whatsapp"> &nbsp &nbsp &nbsp</i> تواصل معنا</a>
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
