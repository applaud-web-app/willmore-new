@extends('layouts.app')
@section('title','View Beneficiaries')
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
                <div class="cus-dashboard-right didlex nwdes-sec">
                    <h2>View Witness</h2>
                    {{-- <p>If you wish to add a new beneficiary please add that before adding the asset details.</p> --}}
                    <a href="{{route('user.manage.witness',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                <div class="dash-right-inr">
                @include('includes.message')

                <div class="row">
                        <div class="col-lg-6">
                            <div class="instructions_aar profile_infop01 executor_box">
                                <ul>
                                    <li> <strong>Name</strong> <span>: {{@$witnessDetail->salutation}} {{@$witnessDetail ? @$witnessDetail->name: ''}}</span> </li>
                                    @if(@$witnessDetail->aadhar_number)<li> <strong>Aadhar Number</strong> <span>: {{@$witnessDetail ? @$witnessDetail->aadhar_number: ''}}</span> </li>@endif
                                    {{-- <li> <strong>Place of Signature</strong> <span>: {{@$witnessDetail ? @$witnessDetail->sign_place: ''}}</span> </li>
                                    <li> <strong>Date of Signature</strong> <span>: {{ @$witnessDetail->sign_date ? date('d.m.Y',strtotime(@$witnessDetail->sign_date)) : '-' }}</span> </li>
                                    <li> <strong>Created on</strong> <span>: {{ @$witnessDetail->created_at ? date('d.m.Y',strtotime(@$witnessDetail->created_at)) : '-' }}</span> </li> --}}

                                    <li> <strong>City</strong> <span>: {{@$witnessDetail ? @$witnessDetail->city: ''}}</span> </li>
                                        <li> <strong>State</strong> <span>: {{@$witnessDetail ? @$witnessDetail->state: ''}}</span> </li>
                                </ul>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="instructions_aar profile_infop01 executor_box">
                                    <ul>
                                        <li> <strong>Country</strong> <span>: {{@$witnessDetail ? @$witnessDetail->getCountry->name: ''}}</span> </li>
                                        <li> <strong>Address</strong> <span>: {{@$witnessDetail->address1.' , '.@$witnessDetail->address2}}</span> </li>
                                        <li> <strong>Post Code</strong> <span>: {{@$witnessDetail ? @$witnessDetail->zip_code: ''}}</span> </li>
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
