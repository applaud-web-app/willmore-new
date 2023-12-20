@extends('admin.layouts.app')
@section('title')
@if(@$faq) Edit @else Add @endif FAQ
@endsection
@section('links')
@include('admin.includes.links')
<style type="text/css">
    .tox-notifications-container{
        display: none;
    }
    .htt{
        margin-top: -20px;
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
                    <li class="active">@if(@$faq) Edit @else Add @endif FAQ </li>
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
                            <h3 class="panel-title">@if(@$faq) Edit @else Add @endif FAQ</h3>
                            <a class="btn btn-primary waves-effect waves-light w-md"
                                href="{{route('manage.faq')}}">
                                Back
                            </a>
                        </div>

                        <div class="panel-body rm04">
                        <form id="faqform" method="post" action="{{ route('store.faq') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{@$faq->id}}" name="id" >
                                <input type="hidden" name="ID" id="ID" value="{{@$subadmin->id}}">

                                <div class="form-group col-xl-10 col-lg-10 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Question</label>
                                        <input name="question" type="text" class="form-control  required" placeholder="Type here" value="{{@$faq->question}}">
                                    </div>
                                </div>

                                <div class="form-group col-xl-10 col-lg-10 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Answer </label>
                                        <textarea name="answer" class="form-control required" style="height:100px;" placeholder="Type here">{{@$faq->answer}}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="form-group col-xl-10 col-lg-10 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="FullName">Display Order</label>
                                        <input name="display_order" type="text" class="form-control  required" placeholder="Type here" value="{{@$faq->display_order}}">
                                    </div>
                                </div> --}}


                                <div class="clearfix"></div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary ">@if(@$faq) Update @else Save @endif</button>
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

        $('#faqform').validate({
            rules: {
                question: {required: true},
                answer: {required: true},
                // type: {required: true},
                // display_order: {required: true}
            },
            submitHandler:function(form){
               form.submit();
            },
        });
        // $("#image").change(function () {
        //     // alert("jio");
        //     $('.image').html('');
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
        //             $("#image").val('');
        //             return false;
        //         }
        //         $.each(files, function(i, f) {
        //             var reader = new FileReader();
        //             reader.onload = function(e){
        //                 $('.image').append('<li><img src="' + e.target.result + '"></li>');
        //             };
        //             reader.readAsDataURL(f);
        //         });
        //     }
        // });



    });
</script>

@endsection
