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
                            <h2>My Services</h2>
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

                            
                            <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                                <div class="table_01 table vvr_table_01">

                                    <div class="row amnt-tble">
                                        <div class="cel_area amunt cess">ID</div>
                                        <div class="cel_area amunt cess">Package Name</div>
                                        <div class="cel_area amunt cess">Start Date</div>
                                        <div class="cel_area amunt cess">Finalized On</div>
                                        <div class="cel_area amunt cess">Status</div>
                                        {{--<div class="cel_area amunt cess">Approval Status</div>--}}
                                        <div class="cel_area amunt cess">Action</div>
                                    </div>

                                    <!--table row-1-->
                                    @if(count(@$wills) > 0)
                                    @foreach(@$wills as $will)
                                    <div class="row small_screen2 for_bg_color_01">
                                        <div class="cel_area amunt-detail cess"> <span class="hide_big">Will ID</span>
                                            <span class="sm_size"><a href="javascript:;">#{{@$will->id}}</a> </span></div>

                                        <div class="cel_area amunt-detail cess"> <span class="hide_big">Package Name</span> 
                                            <span class="sm_size"> 
                                            <?php if(@$will->getPackage->packageDetail->id == 1){
                                                $viewUrl = route('user.manage.executor',[@$will->id]);

                                                }else if(@$will->getPackage->packageDetail->id == 2){
                                                $viewUrl = route('user.add.will.location',[@$will->id]);

                                                }else if(@$will->getPackage->packageDetail->id == 3){
                                                    $viewUrl = route('user.add.will.location',[@$will->id]);
                                                }else{
                                                    $viewUrl = "javacript:;";
                                                }
                                            ?>
                                            <a href="{{@$viewUrl}}">{{@$will->getPackage ? @$will->getPackage->packageDetail->package_name : '-'}}</a>
                                            </span>
                                        </div>

                                        <div class="cel_area amunt-detail cess"> <span class="hide_big">Start
                                                Date</span> <span class="sm_size">{{@$will->start_date ? date('d.m.Y',strtotime(@$will->start_date)) : '-'}}</span></div>

                                        {{--<div class="cel_area amunt-detail cess"> <span class="hide_big">Finalized
                                                On</span> <span class="sm_size">{{@$will->finalized_date ? date('d.m.Y',strtotime(@$will->finalized_date)) : '-'}}</span> </div>--}}

                                        <div class="cel_area amunt-detail cess"> <span class="hide_big">Finalized
                                                On</span> <span class="sm_size">
                                                <?php 
                                                    $w = getWillCount(@$will->id);
                                                ?>
                                                <?php if(@$will->getPackage->packageDetail->id == 1){
                                                    $finalize = getWillCount(@$will->id);

                                                    }else if(@$will->getPackage->packageDetail->id == 2){
                                                    $finalize = getLocationCount(@$will->id);

                                                    }else if(@$will->getPackage->packageDetail->id == 3){
                                                        $finalize = getLOICount(@$will->id);
                                                    }else{
                                                        $finalize = array('count'=>0, 'total'=>0);
                                                    }
                                                ?>
                                                {{$finalize['count']}}/{{$finalize['total']}} completed
                                                  </span> </div>
                                        <div class="cel_area amunt-detail cess"> <span class="hide_big">Status</span>
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
                                        </div>
                                        {{--<div class="cel_area amunt-detail cess"> <span class="hide_big">Approval Status</span>
                                        @switch(@$will->approval_status)
                                            @case(1)
                                                Awaiting Approval
                                                @break

                                            @case(2)
                                                Approved
                                                @break

                                            @case(3)
                                            Changes Suggested
                                                @break

                                            @default
                                                -
                                        @endswitch
                                        </div>--}}
                                        {{-- 1=>I, 2=>F, 3=>C, || 1=>AA, 2=>A, 3=>CS --}}
                                        <div class="cel_area amunt-detail cess btns_cell"> <span class="hide_big">Action</span>
                                            <ul>
                                                {{-- Package 1 --}}

                                                @if(@$will->getPackage->packageDetail->id == 1)
                                                    <li><a href="{{route('user.view.will',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">View</a></li>
                                                @endif

                                                @if(@$will->status == 1  && @$will->approval_status == 3 && @$will->getPackage->packageDetail->id == 1)
                                                    <li><a href="{{route('user.manage.executor',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">
                                                    
                                                    @if(checkWillExist(@$will->id) || checkBeneficiarExist(@$will->id) || checkExecutorsExist(@$will->id) || checkWitnessExist(@$will->id))
                                                    Complete Will
                                                    @else 
                                                    Start Will 
                                                    @endif 
                                                    
                                                </a></li>
                                                @endif

                                                {{--
                                                @if(@$will->getPackage->packageDetail->id == 1 && @$will->status == 1)
                                                    <li><a href="{{route('user.changes.suggested',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue wertttt">
                                                    Changes Suggested By Admin</a></li>
                                                @endif
                                                --}}

                                                @if(@$will->status == 1 && @$will->approval_status == 3 && checkWillExist(@$will->id))
                                                    {{-- <li><a href="javascript:;" class="css-tooltip-top color-blue submitWill"  data-id="{{@$will->id}}"><span>Submit for finalization</span> <img src="{{asset('public/images/upp.png')}}" alt=""></a></li> --}}
                                                    <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">Upload Final Will</a></li>
                                                @endif

                                                @if(@$will->status == 3)
                                                    <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">View Uploaded Will</a></li>
                                                @endif

                                                @if(checkWillExist(@$will->id) && checkBeneficiarExist(@$will->id) && checkExecutorsExist(@$will->id) && checkWitnessCount(@$will->id) > 1)
                                                    <li><a href="javascript:;" data-id="{{@$will->id}}" class="top_battn_new css-tooltip-top color-blue pdf_alrt">Generate and Download PDF</a></li>
                                                @endif

                                                {{-- Package 2 --}}

                                                @if(@$will->getPackage->packageDetail->id == 2 && checkWillAccess(@$will->id))
                                                    <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">Enter Location Information</a></li>
                                                @endif

                                                @if(@$will->getPackage->packageDetail->id == 2 )
                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">
                                                        @if(!checkWillAccess(@$will->id))
                                                        Add Nominee
                                                        @else 
                                                        Nominee
                                                        @endif
                                                    </a></li>
                                                @endif

                                                {{-- Package 3 --}}

                                                @if(@$will->getPackage->packageDetail->id == 3 && checkWillAccess(@$will->id))
                                                    <li><a href="{{route('user.add.will.location',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">Upload LOI</a></li>
                                                @endif

                                                @if(@$will->getPackage->packageDetail->id == 3 )
                                                    <li><a href="{{route('user.service.authorized',[@$will->id])}}" class="top_battn_new css-tooltip-top color-blue">
                                                        @if(!checkWillAccess(@$will->id))
                                                        Add Nominee
                                                        @else 
                                                        Nominee
                                                        @endif
                                                    </a></li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="row small_screen2 for_bg_color_01">
                                <div class="cel_area amunt-detail cess">No Record Found</div>
                            </div>
                                    @endif

                                </div>
                            </div>

                            <div class="col-lg-12 mb-4">
                            {{$wills->links('pagination')}}
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
<script>
    $(document).ready(function() {
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
