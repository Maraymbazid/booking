<nav class="navbar navbar-expand-lg navbar-dark bg-danger mg-b ">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <img src="https://c8.alamy.com/compfr/2g52jjg/maison-hotel-logo-inspiration-2g52jjg.jpg" alt=""
                width="30" height="24">
            فنادق
        </a>
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
                        @if (Route::has('userOrder'))
                        <a class="dropdown-item" href="{{ route('userOrder')}}"  >      <span><i class="fas fa-bell"></i></span>
                            <span class="nav-link-text">  طلباتي </span>  </a>
                        @endif
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

