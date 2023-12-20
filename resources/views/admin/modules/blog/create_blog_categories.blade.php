@extends('admin.layouts.app')
@section('title')
@if(@$blogupdata) Edit @else Add @endif Blog Categories
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
                    <li class="active"> @if(@$blogupdata) Edit @else Add @endif Blog Categories </li>
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
                            <h3 class="panel-title">@if(@$blogupdata) Edit @else Add @endif Blog Categories</h3>
                            <a class="btn btn-primary waves-effect waves-light w-md"
                                href="{{route('manage.blog.categories')}}">
                                Back
                            </a>
                        </div>

                        <div class="panel-body rm04">
                        <form action="{{route('store.blog.category')}}" method="post" id="categoryform" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="blog_cata_id" value="{{@$blogupdata->id}}">
                                <input type="hidden" name="ID" id="ID" value="{{@$subadmin->id}}">

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Category Name</label>
                                        <input name="name" id="name" type="text" class="form-control  category required" placeholder="Type Here" value="{{@$blogupdata->category}}">
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary ">@if(@$blogupdata) Update @else Save @endif</button>
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

        $('#categoryform').validate({
            rules: {
                name:{
                    required:true,
                    remote: {
                           url: '{{ route("blog.chata.chk") }}',
                           type: "post",
                           data: {
                             name: function() {
                               return $( "#name" ).val();
                             },
                           _token: '{{ csrf_token() }}'
                           }
                       }

                   },
            },
            messages: {
            name :{
                remote :'This category is already exists.'
                }
            },
            submitHandler:function(form){
               form.submit();
            },
        });

        // $('.category').change(function(){
        //     var reqData = {
        //         'jsonrpc' : '2.0',
        //         '_token'  : '{{csrf_token()}}',
        //         'data'    : {
        //         'ID'      : $('#ID').val(),
        //         'name'    : $(this).val(),
        //         // 'parent_id' : $('.parent_id').val()
        //         }
        //     };
        //     $.ajax(
        //     {
        //         url: '{{ route('unique.category.check') }}',
        //         dataType: 'json',
        //         data: reqData,
        //         type: 'post',
        //         success: function(response)
        //         {
        //             console.log(response)
        //             if(response.result.category){
        //                 $('#name-error').html('This category is already exits.');
        //                 $('#name-error').show();
        //                 $('.category').addClass('error');
        //                 return false;
        //             } else {
        //                 $(this).removeClass('error');
        //                 $('#name-error').html('');
        //                 $('#name-error').hide();
        //                 return true;
        //             }
        //         },
        //         error:function(error)
        //         {
        //             console.log(error.responseText);
        //         }
        //     });
        // });


        // $("#customFile").change(function () {
        //     $('.uploadImg').html('');
        //     let files = this.files;
        //     if (files.length > 0) {
        //         let exts = ['image/jpeg', 'image/png', 'image/gif'];
        //         let valid = true;
        //         $.each(files, function(i, f) {
        //             if (exts.indexOf(f.type) <= -1) {
        //                 valid = false;
        //                 return false;
        //             }
        //         });
        //         if (! valid) {
        //             alert('Please choose valid image files (jpeg, png, gif) only.');
        //             $("#customFile").val('');
        //             return false;
        //         }
        //         $.each(files, function(i, f) {
        //             var reader = new FileReader();
        //             reader.onload = function(e){
        //                 $('.uploadImg').append('<li><img src="' + e.target.result + '"></li>');
        //             };
        //             reader.readAsDataURL(f);
        //         });
        //     }

        // });
    });
</script>
@endsection
