@extends('admin.layouts.app')
@section('title')
Email Template Update
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
    .infomsg{
        color: #000;
        font-weight: bold;
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
<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Email Template Update</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('template.list')}}" class="breadcrumb-link">Manage Email Template</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Email Template</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @include('admin.includes.message')
            <div class="card">
                <h5 class="card-header">Update : {{@$template->template_name}}</h5>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="{{route('template.update')}}" method="post" id="form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ @$template->id }}">
                            <div class="form-group row htt">
                                <label class="col-lg-12 col-form-label" for="email_subject">Subject</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Enter Subject of mail" value="{{ @$template->email_subject }}">
                                </div>
                            </div>
                            <div class="form-group row htt">
                                <label class="col-lg-12 col-form-label" for="description">Email Body </label>
                                <div class="col-lg-12">
                                    <textarea name="email_body" class="form-control" placeholder="Enter mail body" id="description" style="height: 500;">{{ @$template->email_body }}</textarea>
                                    <div id="description_empty_box" style="float: left;width: 100%; color: red;"></div>
                                </div>
                            </div>
                            <div class="form-group row htt">
                                <label class="col-lg-12 col-form-label" for="email_subject">Image 1</label>
                                <div class="col-lg-6"><input type="file" class="form-control" id="image1" name="image1">
                                    <div class="uplodpic image1">
                                        @if(@$template->image1)
                                            <li><img src="{{asset('storage/app/mail_template/'.@$template->image1)}}"></li>
                                        @endif
                                    </div>
                                </div>
                                <label class="col-lg-12 col-form-label" for="email_subject">Image 2</label>
                                <div class="col-lg-6"><input type="file" class="form-control" id="image2" name="image2">
                                    <div class="uplodpic image2">
                                        @if(@$template->image2)
                                            <li><img src="{{asset('storage/app/mail_template/'.@$template->image2)}}"></li>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 ml-auto">
                                <p class="infomsg">"Drag the saved image to place in the template."</p>
                                    <button type="submit" class="btn btn-primary lgmtn btndth btn-flat m-b-30 subtmp">Update</button>
                                </div>
                            </div>
                            @php
                            $emailHelp = explode(',', @$template->email_help);
                            @endphp
                            <div class="form-group row" style="margin-top: -45px;">
                                <h5 class="col-lg-12" style="font-weight: bold; color: #000;">Email Parameters:</h5>
                                <div class="col-lg-12" style="margin-top: -15px;">
                                    @foreach(@$emailHelp as $val)
                                    <label style="color: #000;">{{$val}}</label><br>
                                    @endforeach
                                </div>
                                <h6 class="col-lg-12" style="font-weight: bold; color: #000;">Note: Above are parameters that can be used in the email content. Use the parameters as specified here.</h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@include('admin.includes.footer')
@endsection
@section('script')
@include('admin.includes.scripts')
<script>
    $(document).ready(function(){
        $("#myform").validate({
            messages : 
            {
                email_subject       : "Please enter email_subject",
                email_body          : "Please enter content",
            },
            errorPlacement: function (error, element) 
            {
                toastr.error(error.text());
            }
        });
        $('body').on('click','.subtmp' , function(){
            if($('#description_ifr').contents().find('body').text() == '') {
                $('.post_comment').removeAttr('disabled');
                $("#description_empty_box").show();
                $("#description_empty_box").html("Enter Mail Body.");
                $("#description").addClass('error');
                // $("#description").autofocus();
                return false;
            } else {
    
                $("#description_empty_box").hide();
            }
        });

        $("#image1").change(function () {
            $('.image1').html('');
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
                    $("#image1").val('');
                    return false;
                }
                $.each(files, function(i, f) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('.image1').append('<li><img src="' + e.target.result + '"></li>');
                    };
                    reader.readAsDataURL(f);
                });
            }
        });
        $("#image2").change(function () {
            $('.image2').html('');
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
                    $("#image2").val('');
                    return false;
                }
                $.each(files, function(i, f) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('.image2').append('<li><img src="' + e.target.result + '"></li>');
                    };
                    reader.readAsDataURL(f);
                });
            }
        });
    });
</script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5.2.0-75/tinymce.js" referrerpolicy="origin"></script>
<script>
    initTineMce();
    function initTineMce(selector) {
        if(selector == undefined){selector = 'textarea';}
        tinymce.init({
            content_style: "@import url('https://fonts.googleapis.com/css2?family=Lato:wght@900&family=Roboto&display=swap'); body { font-family: 'Roboto'; }",
            selector:selector,
            menubar:false,
            statusbar: false,  
            auto_focus : "elm1",
            height: "350px",
            plugins: "autoresize lists textcolor advlist table link media code image charmap fullpage spoiler advcode",
            file_picker_types: 'file image media',
            image_caption: true,
            inline_boundaries: false,
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true,
            font_formats:"Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago;Roboto=roboto; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
            toolbar: 'code | insertfile undo redo | styleselect | fontselect | fontsizeselect | forecolor backcolor | bold italic underline | superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | customInsertButton customDateButton',
        });
    }
</script>
@endsection