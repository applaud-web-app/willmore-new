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





<section class="what_banner">
    <img src="{{asset('public/images/Terms-banner.png')}}" alt="Term and condition banner">
  </section>

{{-- <section class="banner-area inner_banner_area bg_for_privacyy">
    <div class="container">
        <div class="banner-contain">
            <h1>{{ @$template->title }}</h1>
            <h2>Enabling the 'Future of Work' </h2>
            <p>The future of work is DIGITAL, REMOTE and WORK FROM ANYWHERE.</p>
        </div>
    </div>
</section> --}}

{{-- <div style="height: 80px; overflow: hidden;"></div> --}}
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
<script>
$(document).ready(function(){
    if("{{Route::is('dispute_terms_and_conditions')}}"){
        $('html, body').animate({
            'scrollTop' : $(".dispute_span").position().top+345
        });
    }
});
</script>
@endsection