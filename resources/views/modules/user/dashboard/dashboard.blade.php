@extends('layouts.app')
@section('title','Dashboard')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<div class="inner_page_area dashboard_inner">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-12 col-sm-12">
            @include('includes.sidebar')
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="cus-dashboard-right didlex">
                    <h2>Dashboard</h2>
                </div>
                @include('includes.message')
                <div class="dash-right-inr">



                    <div class="row login_rm02 for_dashboard">



                        <div class="col-lg-12">
                            <div class="instructions_aar dashboard_ppgg">
                                <h1><img src="{{asset('public/images/hi.png')}}"> Hi, {{@$user ? @$user->name: ''}} - Welcome to willandmore.com @if(count(@$wills) == 0) Please <a style="color:#f43930;text-decoration:underline;" href="{{route('services')}}">purchase a package</a> of your choice to proceed. @endif</h1>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-2 mt-3">
                            <div class="doubleborder"></div>
                            <div class="doubleborder"></div>
                        </div>

                        @if(count(@$wills) > 0)
                        <div class="col-lg-12 mt-1 mb-4">
                                <div class="meb_shptxt ollp">
                                    <label>
                                        <!--<img src="{{asset('public/images/m-1.png')}}" alt="">-->Packages Purchased
                                    </label>
                                </div>
                                <div class="col-lg-12 mt-1 mb-4">
                                <div class="row align-items-strech">
                                    @if(@$totalWillPkg1 > 0)
                                    <div class="col-lg-4 col-md-4">
                                        <div class="will-clm-box">
                                            <h3>
                                            <img src="{{asset('public/images/will.png')}}" alt="icon">
                                                @if(count(@$packages) > 0)
                                                {{@$packages[0]->package_name}}
                                                @else
                                                Will
                                                @endif
                                            </h3>
                                            <div class="will-clm-inr">
                                            <?php $count1 = 0; ?>
                                            @if(count(@$wills) > 0)
                                            @foreach(@$wills as $will)
                                                @if(@$will->getPackage->packageDetail->id == 1)
                                                <div class="clm-paper">
                                                    <div class="clm-pp-top">
                                                        <h5>
                                                            <span>ID : <strong>#{{@$will->id}}</strong></span>
                                                            @if(@$will->getPackage->master_will_id != null)
                                                                <span>Master ID : <strong>#{{@$will->getPackage->master_will_id}}</strong></span>
                                                            @endif
                                                        </h5>
                                                        <?php
                                                        $finalize = getWillCount(@$will->id);
                                                        ?>

                                                        <h4>
                                                        <span>{{$finalize['count']}}/{{$finalize['total']}} completed</span>
                                                        <strong>
                                                        @switch(@$will->status)
                                                            @case(1)
                                                            In Progress
                                                                @break

                                                            @case(2)
                                                                Finalized
                                                                @break

                                                            @case(3)
                                                            Completed
                                                                @break

                                                            @default
                                                                -
                                                        @endswitch</strong> </h4>
                                                    </div>
                                                    <div class="clm-pp-btns">
                                                        <!-- <h6>Actions :</h6> -->
                                                        <ul>
                                                            {{-- @if(@$finalize['count'] > 0)
                                                                <li><a href="{{route('user.view.will',[@$will->id])}}" class="top_battn_new">View</a></li>
                                                            @endif --}}
                                                            @if(@$will->status == 1  && @$will->approval_status == 3 && @$will->getPackage->packageDetail->id == 1)
                                                                <li>

                                                                @if(checkWillExist(@$will->id) || checkBeneficiarExist(@$will->id) || checkExecutorsExist(@$will->id) || checkWitnessExist(@$will->id))
                                                                <?php
                                                                $completeWillUrl = getCompleteWillUrl(@$will->id);
                                                                ?>
                                                                {{-- <a href="{{@$completeWillUrl}}" class="top_battn_new">Complete Will</a> --}}
                                                                <a href="{{url('your-details/'.@$will->id)}}" class="top_battn_new">Complete Will</a>
                                                                @else
                                                                {{-- <a href="{{route('user.manage.executor',[@$will->id])}}" class="top_battn_new">Start Will</a> --}}
                                                                {{-- <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">Start Will</a> --}}
                                                                <a href="{{url('your-details/'.@$will->id)}}" class="top_battn_new">Start Will</a>
                                                                @endif
                                                               </li>
                                                            @endif

                                                             <li><a href="{{url('consultation-events')}}" class="top_battn_new">Consultation</a></li>
                                                            {{-- @if(@$will->status == 1 && @$will->approval_status == 3 && checkWillExist(@$will->id))
                                                                <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">Upload Final Will</a></li>
                                                            @endif

                                                            @if(@$will->status == 3)
                                                                <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">View Uploaded Will</a></li>
                                                                <li><a href="{{route('user.manage.executor',[@$will->id])}}" class="top_battn_new">Edit Will</a></li>
                                                            @endif --}}

                                                            @if(checkWillExist(@$will->id) && checkBeneficiarExist(@$will->id) && checkExecutorsExist(@$will->id) && checkWitnessCount(@$will->id) > 1)
                                                                <li><a href="javascript:;" data-id="{{@$will->id}}" class="top_battn_new css-tooltip-top color-blue pdf_alrt">Generate and Download PDF</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php $count1++; ?>
                                                @break
                                                @endif
                                            @endforeach
                                                    @endif
                                                    @if(@$count1 == 0)
                                                    <div class="clm-paper">
                                                        <div class="clm-pp-btns">
                                                            <li><a href="{{url('consultation-events')}}" class="top_battn_new">Consultation</a></li>
                                                        </div>
                                                    </div>
                                                    @endif
                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                    @if(@$totalWillPkg3 > 0)
                                    <div class="col-lg-4 col-md-4">
                                        <div class="will-clm-box">
                                            <h3>
                                            <img src="{{asset('public/images/LOI.png')}}" alt="icon">
                                                @if(count(@$packages) > 0)
                                                {{@$packages[2]->package_name ? @$packages[2]->package_name : 'Letter of instruction '}}
                                                @else
                                                LOI
                                                @endif</h3>
                                                <div class="will-clm-inr">
                                                    <?php $count2 = 0; ?>
                                                    @if(count(@$wills) > 0)
                                                    @foreach(@$wills as $will)
                                                        @if(@$will->getPackage->packageDetail->id == 3)
                                                        <div class="clm-paper">
                                                            <div class="clm-pp-top">
                                                                <h5>
                                                                    <span>ID : <strong>#{{@$will->id}}</strong></span>
                                                                    @if(@$will->getPackage->master_will_id != null)
                                                                        <span>Master ID : <strong>#{{@$will->getPackage->master_will_id}}</strong></span>
                                                                    @endif
                                                                </h5>
                                                                <?php
                                                                $finalize = getLOICount(@$will->id);
                                                                ?>

                                                                <h4>
                                                                <span>{{$finalize['count']}}/{{$finalize['total']}} completed</span>
                                                                <strong>
                                                                @switch(@$will->status)
                                                                    @case(1)
                                                                    In Progress
                                                                        @break

                                                                    @case(2)
                                                                        Finalized
                                                                        @break

                                                                    @case(3)
                                                                    Completed
                                                                        @break

                                                                    @default
                                                                        -
                                                                @endswitch</strong> </h4>
                                                            </div>
                                                            <div class="clm-pp-btns">
                                                                <!-- <h6>Actions :</h6> -->
                                                                <ul>
                                                                    @if(@$will->getPackage->packageDetail->id == 3 && checkWillAccess(@$will->id))
                                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Nominee</a></li>
                                                                    @endif

                                                                    @if(@$will->getPackage->packageDetail->id == 3 && !checkWillAccess(@$will->id) && $finalize['count'] == 1)
                                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Add Nominee</a></li>
                                                                    @endif

                                                                    @if(@$will->getPackage->packageDetail->id == 3 )
                                                                        <li>
                                                                            @if($finalize['count'] < 1)
                                                                            <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">
                                                                                Upload LOI
                                                                            @else
                                                                            <a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">
                                                                              View Uploaded LOI
                                                                            @endif
                                                                        </a></li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    <?php $count2++; ?>
                                                        @break
                                                        @endif
                                                    @endforeach
                                                    @endif
                                                    @if(@$count2 == 0)
                                                    <div class="clm-paper">
                                                        <div class="clm-pp-btns">
                                                        -
                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(@$totalWillPkg2 > 0)
                                    <div class="col-lg-4 col-md-4">
                                        <div class="will-clm-box lst-clm">
                                            <h3>
                                            <img src="{{asset('public/images/will-location.png')}}" alt="icon"> Will location</h3>
                                            <div class="will-clm-inr">
                                            <?php $count3 = 0; ?>
                                            @if(count(@$wills) > 0)
                                                @foreach(@$wills as $will)
                                                    @if(@$will->getPackage->packageDetail->id == 2)
                                                    <div class="clm-paper">
                                                        <div class="clm-pp-top">
                                                            <h5>
                                                                <span>ID : <strong>#{{@$will->id}}</strong></span>
                                                                @if(@$will->getPackage->master_will_id != null)
                                                                    <span>Master ID : <strong>#{{@$will->getPackage->master_will_id}}</strong></span>
                                                                @endif
                                                            </h5>
                                                            <?php
                                                            $finalize = getLocationCount(@$will->id);
                                                            ?>
                                                            <h4>
                                                            <span>{{$finalize['count']}}/{{$finalize['total']}} completed</span>
                                                            <strong>
                                                            @switch(@$will->status)
                                                                @case(1)
                                                                In Progress
                                                                    @break

                                                                @case(2)
                                                                    Finalized
                                                                    @break

                                                                @case(3)
                                                                Completed
                                                                    @break

                                                                @default
                                                                    -
                                                            @endswitch</strong> </h4>
                                                        </div>
                                                        <div class="clm-pp-btns">
                                                            <!-- <h6>Actions :</h6> -->
                                                            <ul>
                                                                @if(@$will->getPackage->packageDetail->id == 2 && checkWillAccess(@$will->id))
                                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Nominee</a></li>
                                                                @endif

                                                                @if(@$will->getPackage->packageDetail->id == 2 && !checkWillAccess(@$will->id) && $finalize['count'] == 1)
                                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Add Nominee</a></li>
                                                                @endif

                                                                @if(@$will->getPackage->packageDetail->id == 2 )
                                                                    <li>
                                                                        @if($finalize['count'] < 1)
                                                                        <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">
                                                                            Enter Location Information
                                                                        @else
                                                                        <a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">
                                                                           View Location Information
                                                                        @endif
                                                                    </a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php $count3++; ?>
                                                    @break
                                                    @endif
                                                @endforeach
                                                @endif
                                                @if(@$count3 == 0)
                                                <div class="clm-paper">
                                                    <div class="clm-pp-btns">
                                                    -
                                                    </div>
                                                </div>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                    @endif

                                    @if(@$totalWillPkg5 > 0)
                                    <div class="col-lg-4 col-md-4">
                                        <div class="will-clm-box lst-clm">
                                            <h3>
                                            <img src="{{asset('public/images/will-location.png')}}" alt="icon"> Advance Medical Directive</h3>
                                            <div class="will-clm-inr">
                                            <?php $count5 = 0; ?>
                                            @if(count(@$wills) > 0)
                                                @foreach(@$wills as $will)
                                                    @if(@$will->getPackage->packageDetail->id == 5)
                                                    <div class="clm-paper">
                                                        <div class="clm-pp-top">
                                                            <h5>
                                                                <span>ID :
                                                                <strong>#{{@$will->id}}</strong></span>
                                                            </h5>
                                                            <?php
                                                            $finalize = getAMDCount(@$will->id);
                                                            ?>
                                                            <h4>
                                                            <span>{{$finalize['count']}}/{{$finalize['total']}} completed</span>
                                                            <strong>
                                                            @switch(@$will->status)
                                                                @case(1)
                                                                In Progress
                                                                    @break

                                                                @case(2)
                                                                    Finalized
                                                                    @break

                                                                @case(3)
                                                                Completed
                                                                    @break

                                                                @default
                                                                    -
                                                            @endswitch</strong> </h4>
                                                        </div>
                                                        <div class="clm-pp-btns">
                                                            <!-- <h6>Actions :</h6> -->
                                                            <ul>
                                                                @if(@$will->getPackage->packageDetail->id == 5 && checkWillAccess(@$will->id))
                                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Trusted Person</a></li>
                                                                @endif

                                                                @if(@$will->getPackage->packageDetail->id == 5 && !checkWillAccess(@$will->id) && $finalize['count'] == 1)
                                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Add Trusted Person</a></li>
                                                                @endif

                                                                @if(@$will->getPackage->packageDetail->id == 5 )
                                                                    <li>
                                                                        @if($finalize['count'] < 1)
                                                                        <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">
                                                                            Upload AMD
                                                                        @else
                                                                        <a href="{{route('user.add.amd',[@$will->id])}}" class="top_battn_new">
                                                                           View AMD
                                                                        @endif
                                                                    </a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php $count5++; ?>
                                                    @break
                                                    @endif
                                                @endforeach
                                                @endif
                                                @if(@$count5 == 0)
                                                <div class="clm-paper">
                                                    <div class="clm-pp-btns">
                                                    -
                                                    </div>
                                                </div>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                    @endif

                                    @if (@$totalWillPkg8 > 0)
                                    <div class="col-lg-4 col-md-4">
                                        <div class="will-clm-box lst-clm">
                                            
                                            <h3>
                                                <img src="{{ asset('public/images/will.png') }}" alt="icon"> Will Template Download
                                            </h3>
                                            <div class="will-clm-inr team-text team-text2">
                                                <div class="clm-paper">
                                                    <div class="clm-pp-top">
                                                        <h5>
                                                            <span>ID : <strong>#{{ @$willTempDownload->id }}</strong></span>
                                                        </h5>
                            
                                                        <h4>
                                                            {{-- <span>0/18 completed</span> --}}
                                                            <strong>
                                                                {{-- In Progress --}}
                                                            </strong>
                                                        </h4>
                                                    </div>
                                                    <div class="clm-pp-btns">
                                                       
                                                        <ul>
                            
                                                            <li>
                                                                <a href="{{url("download-will-templates")}}" class="top_battn_new">Start
                                                                    Download</a>
                                                            </li>
                            
                            
                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                            
                                        </div>
                                    </div>
                                @endif

                                </div>
                            </div>
                            </div>
                        @endif

                        @if(count(@$wills) > 0)
                        <div class="col-lg-12" style="display:none;">

                            <div class="instructions_aar profile_infop01 profile_infop02 mt-1 ollp22">

                                <div class="meb_shptxt ollp">
                                    <label>
                                        <!--<img src="{{asset('public/images/m-1.png')}}" alt="">-->Packages Purchased
                                    </label>
                                </div>

                                @foreach(@$wills as $will)
                                <p class="dash-p-wbtn"><strong><img src="{{asset('public/images/m-1.png')}}" alt="">{{@$will->getPackage ? @$will->getPackage->packageDetail->package_name : '-'}} on :</strong> <img src="{{asset('public/images/d5.png')}}" alt="">{{@$will->created_at ? date('d F, Y',strtotime(@$will->created_at)) : '-'}}

                                @if(@$will->status == 1  && @$will->approval_status == 3 && @$will->getPackage->packageDetail->id == 1)
                                                   <a href="{{route('user.manage.executor',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">

                                                    @if(checkWillExist(@$will->id) || checkBeneficiarExist(@$will->id) || checkExecutorsExist(@$will->id) || checkWitnessExist(@$will->id))
                                                    Complete Will
                                                    @else
                                                    Start Will
                                                    @endif

                                                </a>
                                                @endif
                                                {{-- @if(@$will->getPackage->packageDetail->id == 2 && checkWillAccess(@$will->id))
                                                    <a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">Enter Location Information</a>
                                                @elseif(@$will->getPackage->packageDetail->id == 2 )

                                                        @if(!checkWillAccess(@$will->id))
                                                        <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">
                                                        Add Nominee
                                                        </a>
                                                        @else
                                                        <a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">
                                                        Nominee
                                                        </a>
                                                        @endif
                                                    </a>
                                                @endif --}}

                                                @if(@$will->getPackage->packageDetail->id == 2 && checkWillAccess(@$will->id))
                                                    <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new"> View Location Information</a></li>
                                                @elseif(@$will->getPackage->packageDetail->id == 2 && !checkWillAccess(@$will->id) && $finalize['count'] == 1)
                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Add Nominee</a></li>
                                                @elseif(@$will->getPackage->packageDetail->id == 2 )
                                                    <li>
                                                        @if($finalize['count'] < 1)
                                                        <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">
                                                            Enter Location Information
                                                        @endif
                                                    </a></li>
                                                @endif

                                                {{-- @if(@$will->getPackage->packageDetail->id == 3 && checkWillAccess(@$will->id))
                                                    <a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">Upload LOI</a>
                                                @elseif(@$will->getPackage->packageDetail->id == 3 )

                                                        @if(!checkWillAccess(@$will->id))
                                                        <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">
                                                        Add Nominee
                                                        </a>
                                                        @else
                                                        <a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">
                                                        Nominee
                                                        </a>
                                                        @endif

                                                @endif --}}
                                                @if(@$will->getPackage->packageDetail->id == 3 && checkWillAccess(@$will->id))
                                                    <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">View Uploaded LOI</a></li>
                                                @elseif(@$will->getPackage->packageDetail->id == 3 && !checkWillAccess(@$will->id) && $finalize['count'] == 1)
                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Add Nominee</a></li>
                                                @elseif(@$will->getPackage->packageDetail->id == 3 )
                                                    <li>
                                                        @if($finalize['count'] < 1)
                                                        <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">
                                                            Upload LOI
                                                        @endif
                                                    </a></li>
                                                @endif

                                                @if(@$will->status == 3)
                                                    <a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">View Uploaded Will</a>
                                                @endif

                                                {{-- 5 --}}
                                                @if(@$will->getPackage->packageDetail->id == 5 && checkWillAccess(@$will->id))
                                                    <li><a href="{{route('user.add.amd',[@$will->id])}}" class="top_battn_new">View AMD</a></li>
                                                @elseif(@$will->getPackage->packageDetail->id == 5 && !checkWillAccess(@$will->id) && $finalize['count'] == 1)
                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">Add Trusted Person</a></li>
                                                @elseif(@$will->getPackage->packageDetail->id == 5 )
                                                    <li>
                                                        @if($finalize['count'] < 1)
                                                        <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">
                                                            Upload AMD
                                                        @endif
                                                    </a></li>
                                                @endif
                                                @if(@$will->status == 3)
                                                    <a href="{{route('user.add.amd',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">View AMD</a>
                                                @endif
                                                </p>
                                @endforeach

                            </div>

                            {{-- <div class="instructions_aar profile_infop01 profile_infop02 ttpss">
                                <p><img src="{{asset('public/images/acceptt.png')}}" alt=""><strong>Status of will :</strong> last changed
                                    on 7th aug, 2022</p>
                            </div> --}}

                        </div>
                        @endif

                        <div class="col-lg-12">
                            <div class="instructions_aar profile_infop01">
                                <ul>
                                    <li> <strong>Name</strong> <span>: {{@$user ? @$user->name: ''}}</span> </li>
                                    <li> <strong>Username</strong> <span>: {{@$user ? @$user->username: ''}}</span> </li>
                                    <li> <strong>D.O.B</strong> <span>: {{ date('d.m.Y',strtotime(@$user->dob)) }}</span> </li>
                                    <li> <strong>Gender</strong> <span>: {{@$user ? @$user->gender: ''}}</span> </li>
                                    <li> <strong>Mobile</strong> <span>: {{@$user->phonecode ? '+'.@$user->getPhonecode->phonecode : ''}} {{@$user ? @$user->mobile: ''}}
                                        @if(@$user->is_mobile_verified == 'Y')
                                            <b>Verified <img src="{{asset('public/images/verified.png')}}" alt=""> </b>
                                        @else
                                            <b> <a href="{{route('user.verify.mobile')}}">Click To Verify Mobile </a></b>
                                        @endif </span>
                                    </li>
                                    <li> <strong>Email Address</strong> <span>: {{@$user ? @$user->email: ''}}
                                        @if(@$user->is_email_verify == 'Y')
                                            <b>Verified <img src="{{asset('public/images/verified.png')}}" alt=""> </b>
                                        @else
                                            <b><a href="javascript:;" class="verify_email" data-id="{{ @$user->id }}">Click To Verify Email</a> </b>
                                        @endif </span>
                                    </li>

                                    @if(@$user->aadhar_number)<li> <strong>Aadhar Number</strong> <span>: {{@$user ? @$user->aadhar_number: ''}}</span> </li>@endif

                                    @if(@$user->pan_number)<li> <strong>PAN Number</strong> <span>: {{@$user ? @$user->pan_number: ''}}</span> </li>@endif

                                    @if(@$user->passport_number)
                                    <li> <strong>Passport Number</strong> <span>: {{@$user ? @$user->passport_number: ''}}</span> </li>
                                    <li> <strong>Issued date</strong> <span>: {{@$user->passport_issued_date ? date('d-m-Y', strtotime(@$user->passport_issued_date)): ''}}</span> </li>
                                    <li> <strong>Date of Expiry</strong> <span>: {{@$user->passport_expiry_date ? date('d-m-Y', strtotime(@$user->passport_expiry_date)): ''}}</span> </li>
                                    @endif

                                    <li> <strong>Citizen of</strong> <span>: {{@$user->getNationality->name}}</span> </li>
                                    <li> <strong>Address</strong> <span>: {{@$user->address1.', '.@$user->address2.', '.@$user->city.'- '.@$user->zip_code.', '.@$user->state.', '.@$user->country}}</span> </li>
                                    <li> <strong>Last Sign In</strong> <span>: {{ @$user->last_sign_in ? date('d.m.Y',strtotime(@$user->last_sign_in)) : '-' }}</span> </li>
                                    {{-- <li> <strong>Updated On</strong> <span>: {{ @$user->updated_at ? date('d.m.Y',strtotime(@$user->updated_at)) : '-' }}</span> </li> --}}
                                    <li> <strong>Registered on</strong> <span>: {{ @$user->created_at ? date('d.m.Y',strtotime(@$user->created_at)) : '-' }}</span> </li>
                                </ul>
                            </div>
                        </div>



                    </div>
                </div>


            </div>

        </div>
    </div>
</div>

@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function() {


        // $('.pdf_alrt').click(function() {
        //     var id = $(this).data('id');
        //     Swal.fire({
        //         title: 'Hope you have added all information pertaining to your assets! Do you wish to proceed with the completion of the Will?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         cancelButtonText: 'No',
        //         confirmButtonText: 'Yes'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // window.location.href = "{{url('download-pdf')}}/" + id;
        //             url = "{{url('download-pdf')}}/" + id;
        //             window.open(url, '_blank');
        //         } else {
        //             return false;
        //         }
        //     });
        // });

        $('.pdf_alrt').click(function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Hope you have added all information pertaining to your assets! Do you wish to proceed with the completion of the Will?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Please note that the electronic copy of your executed Will which you upload is not valid in a court of law in India; only a physical copy of the executed Will is valid. The uploaded copy is for your reference. We will send you a confirmatory email with a link to access the uploaded copy of the executed Will; you can also access the same through your Dashboard after logging in.',
                        icon: 'warning',
                        width: '1050px',
                        showCancelButton: true,
                        cancelButtonText: 'No',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // window.location.href = "{{url('download-pdf')}}/" + id;
                            url = "{{url('download-pdf')}}/" + id;
                            window.open(url, '_blank');
                        } else {
                            return false;
                        }
                    });
                } else {
                    return false;
                }
            });
        });

        // Swal.fire({
        //         title: 'Please purchase a package to proceed',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         cancelButtonText: 'No',
        //         confirmButtonText: 'Yes'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             url = "{{url('services')}}";
        //             //window.open(url, '_blank');
        //         } else {
        //             return false;
        //         }
        //     });

    });


    $(document).on('click','.verify_email', function(e){

        var id = $(e.currentTarget).attr('data-id');

        $.ajax({
            url: '{{ route('user.verify.email') }}',
            method: 'GET',
            data: 'id='+id,
            success: function(data){
                Swal.fire({
                title: 'A verification link has been sent to your mail, Please verify your email.',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    } else {
                        return false;
                    }
                });
            },
            error: function(error){
                consolse.log(error);
            }
        });
    });

</script>
@endsection
