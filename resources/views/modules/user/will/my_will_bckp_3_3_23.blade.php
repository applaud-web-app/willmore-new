@extends('layouts.app')
@section('title','Change Password')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<div class="inner_page_area dashboard_inner">
    <div class="container bottom-50">
        <div class="row">

            <div class="col-lg-3 col-md-12 col-sm-12">
                @include('includes.sidebar')
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12">
                        <div class="cus-dashboard-right didlex">
                            <h2>My Packages</h2>
                        </div>
            @include('includes.message')

            @if($message = Session::get('purchase_success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ $message }}
                        </div>
                        {{ Session::forget('purchase_success') }}
                    @endif

                        <div class="dash-right-inr">

                            @if(@$totalWill > 0)

                            <form method="get" action="{{route('user.mywill')}}">
                                <div class="row login_rm02 for_dashboard services_page">


                                    <div class="refinee03">
                                        <div class="form-group">
                                            <label>From date</label>
                                            <input type="text" name="from_date" value="{{@$key['from_date']}}" class="rm_form_fild calandar_iconn"
                                                placeholder="Select" id="datepicker">
                                        </div>
                                    </div>

                                    <div class="refinee03">
                                        <div class="form-group">
                                            <label>To date</label>
                                            <input type="text" name="to_date" value="{{@$key['to_date']}}" class="rm_form_fild calandar_iconn"
                                                placeholder="Select" id="datepicker2">
                                        </div>
                                    </div>

                                    <div class=" refinee03">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="rm_form_fild" name="status">
                                                <option vlaue="">Select</option>
                                                <option value="1" {{@$key['status'] == 1 ? 'selected' : ''}}>In Progess</option>
                                                {{--<option value="2" {{@$key['status'] == 2 ? 'selected' : ''}}>Finalized</option>--}}
                                                <option value="3" {{@$key['status'] == 3 ? 'selected' : ''}}>Completed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="for_filter_srch002 refinee2">
                                        <button type="submit" class="submit_rm" id="submit">Search</button>
                                        <a href="{{route('user.mywill')}}" class="submit_rm" id="submit">Reset</a>
                                    </div>
                                    {{--<div class="for_filter_srch002 refinee2">
                                        <a href="{{route('user.mywill')}}" class="submit_rm" id="submit">Reset</a>
                                    </div>--}}

                                    <div class="col-lg-12 mb-4 mt-1">
                                        <div class="doubleborder"></div>
                                    </div>



                                    <div class="w-100"></div>

                            </form>

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
                                            <div class="will-clm-inr team-text team-text2">
                                            <?php $count1 = 0; ?>
                                            @if(count(@$wills) > 0)
                                            @foreach(@$wills as $will)
                                                @if(@$will->getPackage->packageDetail->id == 1)

                                                @if($count1 > 0)
                                                <div class="moretext" style="display:none;">
                                                @endif

                                                <div class="clm-paper">
                                                    <div class="clm-pp-top">
                                                        <h5>
                                                            <span>ID :</span>
                                                            <strong>#{{@$will->id}}</strong>
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
                                                            <li><a href="{{route('user.view.will',[@$will->id])}}" class="top_battn_new">View</a></li>

                                                            @if(@$will->status == 1  && @$will->approval_status == 3 && @$will->getPackage->packageDetail->id == 1)
                                                                <li>

                                                                @if(checkWillExist(@$will->id) || checkBeneficiarExist(@$will->id) || checkExecutorsExist(@$will->id) || checkWitnessExist(@$will->id))
                                                                <?php
                                                                $completeWillUrl = getCompleteWillUrl(@$will->id);
                                                                ?>
                                                                <a href="{{@$completeWillUrl}}" class="top_battn_new">Complete Will</a>
                                                                @else
                                                                {{-- <a href="{{route('user.manage.executor',[@$will->id])}}" class="top_battn_new">Start Will</a> --}}
                                                                <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">Start Will</a>
                                                                @endif
                                                               </li>
                                                            @endif

                                                            @if(@$will->status == 1 && @$will->approval_status == 3 && checkWillExist(@$will->id))
                                                                <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">Upload Final Will</a></li>
                                                            @endif

                                                            @if(@$will->status == 3)
                                                                <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">View Uploaded Will</a></li>
                                                                <li><a href="{{route('user.manage.executor',[@$will->id])}}" class="top_battn_new">Edit Will</a></li>
                                                            @endif

                                                            @if(checkWillExist(@$will->id) && checkBeneficiarExist(@$will->id) && checkExecutorsExist(@$will->id) && checkWitnessCount(@$will->id) > 1)
                                                                <li><a href="javascript:;" data-id="{{@$will->id}}" class="top_battn_new css-tooltip-top color-blue pdf_alrt">Generate and Download PDF</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>


                                                @if($count1 > 0)
                                                </div>
                                                @endif

                                                <?php $count1++; ?>
                                                @endif
                                            @endforeach

                                            <a href="javascript:;" class="readMore moreless-button willReadMore" id="readMoreBtn" @if($count1 == 0 || $count1 == 1) style="display:none;" @endif>Show more</a>

                                            @endif
                                            @if(@$count1 == 0)
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
                                                <div class="will-clm-inr team-text team-text2">
                                            <?php $count2 = 0; ?>
                                                    @if(count(@$wills) > 0)
                                                    @foreach(@$wills as $will)
                                                        @if(@$will->getPackage->packageDetail->id == 3)

                                                        @if($count2 > 0)
                                                        <div class="moretext" style="display:none;">
                                                        @endif

                                                        <div class="clm-paper">
                                                            <div class="clm-pp-top">

                                                            <h5>
                                                                <span>ID :</span>
                                                                <strong>#{{@$will->id}}</strong>
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
                                                                @endswitch
                                                                </strong> </h4>
                                                            </div>
                                                            <div class="clm-pp-btns">
                                                                <!-- <h6>Actions :</h6> -->
                                                                <ul>
                                                                    @if(@$will->getPackage->packageDetail->id == 3 && checkWillAccess(@$will->id))
                                                                    <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">Upload LOI</a></li>
                                                                    @endif

                                                                    @if(@$will->getPackage->packageDetail->id == 3 )
                                                                        <li>
                                                                            @if(!checkWillAccess(@$will->id))
                                                                            <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">
                                                                            Add Nominee
                                                                            @else
                                                                            <a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">
                                                                            Nominee
                                                                            @endif
                                                                        </a></li>
                                                                    @endif
                                                                </ul>
                                                            </div>


                                                        </div>

                                                        @if($count2 > 0)
                                                            </div>
                                                        @endif

                                                <?php $count2++; ?>
                                                        @endif
                                                    @endforeach
                                                    <a href="javascript:;" class="readMore moreless-button willReadMore" id="readMoreBtn" @if($count2 == 0 || $count2 == 1) style="display:none;" @endif>Show more</a>
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
                                            <div class="will-clm-inr team-text team-text2">
                                            <?php $count3 = 0; ?>
                                            @if(count(@$wills) > 0)
                                            @foreach(@$wills as $will)
                                                @if(@$will->getPackage->packageDetail->id == 2)

                                                    @if($count3 > 0)
                                                    <div class="moretext" style="display:none;">
                                                    @endif
                                                <div class="clm-paper">
                                                    <div class="clm-pp-top">

                                                        <h5>
                                                            <span>ID :</span>
                                                            <strong>#{{@$will->id}}</strong>
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
                                                        @endswitch
                                                        </strong> </h4>
                                                    </div>
                                                    <div class="clm-pp-btns">
                                                        <!-- <h6>Actions :</h6> -->
                                                        <ul>
                                                            @if(@$will->getPackage->packageDetail->id == 2 && checkWillAccess(@$will->id))
                                                                <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new">Enter Location Information</a></li>
                                                            @endif

                                                            @if(@$will->getPackage->packageDetail->id == 2 )
                                                                <li>
                                                                    @if(!checkWillAccess(@$will->id))
                                                                    <a href="{{route('introduction',[@$will->id])}}" class="top_battn_new">
                                                                    Add Nominee
                                                                    @else
                                                                    <a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new">
                                                                    Nominee
                                                                    @endif
                                                                </a></li>
                                                            @endif
                                                        </ul>
                                                    </div>

                                                </div>

                                                    @if($count3 > 0)
                                                        </div>
                                                    @endif
                                                <?php $count3++; ?>
                                                @endif
                                            @endforeach
                                            <a href="javascript:;" class="readMore moreless-button willReadMore" id="readMoreBtn" @if($count3 == 0 || $count3 == 1) style="display:none;" @endif>Show more</a>
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
                                </div>
                            </div>

                            <div class="col-lg-12 mb-4">
                            {{$wills->links('pagination')}}
                            </div>

                            @else
                            <div class="col-lg-12 mt-1 mb-4">
                                <div class="row align-items-strech">
                                    <p>You have not purchased any package. Please <a style="color:#f43930;text-decoration:underline;" href="{{route('services')}}">Click here</a> to purchase a package.</p>
                                </div>
                            </div>
                            @endif

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
<script>
    $(document).ready(function() {

        $('.moreless-button').click(function() {
            $(this).parent().find('.moretext').slideToggle();
            if ($(this).text() == "Show more") {
                $(this).text("Show less")
            } else {
                $(this).text("Show more")
            }
        });

        $('.pdf_alrt').click(function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Have you added all the assets information and want to proceed with the completion of will ?',
                icon: 'warning',
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
        });
    });
</script>

{{-- <script>
  $(document).ready(function(){
    $('.submitWill').click(function(){
            var id = $(this).data('id');
            Swal.fire({
                    title: 'Do you want to submit this will for finalization ? ',
                    icon: 'success',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                         window.location.href ="{{url('submit-will')}}/"+id;
                    }
                    else{
                        return false;
                    }
                });
        });
});
</script> --}}
<script>
  $(document).ready(function(){
    $(function() {
        $("#datepicker").datepicker();
    });

$(function() {
        $("#datepicker2").datepicker();
    });

$(function() {
        $("#datepicker3").datepicker();
    });

    });
  </script>
@endsection
