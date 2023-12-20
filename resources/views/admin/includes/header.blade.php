      <!-- Top Bar Start -->

      <div class="topbar">
          <!-- LOGO -->

          <div class="topbar-left">
              <div class="text-center">
                  <a href="{{route('admin.dashboard')}}" class="logo"><img
                          src="{{asset('public/admin/images/logo.png')}}" alt="" /></a>
                  <a href="{{route('admin.dashboard')}}" class="logo-short"><img
                          src="{{asset('public/admin/images/logo.png')}}" alt="" /></a>
              </div>
          </div>

          <!-- Button mobile view to collapse sidebar menu -->

          <div class="navbar navbar-default" role="navigation">
              <div class="container">
                  <div class="">
                      <div class="pull-left">
                          <button class="button-menu-mobile open-left">
                              <i class="fa fa-bars"></i>
                          </button>

                          <span class="clearfix"></span>
                      </div>

                      <ul class="nav navbar-nav navbar-right pull-right">
                          <li class="dropdown">
                              <a href="javascript:;" class="dropdown-toggle profile" data-toggle="dropdown"
                                  aria-expanded="true"><img
                                      src="{{ @Auth::guard('admin')->user()->image ? asset('storage/app/admin/profileImage/'.Auth::guard('admin')->user()->image) : url('public/images/avatar.png') }}"
                                      alt="user-img" class="img-circle" />
                              </a>

                              <ul class="dropdown-menu">
                                  <li>
                                      <a href="{{route('edit.admin.profile')}}"><i class="fa fa-user-circle-o"
                                              aria-hidden="true"></i> Profile</a>
                                  </li>

                                  <li>
                                      <a href="{{route('edit.admin.password')}}"><i class="fa fa-cog"></i> Change
                                          Password</a>
                                  </li>

                                  <li>
                                      <a href="{{route('admin.logout')}}"><i class="fa fa-power-off"></i> Logout</a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </div>

                  <!--/.nav-collapse -->
              </div>
          </div>
      </div>

      <!-- Top Bar End -->