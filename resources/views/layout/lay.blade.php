<!DOCTYPE html>
<html  lang="ar" dir="rtl">

<head>
    <title>
        ELZERO
    </title>
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="yasser mayatı">
    <meta name="google" value="notranslate" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('assest/front/css/all.css') }}">
    <link rel="stylesheet" href="{{ url('assest/front/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assest/front/css/stylesheet.css') }}">
    <link rel="icon" type="image/png" href="{{ url('assest/front2/img/Untitled-123.png') }}" />
    @yield('css')
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="">ELZERO</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>

        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                {{-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                    <a class="nav-link destek" href="#">
                        <span style="color: #000;"> &nbsp <i class="fas fa-money-bill"></i>
                        <span class="nav-link-text ">  ₺ </span>
                        <span style="color: #000;"> &nbsp  &nbsp<i class="fas fa-comment-dollar"></i>
                        <span class="nav-link-text ">  ₺ </span>
                    </a>
                </li> --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="oyun">
                    <a class="nav-link" href="{{ route('userIndexhotel')}}">
                        <span> <i class="fas fa-gamepad"></i></span>
                        <span class="nav-link-text">  الفنادق</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="movement">
                    <a class="nav-link" href="">
                        <span><i class="fas fa-shopping-cart"></i></span>
                        <span class="nav-link-text">  الشقق</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="center" title="para odame">
                    <a class="nav-link" href="{{ route('userIndexVilla')}}">
                        <span><i class="fas fa-money-bill"></i></span>
                        <span class="nav-link-text">   الفلل </span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="odmaelerim">
                    <a class="nav-link" href="{{ route('userIndexCar')}}">
                        <span><i class="fas fa-money-bill-alt"></i> </span>
                        <span class="nav-link-text">  السيارات</span>

                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="odmaelerim">
                    <a class="nav-link" href="{{ route('userIndexTax')}}">
                        <span><i class="fas fa-bell"></i></span>
                        <span class="nav-link-text">  تاكسي المطار</span>

                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                    <a class="nav-link destek" href="https://wa.me/905374504741">
                        <span style="color: green;"> &nbsp <i class="fab fa-whatsapp"> &nbsp &nbsp &nbsp</i>
                        <span class="nav-link-text "> &nbsp Destek </span>
                    </a>
                </li>

                <li class="nav-item login-out">
                    <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>&nbsp Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="container">





    @yield('content')


</div>
</div>
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small> 2022 &copy; جميع حقوق الطبع والنشر محفوظة</small>

            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل تريد تسجيل الخروج حقا</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">اختر "تسجيل الخروج" أدناه إذا كنت مستعدًا لإنهاء جلستك الحالية.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">رجوع</button>
                    <a class="btn btn-primary" >تسجيل خروج</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('assest/front/js/all.js') }}"></script>
<script src="{{ url('assest/front/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ url('assest/front/js/bootstrap.js') }}"></script>
<script src="{{ url('assest/front/js/main.js') }}"></script>
@yield('js')
</body>

</html>
