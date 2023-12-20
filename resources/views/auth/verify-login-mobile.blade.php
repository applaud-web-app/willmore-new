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
                            <h4 class="h-title dark-clr mw-100" style="font-size:18px;">Verify Mobile Number</h4>
                            <span>Enter OTP send to your mobile number</span>
                        </div>

                        <div class="login_form_rm">
                        <form class="login_form" method="POST" id="SigninForm" name="SigninForm" action="{{ route('verify-login-mobile') }}">
                            @csrf
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>OTP (One Time Password) </label>
                                            <input type="text" class="rm_form_fild" placeholder="Enter OTP" id="otp" name="otp">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <p id="error-message" class="text-danger"></p>
                                        <button type="button"  onclick="verify()" class="submit_rm" id="submit_btn">Continue</button>
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
<script src="{{asset('public/js/jquery.validate.js')}}"></script>
{{-- mobile_num --}}
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
    function setOtpToMobile(){
     var number = "{{$mobile_num}}";
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
                $.post('{{url("verify-login-mobile")}}',{'_token':'{{csrf_token()}}','code':code},function(data){
                    document.getElementById('SigninForm').submit();
                });
            }).catch(function (error) {
                $("#submit_btn").removeAttr('disabled').text('Verify OTP');
                $("#error-message").html(`please enter valid otp sent to your mobile number`);  
            });
        }
    }
</script>
    

<script type="text/javascript">
    $(document).ready(function(){
        $("#submit_btn").attr('disabled','disabled').text('Sending OTP. Please Wait...');
        $('#SigninForm').validate({
            rules: {
            otp:{required: true, number: true,}
            },
            submitHandler:function(form,e){
               e.preventDefault();
            },
        });
    });
</script>

@endsection
