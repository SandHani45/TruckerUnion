<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <!-- Fonts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="{{URL::asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="{{URL::asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('lib/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="{{URL::asset('lib/jquery/jquery.min.js')}}"></script>

    <!-- Main Stylesheet File -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
     <style type="text/css">
        .btn-outline-secondary {
    color: #ffffff;
    background-color: #2aa3f4;
    background-image: none;
    border-color: #2aa3f4;
    }
      #header .scrollto p{
           background: url('img/icon_blue.svg') repeat 0 0;
          /* z-index: 9999999999999999999; */
          height: 73px;
          width: 150px;
      }
      #header.header-fixed  .scrollto p{
           background: url('img/icon.svg') repeat 0 0;
          /* z-index: 9999999999999999999; */
          height: 73px;
          width: 150px;
      }
      
    </style>
     @yield('style')


    </head>
    <body>
       
        @yield('header')

        @yield('main-content')

        @yield('footer')

     <!-- JavaScript Libraries -->
       @yield('script-top')
     
      <script src="{{URL::asset('lib/jquery/jquery-migrate.min.js')}}"></script>
      <script src="{{URL::asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{URL::asset('lib/easing/easing.min.js')}}"></script>
      <script src="{{URL::asset('lib/wow/wow.min.js')}}"></script>
      <script src="{{URL::asset('lib/superfish/hoverIntent.js')}}"></script>
      <script src="{{URL::asset('lib/superfish/superfish.min.js')}}"></script>
      <script src="{{URL::asset('lib/magnific-popup/magnific-popup.min.js')}}"></script>
      <!-- Template Main Javascript File -->
      <script src="{{URL::asset('js/main.js')}}"></script>

      <!-- cros mark -->
        <script src="{{URL::asset('js/prefixfree.min.js')}}"></script>
      <!-- SweetAlert script -->
      <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
      @include('sweetalert::alert')
       @yield('script-down')
    </body>
</html>
 