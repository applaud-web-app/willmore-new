@extends('admin.layouts.app')
@section('title')
User Details
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
                <h4 class="pull-left page-title">User Details</h4>

                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>

                    <li class="active">User Details</li>
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
                                    <h3 class="panel-title">Personal Information</h3>
                                    <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.user')}}" >
                                    Back
                                    </a>
                                </div>

                                <div class="panel-body info-panel">
                                    <div class="about-info-p">
                                        <strong>Full Name</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->name ? $user->name : '-' }}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>User Name</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->username ? $user->username : '-' }}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>
                                            @if(@$user->user_relation=='S')
                                                Son of
                                            @elseif(@$user->user_relation=='D')
                                                Daughter of
                                            @elseif(@$user->user_relation=='H')
                                                Husband of
                                            @elseif(@$user->user_relation=='W')
                                                Wife of
                                            @endif
                                        </strong>
                                        <br />
                                        <p class="text-muted">{{@$user->relationship}}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Mobile</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->phonecode ? '+'.@$user->getPhonecode->phonecode : ''}} {{@$user->mobile ? @$user->mobile : '-'}}
                                            @if(@$user->is_mobile_verified == 'Y') (Verified) @elseif(@$user->is_mobile_verified == 'N') (Un-Verified) @endif
                                        </p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Email</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{@$user->email}}
                                            @if(@$user->is_email_verify == 'Y') (Verified) @elseif(@$user->is_email_verify == 'N') (Un-Verified) @endif
                                        </p>
                                    </div>
                                    
                                    <div class="about-info-p m-b-0">
                                        <strong>Date of birth</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->dob ? date("d.M.Y",strtotime($user->dob)) : "-"}}</p>
                                    </div>

                                    @if(@$user->aadhar_number)
                                    <div class="about-info-p">
                                        <strong>Aadhar Number</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{@$user->aadhar_number}}</p>
                                    </div>
                                    @endif

                                    @if(@$user->passport_number)
                                    <div class="about-info-p">
                                        <strong>Passport Number</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{@$user->passport_number}}</p>
                                    </div>
                                    <div class="about-info-p">
                                        <strong>Issued date</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{@$user->passport_issued_date}}</p>
                                    </div>
                                    <div class="about-info-p">
                                        <strong>Date of Expiry</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{@$user->passport_expiry_date}}</p>
                                    </div>
                                    @endif

                                    <div class="about-info-p">
                                        <strong>Pan Number</strong>
                                        <br />
                                        <p class="text-muted" style="word-break: break-word;">{{@$user->pan_number}}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Location</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->city ? @$user->city : ""}}, {{@$user->state ? @$user->state : ""}}, {{@$user->getCountry->name ? @$user->getCountry->name : "-"}}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Post Code</strong>
                                        <br />
                                        <p class="text-muted"> {{@$user->zip_code}}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Nationality</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->getNationality->name ? @$user->getNationality->name : "-"}}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Date of birth</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->dob ? date("d.M.Y",strtotime($user->dob)) : "-"}}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Gender</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->gender }}</p>
                                    </div>

                                    @if(@$user->temp_email)
                                    <div class="about-info-p m-b-0">
                                        <strong>Temp Email</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->temp_email}}</p>
                                    </div>
                                    @endif

                                    @if(@$user->temp_mobile)
                                    <div class="about-info-p m-b-0">
                                        <strong>Temp Mobile</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->temp_mobile}}</p>
                                    </div>
                                    @endif

                                    <div class="about-info-p m-b-0">
                                        <strong>Last Sign In</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->last_sign_in ? date('d.m.Y',strtotime(@$user->last_sign_in)) : '-' }}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Registered on</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->created_at ? date('d.m.Y',strtotime(@$user->created_at)) : '-' }}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Status</strong>
                                        <br />
                                        <p class="text-muted">
                                            @if(@$user->status=='A')
                                                Active
                                            @elseif(@$user->status=='I')
                                                Inactive
                                            @else
                                                Unverified
                                            @endif
                                        </p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Address</strong>
                                        <br />
                                        <p class="text-muted">{{@$user->address1}}, {{@$user->address2}}</p>
                                    </div>

                                </div>
                            </div>

                            <div class="panel panel-default panel-fill">
                                <div class="panel-heading">
                                    <h3 class="panel-title">My Packages</h3>
                                </div>

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>

                                                    <th>Package Name</th>

                                                    <th>Start Date</th>

                                                    <th>Finalized On</th>

                                                    <th>Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @if(count(@$wills) > 0)
                                            @foreach(@$wills as $will)
                                                <tr>
                                                    <td>#{{@$will->id}}</td>

                                                    <td>{{@$will->getPackage ? @$will->getPackage->packageDetail->package_name : '-'}} </td>

                                                    <td>{{@$will->start_date ? date('d.m.Y',strtotime(@$will->start_date)) : '-'}}</td>

                                                    <td>{{@$will->finalized_date ? date('d.m.Y',strtotime(@$will->finalized_date)) : '-'}}</td>

                                                    <td>
                                                        <span class="label label-info">
                                                        @switch(@$will->status)
                                                            @case(1)
                                                            In Progress
                                                                @break

                                                            @case(2)
                                                                Finalized
                                                                @break

                                                            @case(3)
                                                            Completed
                                                                @break

                                                            @default
                                                                -
                                                        @endswitch
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('view.will',[@$will->id])}}">
                                                        <span class="label label-info">
                                                            View
                                                        </span>
                                                    </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{$wills->links('pagination_admin')}}
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
