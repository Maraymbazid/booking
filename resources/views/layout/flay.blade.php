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



        <script src="{{ url('assest/finallfront/js/all.js')  }}"></script>
        <script src="{{ url('assest/finallfront/js/jquery-3.6.0.js') }}"></script>
        <script src="{{ url('assest/finallfront/js/popper.js') }}"></script>
        <script src="{{ url('assest/finallfront/js/bootstrap.js')  }}"></script>
        <script src="{{ url('assest/finallfront/js/main2.js')  }}"></script>
        @yield('js')
    </body>
</html>
