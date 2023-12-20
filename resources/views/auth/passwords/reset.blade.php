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

                <h2 class="page-title">Reset Password</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    <li><span>Reset Password </span></li>
                </ul>
                <!--breadcrumb end-->
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<section class="block2 section_padding">
    <div class="container">
        <div class="contact_section">
            <div class="row align-items-center">

                <div class="col-lg-12">
                    <div class="cnst-form login_rm02">

                    @include('includes.message')
                        <div class="section-title">
                            <h2 class="h-title dark-clr mw-100 forgott_001">Reset Password</h2>
                        </div>

                        <div class="login_form_rm">
                        <form  method="POST" action="{{ route('user.password.update') }}" class="login_form" id="Reset">
                            @csrf
                            <input type="hidden" name="id" value="{{Request::segment(3)}}">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input id="email" type="email" placeholder="Email" class="rm_form_fild" name="email" value="{{$email}}" autocomplete="email" readonly="">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                        <label>Enter Your New Password</label>
                                        <input type="password" id="password-field" placeholder="" class="rm_form_fild" name="password">
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        
                                        <span class="password_error error"></span>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                          <label>Confirm Password</label>
                                          <input type="password" id="password-field1" placeholder="" class="rm_form_fild" name="password_confirmation">
                                        <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="submit_rm" id="submit">Submit</button>
                                    </div>

                                    <div class="col-lg-12 donnt_account">
                                        <div class="form-group">
                                            Remember your password? <a href="{{route('login')}}" class="link_rm">Login</a>
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
  <script src="{{asset('public/admin/js/jquery.validate.js')}}"></script> 
  <script type="text/javascript">
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
    $(document).ready(function() {
       $('#password').change(function(){
         var password = $(this).val();
          var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[A-Z])(?=.*[@#$%&?!*]).*$/;
          if(pattern.test(password)){
            $('.password_error').html(''); 
              return true;
          }else{
            $('.password_error').html('Password minimum 8 character, at least one capital letter, one number, one special character from these (@ # $ % & ? ! * )');
              $('.password_error').css('display','block');
              $(this).val('');
              return false;
          }
      
      });
    });
  </script>

   <script type="text/javascript">
        $(document).ready(function(){
            validator = $('#Reset').validate({
                rules:{
                // password: { required: true},
                password_confirmation : {equalTo : "#password-field"}
               },
                 messages: {
                     password_confirmation:{
                        equalTo: 'Passwords did not match'
                     }
                 },
               submitHandler:function(form){
                   form.submit();
                },
            });
        });
    </script>

    
 
@endsection