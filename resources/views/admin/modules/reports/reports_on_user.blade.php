@extends('admin.layouts.app')
@section('title')
User Reports
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
            <h4 class="pull-left page-title">User Reports</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">User Reports</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading rm02 rm04">
                    <form role="form" action="{{route('reports.on.users')}}" method="get">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label class="form-label">Date From</label>
                            <input type="text" class="form-control" placeholder="Enter here" id="datepicker" name="from_date" value="{{@$key['from_date']}}"/>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                        @php
                            $date = date('m/d/Y');
                        @endphp
                        <div class="form-group">
                            <label class="form-label">Date To</label>
                            <input type="text" class="form-control" placeholder="Enter here" id="datepicker2" name="to_date"
                             @if(@$key == null)  value="{{@$date}}" @else value="{{@$key['to_date']}}" @endif/>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>

                        <div class="rm05" style="margin: 0px 0 0 12px;">
                            <button class="btn btn-primary waves-effect waves-light w-md"type="submit"> Get Reports </button>
                        </div>

                        <div class="rm05" style="margin: 0px 0 0 12px;">
                            <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('reports.on.users')}}"> Reset </a>
                        </div>
                    </form>
                  </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                <h4 class="new_headings_texts"> Total Registered Users : {{@$tot_user}}</h4>

                                <div class="panel panel-default panel-fill">

                                    <div class="panel-body info-panel new-backgrounds">

                                        <h4> Gender </h4>

                                        <div class="about-info-p">
                                            <strong>Male : {{@$tot_male}}</strong>
                                            <br />
                                            <p class="text-muted"></p>
                                        </div>

                                        <div class="about-info-p">
                                            <strong>Female : {{@$tot_female}}</strong>
                                            <br />
                                            <p class="text-muted"></p>
                                        </div>
                                    </div>
                                    <div class="panel-body info-panel new-backgrounds">

                                        <h4> Age Group </h4>

                                        <div class="about-info-p">
                                            <strong>Below 40 : {{@$blow_40}}</strong>
                                            <br />
                                            <p class="text-muted" style="word-break: break-word;"></p>
                                        </div>

                                        <div class="about-info-p">
                                            <strong>40 to 50 : {{@$age_40_50}}</strong>
                                            <br />
                                            <p class="text-muted" style="word-break: break-word;"></p>
                                        </div>

                                        <div class="about-info-p">
                                            <strong>50 to 60 : {{@$age_50_60}}</strong>
                                            <br />
                                            <p class="text-muted" style="word-break: break-word;"></p>
                                        </div>

                                        <div class="about-info-p m-b-0">
                                            <strong>Above 60  : {{@$above_60}}</strong>
                                            <br />
                                            <p class="text-muted"></p>
                                        </div>

                                    </div>
                                </div>

                                <!-- Personal-Information -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- content -->
@endsection
@section('footer')
@include('admin.includes.footer')
@endsection
@section('script')
@include('admin.includes.scripts')

<script>
      $(function () {
        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
      });
    </script>
    <script>
      $('[data-toggle="datepicker"]').datepicker();
    </script>
@endsection
