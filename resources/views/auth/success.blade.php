@extends('layouts.app')
@section('title','Success')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<section class="pager-section login_bg overlay banner_small_rm">
    <div class="container">
        <div class="main-banner-content p-relative">
            @include('includes.social_links')
            <!--social-links end-->
            <div class="pager-content">

                <h2 class="page-title">Success</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    <li><span>Success </span></li>
                </ul>
                <!--breadcrumb end-->
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--pager-section end-->
<section class="block2 section_padding suc-bg">
    <div class="container">
        <div class="contact_section">
            <div class="row align-items-center" style="width:fit-content; margin: 0 auto;">
                <div class="col-lg-12">
                    <div class="parent-divddd">
                        <div class="mesg-cls">
                            <span class="img-span"><img src="{{asset('public/images/success.png')}}"
                                    alt="success"></span>
                            <h2 class="thankyou">Success !</h2>
                            @if(Session::has('success'))
                            <div class="alert alert-success new-alerts w-100" role="alert">
                                <p style="">{{ session('success') }}</p>
                            </div>
                            @endif
                            @if($message = Session::get('purchase_success'))
                                <div class="alert alert-success new-alerts w-100" role="alert">
                                    <p>{{ $message }}</p>
                                </div>
                                {{ Session::forget('purchase_success') }}
                            @endif

                            @if(@$will)
                            <div class="col-lg-12">
                                <div class="signer ">
                                <p class="aflog_mssg">
                                    {{-- @if(@$will->package_id == 1) --}}
                                    <a href="{{route('introduction',[@$will->will_master_id])}}" class="sign-up-btn customer-signup-btn " style="display: inline-block;text-transform:unset;">Click here</a>
                                    {{-- @else
                                    <a href="{{route('user.add.beneficiaries',[@$will->will_master_id])}}" class="sign-up-btn customer-signup-btn " style="display: inline-block;text-transform:unset;">Click here</a> --}}
                                    {{-- @endif --}}
                                        for {{@$will->packageDetail->package_name}}<br>
                                        Or do this at your convenience from your <a href="{{ route('user.dashboard') }}" style="text-transform:unset; display:inline-block; font-size:15px;">Dashboard </a>

                                     {{-- to start {{@$will->packageDetail->package_name}}<br>
                                     or you can create will later from My Packages > @if(@$will->package_id == 1)
                                    Start will
                                    @else
                                     Add Authorized Person
                                    @endif --}}
                                </p>
                                </div>
                                {{--<p class="aflog_mssg">or you can create will later from <br> My Packages > @if(@$will->package_id == 1)
                                    Start will
                                    @else
                                     Add Authorized Person
                                    @endif</p>--}}
                            </div>
                            @endif

                            @guest
                            <div class="col-lg-12">
                                <div class="signer ">
                                    <a href="{{ route('login') }}"
                                        class="sign-up-btn customer-signup-btn success_login ">Go to Login</a>
                                </div>
                            </div>
                            @endguest

                            {{-- @auth
                            <div class="col-lg-12">
                                <div class="signer ">
                                    <a href="{{ route('user.dashboard') }}"
                                        class="sign-up-btn customer-signup-btn success_login ">Go to Dashboard</a>
                                </div>
                            </div>
                            @endauth --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
