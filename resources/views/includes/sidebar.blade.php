<div class="cusdashb-left">
    <div class="mobile_menu2"> <i class="fa fa-bars" aria-hidden="true"></i>
        <span>Show Menu</span>
    </div>

    <div class="user_dash_lf_inr" id="mobile_menu_dv2">
        <a href="{{route('user.dashboard')}}" class="back text-dark my-2 d-block" style="font-size:18px;"><i class="fas fa-long-arrow-alt-left"></i> Return To Dashboard</a>
        <br/>
        <div class="nav_Pannel">
            <ul>
                <li>
                    <a href="{{route('user.dashboard')}}" class="{{Route::is('user.dashboard') ? 'active' : ''}}"><span><img src="{{asset('public/images/dashboard.png')}}" alt="icon"> </span>
                        Dashboard<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                </li>
                <li>
                    <a href="{{route('user.profile')}}" class="{{Route::is('user.profile') ? 'active' : ''}}"><span><img src="{{asset('public/images/iconn01.png')}}" alt="icon"> </span>
                        Edit Profile<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                </li>
                <li>
                    <a href="{{route('user.mywill')}}" class="{{Route::is('user.mywill','user.add.will.location', 'user.changes.suggested') ? 'active' : ''}}"><span><img src="{{asset('public/images/iconn02.png')}}" alt="icon"> </span>
                        My Packages<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                </li>
                <li>
                    <a href="{{route('services')}}" class="{{Route::is('services') ? 'active' : ''}}"><span><img src="{{asset('public/images/iconn03.png')}}" alt="icon">
                        </span>
                        Purchase Package<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                </li>
                <li>
                    <a href="{{route('user.mypayments')}}" class="{{Route::is('user.mypayments') ? 'active' : ''}}"><span><img src="{{asset('public/images/iconn04.png')}}" alt="icon"> </span>
                        My Payments<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                </li>
                {{-- <li>
                    <a href="{{url('consultation-events')}}" class="{{Route::is('consultation-events') ? 'active' : ''}}"><span><img src="{{asset('public/images/iconn02.png')}}" alt="icon"> </span>
                        Consultations<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                </li> --}}
                <li>
                    <a href="{{route('change.password')}}" class="{{Route::is('change.password') ? 'active' : ''}}"><span><img src="{{asset('public/images/change_password.png')}}" alt="icon"> </span>
                        Change Password <img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                </li>
                <li>
                    <a href="{{route('logout')}}"><span><img src="{{asset('public/images/log-out.png')}}" alt="icon"> </span>
                        Log Out<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                </li>
            </ul>
        </div>
    </div>
</div>
