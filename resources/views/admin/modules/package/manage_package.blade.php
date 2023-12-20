@extends('admin.layouts.app')
@section('title')
Manage Packages
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
            <h4 class="pull-left page-title">Manage Packages</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage Packages</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Package Name</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th class="rm07">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($packages) >0)
                                            @foreach($packages as $val)
                                            <tr>
                                                <td>#{{@$val->id ? @$val->id : "-"}}</td>
                                                <td>{{@$val->package_name ? @$val->package_name : "-"}}</td>
                                                <td>₹{{@$val->package_price ? @$val->package_price : "-"}}</td>
                                                <td width="58%">
                                                @if(strlen(@$val->package_desc)>100)
                                                    {{ substr(@$val->package_desc,0,100) . '...' }}
                                                @else
                                                    {{ @$val->package_desc }}
                                                @endif
                                                </td>
                                                <td class="rm07">
                                                    <a href="javascript:void(0);" class="action-dots actionBtn"
                                                        id="action1"><img src="{{asset('public/admin/assets/images/action-dots.png')}}" alt="" /></a>

                                                    <div class="show-actions show-action" id="show-action1"
                                                        style="display: none">
                                                        <span class="angle"><img src="{{asset('public/admin/assets//images/angle.png')}}" alt="" /></span>

                                                        <ul>
                                                            <li><a href="{{route('view.package',[$val->id,'view'])}}">View</a></li>
                                                            <li><a href="{{route('edit.package',[$val->id,'edit'])}}">Edit</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="3">No record</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                {{$packages->links('pagination_admin')}}
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
      });
    </script>
    <script>
      $('[data-toggle="datepicker"]').datepicker();
    </script>
@endsection