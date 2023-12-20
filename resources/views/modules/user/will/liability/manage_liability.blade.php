@extends('layouts.app')
@section('title','Manage Liability')
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
                @include('includes.will_sidebar')
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="cus-dashboard-right didlex des-chng">

                    <h2>Manage Liability</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.add.liability',[@$will_id])}}" class="top_battn_new">Add Liability</a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">

                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Type</div>
                                <div class="cel_area amunt cess">Lender Name</div>
                                <div class="cel_area amunt cess">Amount's Outstanding</div>
                                <div class="cel_area amunt cess">Payment Schedule</div>
                                <div class="cel_area amunt cess">Payment Amount</div>
                                <div class="cel_area amunt cess">Description </div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$liability) > 0)
                            @foreach(@$liability as $val)
                            <div class="row small_screen2 for_bg_color_01 table_box">
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Type</span>
                                    <span class="sm_size">{{@$val->type}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Lender Name
                                    </span> <span class="sm_size">{{@$val->lender_name}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Amount's Outstanding</span>
                                    <span class="sm_size">₹ {{@$val->amount}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Payment
                                        Schedule</span> <span
                                        class="sm_size">{{@$val->payment_schedule}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Payment
                                    Amount</span> <span
                                    class="sm_size">{{@$val->payment_amount}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Description
                                    </span> <span class="sm_size">
                                    @if(strlen(@$val->description)>60)
                                        {{ substr(@$val->description,0,60) . '...' }}
                                    @else
                                        {{ @$val->description }}
                                    @endif
                                    </span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li><a href="{{url('view-liability/'.@$will_id.'/'.@$val->id)}}"
                                                class="css-tooltip-top color-blue"><span>Edit</span>
                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                        <li><a href="javascript:;" class="css-tooltip-top color-blue delete_liability"
                                                data-id="{{@$val->id}}"><span>Delete</span>
                                                <img src="{{asset('public/images/remove1.png')}}" alt=""></a></li>
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

                    <div class="col-lg-12">
                        {{$liability->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                    <a href="{{route('user.add.liability',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                        @if(count(@$liability) > 0)
                        Add another Liability
                        @else
                        Add Liability
                        @endif
                    </a>
                    {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
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
    $('.delete_liability').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this record ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-liability')}}/" + id;
            } else {
                return false;
            }
        });
    });
});
</script>


@endsection
