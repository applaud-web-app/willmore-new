@extends('layouts.app')
@section('title','View Executor')
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
                    <h2>View Executor</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    <a href="{{route('user.manage.executor',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                <div class="dash-right-inr">
                @include('includes.message')

                <div class="row">
                        <div class="col-lg-6">
                            <div class="instructions_aar profile_infop01 executor_box">
                                <ul>
                                    <li> <strong>Name</strong> <span>: {{@$executorDetail ? @$executorDetail->name: ''}}</span> </li>
                                    <li> <strong>Aadhar Number</strong> <span>: {{@$executorDetail ? @$executorDetail->aadhar_number: ''}}</span> </li>
                                    <li> <strong>Email address</strong> <span>: {{@$executorDetail ? @$executorDetail->email: ''}}</span> </li>
                                    <li> <strong>Mobile number</strong> <span>: {{@$executorDetail->phonecode ? '+'.@$executorDetail->getPhonecode->phonecode : ''}} {{@$executorDetail ? @$executorDetail->mobile: ''}}</span> </li>
                                    <li> <strong>Citizen of</strong> <span>: {{@$executorDetail ? @$executorDetail->getNationality->name: ''}}</span> </li>
                                    <li> <strong>Relationship Description</strong> <span>:
                                    @if(@$executorDetail->user_relation == 'S')
                                            Son of
                                        @elseif(@$executorDetail->user_relation == 'W')
                                            Wife of
                                        @elseif(@$executorDetail->user_relation == 'D')
                                            Daughter of
                                        @elseif(@$executorDetail->user_relation == 'H')
                                            Husband of
                                        @endif
                                        {{@$executorDetail ? @$executorDetail->relationship: ''}}</span> </li>
                                    <li> <strong>Relation between Executor and Will creator</strong> <span>: {{@$executorDetail ? @$executorDetail->exe_willcreator_relation: ''}}</span> </li>
                                </ul>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="instructions_aar profile_infop01 executor_box">
                                    <ul>
                                        <li> <strong>City</strong> <span>: {{@$executorDetail ? @$executorDetail->city: ''}}</span> </li>
                                        <li> <strong>State</strong> <span>: {{@$executorDetail ? @$executorDetail->state: ''}}</span> </li>
                                        <li> <strong>Country</strong> <span>: {{@$executorDetail ? @$executorDetail->getCountry->name: ''}}</span> </li>
                                        <li> <strong>Address</strong> <span>: {{@$executorDetail->address1.' , '.@$executorDetail->address2}}</span> </li>
                                        <li> <strong>Created on</strong> <span>: {{ @$executorDetail->created_at ? date('d.m.Y',strtotime(@$executorDetail->created_at)) : '-' }}</span> </li>
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
