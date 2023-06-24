@extends('layouts.main')
@section('content')
    <div class="px-3 text-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="card-deck mb-3 text-center">--}}
{{--                    <div class="card mb-4 box-shadow">--}}
{{--                        <div class="card-header">--}}
{{--                            <h4 class="my-0 font-weight-normal">Post</h4>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <a href="{{route('post.index')}}" class="btn btn-lg btn-block btn-outline-primary">Click</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="card-deck mb-3 text-center">--}}
{{--                    <div class="card mb-4 box-shadow">--}}
{{--                        <div class="card-header">--}}
{{--                            <h4 class="my-0 font-weight-normal">Profile</h4>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <a href="{{route('profile.index')}}" class="btn btn-lg btn-block btn-outline-primary">Click</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}




    <div class="wrapper">

        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Dashboard
                            </h2>
                        </div>
                        <!-- Page title actions -->

                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                            <span class="bg-cyan text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$engaged_users['day']['title']}}
                                                </div>
                                                <div class="text-muted">
                                                    {{$engaged_users['day']['value']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                            <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$engaged_users['week']['title']}}
                                                </div>
                                                <div class="text-muted">
                                                    {{$engaged_users['week']['value']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                            <span class="bg-purple text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$engaged_users['days_28']['title']}}
                                                </div>
                                                <div class="text-muted">
                                                    {{$engaged_users['days_28']['value']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                            <span class="bg-yellow text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$page_impressions['day']['title']}}
                                                </div>
                                                <div class="text-muted">
                                                    {{$page_impressions['day']['value']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                            <span class="bg-orange text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$page_impressions['week']['title']}}
                                                </div>
                                                <div class="text-muted">
                                                    {{$page_impressions['week']['value']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                            <span class="bg-red text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$page_impressions['days_28']['title']}}
                                                </div>
                                                <div class="text-muted">
                                                    {{$page_impressions['days_28']['value']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$page_fans['day']['title']}}
                                                </div>
                                                <div class="text-muted">
                                                    {{$page_fans['day']['value']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->


@endsection

