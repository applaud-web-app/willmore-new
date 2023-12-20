@extends('admin.layouts.app')
@section('title')
Dashboard
@endsection
@section('links')
@include('admin.includes.links')
@endsection
@section('headers')
@include('admin.includes.header')
@endsection
@section('sidebar')
@include('admin.includes.sidebar')
@endsection
@section('content')
<div class="content">
    <div class="container">
        <!-- Page-Title -->

        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Welcome to admin panel !</h4>

                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>

                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>

        <!-- Start Widget -->

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-users"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark">{{ @$totalUser }}</span>

                        Total Users
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-file-word-o"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark">{{ @$totalWC }}</span>

                        Wills Created
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-map-marker"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark">{{ @$totalLS }}</span>

                        Will location service
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-file-text-o"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark">{{ @$totalLOI }}</span>

                        Letter of Instructions
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-handshake-o"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark">{{ @$totalC }}</span>

                        Consultation
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-inr"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark"> {{@$totalSell}} </span>

                        Total Sell
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-shopping-cart"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark">956</span>

                        Total Sell
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-user"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark">5210</span>

                        New Users
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="fa fa-eye"></i></span>

                    <div class="mini-stat-info text-right text-dark">
                        <span class="counter text-dark">20544</span>

                        Unique Visitors
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- end row -->

    </div>
    <!-- container -->
</div>
@endsection
@section('footer')
@include('admin.includes.footer')
@endsection
@section('script')
@include('admin.includes.scripts')

@endsection
