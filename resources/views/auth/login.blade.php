@extends('layouts.app')
@section('title','Login')
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

                <h2 class="page-title">Login</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    <li><span>Login </span></li>
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
                            <h2 class="h-title dark-clr mw-100">Login</h2>
                            <span>Please enter your login info to continue</span>
                        </div>

                        <div class="login_form_rm">
                        {{-- <form class="login_form" method="POST" id="SigninForm" action="{{ route('login') }}"> --}}
                        <form class="login_form" method="POST" id="SigninForm" action="{{ route('user-login') }}">
                            @csrf
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Mobile number </label>
                                            <input type="text" class="rm_form_fild" placeholder="Enter your Email / Mobile number here" id="email" name="email">
                                        </div>
                                    </div>
                                    

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>password</label>
                                                <input type="password" class="rm_form_fild" id="password-field" placeholder="***************"  id="password" name="password">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12  my-3">
                                        <div class="g-recaptcha"  data-callback="recaptchaVerified" data-sitekey={{getenv('GOOGLE_RECAPTCH_SITE_KEY')}}></div>
                                        <div  id="g-rec-err">

                                        </div>
                                    </div>
                                   

                                    <div class="rmm01 mm01">
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="checkiz">
                                            <label for="checkiz">
                                                <span class="check"></span>
                                                <span class="box"></span>
                                                Remember me
                                            </label>
                                        </div>
                                    </div>

                                    <div class="rmm02">
                                        <a href="{{route('user.password.request')}}">Forgot Password?</a>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="submit_rm" id="submit">Login</button>
                                    </div>

                                    <div class="col-lg-12 donnt_account">
                                        <div class="form-group">
                                            Don't have an Account? <a href="{{route('register')}}" class="link_rm">Register
                                                Now</a>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12 donnt_account">
                                        <div class="form-group">
                                            Please <a href="{{route('nominee.executor.login')}}" class="link_rm"> click here </a>
                                                if you are a nominee/executor.
                                        </div>
                                    </div> --}}

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
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    $(document).ready(function(){
      $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    });
    </script>
    
<script type="text/javascript">

   

    $(document).ready(function(){
        $('#SigninForm').validate({
            rules: {
                email: { required: true},
                password: { required: true},
                "g-recaptcha-response":{required:true}
            },
            messages: {
             email:{
                email: 'Please enter a valid email address'
            }
         },

            submitHandler:function(form){
                if($('#g-recaptcha-response').val() == "") {
                    $("#g-rec-err").html('<span class="text-danger">Re-Captcha is required</span>')
                } else {
                    form.submit();
                }
               
            },
        });
    });
</script>
<script>
    function recaptchaVerified(){
        $("#g-rec-err").html('')
    }
</script>
@endsection
