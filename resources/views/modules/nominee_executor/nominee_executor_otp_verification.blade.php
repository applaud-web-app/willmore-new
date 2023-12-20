@extends('layouts.app')
@section('title','WillAndMore')
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
                    <div class="social-links">
                        <ul>
                            <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                        </ul>
                    </div><!--social-links end-->
                    <div class="pager-content">

                        <h2 class="page-title">OTP Verification</h2>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ route('nominee.executor.login')}}" title="">Login</a></li>
                            <li><span>OTP Verification</span></li>
                        </ul><!--breadcrumb end-->
                    </div><!--pager-content end-->
                </div><!--main-banner-content end-->
            </div>
        </section><!--pager-section end-->

        <section class="block2 section_padding">
            <div class="container">
                <div class="contact_section">
                    <div class="row align-items-center">



                        <div class="col-lg-12">
                            <div class="cnst-form login_rm02 ne_log">
                                <div class="section-title">
                                    <h2 class="h-title dark-clr mw-100">OTP Verification</h2>
                                    <span>Please enter OTP sent to your 
                                        @if(@$isEmail)
                                        email address @if(@$beneficiaries) {{$beneficiaries->email}} @elseif(@$executor) {{$executor->email}} @endif
                                        @else
                                            mobile number
                                            @if(@$beneficiaries) {{$beneficiaries->mobile}} @elseif(@$executor) {{$executor->mobile}} @endif
                                        @endif
                                        </span>
                                </div>
                                @include('includes.message')

                                <div class="login_form_rm">
                                    <form id="nomExeForm" method="post" action="{{route('nominee.executor.otp.verify')}}">
                                        @csrf
                                        <div class="row">
                                            @if(@$beneficiaries)
                                            <input type="hidden" name="ben_id" value="{{@$beneficiaries->id}}">
                                            @endif
                                            @if(@$executor)
                                            <input type="hidden" name="exe_id" value="{{@$executor->id}}">
                                            @endif
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Enter OTP @if(@$beneficiaries) {{$beneficiaries->pnonecode}} @elseif(@$executor) {{$executor->pnonecode}} @endif</label>
                                                    <input type="text" name="otp" class="rm_form_fild" placeholder="Enter here">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                                <button type="submit" class="submit_rm" id="submit">Submit</button>
                                                {{-- <a href="nominee_executor_upload_file.html" class="submit_rm">Submit</a> --}}
                                            </div>

                                            <div class="col-lg-12 donnt_account">
                                                <div class="form-group">
                                                    Did not received verification code yet
                                                        @if(@$beneficiaries)
                                                            <a href="{{route('nominee.executor.resend.otp',['otp'=> @$beneficiaries->pnonecode])}}" class="link_rm">
                                                        @elseif(@$executor)
                                                            <a href="{{route('nominee.executor.resend.otp',['otp'=> @$executor->pnonecode])}}" class="link_rm">
                                                        @endif
                                                    Resend Code</a>
                                                </div>
                                            </div>




                                        </div>
                                    </form>
                                </div>
                            </div><!--cnst-form end-->
                        </div>
                    </div>
                </div><!--contact_section end-->
            </div>
        </section>

@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
@endsection
