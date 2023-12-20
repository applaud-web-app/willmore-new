@extends('layouts.app')
@section('title')
{{ @$template->title }}
@endsection
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content') 






<!DOCTYPE html>
<html>
<head>
</head>
<body>
<section class="freelancer-body com_mtop">
<div class="container">
<div class="top-main-profile">
<div class="contact-wrap"><!--<h2 class="only-h2"> About Us </h2>-->
<div class="about_us_rowPanel auto-float common_newwww rppppppoo">
<div class="right_panel_ofAboutUs">
    <div class="its_new_rm01 this_mob">
        <div class="banr_bottomn96">
            <div class="linee_left"><p class="v_line_left"></p><a href="https://dignifiedme.com/preview/copyright-policy" class="show_hovver5"><img src="https://dignifiedme.com/preview/public/images/how-left.png" alt=""> <strong>Copyright Policy</strong></a></div>
            <strong>Code of Conduct</strong>
            <div class="linee_right"><p class="v_line_right"></p><a href="https://dignifiedme.com/preview/about-us" class="show_hovver6"><img src="https://dignifiedme.com/preview/public/images/how-right.png" alt=""><strong>About Us</strong></a></div>
        </div>
    </div>
    
    
    <!--NEW ADD-->
    <div class="cntr_ddn this_desk">
            <div class="cntr_ddn_nxtt">
            <h1>
            
            <span class="lfe_ln">
               <a href="https://dignifiedme.com/preview/copyright-policy" class="normaly_not_showw01"> 
                <strong class="l_vis_text">Copyright Policy</strong> 
                </a>
            </span> 
            
           Code of Conduct 
            
            <span class="rht_ln">
               <a href="https://dignifiedme.com/preview/about-us" class="normaly_not_showw02">
                <strong class="r_vis_text">About Us</strong>
                </a>
            </span>
            
            </h1>
            </div>
    </div>
<div class="CodeOfConduct-item Grid-col" style="box-sizing: border-box; -webkit-box-flex: 0; flex: 0 0 100%; max-width: 100%; padding: 0px 12px; margin-top: 32px; color: #0e1724; font-family: Roboto, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; background-color: #ffffff;">
<p class="MsoNormal" style="margin-bottom: 19.5pt; line-height: normal; mso-outline-level: 1; background: white;"><strong style="font-family: Roboto, serif; font-size: 32px;">We will be updating our Code of Conduct very soon.</strong></p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</body>
</html>




@guest
<section class="get_stt">
    <div class="container">
        <div class="new_getStarted">
            <span>
                <h5>Connect with your next great hire today!</h5>
                <p>Risk-free hiring made easy</p>
            </span>
            <a class="btns-start professional-btns" href="{{route('register.step1')}}">Get Started <img src="{{asset('public/images/start-arw.png')}}" alt=""></a>
        </div>
	</div>
</section>
@endguest
@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
@endsection