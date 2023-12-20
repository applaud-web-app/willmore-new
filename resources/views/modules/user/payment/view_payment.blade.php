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
                    <h2>View Payment</h2>
                    <a href="{{route('user.mypayments')}}" class="top_battn_new">Back</a>
                </div>
                <div class="dash-right-inr">

                    <div class="row login_rm02 for_dashboard">


                        <div class="col-lg-12">
                            <div class="instructions_aar dashboard_ppgg">
                                <h1>Payment ID: #{{@$paymentDetail->id}}</h1>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-2 mt-3">
                            <div class="doubleborder"></div>
                            <div class="doubleborder"></div>
                        </div>

                        <div class="col-lg-12">
                            <div class="instructions_aar profile_infop01">
                               <ul>
                                    <li> <strong>Package Name</strong> <span>: {{@$paymentDetail->getPackage ? @$paymentDetail->getPackage->package_name: '-'}}</span> </li>
                                    
                                    <li> <strong>Amount</strong> <span>: Rs. {{@$paymentDetail ? @$paymentDetail->price: '-'}}</span> </li>
                                    <li> <strong>Transaction Id</strong> <span>: {{@$paymentDetail ? @$paymentDetail->razorpay_payment_id: '-'}}</span> </li>
                                    
                                    <li> <strong>Status</strong> <span>: 
                                    @switch(@$paymentDetail->status)
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
                                    </span> </li>

                                    <li> <strong>Description</strong> <span>: {{@$paymentDetail ? @$paymentDetail->description: '-'}}</span> </li>
                                    
                                    <li> <strong>Payment Date</strong> <span>: {{ @$paymentDetail->created_at ? date('d.m.Y',strtotime(@$paymentDetail->created_at)) : '-' }}</span> </li>
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
@endsection
