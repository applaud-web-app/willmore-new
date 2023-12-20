@extends('layouts.app')
@section('title','User|Forgot Password')
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

                <h2 class="page-title">Forgot Password</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    <li><span>Forgot Password </span></li>
                </ul>
                <!--breadcrumb end-->
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--pager-section end-->
<section class="block2 section_padding">
    <div class="container">
        <div class="contact_section">
            <div class="row align-items-center">

                <div class="col-lg-12">
                    <div class="cnst-form login_rm02">

                    @include('includes.message')
                        <div class="section-title">
                            <h2 class="h-title dark-clr mw-100 forgott_001">Forgot Password?</h2>
                            <span>Not to worry. Just enter your email address below and we'll send you an instruction
                                email for recovery.</span>
                        </div>

                        <div class="login_form_rm">
                        <form  method="POST" action="{{ route('user.password.email') }}" class="login_form" id="register-form">
                            @csrf
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input id="email" type="email" class="rm_form_fild" placeholder="Enter your Email addres here" name="email" value="{{ old('email') }}" autocomplete="email">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="submit_rm save_btn" id="submit">Submit</button>
                                    </div>

                                    <div class="col-lg-12 donnt_account">
                                        <div class="form-group">
                                            Remember your password? <a href="{{route('login')}}" class="link_rm ">Login</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--cnst-form end-->
                </div>
            </div>
        </div>
        <!--contact_section end-->
    </div>
</section>

@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
<script src="{{asset('public/js/jquery.validate.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    validator = $('.login_form').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        submitHandler: function(form) {
            $(".save_btn").prop('disabled', true);
            form.submit();
        },
    });
});
</script>

@endsection