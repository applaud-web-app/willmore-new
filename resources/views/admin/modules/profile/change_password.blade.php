@extends('admin.layouts.app')
@section('title')
Change Password
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
                    <li class="active">Change Password</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <!-- Personal-Information -->

                    <div class="panel panel-default panel-fill">
                        <div class="panel-heading">
                            <h3 class="panel-title">Change Password</h3>
                        </div>

                        <div class="panel-body rm04">
                            <form id="EditProfileForm" action="{{route('update.admin.password')}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{@$profile->id}}" id="ID">
                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="FullName">Password</label>
                                        <input id="password" type="password" placeholder="Password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="Email">Confirm Password</label>
                                        <input type="password" placeholder="Confirm Password" class="form-control" name="cpassword">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary ">Update</button>
                                </div>
                            </form>
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
<script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    validator = $('#EditProfileForm').validate({
        rules: {
            password: {
                required: true
            },
            cpassword: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            cpassword: {
                equalTo: 'Confirm password must be equal to Password field'
            },
        },
        submitHandler: function(form) {
            form.submit();
        },
    });
});

</script>
@endsection