@extends('layouts.app')
@section('title','About Us')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content') 







<section class="banner-area inner_banner_area bg_for_all">
    <div class="container">
        <div class="banner-contain">
            <h1>Help</h1>
            <h2>Enabling the 'Future of Work' </h2>
            <p>The future of work is DIGITAL, REMOTE and WORK FROM ANYWHERE.</p>
        </div>
    </div>
</section>


<section class="freelancer-body com_mtop">
    <div class="container">
        <div class="top-main-profile">
            <div class="contact-wrap">
                <h2 class="only-h2">Help</h2>
             <div class="about_us_rowPanel auto-float common_newwww rppppppoo">
                 
                <div class="right_panel_ofAboutUs">
                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words. </p>
                    
<h5>Simply dummy heading or caption text will be show here</h5>
<p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop.</p>

<ul class="mkkkk">
    <li><i class="fa fa-check" aria-hidden="true"></i> More recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Contrary to popular belief.</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Very popular during the Renaissance. The first line of Lorem.</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Containing Lorem Ipsum passages software like Aldus</li>
</ul>


<h5>Simply dummy heading or caption text will be show here</h5>
<p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into..</p>

<ul class="mkkkk">
    <li><i class="fa fa-check" aria-hidden="true"></i> More recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Contrary to popular belief.</li>
    <li><i class="fa fa-check" aria-hidden="true"></i> Very popular during the Renaissance. The first line of Lorem.</li>
    
</ul>


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