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


@if(Route::is('what_is_in_a_name','what_do_we_enable','what_is_the_future_of_work','what_is_our_mission'))
<section class="what_banner">
    <img src="{{asset('public/images/What-banner.png')}}" alt="what banner">
</section>
@else
<section class="banner-area inner_banner_area bg_for_all">
    <div class="container">
        <div class="banner-contain">
            <h1>{{ @$template->title }}</h1>
            <h2>Enabling the 'Future of Work' </h2>
            <p>The future of work is DIGITAL, REMOTE and WORK FROM ANYWHERE.</p>
        </div>
    </div>
</section>
@endif


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
<script type="text/javascript">
    $(document).ready(function(){
        if("{{Route::is('risk_free_hiring')}}"){
            $('html, body').animate({
                'scrollTop' : $(".risk-free-hiring-scroll").position().top-35
            });
        }

        if("{{Route::is('growth_and_opportunities')}}"){
            $('html, body').animate({
                'scrollTop' : $(".growth-opportunities-scroll").position().top-35
            });
        }
        if("{{Route::is('flexible_workstyle')}}"){
            $('html, body').animate({
                'scrollTop' :$(".flexible-workstyle-scroll").position().top-35
            });
        }


        if("{{Route::is('self_reliance')}}"){
            $('html, body').animate({
                'scrollTop' :$(".self-reliance-scroll").position().top-35
            });
        }

    
    });
</script>
@endsection