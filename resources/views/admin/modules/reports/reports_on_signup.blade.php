@extends('admin.layouts.app')
@section('title')
Reports on sign up
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
            <h4 class="pull-left page-title">Reports on sign up</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Reports on sign up</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading rm02 rm04">
                    <form role="form" action="{{route('reports.on.signup')}}" method="get">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label class="form-label">Sign Up Date From</label>
                            <input type="text" class="form-control" placeholder="Enter here" id="datepicker" name="from_date" value="{{@$key['from_date']}}"/>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Sign Up Date To</label>
                            <input
                            type="text" class="form-control" placeholder="Enter here" id="datepicker2" name="to_date" value="{{@$key['to_date']}}"/>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>

                        <div class="rm05" style="margin: 0px 0 0 12px;">
                            <button class="btn btn-primary waves-effect waves-light w-md"type="submit"> Get Reports </button>
                        </div>

                        <div class="rm05" style="margin: 0px 0 0 12px;">
                            <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('reports.on.signup')}}"> Reset </a>
                        </div>
                    </form>
                  </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <h4> Total Sign Up : {{ @$tot_user}} </h4>

                                @if(@$tot_user >0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>DOB</th>
                                                <th>Country</th>
                                                <th>Registered on</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach(@$users as $key => $val)
                                            <tr>
                                                <td>{{@$key+1}}</td>
                                                <td width="20%" style="word-break: break-word;">{{@$val->name ? @$val->name : "-"}}</td>
                                                <td>{{@$val->email ? @$val->email : "-"}}</td>
                                                <td>{{@$val->phonecode ? '+'.@$val->getPhonecode->phonecode : ''}} {{@$val->mobile ? @$val->mobile : "-"}}</td>
                                                <td>{{date("d.M.Y",strtotime($val->dob))}}</td>
                                                <td>{{@$val->country  ? @$val->getCountry->name  : "-"}}</td>
                                                <td>{{date("d.M.Y",strtotime($val->created_at))}}</td>
                                                <td>
                                                @if(@$val->status=='A')
                                                    Active
                                                @elseif(@$val->status=='I')
                                                    Inactive
                                                @else
                                                    Unverified
                                                @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('view.user',[$val->id])}}">
                                                    <span class="label label-info"> View User</span></a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                {{@$users->links('pagination_admin')}}
                                @endif
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
