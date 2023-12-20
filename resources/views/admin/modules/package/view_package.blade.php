@extends('admin.layouts.app')
@section('title')
Package Details
@endsection
@section('links')
@include('admin.includes.links')
<style>
    .about-info-p {
    width: 100%;
}
.panel .panel-body p {
    font-size: 15px;
}
</style>
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
                <h4 class="pull-left page-title">Package Details</h4>

                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>

                    <li class="active">Package Details</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default panel-fill">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Package Information</h3>
                                    <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.package')}}" >
                                    Back
                                    </a>
                                </div>

                                <div class="panel-body info-panel">
                                    <div class="about-info-p">

                                        <p class="text-muted">
                                        <strong>Package Name</strong>: {{@$package->package_name ? $package->package_name : '-' }}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <p class="text-muted"><strong>Price</strong>: ₹ {{@$package->package_price ? @$package->package_price : '-'}}</p>
                                    </div>

                                    <div class="about-info-p">

                                        <p class="text-muted" style="word-break: break-word;">
                                        <strong>Description</strong>: {{@$package->package_desc}}</p>
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
        <script type="text/javascript">
        $(document).ready(function() {

            $('#usernamefrm').validate({
                rules: {
                    username: {
                        required: true
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                },
            });
            $('#dobFrm').validate({
                rules: {
                    dob: {
                        required: true
                    },
                },
                submitHandler: function(form) {
                    var age = $('#datepicker-example8').val();
                    var getAge = Math.floor((new Date() - new Date(age).getTime()) / 3.15576e+10)
                    if (getAge < 18) {
                        $('.dob_error').html('Sorry, age must be 18 years.');
                        $('.dob_error').show();
                        return false;
                    } else {
                        $('#datepicker-example8 .error').html('');
                        form.submit();
                    }
                },
            });

            $('#dsFrm').validate({
                rules: {
                    dignity_score: {
                        required: true,
                        number: true
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                },
            });
        });
        </script>
        @endsection