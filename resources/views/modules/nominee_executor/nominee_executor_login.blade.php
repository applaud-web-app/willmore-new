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

                        <h2 class="page-title">Nominee / Executor Login</h2>
                        <ul class="breadcrumb-list">
                            <li><a href="{{route('home')}}" title="">Home</a></li>
                            <li><span>Login</span></li>
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
                                    <h2 class="h-title dark-clr mw-100">Nominee / Executor Login</h2>
                                    <span>Please enter following info to validate</span>
                                </div>
                                @include('includes.message')
                                <div class="login_form_rm">
                                    <form id="nomExeForm" method="post" action="{{route('check.nominee_executor.login')}}">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Mobile Number / Email</label>
                                                    <input type="text" name="mobile" class="rm_form_fild" placeholder="Enter here" >
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Code</label>
                                                    <input type="text" name="code" class="rm_form_fild" placeholder="Enter here">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                                <button type="submit" class="submit_rm" id="submit">Submit</button>
                                                {{-- <a href="nominee_executor_otp_verification.html" class="submit_rm">Submit</a> --}}
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function(){
            $('#nomExeForm').validate({
                rules: {
                    mobile:{
                        required: true,
                        //maxlength: 10,
                    },
                    code:{
                        required: true,
                    },
                },
                messages:{
                    will_location:{
                        maxlength: 'Location no more than 250 characters',
                    },
                },
            });
        });
    </script>

@endsection
