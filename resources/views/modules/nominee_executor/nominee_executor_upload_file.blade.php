@extends('layouts.app')
@section('title','WillAndMore')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')


<section class="pager-section login_bg overlay banner_small_rm">
    <div class="container">
        <div class="main-banner-content p-relative">
            <div class="social-links">
                <ul>
                    <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div><!--social-links end-->
            <div class="pager-content">

                <h2 class="page-title">Nominee Executor Upload File</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    {{-- <li><span>Login</span></li> --}}
                </ul><!--breadcrumb end-->
            </div><!--pager-content end-->
        </div><!--main-banner-content end-->
    </div>
</section><!--pager-section end-->


    <div class="inner_page_area dashboard_inner">
         <div class="container">
            <div class="row">




               <div class="col-lg-12 col-md-12 col-sm-12">
                  {{-- <div class="cus-dashboard-right didlex"><h2>Nominee Executor Upload File</h2></div> --}}
                  <div class="dash-right-inr login_rm02 nnec_page_neww">
                    @include('includes.message')

                    <form id="pdfUpload_form" method="post" action="{{route('save.upload.file')}}" enctype="multipart/form-data">
                        @csrf

                        @if(@$beneficiaries)
                        <input type="hidden" name="ben_id" value="{{@$beneficiaries->id}}">
                        @endif
                        @if(@$executor)
                        <input type="hidden" name="exe_id" value="{{@$executor->id}}">
                        @endif

                     <div class="col-lg-12 col-md-12 for_genderr poi">
                        <div class="form-group">
                                <label>Document</label>
                                <label class="radio">
                                <input id="radio1" type="radio" value="LI" name="type">
                                <span class="outer"><span class="inner"></span></span>Letter of Instruction</label>

                                <label class="radio">
                                <input id="radio2" type="radio" value="DC" name="type">
                                <span class="outer"><span class="inner"></span></span>Death Certificate</label>
                        </div>
                        <div class="w-100"></div>
                        <label for="type" generated="true" class="error" style="display: none;"></label>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="uplodimg gigupld">
                            <span>Upload File</span>
                            <div class="uplodimgfil">
                                <input type="file" name="file" id="file" class="inputfile inputfile-1">
                                <label for="file">Click here to upload file<img src="{{asset('public/images/clickhe.png')}}" alt=""></label>
                            </div>
                            <label class="mr-top" for="file_pre">Allowed file type ( pdf, jpeg, jpg, png only)*</label>
                            <label for="file" generated="true" class="file_error error" style="display: none;"></label>                        </div>
                    </div>


                  <div class="rmm01 mm01">
                    <div class="checkbox-group">
                        <input type="checkbox" name="checkiz" id="checkiz">
                        <label for="checkiz">
                            <span class="check"></span>
                            <span class="box"></span>
                             I agree and acknowledge that i am uploading a valid document as proof
                         </label>
                    </div>
                    <label generated="true" class="checkiz_error error" for="checkiz" style="display: none;"></label>

                    </div>



                 		<div class="col-lg-12 mb-4 mt-4">
                            <div class="doubleborder"></div>
                            <div class="doubleborder"></div>
                        </div>


                        <div class="col-lg-2 col-md-4">
                            <button type="submit" class="submit_rm bntt_collor btn_colorrr_002">Submit</button>
                            {{-- <a href="nominee_executor.html" class="submit_rm">Submit</a> --}}
                        </div>

                </form>

                  </div>

               </div>

            </div>
         </div>
      </div>

@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
<script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>

<script>
    $(document).ready(function() {

     // validate the comment form when it is submitted
       $("#pdfUpload_form").validate({
         rules: {
           type:{required: true},
        //    file:{required: true},
         },

        submitHandler:function(form){
            var file = $('#file').val();

             if(file.length == 0){
                    $('.file_error').html('This field is required');
                    $('.file_error').show();
                    return false;

            }else if($('#checkiz:checkbox:checked').length == 0){

                $('.checkiz_error').html('Please accept authorize');
                $('.checkiz_error').show();
                return false;

            }else{
                 $('.file_error.error').html('');
                 $('.file_error').hide();
                 $('.checkiz_error.error').html('');
                 $('.checkiz_error').hide();
                 form.submit();
             }

         },

       });


    });
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $("#file").change(function () {
        console.log("Clicked");
        // $('.uploadResume').html('');
        let files = this.files;
        console.log(files);
        var fullPath = $('#file').val();
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename_img = filename.substring(1);
        }
        var fileExt = filename.split('.').pop();

        if(fileExt == "pdf" || fileExt == "jpeg" || fileExt == "jpg" || fileExt == "png"){
            //
        } else {
            alert('Please choose valid pdf (pdf, jpeg, jpg, png) only.');
            $("#cvs").val('');
            $("label[for='file']").text('Click here to upload your file');
            return false;
        }
        $(this).valid();
        $.each(files, function(i, f) {
            var reader = new FileReader();
            reader.onload = function(e){
                $("label[for='file_pre']").text(filename_img);
            };
            reader.readAsDataURL(f);
        });
    });

    });
</script>
{{--
<script>
    $(document).ready(function(){
            $('#pdfUpload_form').validate({
                rules: {
                    type:{
                        required: true,
                    },
                    file:{
                        required: true,
                    }
                },
                messages:{

                },
                submitHandler: function (form) {

                if($('#checkiz').is(":checked")){

                    console.log('test');

                    return true;

                }else{

                    $('#checkiz-error').html('Please accept authorize');

                    $('#checkiz-error').css('display', 'block');

                    return false;

                }

                }
            });
        });
    </script> --}}


@endsection
