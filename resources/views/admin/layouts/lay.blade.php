<!DOCTYPE html>
<html lang="en" style="direction: rtl;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('assest/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('assest/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assest/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('assest/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assest/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assest/admin/dist/css/adminlte.min.css') }}">
    <style>
        .card-header>.card-tools {
            float: left;
            margin-right: -0.625rem;
        }

        .card-title {
            float: right;
            font-size: 1.1rem;
            font-weight: 400;
            margin: 0;
        }

    </style>
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"
    style="font-family: 'Tajawal;';">
    <div class="wrapper">

        <!-- Preloader -->


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light" style="direction: rtl;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/admin')}}" class="nav-link">الصفحة الرئيسية</a>
                </li>
            </ul>

            <!-- Right navbar links -->

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="direction: ltr;">
            <!-- Brand Logo -->
            <a class="brand-link">
                <img src="{{ url('assest/admin/dist/img/LOGO.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SW GAMES</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    المحافظات
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('creategouvernement')}}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> إضافة محافظة  </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('allgouvernement')}}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>كل محافظات</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="fab fa-steam"></i>
                                <p>
                                        الفنادق
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('Hotels')}}" class="nav-link">
                                        <i class="fas fa-gamepad"></i>
                                        <p>كل الفنادق </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('createHotel')}}" class="nav-link">
                                        <i class="fas fa-plus-circle"></i>
                                        <p>اضافة فندق</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="" class="nav-link">
                                <i class="fas fa-folder-open"></i>
                                <p>
                                     شقق  
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('createapartement')}}" class="nav-link">
                                        <i class="fas fa-folder"></i>
                                        <p>إضافة شقة </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('allapartements')}}" class="nav-link">
                                        <i class="fas fa-plus-square"></i>
                                        <p>كل شقق</p>
                                    </a>
                                </li>
    </ul>
    </li>
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="fas fa-folder-open"></i>
                                <p>
                                    الدفعات
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fas fa-folder"></i>
                                        <p>التفاصيل</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="{{ url('admin/logout') }}" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>
                                    تسجيل خروج

                                </p>
                            </a>

                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        @yield('content')
        @include('sweetalert::alert')

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer" style="text-align: center;">
            جميع الحقوق محفوظة &copy; <strong><a href="#">ُELZERO</a></strong> 2022
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ url('assest/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assest/admin/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ url('assest/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url('assest/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('assest/admin/dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ url('assest/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assest/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ url('assest/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ url('assest/admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ url('assest/admin/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('assest/admin/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ url('assest/admin/dist/js/pages/dashboard2.js') }}"></script>
    <script>
        $(function() {

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        });
    </script>


    @yield('js')
    @stack('jss')
</body>

</html>
