@extends('layouts.app')
@section('title','Careers')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content') 

<section class="banner-area inner_banner_area carrer_bg">
    <div class="container">
        <div class="banner-contain">
            <h1>Careers</h1>
            <h2>Enabling the 'Future of Work'</h2>
            <p>The future of work is DIGITAL, REMOTE and WORK FROM ANYWHERE.</p>
            <!--<a class="post-project for_hoverr" href="#">Learn More <img src="./images/start-arw.png" alt=""></a>
            <a class="post-project rev-btn for_hoverr" href="#">Join The Revolution <img src="./images/start-arw.png" alt=""></a>-->
        </div>
    </div>
</section>



<section class="bookmark_area">
<div class="container single-page-nav">
    <a href="{{route('about_us')}}">About Us </a>
    <a href="{{route('dignifiedme_story')}}">Dignifiedme Story</a>
    <a href="{{route('careers')}}" class="innr_page_active">Careers</a>
    <a href="{{route('contact_us')}}">Contact Us</a>
</div>
</section>






<section class="freelancer-body com_mtop">
    <div class="container">
        <div class="top-main-profile">
          <div class="contact-wrap">
             <div class="about_us_rowPanel auto-float">

                <!--<h2 class="only-h2"> Careers</h2>-->

                <div class="right_panel_ofAboutUs common_newwww02">
                    <p>We are hiring the best talent! Send us your resumes here </p>
                    <a href="#"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Your Resumes</a>
                </div>  

               
            </div>
          </div>
        </div>
    </div>
</section>



@guest
<section class="get_stt">
    <div class="container">
        <div class="new_getStarted">
            <span>
                <h5>Connect with your next great hire today!</h5>
                <p>Risk-free hiring made easy</p>
            </span>
            <a class="btns-start professional-btns" href="{{route('register.step1')}}">Get Started <img src="{{asset('public/images/start-arw.png')}}" alt="Get Started"></a>
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