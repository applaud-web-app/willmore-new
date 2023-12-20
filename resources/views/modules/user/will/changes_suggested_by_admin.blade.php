@extends('layouts.app')
@section('title','')
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
                @include('includes.message')
                <div class="cus-dashboard-right didlex">
                    <h2>Changes Suggested for Will</h2>
                    <a href="{{route('user.mywill')}}" class="top_battn_new">Back</a>
                </div>

                <div class="dash-right-inr">
                    <b style="margin-left: 20px;">Will ID: #{{@$will_id}}</b>
                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">
                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Date</div>
                                <div class="cel_area amunt cess">Changes Suggested</div>
                                <div class="cel_area amunt cess">Attachments</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$messages) > 0)
                            @foreach(@$messages as $data)
                            <div class="row small_screen2 for_bg_color_01">
                                <div class="cel_area amunt-detail cess">
                                    <span class="hide_big">Date</span>
                                    <span class="sm_size"><a href="manage_cash.html">{{@$data->created_at ? date('d.m.Y', strtotime(@$data->created_at)) : '--'}}</a>
                                    </span>
                                </div>
                                <div class="cel_area amunt-detail cess">
                                    <span class="hide_big">Changes Suggested</span>
                                    <span class="sm_size">
                                        <p>
                                           {{@$data->message}}
                                        </p>
                                    </span>
                                </div>
                                <div class="cel_area amunt-detail cess">
                                    <span class="hide_big">Attachments</span>
                                    <span class="sm_size">
                                        @if(@$data->attachments)
                                        <a href="{{url('storage\app\admin\will_message')}}\{{@$data->attachments}}" download="" style="color:#086fc6 !important;" class="css-tooltip-top color-blue" ><span>Download Attachment</span>
                                           {{@$data->attachments}}
                                        </a>
                                        @else
                                        --
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="row small_screen2 for_bg_color_01">
                                <div class="cel_area amunt-detail cess">No Record Found</div>
                            </div>
                            @endif
                            <!--table row-2-->
                        </div>
                        <div class="col-lg-12 mb-4">
                            {{$messages->links('pagination')}}
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
