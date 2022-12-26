<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    <!-- ENCODING -->
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- AUTHOR -->
    <meta name="author" content="bdCoder" />
    <!-- DESCRIPTION -->
    <meta name="description" content="Modern Bootstrap 4 Admin Template - Fully Responsive" />
    <!-- IE EDGE COMPATIBILITY -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- RESPONSIVE BROWSER TO SCREEN WIDTH -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />
    <!------------------------------------------------------------------------------------------------>
    <!-- FAVICON  -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('backend/assets/img/favicon/favicon.png') }}" />
    <!-- BOOTSTRAP - V 4.0.0 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}" />
    <!-- MATERIAL ICONS -->
    <link rel="stylesheet" href="{{asset('backend/assets/icons/material-icons/material-icons.css')}}" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{asset('backend/assets/icons/font-awesome/font-awesome.min.css')}}" />
    <!-- WEATHER ICONS -->
    <link rel="stylesheet" href="{{asset('backend/assets/icons/weather-icons/css/weather-icons.min.css')}}" />
    <!-- FLAG ICON CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/icons/flag-icon-css/css/flag-icon.min.css')}}" />
    <!-- OVERLAYSCROLLBARS -->
    <link type="text/css" href="{{asset('backend/assets/plugin/OverlayScrollbars/css/OverlayScrollbars.min.css')}}" rel="stylesheet" />
    <!-- JVECTORMAP -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/jVectormap/jquery-jvectormap-2.0.3.css')}}" />
    <!-- Circliful Master -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/circliful/css/jquery.circliful.css')}}" />
    <!-- DATA TABLES -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/DataTables/1.10.16/css/dataTables.bootstrap4.min.css')}}" />
    <!-- SUMMERNOTE{{-- -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/summernote/summernote-bs4.css')}}" />--}}
    <!-- JQUERY NOTIFY -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/notify/css/notify.css')}}" />
    <!-- BOOTSTRAP SLIDER -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/bootstrap-slider/bootstrap-slider.min.css')}}" />
    <!-- SUMOSELECT -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/sumoselect/sumoselect.min.css')}}" />
    <!-- IMAGE UPLOADER -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/image-uploader.min.css')}}" />
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Julius+Sans+One" rel="stylesheet">
    <!-- STYLE -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css ')}}" />
    @stack('css')


</head>

<body>
    <!------------------------------------------------------------------------------------------------>
    <!-- WRAPPER ------------------------------------------------------------------------------------->
    <div id="wrapper" class="wrapper-left-fixed wrapper-header-fixed bg-dark">
        <!------------------------------------------------------------------------------------------------>
        <!-- WRAPPER LOAD -------------------------------------------------------------------------------->
        <div id="wrapper-load">
            <div class="load-container">
                <img class="mb-3"
                    src="{{ asset('backend/assets/img/logo/white.png') }}" /><img>
                <h6 class="font-julius-sans-one mb-4">IT Desk</h6>
                <div class="load-bard"></div>
                <div class="load-bard"></div>
                <div class="load-bard"></div>
            </div>
        </div>
        <!-- END WRAPPER LOAD ---------------------------------------------------------------------------->

        <!-- WRAPPER HEADER ------------------------------------------------------------------------------>
        @include('admin.includes.header')
        <!-- END WRAPPER HEADER -------------------------------------------------------------------------->


        <!------------------------------------------------------------------------------------------------>
        <!-- WRAPPER LEFT -------------------------------------------------------------------------------->
        <div id="wrapper-left">
            <!-- SIDEBAR -->
            <div class="sidebar sidebar-dark sidebar-danger bg-dark">
                <!-- SIDEBAR HEADER -->
                <div class="sidebar-header border-fade">
                    <!-- SIDEBAR BRAND -->
                    <a href="{{route('admin.dashboard')}}" class="sidebar-brand">
                        <!-- SIDEBAR BRAND IMG -->
                        <img class="sidebar-brand-img"
                            src="{{  asset(setting('app.basic.logo','frontend/images/logo-example.png')) }}" />
                        <!-- SIDEBAR BRAND TEXT -->
                    </a>
                    <!-- SIDEBAR CLOSE -->
                    <a href="javascript:void(0);" class="sidebar-close d-md-none" data-toggle="class" data-target="#wrapper" toggle-class="toggled">
                        <i class="material-icons icon-sm">close</i>
                    </a>
                </div>
                <!-- SIDEBAR CONTAINER -->
                <div class="sidebar-container style-scroll-dark">
                    <!-- SIDEBAR PROFILE -->
                    <div class="sidebar-profile border-fade">
                        <!-- SIDEBAR PROFILE IMG -->
                        <div class="d-flex align-items-center">
                            <img src="{{ $admin_user->profile_photo_path ? asset('upload/backend/profile/'.$admin_user->profile_photo_path) : asset('upload/backend/mail_blank_avatar.jpg') }}"
                                class="img-fluid img-thumbnail sidebar-profile-img" />
                        </div>
                        <!-- SIDEBAR PROFILE INFO -->
                        <div class="sidebar-profile-info">
                            <h6>{{ $admin_user->name }}</h6>
                            <!-- SIDEBAR ACTIONS -->
                            <div class="sidebar-actions">
                                <a href="{{route('admin.profile')}}" class="keep"><i class="material-icons">person_outline</i></a>
                                <a href="{{ route('admin.contact') }}"><i class="material-icons fs-21px">mail_outline</i></a>
                                <a href="{{ route('admin.change.password')}}"><i class="material-icons">settings</i></a>
                            </div>
                        </div>
                    </div>
                    <!-- SIDEBAR NAV -->
                    @include('admin.includes.menu')
                </div>
            </div>
        </div>
        <!-- END WRAPPER LEFT ---------------------------------------------------------------------------->
        <!------------------------------------------------------------------------------------------------>
        <!-- WRAPPER CONTENT ----------------------------------------------------------------------------->
        <div id="wrapper-content">

            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
        <!-- END WRAPPER CONTENT ------------------------------------------------------------------------->

        <!-- WRAPPER SLIDE ------------------------------------------------------------------------------->
        <div id="wrapper-slide">
            <button data-toggle="slideUp" data-target="body" class="btn btn-circle btn-danger btn-flash-dark ">
                <i class="material-icons">keyboard_arrow_up</i>
            </button>
        </div>
        <!-- END WRAPPER SLIDE --------------------------------------------------------------------------->

        <!-- WRAPPER FOOTER ------------------------------------------------------------------------------>
        @include('admin.includes.footer')
        <!-- END WRAPPER FOOTER -------------------------------------------------------------------------->
    </div>

    <!-- END WRAPPER --------------------------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------>
    <!-- JAVASCRIPT ---------------------------------------------------------------------------------->
    <!-- JQUERY -->
    <script src="{{asset('jquery/jquery.min.js')}}"></script>
    <!-- JQUERY UI -->
    <script src="{{asset('backend/assets/libraries/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- POPPER -->
    <script src="{{asset('jquery/popper.min.js')}}"></script>
    <!-- BOOTSTRAP - V 4.0.0 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- CHARTJS -->
    <script src="{{asset('backend/assets/plugin/chartJs/Chart.bundle.min.js')}}"></script>
    <!-- CIRCLIFUL MASTER -->
    <script src="{{asset('backend/assets/plugin/circliful/js/jquery.circliful.js')}}"></script>
    <!-- OVERLAYSCROLLBARS -->
    <script src="{{asset('backend/assets/plugin/OverlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- DATA TABLES -->
    <script src="{{asset('backend/assets/plugin/DataTables/1.10.16/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/DataTables/1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  {{--  <!-- SUMMERNOTE -->
    <script src="{{asset('backend/assets/plugin/summernote/summernote-bs4.js')}}"></script>--}}
    <!-- JQUERY-NOTIFY -->
    <script src="{{asset('backend/assets/plugin/notify/js/notify.js')}}"></script>
    <!-- JVECTORMAP -->
    <script src="{{asset('backend/assets/plugin/jVectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/jVectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/jVectormap/jquery-jvectormap-us-aea.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/jVectormap/jquery-jvectormap-ca-lcc.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/jVectormap/jquery-jvectormap-fr-regions-mill.js')}}"></script>
    <!-- BOOTSTRAP SLIDER -->
    <script src="{{asset('backend/assets/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>
    <!-- TINY COLOR PICKER -->
    <script src="{{asset('backend/assets/plugin/tinyColorPicker/jqColorPicker.min.js')}}"></script>
    <!-- SUMOSELECT -->
    <script src="{{asset('backend/assets/plugin/sumoselect/jquery.sumoselect.min.js')}}"></script>
    <!-- INPUTMASK -->
    <script src="{{asset('backend/assets/libraries/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <!-- PLUGINS -->
    <script src="{{asset('backend/assets/js/plugin.js')}}"></script>
    <!-- IMAGE UPLOADER -->
    <script src="{{asset('backend/assets/js/image-uploader.min.js')}}"></script>
    <!-- FUNCTIONS -->
    <script src="{{asset('backend/assets/js/functions.js')}}"></script>
    <!-- END JAVASCRIPT ------------------------------------------------------------------------------>
    @stack('scripts')

</body>

</html>
