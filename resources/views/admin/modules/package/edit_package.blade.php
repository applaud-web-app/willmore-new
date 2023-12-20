@extends('admin.layouts.app')
@section('title')@endsection
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
                    <li class="active">Edit Package</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <!-- Personal-Information -->

                    <div class="panel panel-default panel-fill">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Package <img src="{{asset('public/images/pagright.png')}}" alt="icon"> {{@$package->package_name}}</h3>
                            <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.package')}}" >Back</a>
                        </div>

                        @include('admin.includes.message')
                        <div class="panel-body rm04">
                            <form id="create_package" action="{{route('update.package')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="package_id" id="ID" value="{{@$package->id}}">

                                <div class="form-group col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                    <label for="name" class="col-form-label">Package Price (₹)</label>
                                    <input name="package_price" type="text" class="form-control required" placeholder="Type here" value="{{@package ? @$package->package_price : ''}}" min="1">
                                    </div>
                                </div>

                                <div class="form-group col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                    <label for="name" class="col-form-label">Description</label>
                                    <textarea name="package_desc" style="height: 200px;"  class="form-control">{{@package ? @$package->package_desc : ''}}</textarea>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
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

        $('#create_package').validate({
         rules:{
            package_price:{ 
                required:true,
                number:true,
                maxlength:30,
                },
            package_desc:{
                required:true,//maxlength:300,
            } 
         },
         messages: {
            package_desc:{
               maxlength: 'Please enter not more than 300 characters'  
            }
         },
         submitHandler: function(form) {
            form.submit();
        },
      });
    });
</script>
@endsection