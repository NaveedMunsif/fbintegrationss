<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        SEOLOGY
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">




    {{-- datatable css --}}
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">



    <script src="{{ asset('public/dist/js/tabler.js') }}" defer></script>



    <!-- Styles -->
    <link href="{{ asset('public/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/dist/css/demo.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style>
        .badge-success {
            color: #fff;
            background-color: #28a745 !important;
        }
        .navbar .navbar-nav .nav-link{
            color: white;
        }
    </style>
</head>
<body class="antialiased">
<div class="wrapper">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light d-print-none" style="background-color:#355e3b">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
{{--                {{ config('app.name', 'Laravel') }}--}}
                <img src="{{asset('/compnaylogo.jpeg')}}" alt="Image" width="110" height="32" class="navbar-brand-image"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                <span class="avatar avatar-sm">
                                       <img src="{{asset(auth()->user()->image_name ??'')}}">
                                </span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>{{ Auth::user()->name }}</div>
{{--                                    <div class="mt-1 small text-muted">UI Designer</div>--}}
                                </div>



                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{ route('admin_home') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('admin-home').submit();">
                                    {{ __('Main Home') }}
                                </a>
                                @endif
                                    <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <form id="admin-home" action="{{ route('home') }}" method="get" class="d-none">

                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar navbar-light" style="background-color:#355e3b">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin_home')}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                                <span class="nav-link-title">
                      Home
                    </span>
                            </a>
                        </li>

                        @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><circle cx="12" cy="12" r="9" /><line x1="15" y1="15" x2="18.35" y2="18.35" /><line x1="9" y1="15" x2="5.65" y2="18.35" /><line x1="5.65" y1="5.65" x2="9" y2="9" /><line x1="18.35" y1="5.65" x2="15" y2="9" /></svg>
                    </span>
                                <span class="nav-link-title">
                      User's Data
                    </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="nav-link" href="{{route('alluserlist')}}">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                    <!-- Download SVG icon from http://tabler-icons.io/i/help -->

                                    <span class="nav-link-title" style="text-align: left">
                                     All Users
                                    </span>
                                </a>
                                <a class="nav-link" href="{{route('deletedUserList')}}">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                    <!-- Download SVG icon from http://tabler-icons.io/i/help -->

                                    <span class="nav-link-title" style="text-align: left">
                                    Deleted User's
                                    </span>
                                </a>

                            </div>
                        </li>
                        @endif


                        <li class="nav-item">
                            <a class="nav-link" href="{{route('getnotes')}}">
                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                <!-- Download SVG icon from http://tabler-icons.io/i/help -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="17" x2="12" y2="17.01" /><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" /></svg>
                                <span class="nav-link-title ml-2">
                      Get the notes
                            </span>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
    <footer class="footer footer-transparent d-print-none">
        <div class="container">
            <div class="row text-center align-items-center flex-row-reverse">

                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                            Copyright &copy; 2023
                            <a href="." class="link-secondary">SEOLOGY</a>.
                            All rights reserved.
                        </li>
                        <li class="list-inline-item">
                            <a href="" class="link-secondary" rel="noopener">v1.0.0-beta3</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

{{-- datatable js --}}
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@stack('script')
    <script>
        $("body").on('click','.model-close',function(){
        // $(".model-close").click(function(){
            // remove expand class and add original mybtn class

            $('.modal-backdrop').remove();

        })
    </script>
</div>
</body>
</html>
