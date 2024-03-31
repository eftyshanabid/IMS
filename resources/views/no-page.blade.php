@extends('frontend::layouts.master')

@section('breadcrumb')
    <!-- breadcrumb start -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0">
                <li><a href="{{url('/')}}">Home</a></li>
                <li>
                    <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.4">
                            <path
                                d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                fill="#000"/>
                        </g>
                    </svg>
                </li>
                <li>404</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->
@endsection
@section('content')
    <div class="error-page mt-100">
        <div class="container">
            <div class="error-content text-center">
                <div class="error-img mx-auto">
                    <img src="{{asset('assets/img/error/error.png')}}" alt="error">
                </div>
                <p class="error-subtitle">Page Not Found</p>
                <a href="{{url('/')}}" class="btn-primary mt-4">BACK TO HOMEPAGE</a>
            </div>
        </div>
    </div>
@endsection

