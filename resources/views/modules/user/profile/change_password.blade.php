@extends('layouts.app')
@section('title','Change Password')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<div class="inner_page_area dashboard_inner">
    <div class="container mb-5">
        <div class="row">

            <div class="col-lg-3 col-md-12 col-sm-12">
                @include('includes.sidebar')
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="cus-dashboard-right didlex">
                    <h2>Change Password</h2>
                </div>

                <div class="dash-right-inr">
                @include('includes.message')
                <form id="changePasswordForm" method="POST" action="{{ route('update.password') }}">
                          @csrf
                        <div class="row login_rm02 for_dashboard">

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" placeholder="**********" class="rm_form_fild" name="old_password" id="password-field">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" placeholder="**********" class="rm_form_fild" name="password" id="password-field1">
                                    <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>                                
                                <label class="password_error error"></label>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" id="password-field2" placeholder="**********" class="rm_form_fild" name="password_confirmation">
                                    <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-12 mb-4 mt-4">
                                <div class="doubleborder"></div>
                                <div class="doubleborder"></div>
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" class="submit_rm" id="submit">Change Password</button>
                            </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

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

<script>
    $(document).ready(function(){
      $('#changePasswordForm').validate({
        rules:{ 
            old_password:{required:true}, 
            password:{required:true}, 
            password_confirmation:{equalTo: "#password-field1"} 
        },
        messages: {
            password_confirmation:{
                equalTo: 'Password and Confirm Password must be same'
             }
         }
      });
    });
   </script>  
</script>
@endsection