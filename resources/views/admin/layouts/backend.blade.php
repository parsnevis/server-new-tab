<html lang="{{ $_auth->default_language }}">
<?php
use \App\Http\Controllers\RequireFunction;

$getRoute = RequireFunction::getRoute();
$route = @$getRoute[0];
$action = @$getRoute[1];

//$route = explode('/', explode('admin/', $_url)[1]);
//if(count(explode('-', $route[count($route)-1])) > 1)
//    unset($route[count($route)-1]);
//$route = implode('.', $route);
//dd($route);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $_siteSettings[app()->getLocale() == 'en' ? 'site_name_en' : 'site_name_fa'] . ' | ' . __('lang.' . strtoupper($route.'.'.$action)) }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/fontawesome.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/jqvmap.min.css') }}">

    @if($_auth->default_language == 'en')
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/bootstrap.css') }}">

    @elseif($_auth->default_language == 'fa' || $_auth->default_language == 'ar')
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif

<!-- Theme style -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/admintheme.css') }}">


    <!-- overlayScrollbars -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/summernote-bs4.css') }}">


    <!-- dataTables -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/datatables.min.css') }}">
    <!-- select2 -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/select2-bootstrap4.min.css') }}">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/fonts.css') }}">
    <!-- Custom style for Backend -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/backend-custom.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/toastr.min.css') }}">

    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/persian-datepicker.min.css') }}">
    @if($_auth->default_language == 'fa' || $_auth->default_language == 'ar')
    <!-- Bootstrap 4 RTL -->
{{--        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/bootstrap-rtl.min.css') }}">--}}
    <!-- Persian Date picker for RTL -->
{{--        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/persianDatepicker-default.css') }}">--}}

        <!-- Custom style for RTL -->
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/custom-rtl.css') }}">
    <!-- Custom fonts for RTL -->
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/fonts-persian.css') }}">
    @endif

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
        $.widget.bridge('uibutton', $.ui.button)
    </script>


{{--    @if($_auth->default_language == 'fa' || $_auth->default_language == 'ar')--}}
        <!-- Persian Date picker for RTL -->
{{--            <script type="text/javascript" src="{{ asset('assets/js/persianDatepicker.min.js') }}"></script>--}}
            <script type="text/javascript" src="{{ asset('assets/js/persian-date.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/js/persian-datepicker.min.js') }}"></script>
{{--    @endif--}}

<!-- Popper -->
    <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<?php
//\Illuminate\Support\Facades\App::setLocale($_auth->default_language);
//dd($_auth);
?>
{{--{{ \Illuminate\Support\Facades\App::getLocale() }}--}}
<input type="hidden" name="default_laguage" value="{{ $_auth->default_language }}">

<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
{{--            <li class="nav-item d-none d-sm-inline-block">--}}
{{--                <a href="#" class="nav-link">Home</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item d-none d-sm-inline-block">--}}
{{--                <a href="#" class="nav-link">Contact</a>--}}
{{--            </li>--}}
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto-navbav">
            <!-- Messages Dropdown Menu -->

{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                    <i class="far fa-comments"></i>--}}
{{--                    <span class="badge badge-danger navbar-badge">3</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <!-- Message Start -->--}}
{{--                        <div class="media">--}}
{{--                            <img src="{{ asset('assets/images/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">--}}
{{--                            <div class="media-body">--}}
{{--                                <h3 class="dropdown-item-title">--}}
{{--                                    Brad Diesel--}}
{{--                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>--}}
{{--                                </h3>--}}
{{--                                <p class="text-sm">Call me whenever you can...</p>--}}
{{--                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Message End -->--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <!-- Message Start -->--}}
{{--                        <div class="media">--}}
{{--                            <img src="{{ asset('assets/images/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">--}}
{{--                            <div class="media-body">--}}
{{--                                <h3 class="dropdown-item-title">--}}
{{--                                    John Pierce--}}
{{--                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>--}}
{{--                                </h3>--}}
{{--                                <p class="text-sm">I got your message bro</p>--}}
{{--                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Message End -->--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <!-- Message Start -->--}}
{{--                        <div class="media">--}}
{{--                            <img src="{{ asset('assets/images/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">--}}
{{--                            <div class="media-body">--}}
{{--                                <h3 class="dropdown-item-title">--}}
{{--                                    Nora Silvester--}}
{{--                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>--}}
{{--                                </h3>--}}
{{--                                <p class="text-sm">The subject goes here</p>--}}
{{--                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Message End -->--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <!-- Notifications Dropdown Menu -->--}}

{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                    <i class="far fa-bell"></i>--}}
{{--                    <span class="badge badge-warning navbar-badge">15</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                    <span class="dropdown-item dropdown-header">15 Notifications</span>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                        <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-users mr-2"></i> 8 friend requests--}}
{{--                        <span class="float-right text-muted text-sm">12 hours</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--                        <span class="float-right text-muted text-sm">2 days</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--        <!-- Notifications Dropdown Menu -->--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">--}}
{{--                    <i class="fas fa-th-large"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <!-- Notifications Dropdown Menu -->--}}

            <li class="nav-item calendar-box">
                <div class="clock-box">
                    <div class="float-right" id="clock"></div>
                </div>
            </li>
            <li class="nav-item calendar-box">
                <div class="persian-date-box">
                    <div class="progress-description">{{ jdate()->format('l - d F Y') }}</div>
                </div>
            </li>
            <li class="nav-item calendar-box">
                <div class="gregorian-date-box">
                    <div class="gregorian-date">{{ date('D - Y d M') }}</div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link text-danger" data-widget="control-sidebar" data-slide="true"  href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off" alt="{{ __('lang.' . strtoupper('Logout')) }}"></i>
                </a>
            </li>
        </ul>
        <script language="JavaScript">

            var myVar = setInterval(showTheTime, 1000);

            function showTheHours(theHour) {
                if (theHour > 0 && theHour < 13) {
                    if (theHour == "0") theHour = 12;
                    return (theHour);
                }
                if (theHour == 0) {
                    return (12);
                }
                return (theHour-12);
            }
            function showZeroFilled(inValue) {
                if (inValue > 9) {
                    return "" + inValue;
                }
                return "0" + inValue;
            }
            function showTheTime() {
                now = new Date(<?php date('Y-m-d H:i:s') ?>);

                document.getElementById("clock").innerHTML = showTheHours(now.getHours()) + ":" + showZeroFilled(now.getMinutes()) + ":" + showZeroFilled(now.getSeconds());
                // setTimeout("showTheTime()",1000)
            }

        </script>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ $_siteSettings['site_url'] }}" class="brand-link">
            @if(!empty($_siteSettings['site_logo']) && $_siteSettings['site_logo'] !== '')
                <img src="{{ asset('storage/'.$_siteSettings['site_logo_small']) }}" alt="{{ $_siteSettings['site_name_en'] }}" class="m-auto" style="opacity: .8">
            @else
                <img src="{{ asset($_siteSettings['site_favicon']) }}" alt="{{ $_siteSettings['site_name_en'] }}" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ $_siteSettings['site_name_en'] }}</span>
            @endif
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset($_auth->profile_picture) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('admin.profile') }}" class="d-block">{{ !empty($_auth->nice_name) ? $_auth->nice_name : $_auth->first_name . ' ' . $_auth->last_name }}</a>
                    <span class="label label-administrator">{{ __('lang.' . strtoupper(implode('_', explode(' ', $_auth->roles->pluck('name')->first())))) }}</span>
                </div>
                <div class="info float-right">
                    <a class="text-danger" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off" alt="{{ __('lang.' . strtoupper('Logout')) }}"></i>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="row text-white">--}}
{{--                        <div class="col-6 pr-1">--}}
{{--                            <span class="progress-description">{{ jdate()->format('l - d F Y') }}</span>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 pl-2 gregorian-date-box">--}}
{{--                            <div class="gregorian-date">{{ date('D - Y d M') }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row text-white">--}}
{{--                        <div class="col-12">--}}
{{--                            <span class="info-box-text"><span class="float-right" id="clock"></span></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <script language="JavaScript">--}}

{{--                    var myVar = setInterval(showTheTime, 1000);--}}

{{--                    function showTheHours(theHour) {--}}
{{--                        if (theHour > 0 && theHour < 13) {--}}
{{--                            if (theHour == "0") theHour = 12;--}}
{{--                            return (theHour);--}}
{{--                        }--}}
{{--                        if (theHour == 0) {--}}
{{--                            return (12);--}}
{{--                        }--}}
{{--                        return (theHour-12);--}}
{{--                    }--}}
{{--                    function showZeroFilled(inValue) {--}}
{{--                        if (inValue > 9) {--}}
{{--                            return "" + inValue;--}}
{{--                        }--}}
{{--                        return "0" + inValue;--}}
{{--                    }--}}
{{--                    function showTheTime() {--}}
{{--                        now = new Date(<?php date('Y-m-d H:i:s') ?>);--}}

{{--                        document.getElementById("clock").innerHTML = showTheHours(now.getHours()) + ":" + showZeroFilled(now.getMinutes()) + ":" + showZeroFilled(now.getSeconds());--}}
{{--                        // setTimeout("showTheTime()",1000)--}}
{{--                    }--}}

{{--                </script>--}}
{{--            </div>--}}
{{--            <hr class="bg-info">--}}

{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card card-widget widget-user">--}}
{{--                        <!-- Add the bg color to the header using any of the bg-* classes -->--}}
{{--                        <div class="widget-user-header text-white" style="background: url({{ asset($_auth->background_picture) }}) center center;">--}}
{{--                            <h3 class="widget-user-username text-right">{{ !empty($_auth->nice_name) ? $_auth->nice_name : $_auth->first_name . ' ' . $_auth->last_name }}</h3>--}}
{{--                            <h5 class="widget-user-desc text-right">{{ $_auth->role }}</h5>--}}
{{--                        </div>--}}
{{--                        <div class="widget-user-image">--}}
{{--                            <img class="img-circle" src="{{ asset($_auth->profile_picture) }}" alt="User Avatar">--}}
{{--                        </div>--}}
{{--                        <div class="card-footer">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-4 border-right">--}}
{{--                                    <div class="description-block">--}}
{{--                                        <h5 class="description-header">3,200</h5>--}}
{{--                                        <span class="description-text">SALES</span>--}}
{{--                                    </div>--}}
{{--                                    <!-- /.description-block -->--}}
{{--                                </div>--}}
{{--                                <!-- /.col -->--}}
{{--                                <div class="col-sm-4 border-right">--}}
{{--                                    <div class="description-block">--}}
{{--                                        <h5 class="description-header">13,000</h5>--}}
{{--                                        <span class="description-text">FOLLOWERS</span>--}}
{{--                                    </div>--}}
{{--                                    <!-- /.description-block -->--}}
{{--                                </div>--}}
{{--                                <!-- /.col -->--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="description-block">--}}
{{--                                        <h5 class="description-header">35</h5>--}}
{{--                                        <span class="description-text">PRODUCTS</span>--}}
{{--                                    </div>--}}
{{--                                    <!-- /.description-block -->--}}
{{--                                </div>--}}
{{--                                <!-- /.col -->--}}
{{--                            </div>--}}
{{--                            <!-- /.row -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


            <!-- Date and Time -->
            <div class="row">
                <div class="col-12">

{{--                    <div class="info-box bg-warning">--}}
{{--                        <div class="info-box-content">--}}
{{--                            <span class="info-box-text">{{ __('lang.' . strtoupper('Today Date') }}<span class="float-right" id="clock"></span></span>--}}
{{--                            <script language="JavaScript">--}}

{{--                                var myVar = setInterval(showTheTime, 1000);--}}

{{--                                function showTheHours(theHour) {--}}
{{--                                    if (theHour > 0 && theHour < 13) {--}}
{{--                                        if (theHour == "0") theHour = 12;--}}
{{--                                        return (theHour);--}}
{{--                                    }--}}
{{--                                    if (theHour == 0) {--}}
{{--                                        return (12);--}}
{{--                                    }--}}
{{--                                    return (theHour-12);--}}
{{--                                }--}}
{{--                                function showZeroFilled(inValue) {--}}
{{--                                    if (inValue > 9) {--}}
{{--                                        return "" + inValue;--}}
{{--                                    }--}}
{{--                                    return "0" + inValue;--}}
{{--                                }--}}
{{--                                function showTheTime() {--}}
{{--                                    now = new Date(<?php date('Y-m-d H:i:s') ?>);--}}

{{--                                    document.getElementById("clock").innerHTML = showTheHours(now.getHours()) + ":" + showZeroFilled(now.getMinutes()) + ":" + showZeroFilled(now.getSeconds())--}}
{{--                                    // setTimeout("showTheTime()",1000)--}}
{{--                                }--}}

{{--                            </script>--}}

{{--                            <div class="progress"><div class="progress-bar"></div></div>--}}
{{--                            <div class="gregorian-date-box">--}}
{{--                                <div class="gregorian-date">{{ date('l') }}</div>--}}
{{--                                <div class="gregorian-date">{{ date('Y d F') }}</div>--}}
{{--                            </div>--}}

{{--                            <div class="progress"><div class="progress-bar"></div></div>--}}
{{--                            <span class="progress-description">{{ jdate()->format('l - d F Y') }}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
            <!-- ./Date and Time -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <!-- Dashboard Menu -->
                    <li class="nav-item {{ $route == 'console' ? 'active' : '' }}">
                        <a href="{{ route('admin.console') }}" class="nav-link {{ $route == 'console' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>{{ __('lang.' . strtoupper('console')) }}</p>
                        </a>
                    </li>

                    <!-- Shipments Menu -->
                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments'))
                    <li class="nav-item has-treeview {{ $route == 'shipments' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $route == 'shipments' ? 'active' : '' }}">
                            <i class="nav-icon fa fa-rotate-310 fa-exchange-alt"></i>
                            <p>{{ __('lang.' . strtoupper('shipments')) }}
                                <i class="right fas fa-angle-left"></i>
                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                            </p>
                        </a>

{{--                        'shipments/list/{inter_domest?}/{import_export?}/{air_train?}/{cargo_express?}'--}}
                        <ul class="nav nav-treeview">
                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.all'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.shipments.index') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                        <i class="nav-icon fa fa-rotate-310 fa-exchange-alt"></i>
                                        <p>{{ __('lang.' . strtoupper('all_shipments')) }}
{{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international'))
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-globe"></i>
                                    <p>{{ __('lang.' . strtoupper('international_shipments')) }}
                                        <i class="right fas fa-angle-left"></i>
                                        {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.all'))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.shipments.custom_index', 'international') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-globe-americas"></i>
                                                <p>{{ __('lang.' . strtoupper('all_international_shipments')) }}
                                                    {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                </p>
                                            </a>
                                        </li>
                                    @endif

                                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import'))
                                        <li class="nav-item">
                                            <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-rotate-310 fa-arrow-left text-success"></i>
                                                <p>{{ __('lang.' . strtoupper('international_import_shipments')) }}
                                                    <i class="right fas fa-angle-left"></i>
                                                    {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                </p>
                                            </a>

                                            <ul class="nav nav-treeview">
                                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international_import.all'))
                                                    <li class="nav-item">
                                                        <a href="{{ route('admin.shipments.custom_index', 'international/import') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                            <i class="nav-icon far fa-circle text-success text-success"></i>
                                                            <p>{{ __('lang.' . strtoupper('all_international_import_shipments')) }}
                                                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.air'))
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                            <i class="nav-icon fas fa-plane text-success"></i>
                                                            <p>{{ __('lang.' . strtoupper('international_import_air_shipments')) }}
                                                                <i class="right fas fa-angle-left"></i>
                                                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                            </p>
                                                        </a>

                                                        <ul class="nav nav-treeview">
                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.air.all'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/import/air') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon far fa-circle text-success"></i>
                                                                        <p>{{ __('lang.' . strtoupper('all_international_import_air_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.air.cargo'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/import/air/cargo') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fa fa-rocket text-success"></i>
                                                                        <p>{{ __('lang.' . strtoupper('international_import_air_cargo_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif

                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.air.express'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/import/air/express') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fa fa-space-shuttle text-success"></i>
                                                                        <p>{{ __('lang.' . strtoupper('international_import_air_express_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>

                                                    </li>
                                                @endif

                                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.transit'))
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                            <i class="nav-icon fa fa-road text-success"></i>
                                                            <p>{{ __('lang.' . strtoupper('international_import_transit_shipments')) }}
                                                                <i class="right fas fa-angle-left"></i>
                                                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                            </p>
                                                        </a>

                                                        <ul class="nav nav-treeview">
                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.transit.all'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/import/transit') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fa fa-road text-success"></i>
                                                                        <p>{{ __('lang.' . strtoupper('all_international_import_transit_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.transit.road'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/import/transit/road') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fa fa-truck text-success"></i>
                                                                        <p>{{ __('lang.' . strtoupper('international_import_transit_road_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif

                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.transit.rail'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/import/transit/rail') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fas fa-train text-success"></i>
                                                                        <p>{{ __('lang.' . strtoupper('international_import_transit_rail_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>

                                                    </li>
                                                @endif

                                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.import.shipping'))
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                            <i class="nav-icon fas fa-ship text-success"></i>
                                                            <p>{{ __('lang.' . strtoupper('international_import_shipping_shipments')) }}
                                                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endif



                                            </ul>

                                        </li>
                                    @endif


                                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export'))
                                        <li class="nav-item">
                                            <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-rotate-310 fa-arrow-right text-danger"></i>
                                                <p>{{ __('lang.' . strtoupper('international_export_shipments')) }}
                                                    <i class="right fas fa-angle-left"></i>
                                                    {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                </p>
                                            </a>

                                            <ul class="nav nav-treeview">
                                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.all'))
                                                    <li class="nav-item">
                                                        <a href="{{ route('admin.shipments.custom_index', 'international/export') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                            <i class="nav-icon far fa-circle text-danger text-danger"></i>
                                                            <p>{{ __('lang.' . strtoupper('all_international_export_shipments')) }}
                                                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.air'))
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                            <i class="nav-icon fas fa-plane text-danger"></i>
                                                            <p>{{ __('lang.' . strtoupper('international_export_air_shipments')) }}
                                                                <i class="right fas fa-angle-left"></i>
                                                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                            </p>
                                                        </a>

                                                        <ul class="nav nav-treeview">
                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.air.all'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/export/air') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon far fa-circle text-danger"></i>
                                                                        <p>{{ __('lang.' . strtoupper('all_international_export_air_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.air.cargo'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/export/air/cargo') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fa fa-rocket text-danger"></i>
                                                                        <p>{{ __('lang.' . strtoupper('international_export_air_cargo_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif

                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.air.express'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/export/air/express') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fa fa-space-shuttle text-danger"></i>
                                                                        <p>{{ __('lang.' . strtoupper('international_export_air_express_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>

                                                    </li>
                                                @endif

                                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.transit'))
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                            <i class="nav-icon fa fa-road text-danger"></i>
                                                            <p>{{ __('lang.' . strtoupper('international_export_transit_shipments')) }}
                                                                <i class="right fas fa-angle-left"></i>
                                                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                            </p>
                                                        </a>

                                                        <ul class="nav nav-treeview">
                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.transit.all'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/export/transit') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fa fa-road text-danger"></i>
                                                                        <p>{{ __('lang.' . strtoupper('all_international_export_transit_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.transit.road'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/export/transit/road') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fa fa-truck text-danger"></i>
                                                                        <p>{{ __('lang.' . strtoupper('international_export_transit_road_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif

                                                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.transit.rail'))
                                                                <li class="nav-item">
                                                                    <a href="{{ route('admin.shipments.custom_index', 'international/export/transit/rail') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                                        <i class="nav-icon fas fa-train text-danger"></i>
                                                                        <p>{{ __('lang.' . strtoupper('international_export_transit_rail_shipments')) }}
                                                                            {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                                        </p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>

                                                    </li>
                                                @endif

                                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index.international.export.shipping'))
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">
                                                            <i class="nav-icon fas fa-ship text-danger"></i>
                                                            <p>{{ __('lang.' . strtoupper('international_import_shipping_shipments')) }}
                                                                {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endif



                                            </ul>

                                        </li>
                                    @endif

                                </ul>
                            </li>
                            @endif

                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.create'))
                                <li class="nav-item">
                                    <a href="{{ Route('admin.shipments.create') }}" class="nav-link {{ $route == 'shipments' && $action == 'create' ? 'active' : '' }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('lang.' . strtoupper('CREATE_SHIPMENT')) }}</p>
                                    </a>
                                </li>
                            @endif

{{--                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('shipments.index'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('admin.shipments.index') }}" class="nav-link {{ $route == 'shipments' && $action == 'index' ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon far fa-circle"></i>--}}
{{--                                    <p>{{ __('lang.' . strtoupper('ALL_SHIPMENTS')) }}--}}
{{--                                        {{--                                            <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('index') }}</span>--}}--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ Route('admin.shipments.export') }}" class="nav-link {{ $route == 'shipments' && $action == 'export' ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon far fa-circle"></i>--}}
{{--                                    <p>{{ __('lang.' . strtoupper('Export')) }}--}}
{{--                                        <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('export') }}</span>--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ Route('admin.shipments.import') }}" class="nav-link {{ $route == 'shipments' && $action == 'import' ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon far fa-circle"></i>--}}
{{--                                    <p>{{ __('lang.' . strtoupper('export')) }}--}}
{{--                                        <span class="badge badge-danger right ">{{ RequireFunction::requestStatusCount('import') }}</span>--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @endif--}}




                        </ul>
                    </li>
                    @endif

                    <!-- Agents Menu -->
                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('agents'))
                    <li class="nav-item has-treeview {{ $route == 'agents' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $route == 'agents' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>{{ __('lang.' . strtoupper('Agents')) }}<i class="fas fa-angle-left right"></i>
                                {{--                                <span class="badge badge-info right">6</span>--}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('agents.index'))
                            <li class="nav-item">
                                <a href="{{ Route('admin.agents.index') }}" class="nav-link {{ $route == 'agents' && $action == 'index' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('lang.' . strtoupper('ALL_AGENTS')) }}</p>
                                </a>
                            </li>
                            @endif
                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('agents.create'))
                            <li class="nav-item">
                                <a href="{{ Route('admin.agents.create') }}" class="nav-link {{ $route == 'agents' && $action == 'create' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('lang.' . strtoupper('CREATE_AGENT')) }}</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    <!-- Staff Menu -->
                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('staffs'))
                    <li class="nav-item has-treeview {{ ($route == 'staffs' or $route == 'staff') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ ($route == 'staffs' or $route == 'staff') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>{{ __('lang.' . strtoupper('staffs')) }}<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('staffs.index'))
                            <li class="nav-item">
                                <a href="{{ Route('admin.staffs.index') }}" class="nav-link {{ $route == 'staffs' && $action == 'index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>{{ __('lang.' . strtoupper('all_staffs')) }}</p>
                                </a>
                            </li>
                            @endif

                            @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('staffs.create'))
                            <li class="nav-item">
                                <a href="{{ Route('admin.staffs.create') }}" class="nav-link {{ $route == 'staffs' && $action == 'create' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>{{ __('lang.' . strtoupper('create_staff')) }}</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif


                    <!-- Users Menu -->
                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('users'))
                        <li class="nav-item has-treeview {{ ($route == 'users' or $route == 'user') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ ($route == 'users' or $route == 'user') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>{{ __('lang.' . strtoupper('Users')) }}<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('users.index'))
                                    <li class="nav-item">
                                        <a href="{{ Route('admin.users.index') }}" class="nav-link {{ $route == 'users' && $action == 'index' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-users"></i>
                                            <p>{{ __('lang.' . strtoupper('all_users')) }}</p>
                                        </a>
                                    </li>
                                @endif
{{--                                --}}
{{--                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('users.index.employees'))--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="{{ Route('admin.user', 'employees') }}" class="nav-link {{ ($route == 'users' or $route == 'user') && $action == 'employees' ? 'active' : '' }}">--}}
{{--                                            <i class="nav-icon fas fa-users"></i>--}}
{{--                                            <p>{{ __('lang.' . strtoupper('ALL_EMPLOYEES')) }}</p>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
{{--                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('users.index.customers'))--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="{{ Route('admin.user', 'customers') }}" class="nav-link {{ ($route == 'users' or $route == 'user') && $action == 'customers' ? 'active' : '' }}">--}}
{{--                                            <i class="nav-icon fas fa-users"></i>--}}
{{--                                            <p>{{ __('lang.' . strtoupper('ALL_CUSTOMERS')) }}</p>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
{{--                                --}}
                                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('users.create'))
                                    <li class="nav-item">
                                        <a href="{{ Route('admin.users.create') }}" class="nav-link {{ $route == 'users' && $action == 'create' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-user-plus"></i>
                                            <p>{{ __('lang.' . strtoupper('CREATE_USER')) }}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif



                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasAnyDirectPermission(['countries', 'events']))
                    <li class="nav-header">{{ __('lang.' . strtoupper('SITE_SETTING')) }}</li>
                    @endif

                    <!-- Countries Menu -->
                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('countries'))
                        <li class="nav-item has-treeview {{ $route == 'countries' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $route == 'countries' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>{{ __('lang.' . strtoupper('Countries')) }}<i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('countries.index'))
                                    <li class="nav-item">
                                        <a href="{{ Route('admin.countries.index') }}" class="nav-link {{ $route == 'countries' && $action == 'index' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('lang.' . strtoupper('ALL_COUNTRIES')) }}</p>
                                        </a>
                                    </li>
                                @endif
                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('countries.create'))
                                    <li class="nav-item">
                                        <a href="{{ Route('admin.countries.create') }}" class="nav-link {{ $route == 'countries' && $action == 'create' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ __('lang.' . strtoupper('CREATE_COUNTRY')) }}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <!-- Events Menu -->
                    @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('events'))
                        <li class="nav-item has-treeview {{ $route == 'events' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $route == 'events' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>{{ __('lang.' . strtoupper('Events')) }}<i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('events.index'))
                                <li class="nav-item">
                                    <a href="{{ Route('admin.events.index') }}" class="nav-link {{ $route == 'events' && $action == 'index' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('lang.' . strtoupper('ALL_EVENTS')) }}</p>
                                    </a>
                                </li>
                                @endif
                                @if($_auth->hasAnyRole('Super User', 'Management') or $_auth->hasPermissionTo('events.create'))
                                <li class="nav-item">
                                    <a href="{{ Route('admin.events.create') }}" class="nav-link {{ $route == 'events' && $action == 'create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('lang.' . strtoupper('CREATE_EVENT')) }}</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    @endif




                    @if($_auth->hasAnyRole('Super User') or $_auth->hasAnyDirectPermission(['roles', 'permissions', 'settings']))
                    <li class="nav-header">{{ __('lang.' . strtoupper('ACCESS_LEVEL')) }}</li>
                    @endif

                    <!-- Roles Menu -->
                    @if($_auth->hasAnyRole('Super User') or $_auth->hasPermissionTo('roles'))
{{--                    @if($_auth->hasAnyRole('Super User'))--}}
                        <li class="nav-item has-treeview {{ $route == 'roles' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $route == 'roles' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>{{ __('lang.' . strtoupper('Roles')) }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if($_auth->hasAnyRole('Super User') or $_auth->hasPermissionTo('roles.index'))
                                    <li class="nav-item">
                                        <a href="{{ Route('admin.roles.index') }}" class="nav-link {{ $route == 'roles' && $action == 'index' ? 'active' : '' }}">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>{{ __('lang.' . strtoupper('ALL_ROLES')) }}</p>
                                        </a>
                                    </li>
                                @endif
                                @if($_auth->hasAnyRole('Super User') or $_auth->hasPermissionTo('roles.create'))
                                    <li class="nav-item">
                                        <a href="{{ Route('admin.roles.create') }}" class="nav-link {{ $route == 'roles' && $action == 'create' ? 'active' : '' }}">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>{{ __('lang.' . strtoupper('CREATE_ROLE')) }}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <!-- Permissions Menu -->
                    @if($_auth->hasAnyRole('Super User') or $_auth->hasPermissionTo('permissions'))
                        <li class="nav-item has-treeview {{ $route == 'permissions' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $route == 'permissions' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>{{ __('lang.' . strtoupper('permissions')) }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if($_auth->hasAnyRole('Super User') or $_auth->hasPermissionTo('permissions.index'))
                                    <li class="nav-item">
                                        <a href="{{ Route('admin.permissions.index') }}" class="nav-link {{ $route == 'permissions' && $action == 'index' ? 'active' : '' }}">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>{{ __('lang.' . strtoupper('ALL_PERMISSIONS')) }}</p>
                                        </a>
                                    </li>
                                @endif
                                @if($_auth->hasAnyRole('Super User') or $_auth->hasPermissionTo('permissions.create'))
                                    <li class="nav-item">
                                        <a href="{{ Route('admin.permissions.create') }}" class="nav-link {{ $route == 'permissions' && $action == 'create' ? 'active' : '' }}">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>{{ __('lang.' . strtoupper('CREATE_PERMISSION')) }}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <!-- Settings Menu -->
                    @if($_auth->hasAnyRole('Super User') or $_auth->hasPermissionTo('settings'))
                        <li class="nav-item {{ $route == 'settings' ? 'active' : '' }}">
                            <a href="{{ Route('admin.settings.edit') }}" class="nav-link {{ $route == 'settings' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>{{ __('lang.' . strtoupper('Settings')) }}</p>
                            </a>
                        </li>
                    @endif
                </ul>
                <br><br>
            </nav>

            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
{{--                        <h1 class="m-0 text-dark">{{ __('lang.' . strtoupper($route . ($action != '' ? '.'.$action : ''))) }}</h1>--}}
{{--                        <h1 class="m-0 text-dark">{{ __('lang.' . $route) }}</h1>--}}
                    </div><!-- /.col -->
{{--                    <div class="col-sm-6">--}}
{{--                        <ol class="breadcrumb float-sm-right">--}}
{{--                            <li class="breadcrumb-item"><a href="{{ route($route . ($action != '' ? '.'.$action : '')) }}">{{ __('lang.' . strtoupper($route) }}</a></li>--}}
{{--                            <li class="breadcrumb-item active">{{ __('lang.' . strtoupper($action) }}</li>--}}
{{--                        </ol>--}}
{{--                    </div><!-- /.col -->--}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        @yield('content')

        <div class="row">
            <div class="col-12">
                <br><br><br>
                <br><br><br>
            </div>
        </div>

        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <!-- /.content-wrapper -->

    @yield('modal')



    <footer class="main-footer no-print">

        <div class="row">
            <div class="col-6">

                <div class="d-sm-inline-block">
                    @if(app()->getLocale() == 'en')
                        <span>{{ jdate()->toCarbon()->format('Y') }} - {{ jdate()->toCarbon()->addYears(5)->format('Y') }} &copy;</span>
                    @else
                        <span>{{ jdate()->getYear() }} - {{ jdate()->addYears(5)->getYear() }} &copy;</span>
                    @endif
                    <strong>{!! __('lang.' . strtoupper('COPYRIGHT_STATEMENT')) !!}</strong>
                </div>
            </div>

            <div class="col-6">
                <div class="d-sm-inline-block float-right">
                    <strong>{{ __('lang.' . strtoupper('ONLINE_INTERNATIONAL_TRANSPORTATION_SYSTEM')) }} , </strong>
                    <span><a href="{{ Route('versions') }}">{{ $_siteSettings['version'] }}</a></span>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- ./wrapper -->



<!-- Bootstrap 4 rtl -->
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-rtl.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- ChartJS -->
<script type="text/javascript" src="{{ asset('assets/js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script type="text/javascript" src="{{ asset('assets/js/sparkline.js') }}"></script>
<!-- JQVMap -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.vmap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.vmap.world.js') }}"></script>
<!-- jQuery Knob Chart -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script type="text/javascript" src="{{ asset('assets/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script type="text/javascript" src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{ asset('assets/js/adminlte.min.js') }}"></script>


<!-- dataTables -->
<script type="text/javascript" src="{{ asset('assets/js/datatables.min.js') }}"></script>
<!-- select2 -->
<script type="text/javascript" src="{{ asset('assets/js/select2.full.min.js') }}"></script>
<!-- Toastr -->
<script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script>
<!-- TreeView Js -->
<script type="text/javascript" src="{{ asset('assets/js/tree.min.js') }}"></script>


<!-- Custom js for Backend -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.ajax.queue.coffee') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.ajax.queue.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/backend-custom.js') }}"></script>




<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ asset('assets/js/dashboard.js') }}"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="{{ asset('assets/js/demo.js') }}"></script>--}}

    <script type="text/javascript">
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-<?php echo $_auth->default_language == 'en' ? 'right' : 'left' ?>",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        var info = "<?php echo $_auth->default_language == 'en' ? Session::get('info') : __('lang.' . strtoupper('' . Session::get('info'))); ?>";
        var success = "<?php echo $_auth->default_language == 'en' ? Session::get('success') : __('lang.' . strtoupper('' . Session::get('success'))); ?>";
        var warning = "<?php echo $_auth->default_language == 'en' ? Session::get('warning') : __('lang.' . strtoupper('' . Session::get('warning'))); ?>";
        var error = "<?php echo $_auth->default_language == 'en' ? Session::get('error') : __('lang.' . strtoupper('' . Session::get('error'))); ?>";
{{--        var error = "{{ trans('lang.'.Session::get('error')) }}";--}}

        @if (Session::get('info'))
        toastr.info(info);
        @elseif (Session::get('success'))
        toastr.success(success);
        @elseif (Session::get('warning'))
        toastr.warning(warning);
        @elseif (Session::get('error'))
        toastr.error(error);//.css("width","auto");
        @endif
    </script>

    @yield('script')
</body>
</html>
