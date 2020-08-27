<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/laravel-user/assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/laravel-user/assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/laravel-user/assets/fonts/flaticon/font/flaticon.css') }}">
    <link rel="shortcut icon" href="{{ asset('vendor/laravel-user/assets/img/favicon.ico') }}" type="image/x-icon" >
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/laravel-user/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('vendor/laravel-user/assets/css/skins/default.css') }}">
</head>
<body id="top">
<div class="page_loader"></div>
<div class="login-17">
    <div class="container">
        <div class="col-md-12 pad-0">
            <div class="row login-box-6">
                <div class="col-lg-5 col-md-12 col-sm-12 col-pad-0 bg-img align-self-center none-992">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('vendor/laravel-user/assets/img/logos/logo.png') }}" class="logo" alt="logo">
                    </a>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur 
                        adipisicing elit, sed do eiusmod 
                        tempor incididunt Lorem Ipsum
                    </p>
                    <a href="{{ route('home') }}" class="btn-outline">Saiba Mais</a>
                    <ul class="social-list clearfix">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-7 col-sm-12 col-pad-0 align-self-center">
                    <div class="login-inner-form">
                        <div class="details">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/laravel-user/assets/js/jquery-2.2.0.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-user/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-user/assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
