<header @auth class="inner_page_header" @endauth>
    <div class="container">
        <div class="header-content d-flex flex-wrap align-items-center">
            <div class="menu-btn">
                <a href="#">
                    <span class="bar1"></span>
                    <span class="bar2"></span>
                    <span class="bar3"></span>
                </a>
            </div>
            <!--menu-btn end-->
            <div class="logo">
                <a href="{{route('home')}}" title="logo">
                    <img src="{{asset('public/images/logo.png')}}" alt="">
                </a>
            </div><!-- logo end-->
            <nav>
                <ul>
                    <li>
                        @guest <a class="{{Route::is('home') ? 'active' : ''}}" href="{{route('home')}}">Home</a> @endguest
                        @auth <a href="{{route('user.dashboard')}}">Dashboard</a> @endauth
                    </li>
                    <li><a class="{{Route::is('about_us') ? 'active' : ''}}" href="{{route('about_us')}}">About Us</a></li>
                    <li><a class="{{Route::is('services','service_detail') ? 'active' : ''}}" href="{{route('services')}}">Services</a></li>
                    <li><a class="{{Route::is('blog') ? 'active' : ''}}" href="{{route('blog')}}">Blog</a></li>
                    <li><a class="{{Route::is('faq') ? 'active' : ''}}" href="{{route('faq')}}">FAQ</a></li>
                    <li><a class="{{Route::is('contact_us') ? 'active' : ''}}" href="{{route('contact_us')}}">Contact Us</a></li>
                    @guest
                    <li><a class="{{Route::is('login') ? 'active' : ''}}" href="{{route('login')}}">Login</a></li>
                    <li><a class="{{Route::is('register') ? 'active' : ''}}" href="{{route('register')}}">Sign Up</a></li>
                    @endguest
                </ul>
            </nav>
            <!--navigation end-->
            @guest
            {{-- <ul class="contact-head-info ml-auto">
                <li>
                    <img src="{{asset('public/images/phone.svg')}}" alt="">
                    <a href="tel:+91 7777076298"><span>+91 7777076298</span></a>
                </li>
            </ul> --}}
            @endguest

            @auth
                <div class="after_login_head log-wt-call">
                    {{-- <ul class="contact-head-info ml-auto">
                        <li>
                            <img src="{{asset('public/images/phone.svg')}}" alt="">
                            <a href="tel:+91 7777076298"><span>+91 7777076298</span></a>
                        </li>
                    </ul> --}}
                    <div class="af_log_dv">
                        <em href="#url" id="profidrop">
                           <b>
                            @if(Auth::user()->profile_picture != null)
                              <img src="{{url('storage\app\public\profile_picture')}}\{{Auth::user()->profile_picture}}" alt="">
                            @elseif(Auth::user()->profile_picture == null && Auth::user()->gender == 'Male')
                                <img src="{{asset('public/images/dash_user1.png')}}" alt="">
                            @elseif(Auth::user()->profile_picture == null && Auth::user()->gender == 'Female')
                                <img src="{{asset('public/images/dash_user2.png')}}" alt="">
                            @else
                                <img src="{{asset('public/images/avatar.png')}}" alt="">
                            @endif
                              <div class="header_log">
                                 <p>Welcome</p>
                                 @if(Auth::user())
                                 <h6> {{ strlen(Auth::user()->first_name)>10 ? substr(Auth::user()->first_name,0,10) : Auth::user()->first_name }}<span><img src="{{asset('public/images/drop6.png')}}" alt=""></span></h6>
                                 @endif
                              </div>
                           </b>
                        </em>
                        <div class="profidropdid" id="profidropdid" style="display: none;">
                           <ul>
                              <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                              <li><a href="{{route('user.profile')}}">Edit Profile </a></li>
                              <li><a href="{{route('user.mywill')}}">My Packages</a></li>
                              <li><a href="{{route('services')}}">Purchase Package</a></li>
                              <li><a href="{{route('user.mypayments')}}">My Payments</a></li>
                              <li><a href="{{route('change.password')}}">Change Password</a></li>
                              <li><a href="{{route('logout')}}">Logout</a></li>
                           </ul>
                        </div>
                   </div>
                </div>
            @endauth
            <!--contact-head-info end-->

        </div>
        <!--header-content end-->
    </div>
</header>
<!--header end-->

<div class="burger-menu">
            <a href="#" class="close-menu">
                <i class="flaticon-close"></i>
            </a>
            <div class="menu-middle">
                <div class="container">
                    <div class="main-menu">
                        <div class="row">

                            <div class="col-md-4">
                                @guest
                                <div class="menu-widget">
                                    <h4>LOGIN / SIGN UP</h4>
                                    <ul>
                                        <li><a href="{{route('login')}}">Login</a></li>
                                        <li><a href="{{route('register')}}">Sign Up</a></li>
                                    </ul>
                                </div>
                                @endguest

                                @auth
                                <div class="menu-widget">
                                    <h4>MY ACCOUNT</h4>
                                    <ul>
                                        <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                                        <li><a href="{{route('user.profile')}}">Edit Profile</a></li>
                                        <li><a href="{{route('user.mywill')}}">My Packages</a></li>
                                        <li><a href="{{route('services')}}">Purchase Package</a></li>
                                        <li><a href="{{route('user.mypayments')}}">My Payments</a></li>
                                        <li><a href="{{route('change.password')}}">Change Password</a></li>
                                    </ul>
                                </div>
                                @endauth
                            </div>

                            <div class="col-md-4">
                                <div class="menu-widget">
                                    <h4>COMPANY</h4>
                                    <ul>
                                    	<li><a href="{{route('home')}}">Home</a></li>
                                        <li><a href="{{route('about_us')}}">About Us</a></li>
                                        <li><a href="{{route('services')}}">Services</a></li>
                                        <li><a href="{{route('blog')}}">Blog</a></li>
                                        <li><a href="{{route('faq')}}">FAQ</a></li>
                                        <li><a href="{{route('contact_us')}}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="menu-widget">
                                    <h4>SOCIAL MEDIA</h4>
                                    <ul>
                                        <li><a href="#">Twitter</a></li>
                                        <li><a href="#">Linkedin</a></li>
                                        <li><a href="#">Instagram</a></li>
                                        <li><a href="#">Facebook</a></li>
                                        <li><a href="#">Telegram</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div><!--main-menu end-->
                </div>
            </div><!--menu-middle end-->

        </div><!--burger-menu end-->
