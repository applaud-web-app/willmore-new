@extends('layouts.app')
@section('title','My Payments')
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
                    @include('includes.message')
                <div class="cus-dashboard-right didlex">
                    <h2>My Payments</h2>
                </div>

                <div class="dash-right-inr payment_page">

                    <form method="get" action="{{route('user.mypayments')}}">
                        <div class="row login_rm02 for_dashboard">

                            <div class="for_filter_srch001 refinee1">
                                <div class="form-group">
                                    <label>From date</label>
                                    <input type="text" name="from_date" value="{{@$key['from_date']}}" class="rm_form_fild calandar_iconn" placeholder="Select"
                                        id="datepicker">
                                </div>
                            </div>

                            <div class="for_filter_srch001 refinee1">
                                <div class="form-group">
                                    <label>To date</label>
                                    <input type="text" name="to_date" value="{{@$key['to_date']}}" class="rm_form_fild calandar_iconn" placeholder="Select"
                                        id="datepicker2">
                                </div>
                            </div>

                            <div class="for_filter_srch001 refinee1">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="rm_form_fild" name="status">
                                    <option vlaue="">Select</option>
                                        <option value="1" {{@$key['status'] == 1 ? 'selected' : ''}}>Completed</option>
                                        <option value="2" {{@$key['status'] == 2 ? 'selected' : ''}}>Pending</option>
                                        <option value="3" {{@$key['status'] == 3 ? 'selected' : ''}}>Cancel</option>
                                    </select>
                                </div>
                            </div>

                            <div class="for_filter_srch002 refinee2">
                                <button type="submit" class="submit_rm" id="submit">Search</button>
                            </div>

                            <div class="col-lg-12 mb-4 mt-1">
                                <div class="doubleborder"></div>
                            </div>

                            <div class="w-100"></div>
                    </form>

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table payment_table">

                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Id</div>
                                <div class="cel_area amunt cess">Transaction Id</div>
                                <div class="cel_area amunt cess">Date</div>
                                <div class="cel_area amunt cess">Amount</div>
                                <div class="cel_area amunt cess">Description</div>
                                <div class="cel_area amunt cess">Status</div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$payments) > 0)
                            @foreach(@$payments as $val)
                            <div class="row small_screen2 for_bg_color_01">
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Id</span> <span
                                        class="sm_size">#{{@$val->id}} </span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Transaction Id</span>
                                    <span class="sm_size">{{@$val->razorpay_payment_id}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Date</span>
                                    <span class="sm_size">{{@$val->created_at ? date('d.m.Y',strtotime(@$val->created_at)) : '-'}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Amount</span>
                                    <span class="sm_size">₹ {{@$val->price}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Description</span> <span
                                        class="sm_size">{{@$val->description ? @$val->description : '-'}}</span> </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Status</span>
                                @switch(@$val->status)
                                            @case(1)
                                            Completed
                                                @break

                                            @case(2)
                                                Pending
                                                @break

                                            @case(3)
                                            Cancel
                                                @break

                                            @default
                                                -
                                        @endswitch
                                </div>

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li><a href="{{route('view.payment',[@$val->id])}}" class="css-tooltip-top color-blue"><span>View</span>
                                                <img src="{{asset('public/images/view.png')}}" alt=""></a></li>
                                        {{--<li><a href="javascript:;" class="css-tooltip-top color-blue delete_payment"
                                                data-id="{{@$val->id}}"><span>Delete</span>
                                                <img src="{{asset('public/images/remove1.png')}}" alt=""></a></li>--}}
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
                        {{$payments->links('pagination')}}
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
        $('.delete_payment').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this record ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-payment')}}/" + id;
            } else {
                return false;
            }
        });
    });
    });
</script>
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
