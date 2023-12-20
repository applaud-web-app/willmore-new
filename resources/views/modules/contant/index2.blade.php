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

<section class="banner-area inner_banner_area story_bg">
    <div class="container">
        <div class="banner-contain">
            <h1>{{ @$template->title }}</h1>
            <h2>Enabling the 'Future of Work'</h2>
            <p>The future of work is DIGITAL, REMOTE and WORK FROM ANYWHERE.</p>
            <!--<a class="post-project for_hoverr" href="#">Learn More <img src="./images/start-arw.png" alt=""></a>
            <a class="post-project rev-btn for_hoverr" href="#">Join The Revolution <img src="./images/start-arw.png" alt=""></a>-->
        </div>
    </div>
</section>



<section class="bookmark_area">
<div class="container single-page-nav">
    <a href="{{route('about_us')}}" class="{{Route::is('about_us') ? 'innr_page_active' : ''}}">About Us </a>
    <a href="{{route('dignifiedme_story')}}" class="{{Route::is('dignifiedme_story') ? 'innr_page_active' : ''}}">Dignifiedme Story</a>
    <a href="{{route('careers')}}"  class="{{Route::is('careers') ? 'innr_page_active' : ''}}">Careers</a>
    <a href="{{route('contact_us')}}"  class="{{Route::is('contact_us') ? 'innr_page_active' : ''}}">Contact Us</a>
</div>
</section>




{!! @$template->content !!}

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