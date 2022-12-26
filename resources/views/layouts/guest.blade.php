<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- FAVICON  -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/img/favicon/favicon.png') }}" />
    <!--Bootstrap Css-->
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!--Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/font-awesome.min.css')}}">

    <!--Animeted Css-->
    <link rel="stylesheet" href="{{asset('frontend/css/animate.min.css')}}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/file-upload.css')}}" />
    @stack('css')


</head>

<body>
    <!--Start Header-->
    @include('includes.header')
    <!--End Header-->

    <!-- Start Content -->
    @yield('content')
    <!-- End Content -->

    <!-- Start Footer -->
    @include('includes.footer')
    <!-- End Footer -->

    <!-------Plugin js------->
    <script src="{{asset('jquery/jquery.min.js')}}"></script>
    <script src="{{asset('jquery/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('frontend/js/script.js')}}"></script>
    <script src="{{asset('frontend/js/file-upload.js')}}"></script>

    @stack('modals')

    @stack('scripts')



</body>

</html>
