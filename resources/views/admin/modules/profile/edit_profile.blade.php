@extends('admin.layouts.app')
@section('title')
Edit Profile
@endsection
@section('links')
@include('admin.includes.links')
<style>
.uplodpic img {
    /* position: absolute; */
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    /* max-width: 100%;
    max-height: 100%; */
    width: 20%;
    height: 100%;
    margin-top: 20px;
    margin-bottom: 20px;
    z-index: 1;
    object-fit: cover;
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
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Edit Profile</li>
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
                            <h3 class="panel-title">Edit Profile</h3>
                        </div>

                        <div class="panel-body rm04">
                            <form id="EditProfileForm" action="{{route('update.admin.profile')}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{@$profile->id}}" id="ID">
                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="FullName">Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                            value="{{@$profile->name}}">
                                    </div>
                                </div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="email" id="email" placeholder="Enter Email" class="form-control"
                                            name="email" value="{{@$profile->email}}">
                                    </div>
                                </div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <label for="ProfileImg" class="col-form-label">Profile Image</label>
                                    <input id="ProfileImg" type="file" class="form-control" name="image">
                                    <div class="uplodpic uplodprofilepic">
                                        @if(@$profile->image)
                                        <img src="{{asset('storage/app/admin/profileImage/'.@$profile->image)}}">
                                        @else
                                        <img src="{{asset('public/images/avatar.png')}}">
                                        @endif
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
            email: {
                required: true,email: true
            },
            name: {
                required: true
            },
            cpassword: {
                equalTo: "#password"
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
    });
});
//Select Profile Pic
$(function() {
    $("#ProfileImg").change(function() {
        $('.uplodprofilepic').html('');
        let files = this.files;
        
        if (files.length > 0) {
            let exts = ['image/jpeg', 'image/png', 'image/gif'];
            let valid = true;
            $.each(files, function(i, f) {
                if (exts.indexOf(f.type) <= -1) {
                    valid = false;
                    return false;
                }
            });
            if (!valid) {
                alert('Please choose valid image files (jpeg, png, gif) only.');
                $("#ProfileImg").val('');
                return false;
            }
            $.each(files, function(i, f) {
                var reader = new FileReader();
                reader.onload = function(e) { 
                    $('.uplodprofilepic').append('<img src="' + e.target.result +
                        '">');
                };
                reader.readAsDataURL(f);
            });
        }

    });
});
</script>
@endsection