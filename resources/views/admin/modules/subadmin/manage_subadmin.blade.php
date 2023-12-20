@extends('admin.layouts.app')
@section('title')
Manage Sub Admin
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
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage Sub Admin</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading">
                        <h3 class="panel-title">Manage Sub Admin</h3>

                        <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('create.subadmin')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Create Sub Admin
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th class="rm07">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($subadmins) >0)
                                            @foreach($subadmins as $subadmin)
                                            <tr>
                                                <td class="sorting_1">{{$subadmin->name}}</td>
                                                <td>
                                                    @if(@$subadmin->image)
                                                    <img src="{{URL::to('storage/app/admin/profileImage/').'/'.$subadmin->image}}"
                                                        height=40>
                                                    @else
                                                    <p>No Image</p>
                                                    @endif
                                                </td>
                                                <td>{{$subadmin->email}}</td>
                                                <td>
                                                @if(@$subadmin->status=='A')
                                                    Active
                                                @elseif(@$subadmin->status=='I')
                                                    Inactive
                                                @else
                                                    -
                                                @endif
                                                </td>

                                                <td class="rm07">
                                                    <a href="javascript:void(0);" class="action-dots actionBtn"
                                                        id="action1"><img
                                                            src="{{asset('public/admin/assets/images/action-dots.png')}}"
                                                            alt="" /></a>

                                                    <div class="show-actions show-action" id="show-action1"
                                                        style="display: none">
                                                        <span class="angle"><img
                                                                src="{{asset('public/admin/assets//images/angle.png')}}"
                                                                alt="" /></span>

                                                        <ul>

                                                            <li><a href="{{route('create.subadmin',[$subadmin->id])}}">Edit
                                                                </a></li>

                                                            <li><a href="{{route('delete.subadmin',[$subadmin->id])}}"
                                                                    onclick="return confirm('Do you want to delete this sub-admin account ?')">Delete</a>
                                                            </li>

                                                            @if($subadmin->status == 'A')
                                                            <li><a href="{{route('active.subadmin',[$subadmin->id])}}" onclick="return confirm('Do you want to block this sub-admin ?')">Inactivate</a>
                                                            </li>
                                                            @elseif($subadmin->status == 'I')
                                                            <li><a href="{{route('active.subadmin',[$subadmin->id])}}" onclick="return confirm('Do you want to unblock this sub-admin ?')">Activate</a>
                                                            </li>
                                                            @endif
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

                                {{$subadmins->links('pagination_admin')}}
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
@endsection