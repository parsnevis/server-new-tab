<!DOCTYPE html>
<?php
use \App\Models\Setting;
$site_name_en = (!empty(Setting::where('setting_name', 'site_name_en')->first()) && Setting::where('setting_name', 'site_name_en')->first() != null) ? Setting::where('setting_name', 'site_name_en')->first()->setting_value : config('site_setting.project_name');
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/fontawesome.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/ionicons.min.css') }}">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/adminlte.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/fonts.min.css') }}">

    @if(app()->getLocale() == 'fa' || app()->getLocale() == 'ar')
    <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/bootstrap-rtl.min.css') }}">
    <!-- Custom fonts for RTL -->
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/fonts-persian.css') }}">
    @endif


</head>

<body class="hold-transition login-page">

<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/') }}"><b>{{ $site_name_en }}</b></a>
    </div>

    @yield('content')
</div>

<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
