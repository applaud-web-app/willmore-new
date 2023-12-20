<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="{{ asset('public/images/logo_icon.png') }}" type="image/x-icon">
<title>Dignified Me :: User|Forgot Password</title>
    <!--style-->
    <link href="{{asset('public/css/style.css')}}" type="text/css" rel="stylesheet" media="all"/>
    <link href="{{asset('public/css/responsive.css')}}" type="text/css" rel="stylesheet" media="all"/>    
    <!--bootstrape-->
    <link href="{{asset('public/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet" media="all"/>
    <!--font-awesome-->
    <link href="{{asset('public/css/font-awesome.min.css')}}" type="text/css" rel="stylesheet" media="all"/>
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 

    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{asset('public/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/owl.theme.default.min.css')}}">
    
<script type="text/javascript" src="{{asset('public/js/jquery-3.2.1.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>   

<!-- Owl javascript -->
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/owl.carousel.js')}}"></script>  

 <style type="text/css">
  .error{
    color: red;
  }
</style>
 

<script>
$(document).ready(function(){
    $(".msg-close").click(function(){
        $(".header-msg").slideToggle();
    });
});
</script> 
    
 
</head>

<body>

  <section class="login_main">
       <div class="login_left">
         <div class="left_back_imgBox">
             <div class="login_logo">
                <a href="#"><img src="{{asset('public/images/logo1.png')}}"></a>
             </div>
             <div class="left_wayContent">
                <label><img src="{{asset('public/images/log1.png')}}"></label>
                <h3><span><img src="{{asset('public/images/log5.png')}}"></span>Smarter way to find projects or post jobs</h3>
                <p>Dignifiedme enables risk-free hiring and remote work culture. Join us to find exciting projects or hire your next vetted professionals.</p>
                <span>
                   <a href="#"><img src="{{asset('public/images/log2.png')}}"></a>
                </span>
             </div>
         </div>
      </div>
      <div class="login_right">
            <div class="login_right_container">
                <div class="login_right_content signup_step1 ex_mtb">
                    @include('includes.message')
                   <div class="icon_log">
                      <img src="{{asset('public/images/logo_icon.png')}}">
                      <h6>Join the Revolution</h6> 
                   </div>
                   <form  method="POST" action="{{ route('user.password.update') }}" class="login_form" id="Reset">
                    @csrf
                      <div class="row">
                        <input type="hidden" name="id" value="{{Request::segment(3)}}">
                        <div class="col-lg-12">
                            <div class="form_group">
                                <h6>Email</h6>
                                <input class="form-control form-control-lg required" id="email" type="email" placeholder="Email" value="{{$email}}" readonly>
                            </div> 
                         </div>
                         <div class="col-lg-12">
                            <div class="form_group">
                                <h6>Enter Your New Password</h6>
                                <input class="form-control form-control-lg required" id="password" type="password" placeholder="password" name="password">
                            </div> 
                         </div>

                         <div class="col-lg-12">
                            <div class="form_group">
                                <h6>Confirm Password</h6>
                                 <input class="form-control form-control-lg required" id="confirm_password" type="password" placeholder="confirm password" name="confirm_password">
                            </div> 
                         </div>
                         
                         <div class="col-lg-12">
                            <div class="form_group">
                               <input type="submit"  value="Password Rest" class="login_btn">
                            </div>
                         </div>
                      </div>
                   </form>
                   <!-- <p class="forgot-password"><a href="#">Forgot Password?</a></p> -->
                   <p class="signUptxt"> Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </div>
      </div>
  </section>
  <script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            validator = $('#Reset').validate({
                rules:{
                password: { required: true},
                confirm_password : {equalTo : "#password"}
               },
               submitHandler:function(form){
                   form.submit();
                },
            });
        });
    </script>

</body>
</html>