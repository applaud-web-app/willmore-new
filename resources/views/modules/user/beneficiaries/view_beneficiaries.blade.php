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
                    <h2>View @if(@$locPack->package_id ==1 )Beneficiaries @elseif(@$locPack->package_id ==5 ) Trusted Person @else Nominee @endif</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    {{-- <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="top_battn_new">Back</a> --}}
                    @if(@$locPack->package_id ==1 )
                    <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="top_battn_new">Back to list</a>
                    @else
                    <a href="{{route('user.service.authorized',[@$will_id])}}" class="top_battn_new">Back to list</a>
                    @endif
                </div>

                <div class="dash-right-inr">
                @include('includes.message')

                <div class="row">
                        <div class="col-lg-6">
                            <div class="instructions_aar profile_infop01 executor_box">
                                <ul>
                                    <li> <strong>Name</strong> <span>: {{@$beneficiarDetail ? @$beneficiarDetail->name: ''}}</span> </li>
                                    <li> <strong>Aadhar Number</strong> <span>: {{@$beneficiarDetail ? @$beneficiarDetail->aadhar_number: ''}}</span> </li>
                                    <li> <strong>Email address</strong> <span>: {{@$beneficiarDetail ? @$beneficiarDetail->email: ''}}</span> </li>
                                    <li> <strong>Mobile number</strong> <span>: {{@$beneficiarDetail->phonecode ? '+'.@$beneficiarDetail->getPhonecode->phonecode : ''}} {{@$beneficiarDetail ? @$beneficiarDetail->mobile: ''}}</span> </li>
                                    <li> <strong>Citizen of</strong> <span>: {{@$beneficiarDetail ? @$beneficiarDetail->getNationality->name: ''}}</span> </li>
                                    <li> <strong>Relationship Description</strong> <span>: {{@$beneficiarDetail ? @$beneficiarDetail->relationship: ''}}</span> </li>
                                </ul>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="instructions_aar profile_infop01 executor_box">
                                    <ul>
                                        <li> <strong>City</strong> <span>: {{@$beneficiarDetail ? @$beneficiarDetail->city: ''}}</span> </li>
                                        <li> <strong>State</strong> <span>: {{@$beneficiarDetail ? @$beneficiarDetail->state: ''}}</span> </li>
                                        <li> <strong>Country</strong> <span>: {{@$beneficiarDetail ? @$beneficiarDetail->getCountry->name: ''}}</span> </li>
                                        <li> <strong>Address</strong> <span>: {{@$beneficiarDetail->address1.' , '.@$beneficiarDetail->address2}}</span> </li>
                                        <li> <strong>Created on</strong> <span>: {{ @$beneficiarDetail->created_at ? date('d.m.Y',strtotime(@$beneficiarDetail->created_at)) : '-' }}</span> </li>
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
