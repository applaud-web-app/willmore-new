      <!-- ========== Left Sidebar Start ========== -->

      <div class="left side-menu">
          <div class="sidebar-inner slimscrollleft">
              <div class="user-details">
                  <div class="pull-left">
                      <img src="{{ @Auth::guard('admin')->user()->image ? asset('storage/app/admin/profileImage/'.Auth::guard('admin')->user()->image) : url('public/images/avatar.png') }}"
                          alt="" class="thumb-md img-circle" />
                  </div>

                  <div class="user-info">
                      <div class="dropdown">
                          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                              aria-expanded="false">{{@Auth::guard('admin')->user()->name}} <span class="caret"></span></a>

                          <ul class="dropdown-menu">
                              <li>
                                  <a href="{{route('edit.admin.profile')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Profile</a>
                              </li>

                              <li>
                                  <a href="{{route('edit.admin.password')}}"><i class="fa fa-cog"></i> Change Password</a>
                              </li>

                              <li>
                                  <a href="{{route('admin.logout')}}"><i class="fa fa-power-off"></i> Logout</a>
                              </li>
                          </ul>
                      </div>

                      <p class="text-muted m-0">Administrator</p>
                  </div>
              </div>

              <!--- Divider -->

              <div id="sidebar-menu">
                  <ul>

                        @if(Auth::guard('admin')->user()->admin_type == 'MA')
                            <li><a href="{{route('manage.package')}}" class="{{Route::is('manage.package','create.package') ? 'active' : ''}} waves-effect"><i class="fa fa-inr" aria-hidden="true"></i> <span>Package Prices </span></a></li>
                            <li><a href="{{route('manage.subadmin')}}" class="{{Route::is('manage.subadmin','create.subadmin') ? 'active' : ''}} waves-effect"><i class="fa fa-users" aria-hidden="true"></i> <span>Sub-Admin Users </span></a> </li>
                        @endif

                        <li><a href="{{route('manage.user')}}" class="{{Route::is('manage.user','view.user') ? 'active' : ''}} waves-effect"><i class="fa fa-user-circle ri1"></i><span> Users</span></a></li>
                        <li><a href="{{route('manage.will')}}" class="{{Route::is('manage.will','suggest.will.change','view.will') ? 'active' : ''}} waves-effect"><i class="fa fa-file-word-o" aria-hidden="true"></i><span>Manage Services</span></a></li>
                        
                        <li>
                            <a href="{{route('manage.payment')}}" class="{{Route::is('manage.payment') ? 'active' : ''}} waves-effect"><i class="fa fa-money" aria-hidden="true"></i><span>Manage Payments</span></a>
                        </li>

                        <li><a href="{{route('manage.consultation')}}" class="{{Route::is('manage.consultation') ? 'active' : ''}} waves-effect"><i class="fa fa-handshake-o" aria-hidden="true"></i><span>Manage Consultation</span></a></li>

                        {{-- <li>
                            <a href="#" class="waves-effect"><i class="fa fa-bell" aria-hidden="true"></i><span>
                                    Notifications </span></a>
                        </li> --}}

                        <li class="has_sub">
                            <a href="javascript:;" class="waves-effect {{Route::is('manage.blog.categories','manage.blog','create.blog.category','manage.blog.categories','create.blog.category','manage.faq','create.faq') ? 'active' : ''}}"><i class="fa fa-folder-open" aria-hidden="true"></i><span>
                                    Content Management </span><span class="pull-right"><i
                                        class="md md-add"></i></span></a>

                            <ul class="list-unstyled">
                                <li><a href="{{route('manage.blog')}}">Manage Blogs</a></li>
                                <li><a href="{{route('manage.blog.categories')}}">Blog Categories</a></li>
                                <li><a href="{{route('manage.faq')}}">Manage FAQ</a></li>
                            </ul>
                        </li>

                      @if(Auth::guard('admin')->user()->admin_type == 'MA')
                        {{-- <li><a href="#" class="waves-effect"><i class="fa fa-flag" aria-hidden="true"></i><span> Reports </span></a></li> --}}
                        <li class="has_sub">
                            <a href="javascript:;" class="waves-effect {{Route::is('reports.on.signup','reports.on.services','reports.on.users') ? 'active' : ''}}"><i class="fa fa-flag" aria-hidden="true"></i></i><span>
                                Reports </span><span class="pull-right"><i class="md md-add"></i></span></a>

                            <ul class="list-unstyled">
                                <li><a href="{{route('reports.on.signup')}}">Reports on sign up </a></li>
                                <li><a href="{{route('reports.on.services')}}">Reports on Services</a></li>
                                <li><a href="{{route('reports.on.users')}}">User Report</a></li>
                            </ul>
                        </li>
                        @endif
                        <li><a href="{{route('will-location-search-enquiries')}}" class="{{Route::is('will-location-search-enquiries') ? 'active' : ''}} waves-effect"><i class="fa fa-file-word-o" aria-hidden="true"></i><span>Will Location Search</span></a></li>

                  </ul>

                  <div class="clearfix"></div>
              </div>

              <div class="clearfix"></div>
          </div>
      </div>

      <!-- Left Sidebar End -->
