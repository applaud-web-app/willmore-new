@extends('admin.layouts.app')
@section('title')
Reports on services
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
            <h4 class="pull-left page-title">Reports on services</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Reports on services</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading rm02 rm04">
                    <form role="form" action="{{route('reports.on.services')}}" method="get">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="">Package</label>
                            <select class="form-control rm06" name="package">
                            <option value="">Select</option>
                            @foreach (@$packages as $item)
                                <option value="{{@$item->id}}" @if(Request::get('package') == @$item->id) selected @endif>{{@$item->package_name}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Creation Date From</label>
                            <input type="text" class="form-control" placeholder="Enter here" id="datepicker" name="from_date" value="{{@$key['from_date']}}"/>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Creation Date To</label>
                            <input
                            type="text" class="form-control" placeholder="Enter here" id="datepicker2" name="to_date" value="{{@$key['to_date']}}"/>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>

                        <div class="rm05" style="margin: 0px 0 0 12px;">
                            <button class="btn btn-primary waves-effect waves-light w-md" type="submit"> Get Reports </button>
                        </div>
                        <div class="rm05" style="margin: 0px 0 0 12px;">
                            <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('reports.on.services')}}"> Reset </a>
                        </div>

                    </form>
                  </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <h4> Total Service Purchased : {{ @$tot_wills}}
                                    @if(@$tot_wills >0)
                                        <span style="margin-left: 50px" >Total Price :
                                        @php
                                            $sum = 0
                                        @endphp
                                        @foreach(@$wills as $key => $will)
                                            @php
                                                $sum += $will->getPackage->packageDetail->package_price;
                                            @endphp
                                        @endforeach
                                        ₹{{$sum}} </span>
                                    @endif
                                </h4>

                                @if(@$tot_wills >0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Package Name</th>
                                                <th>Price</th>
                                                <th>User Name</th>
                                                <th>Start Date</th>
                                                <th>Status</th>
                                                <th>Completed On</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach(@$wills as $key => $will)
                                            <tr>
                                                <td>{{@$key+1}}</td>
                                                <td width="20%" style="word-break: break-word;">{{@$will->getPackage ? @$will->getPackage->packageDetail->package_name : '-'}}</td>
                                                <td>{{@$will->getPackage ? @$will->getPackage->packageDetail->package_price : '-'}}</td>
                                                <td style="word-break: break-word;">{{@$will->userDetails ? @$will->userDetails->name : '-' }}</td>
                                                <td>{{@$will->start_date ? date('d.m.Y',strtotime(@$will->start_date)) : '-'}}</td>
                                                <td>
                                                  @if(@$will->status==1)
                                                      Inprogress
                                                  @elseif(@$will->status==2)
                                                      Finalized
                                                  @elseif(@$will->status==3)
                                                      Completed
                                                  @endif
                                                </td>
                                                <td>{{@$will->finalized_date ? date('d.m.Y',strtotime(@$will->finalized_date)) : '-'}}</td>
                                                <td>
                                                    <a href="{{route('view.will',[@$will->id])}}">
                                                    <span class="label label-info"> View Service</span></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{@$wills->links('pagination_admin')}}
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
$(document).ready(function() {
    $(".actionBtn").click(function() {
        $(".show-action").css('display', 'none');
        $(this).parent().find(".show-action").slideToggle();
        event.stopPropagation();
    });
    // $("#show-action1").click(function (event) {
    //   event.stopPropagation();
    // });
    $("html").click(function() {
        $(".show-action").slideUp();
    });
});
</script>
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
