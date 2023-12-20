@extends('layouts.app')
@section('title','OTP Verification')
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

                <h2 class="page-title">OTP Verification</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
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
            <div class="row align-items-center justify-content-center">



                <div class="col-lg-5">
                    <div class="cnst-form login_rm02 for_signup_sec">
                    @include('includes.message')
                        <div class="section-title">
                            <h2 class="h-title dark-clr mw-100" style="font-size: 30px;line-height: 30px;">Please enter the OTP sent on your mobile number to activate your account.</h2>
                        </div>

                        <div class="login_form_rm">
                            @guest
                            <form id="otpForm" name="otpForm" method="POST" action="{{ route('user.verify') }}">
                            @endguest
                            @auth
                                @if(@$page == 'Dash')
                                    <form id="otpForm" name="otpForm" method="POST" action="{{ route('verification.mobile.otp') }}">
                                @else
                                    <form id="otpForm" name="otpForm" method="POST" action="{{ route('verification.otp') }}">
                                @endif
                            @endauth
                            @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            {{-- <label>One Time Password - {{@$vcode}}</label> --}}
                                            <input type="hidden" name="user_id" class="rm_form_fild"
                                                placeholder="Enter here" value="{{@$userid}}">
                                            <input type="text" name="otp" class="rm_form_fild"
                                                placeholder="Enter here" value="{{old('otp')}}">
                                                @if($errors->has('otp'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('otp')}}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <p id="error-message" class="text-danger"></p>
                                        <button type="button" class="submit_rm" id="submit_btn" onclick="verify()">Verify OTP</button>
                                    </div>

                                </div>
                            </form>
                            <div id="recaptcha-container" class="mb-3"></div>
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
<script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: '{{config("services.firebase_otp.apiKey")}}',
        authDomain: '{{config("services.firebase_otp.authDomain")}}',
        databaseURL: '{{config("services.firebase_otp.databaseURL")}}',
        projectId: '{{config("services.firebase_otp.projectId")}}',
        storageBucket: '{{config("services.firebase_otp.storageBucket")}}',
        messagingSenderId: '{{config("services.firebase_otp.messagingSenderId")}}',
        appId: '{{config("services.firebase_otp.appId")}}'
    };
    firebase.initializeApp(firebaseConfig);
</script>
<script>
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'invisible',
    });
</script>

<script>
$(document).ready(function(){
    $("#submit_btn").attr('disabled','disabled').text('Sending OTP. Please Wait...');
    $(document).ready(function() {

       $("#otpForm").validate({
         rules: {
           otp:{required: true, number: true,}
         },
         messages: {
             otp:{
               remote: 'Please enter OTP'
            }
         },

        submitHandler:function(form,event){
            event.preventDefault();
            // form.submit();
         },

       });


    });
});

function setOtpToMobile(){
     var number = "{{$phone_number}}";
    firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        $('#submit_btn').removeAttr('disabled').text('Verify OTP');
    }).catch(function (error) {
        var err_msg = error.message;
        if(error.message=="TOO_SHORT"){
            err_msg = "OTP not sent..something went wrong";
        }
        $("#error-message").text(err_msg);
    });
}

setOtpToMobile();

</script>

<script>
    function verify() {
        var code = $("input[name=otp]").val();
        if(code!=""){
            $("#submit_btn").attr('disabled','disabled').text('Processing...');
            coderesult.confirm(code).then(function (result) {
                var user = result.user;
                document.getElementById('otpForm').submit();
            }).catch(function (error) {
                $("#submit_btn").removeAttr('disabled').text('Verify OTP');
                $("#error-message").html(`please enter valid otp sent to your mobile number`);  
            });
        }
    }
</script>


@endsection
