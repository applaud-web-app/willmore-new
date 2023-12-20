@extends('admin.layouts.app')
@section('title')
@if(@$blogdata) Edit @else Add @endif Blog
@endsection
@section('links')
@include('admin.includes.links')
<style type="text/css">
    .tox-notifications-container{
        display: none;
    }
     .tox-tinymce{
        min-height:300px !important;
     }
     .htt{
        margin-left: 15px;
        margin-right: 15px;
     }
     .tox-editor-header{
        position: fixed;
        top: 59px;
        width: 100%;
        margin-left: -22px;
    }
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
                    <li class="active">@if(@$blogdata) Edit @else Add @endif Blog </li>
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
                            <h3 class="panel-title">@if(@$blogdata) Edit @else Add @endif Blog</h3>
                            <a class="btn btn-primary waves-effect waves-light w-md"
                                href="{{route('manage.blog')}}">
                                Back
                            </a>
                        </div>

                        <div class="panel-body rm04">
                        <form action="{{route('store.blog')}}" method="post" id="categoryform" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{@$blogdata->id}}">
                                <input type="hidden" name="ID" id="ID" value="{{@$subadmin->id}}">

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Select Category</label>
                                <select class="form-control category_id required" name="category_id">
                                    <option value="">Select</option>
                                    @foreach($blogcata as $val)
                                        <option value="{{$val->id}}" {{@$blogdata->category_id==@$val->id ? 'selected' : ''}}>{{@$val->category}}</option>
                                    @endforeach
                                </select>
                                    </div>
                                </div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Title </label>
                                        <input name="title" type="text" class="form-control category required" placeholder="Type Here"  value="{{@$blogdata->title}}">
                                    </div>
                                </div>

                                @if(@$subadmin)
                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Meta Title</label>
                                        <input name="meta_title" type="text" class="form-control category required" placeholder="Type Here"  value="{{@$blogdata->meta_title}}">
                                    </div>
                                </div>
                                @endif

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="FullName">Meta Description</label>
                                        <input name="meta_desc" type="text" class="form-control category required" placeholder="Type Here"  value="{{@$blogdata->meta_desc}}">
                                    </div>
                                </div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="Email">Author Name</label>
                                        <input name="author_name" type="text" class="form-control category required" placeholder="Type Here"  value="{{@$blogdata->author_name}}">
                                    </div>
                                </div>

                                <div class="form-group col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="Email">Description</label>
                                        <textarea name="description" class="form-control" placeholder="Enter Blog Description" id="description" style="height:800px;">{!! @$blogdata->description !!}</textarea>
                                    <div id="description_empty_box" style="float: left;width: 100%;color: red;"></div>
                                    </div>
                                </div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-5 col-12 pad-l imgdiv">
                                    <input type="file" class="custom-file-input" id="home_image" name="home_image"
                                        style="display:none">
                                    <label class="custom_file_label extrlft" for="home_image">Upload Home Image</label>
                                    <div class="uplodpic uploadaImg">
                                        @if(@$blogdata->home_image)
                                        <img src="{{asset('storage/app/blog_cata_img/home_img/'.@$blogdata->home_image)}}">
                                        @else
                                        <img src="{{asset('public/images/avatar.png')}}">
                                        @endif
                                    </div>
                                <label>Recommended Image Size (444px * 573px)</label>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-5 col-12 pad-l imgdiv">
                                    <input type="file" class="custom-file-input" id="customFile" name="image"
                                        style="display:none">
                                    <label class="custom_file_label extrlft" for="customFile">Upload Blog Image</label>
                                    <div class="uplodpic uploadImg">
                                        @if(@$blogdata->image)
                                        <img src="{{asset('storage/app/blog_cata_img/'.@$blogdata->image)}}">
                                        @else
                                        <img src="{{asset('public/images/avatar.png')}}">
                                        @endif
                                    </div>
                                <label>Recommended Image Size (880px * 449px)</label>
                                </div>
                                <div class="clearfix"></div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary ">@if(@$blogdata) Update @else Save @endif</button>
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
                title: {required: true},
                description: {required: true},
                author_name: {required: true},
                meta_title: {required: true},
                meta_desc: {required: true},
            },
            submitHandler:function(form){
               form.submit();
            },
        });

        $('.category').change(function(){
            var reqData = {
                'jsonrpc' : '2.0',
                '_token'  : '{{csrf_token()}}',
                'data'    : {
                'ID'      : $('#ID').val(),
                'name'    : $(this).val(),
                'category_id' : $('.category_id').val()
                }
            };
            $.ajax(
            {
                url: '{{ route('unique.category.check') }}',
                dataType: 'json',
                data: reqData,
                type: 'post',
                success: function(response)
                {
                    console.log(response)
                    if(response.result.category){
                        $('#name-error').html('This category is already exits.');
                        $('#name-error').show();
                        $('.category').addClass('error');
                        return false;
                    } else {
                        $(this).removeClass('error');
                        $('#name-error').html('');
                        $('#name-error').hide();
                        return true;
                    }
                },
                error:function(error)
                {
                    console.log(error.responseText);
                }
            });
        });


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
                        $('.uploadImg').append('<img src="' + e.target.result + '" alt="Blog Image">');
                    };
                    reader.readAsDataURL(f);
                });
            }

        });
        $("#home_image").change(function () {
            $('.uploadaImg').html('');
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
                    $("#home_image").val('');
                    return false;
                }
                $.each(files, function(i, f) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('.uploadaImg').append('<img src="' + e.target.result + '" alt="Blog Image">');
                    };
                    reader.readAsDataURL(f);
                });
            }

        });
    });
</script>

{{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5.2.0-75/tinymce.js" referrerpolicy="origin"></script>
<script>
    initTineMce();
    function initTineMce(selector) {
        if(selector == undefined){selector = 'textarea';}
        tinymce.init({
            content_css : "{{asset('public/css/style.css')}},{{asset('public/css/bootstrap.min.css')}}",
            content_style: "@import url('https://fonts.googleapis.com/css2?family=Lato:wght@900&family=Roboto&display=swap'); body { font-family: 'Roboto'; }",
            selector:selector,
            menubar:false,
            statusbar: false,
            auto_focus : "elm1",
            height: "350px",
            plugins: "autoresize lists textcolor advlist table link media code image charmap fullpage spoiler advcode",
            file_picker_types: 'file image media',
            advlist_bullet_styles: 'disc',
            image_caption: true,
            inline_boundaries: false,
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true,
            font_formats:"Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago;Roboto=roboto; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
            toolbar: 'code | insertfile undo redo | styleselect | fontselect | fontsizeselect | forecolor backcolor | bold italic underline | superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | customInsertButton customDateButton',
            lists_indent_on_tab: false,
            setup: function (editor) {
                editor.ui.registry.addButton('customInsertButton', {
                    text: 'Add Button',
                    onAction: function (_) {
                        editor.insertContent('&nbsp; <a href="_BTNLINK_" class="save_all_changes_btn">Button</a>&nbsp;');
                        }
                });


            },

        });

        // tinymce.get('description').execCommand('InsertDefinitionList', false, {
        // 'list-item-attributes': {class: 'mylistitemclass'},
        // 'list-attributes': {id: 'mylist'}
        // });
        // tinymce.activeEditor.execCommand('InsertOrderedList', false, {
        // 'list-style-type': 'decimal',
        // 'list-item-attributes': {class: 'mylistitemclass'},
        // 'list-attributes': {id: 'mylist'}
        // });
        // tinymce.activeEditor.execCommand('InsertUnorderedList', false, {
        // 'list-style-type': 'disc',
        // 'list-item-attributes': {class: 'mylistitemclass'},
        // 'list-attributes': {id: 'mylist'}
        // });
        // tinymce.get('textarea').execCommand('RemoveList');


    }
    $(document).ready(function(){
        $('ul').each(function(i)
        {
        console.log($(this).css('list-style-type'));
            if( $(this).css('list-style-type') == 'disc') {
                 $(this).addClass('bullets-uls');
            }
        });
    });



</script> --}}

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5.2.0-75/tinymce.js" referrerpolicy="origin"></script>
<script>
    initTineMce();
    function initTineMce(selector) {
        if(selector == undefined){selector = 'textarea';}
        tinymce.init({
            selector:selector,
            min_height: 350,
            menubar:false,
            statusbar: false,
            auto_focus : "elm1",
            plugins: "autoresize lists textcolor advlist table link code charmap spoiler",
            advlist_bullet_styles: 'disc',
            inline_boundaries: false,
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true,
            font_formats:"Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago;Roboto=roboto; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
            toolbar: 'code | insertfile undo redo | styleselect | fontselect | fontsizeselect | forecolor backcolor | bold italic underline | superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | customInsertButton customDateButton',
            lists_indent_on_tab: false,

        });
    }
    $(document).ready(function(){
        $('ul').each(function(i)
        {
        console.log($(this).css('list-style-type'));
            if( $(this).css('list-style-type') == 'disc') {
                 $(this).addClass('bullets-uls');
            }
        });
    });

</script>

<script>
    $(document).ready(function(){
        // $(window).scroll(function() {
        $(window).on('scroll', function (){
            let h = $(window).scrollTop();
            if (h > 225) {
                $(".tox-editor-header").css("position","fixed");
            } else {
                $(".tox-editor-header").css("position","unset");
                // $(".tox-editor-header").removeClass("tox-editor-header-style");
            }
        });


   });
</script>
@endsection
