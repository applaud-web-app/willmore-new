@extends('admin.layouts.app')
@section('title')
Payment Details
@endsection
@section('links')
@include('admin.includes.links')
@endsection
@section('headers')
@include('admin.includes.header')
@endsection
@section('sidebar')
@include('admin.includes.sidebar')
@endsection
@section('content')
<div class="content">
    <div class="wraper container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Payment Details</h4>

                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>

                    <li class="active">Payment Details</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default panel-fill">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Payment ID: #{{@$paymentDetail->id}}</h3>
                                    <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.payment')}}" >
                                    Back
                                    </a>
                                </div>

                                <div class="panel-body info-panel">
                                    <div class="about-info-p">
                                        <strong>User Name</strong>
                                        <br />
                                        <p class="text-muted">{{@$paymentDetail->getUser->name ? $paymentDetail->getUser->name : '-' }}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Mobile</strong>
                                        <br />
                                        <p class="text-muted">{{@$paymentDetail->getUser->phonecode ? '+'.@$paymentDetail->getUser->getPhonecode->phonecode : ''}} {{@$paymentDetail->getUser->mobile ? @$paymentDetail->getUser->mobile : '-'}}
                                            @if(@$paymentDetail->getUser->is_mobile_verified == 'Y') (Verified) @elseif(@$paymentDetail->getUser->is_mobile_verified == 'N') (Un-Verified) @endif
                                        </p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Email</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{@$paymentDetail->getUser->email}}
                                            @if(@$paymentDetail->getUser->is_email_verify == 'Y') (Verified) @elseif(@$paymentDetail->getUser->is_email_verify == 'N') (Un-Verified) @endif
                                        </p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Transaction ID</strong>
                                        <br />
                                        <p class="text-muted">{{@$paymentDetail->razorpay_payment_id ? @$paymentDetail->razorpay_payment_id: '-'}}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Package Name</strong>
                                        <br />
                                        <p class="text-muted">{{@$paymentDetail->getPackage ? @$paymentDetail->getPackage->package_name: '-'}}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Amount</strong>
                                        <br />
                                        <p class="text-muted">Rs. {{@$paymentDetail ? @$paymentDetail->price: '-'}}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>
                                        Status
                                        </strong>
                                        <br />
                                        <p class="text-muted">
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
                                        </p>
                                    </div>


                                    <div class="about-info-p">
                                        <strong>Description</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{@$paymentDetail ? @$paymentDetail->description: '-'}}
                                        </p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Payment Date</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{ @$paymentDetail->created_at ? date('d.m.Y',strtotime(@$paymentDetail->created_at)) : '-' }}</p>
                                    </div>

                                </div>
                            </div>


                            <!-- Personal-Information -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>
        <!-- content -->
        @endsection
        @section('footer')
        @include('admin.includes.footer')
        @endsection
        @section('script')
        @include('admin.includes.scripts')

        @endsection
