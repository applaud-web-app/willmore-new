@extends('admin.layouts.app')
@section('title')
@if(@$subadmin) Update @else Create @endif Sub Admin
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
.custom_file_label {
    z-index: 1;
    height: calc(2.25rem + 15px);
    padding: 6px;
    line-height: 1.5;
    border: 1px solid #262626;
    border-radius: .25rem;
    background: #262626;
    color: #fff;
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
                    <li class="active">@if(@$subadmin) Update @else Create @endif Sub Admin </li>
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
                            <h3 class="panel-title">@if(@$subadmin) Update @else Create @endif Sub Admin</h3>
                            <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.subadmin')}}" >
                            Back
                            </a>
                        </div>

                        <div class="panel-body rm04">
                        <form id="create_subadmin" action="{{route('store.subadmin')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="ID" id="ID" value="{{@$subadmin->id}}">

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input name="name" type="text" class="form-control required lettersonly" placeholder="Type here" value="{{@subadmin ? @$subadmin->name : ''}}">
                                    </div>
                                </div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                    <label class="col-form-label">Email </label>
                                    <input type="email" name="email" id="email" class="form-control required" placeholder="Type here" value="{{@subadmin ? @$subadmin->email : ''}}">
                                    </div>
                                </div>

                                @if(@$subadmin)
                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Old Password </label>
                                        <input type="password" name="old_password" id="old_password" class="form-control" placeholder="*********">
                                    </div>
                                </div>
                                @endif

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="FullName">Password</label>
                                        <input type="password" name="password" id="password" class="form-control required" placeholder="*********">
                                    </div>
                                </div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="Email">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control required" placeholder="*********">
                                    </div>
                                </div>
                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-5 col-12 pad-l imgdiv">
                                    <input type="file" class="custom-file-input" id="customFile" name="image" style="display:none">
                                    <label class="custom_file_label extrlft" for="customFile">Upload Image</label>
                                    <div class="uplodpic uploadImg">
                                        @if(@$subadmin->image)
                                            <img src="{{URL::to('storage/app/admin/profileImage/').'/'.$subadmin->image}}">
                                        @else
                                        <img src="{{asset('public/images/avatar.png')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary ">@if(@$subadmin) Update @else Create @endif</button>
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
    $(document).ready(function(){
        var type= "{{@$subadmin ? 'Edit' : 'Create'}}";
        console.log(type);
        $("#customFile").change(function () {
            $('.uploadImg').html('');
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
                if (! valid) {
                    alert('Please choose valid image files (jpeg, png, gif) only.');
                    $("#customFile").val('');
                    return false;
                }
                $.each(files, function(i, f) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('.uploadImg').append('<img src="' + e.target.result + '">');
                    };
                    reader.readAsDataURL(f);
                });
            }

        });


        jQuery.validator.addMethod("letterspaceonly", function(value, element) {
            return this.optional(element) || /^[A-Za-z ]+$/i.test(value);
        }, "Letters or spaces only please");

        $('#create_subadmin').validate({
         rules:{
            name:{ required:true, letterspaceonly:true },
            email:{ required:true,
                remote: {
	              		url: '{{ route("admin.email.check") }}',
	              		type: "post",
	              		data: {
			                email: function() {
			                  return $( "#email" ).val();
                            },
                            id: function() {
			                  return $( "#ID" ).val();
			                },
	                	_token: '{{ csrf_token() }}'
	              		}
	            	}
            },
            mobile:{
                required:false,
                number:true,
                minlength:8,
                maxlength:10,
                },
            password:{
                required:function(element){
                    if(type == 'Edit')
                    return $("#old_password").val().length > 0;
                    else
                    return true;
                },
                minlength:6
           },
           password_confirmation: {
                required:function(element){
                    if(type == 'Edit')
                    return $("#old_password").val().length > 0;
                    else
                    return true;
                },
                equalTo:'#password'
            }
         },
          messages: {
            email:{
                    remote: 'This email has already been taken'
                } ,
             mobile:{
                remote: 'This mobile no is already in use'
             },
             password_confirmation: {
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
