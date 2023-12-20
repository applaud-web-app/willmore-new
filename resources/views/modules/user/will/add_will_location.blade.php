@extends('layouts.app')
@section('title','')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

    <div class="inner_page_area dashboard_inner">
         <div class="container">
            <div class="row">

               <div class="col-lg-3 col-md-12 col-sm-12">
                @if (@$locationStor->package_id == 1)
                    @include('includes.sidebar')
                @else
                    @include('includes.will_sidebar')
                @endif
               </div>

               <div class="col-lg-9 col-md-12 col-sm-12">
                  <div class="cus-dashboard-right didlex des-chng">
                    @if (@$locationStor->package_id == 2)
                        <h2>Location Information</h2>
                    @elseif (@$locationStor->package_id == 3)
                        <h2>Letter of instruction</h2>
                    @elseif (@$locationStor->package_id == 1)
                        <h2> Final Will</h2>
                    @elseif (@$locationStor->package_id == 5)
                        <h2> Advance Medical Directive</h2>
                    @endif
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    {{-- <a href="{{route('user.mywill')}}" class="top_battn_new">Back</a> --}}
                </div>
                @include('includes.message')

                  <div class="dash-right-inr">

                    <form id="pdfUpload-form" action="{{route('save.will.location')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="will_id" value="{{@$will_id}}" class="rm_form_fild">
                        <input type="hidden" name="pack" id="pack" value="{{@$locationStor->package_id}}">

                        <div class="row login_rm02 for_dashboard">

                            <div class="col-lg-12">
                                @if (@$locationStor->package_id == 1 )
                                    {{ @$will->will_code}}
                                    <div class="instructions_aar">
                                        <ul>
                                        <li>
                                            Please note that the electronic copy of your executed Will which you upload is not valid in
                                            a court of law in India; only a physical copy of the executed Will is valid. The uploaded
                                            copy is for your reference. We will send you a confirmatory email with a link to access
                                            the uploaded copy of the executed Will; you can also access the same through your
                                            Dashboard after logging in.
                                        </li>
                                        <li>
                                            Once you're satisfied with your Will, you'll need to download and print it on a sturdy A4 paper.
                                            Sign the printed Will on all pages and on the designated spot indicated with your name on the last page.
                                        </li>
                                        <li>
                                            Don't forget to obtain the signatures of your witnesses on the same day. Remember,
                                            the witnesses and you must sign the Will on the same date.
                                        </li>
                                        <li>
                                            Please keep the printed and signed copy in a safe and accessible place once your Will is executed.
                                            If you wish to, you can register the location of your Will with us using the <a class="txt_href" href="{{route('service_detail',[2])}}">Will Location Registry package.</a>
                                            After you pass away, your beneficiaries, executors, or any other person you nominate can retrieve the location of your Will
                                            by uploading a copy of your death certificate.

                                        </li>
                                        <li>
                                            We encourage you to take this first step in securing your loved ones’ future by adding the Executor of your Will,
                                            Beneficiaries, Witnesses, and details of your assets.
                                        </li>
                                        <li>
                                            So, go ahead and create your Will today.
                                        </li>
                                    </div>
                                @endif
                            </div>

                            {{-- Upload Form Body Final Will --}}
                            @if(@$locationStor->package_id == 1)

                                @if(@$will->final_will_file == null)
                                    <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Upload Final Will <span class="text-danger">*</span></label>
                                    </div>
                                        <div class="uplodimg gigupld">
                                            <div class="uplodimgfil">
                                                <input type="file" name="final_will_file" id="final_will_file" accept=".pdf" class="inputfile inputfile-1" />
                                                <label for="final_will_file">Click here to upload your file<img src="{{asset('public/images/clickhe.png')}}" alt=""></label>                      </div>
                                            </div>
                                            <label style="margin-top: 10px" for="final_will_file_pre">Allowed file type ( pdf only)*</label>
                                        </div>
                                    </div>
                                @endif

                                @if(@$will->final_will_file !=null)
                                    <div class="col-lg-4 col-md-6">
                                        <div style="margin-top: 10px">
                                            <iframe src="{{url('storage\app\public\final_will_file')}}\{{@$will->final_will_file}}" title="description"></iframe>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="atz-btn view-atz" style="margin-top: 10px">
                                            <a href="{{url('storage\app\public\final_will_file')}}\{{@$will->final_will_file}}" target="_blank" style="color:#086fc6;"> View Will <img src="{{asset('public/images/view02.png')}}" alt=""></a>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{--Will LOcation --}}
                            @if (@$locationStor->package_id == 2)
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Will Location <span class="text-danger">*</span></label>
                                        <input type="text" name="will_location" class="rm_form_fild" placeholder="Enter here" value="{{ @$will->will_location}}">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <textarea type="text" name="address" class="rm_form_fild" placeholder="Enter here">{!! @$will->address !!}</textarea>
                                    </div>
                                </div>
                            @endif

                            {{--LOI --}}
                            @if(@$locationStor->package_id == 3)
                                {{-- <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Please write your letter of instruction <span class="text-danger">*</span></label>
                                        <textarea class="rm_form_fild rm_form_fild_trr" name="loi"
                                            placeholder="Write here">{{@$will ? @$will->loi : ''}}</textarea>
                                    </div>
                                </div> --}}

                                <div class="w-100"></div>


                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Upload LOI <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="uplodimg gigupld">
                                        <div class="uplodimgfil">
                                            <input type="file" name="loi_file" id="loi_file" accept="image/*,.pdf" class="inputfile inputfile-1" />
                                            <label for="loi_file">Click here to upload your file<img src="{{asset('public/images/clickhe.png')}}" alt=""></label>
                                        </div>
                                        <label style="margin-top: 10px" for="loi_file_pre">Allowed file type ( pdf and images only)*</label>
                                    </div>
                                    <label style="margin-top: 10px">
                                    <div class="atz-btn view-atz">
                                    @if(@$will->loi_file !=null)
                                            <a href="{{url('storage\app\public\loi_file')}}\{{@$will->loi_file}}" target="_blank" style="color:#086fc6;"> View LOI <img src="{{asset('public/images/view02.png')}}" alt=""></a>
                                        @endif
                                    </div>
                                    </label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="loi-btn">
                                        <a href="{{asset('public/LOI_sample.docx')}}" class="css-tooltip-top color-blue"><span>Click here to download sample LOI</span>Sample LOI <i class="fa fa-download" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <input type="hidden" class="uploadedFile" value="{{@$will->loi_file}}" />
                            @endif

                            {{--AMD --}}
                            @if(@$locationStor->package_id == 5)
                                {{-- <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Please write your Advance Medical Directive <span class="text-danger">*</span></label>
                                        <textarea class="rm_form_fild rm_form_fild_trr" name="amd_text"
                                            placeholder="Write here">{{@$will ? @$will->amd_text : ''}}</textarea>
                                    </div>
                                </div> --}}

                                <div class="w-100"></div>


                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Upload AMD <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="uplodimg gigupld">
                                        <div class="uplodimgfil">
                                            <input type="file" name="amd_file" id="amd_file" accept="image/*,.pdf" class="inputfile inputfile-1" />
                                            <label for="amd_file">Click here to upload your file<img src="{{asset('public/images/clickhe.png')}}" alt=""></label>
                                        </div>
                                        <label style="margin-top: 10px" for="amd_file_pre">Allowed file type ( pdf and images only)*</label>
                                    </div>
                                    <label style="margin-top: 10px">
                                    <div class="atz-btn view-atz">
                                    @if(@$will->amd_file !=null)
                                            <a href="{{url('storage\app\public\amd_file')}}\{{@$will->amd_file}}" target="_blank" style="color:#086fc6;"> View AMD <img src="{{asset('public/images/view02.png')}}" alt=""></a>
                                        @endif
                                    </div>
                                    </label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="loi-btn">
                                        <a href="{{asset('public/amd_sample.docx')}}" class="css-tooltip-top color-blue"><span>Click here to download sample of Advance Medical Directive</span>Sample AMD <i class="fa fa-download" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <input type="hidden" class="uploadedFile" value="{{@$will->amd_file}}" />
                            @endif

                            {{-- loi/final_will/amd file error div --}}
                            <label for="final_will_file" generated="true" class="final_will_file_error error ml-3" style="display: none;"></label>
                            <div class="w-100"></div>
                            <label for="upload_file" generated="true" class="upload_file_error error ml-3" style="display: none;"></label>

                        <div class="col-lg-12 mb-4 mt-4">
                            <div class="doubleborder"></div>
                            <div class="doubleborder"></div>
                        </div>

                        {{-- Submit Button --}}
                        @if (@$locationStor->package_id == 1)
                            @if(@$will->final_will_file == null)
                            <div class="col-lg-12">
                                <button type="submit" name="SaveFWill" value="Final_will" class="submit_rm" id="submit">Submit</button>
                            </div>
                            @endif
                        @elseif (@$locationStor->package_id == 2)
                            <div class="col-lg-12">
                                <button type="submit" class="submit_rm" id="submit">Submit</button>
                            </div>
                        @elseif (@$locationStor->package_id == 3)
                            <div class="col-lg-12">
                                <button type="submit" name="SaveLOI" value="LOI" class="submit_rm" id="submit">Submit</button>
                            </div>
                        @elseif (@$locationStor->package_id == 5)
                            <div class="col-lg-12">
                                <button type="submit" name="SaveAMD" value="AMD" class="submit_rm" id="submit">Submit</button>
                            </div>
                        @endif

                </form>

                  </div>
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

<script type="text/javascript">
    $(document).ready(function(){

        $("#loi_file").change(function () {
        console.log("Clicked");
        // $('.uploadResume').html('');
        let files = this.files;
        console.log(files);
        var fullPath = $('#loi_file').val();
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename_img = filename.substring(1);
        }
        var fileExt = filename.split('.').pop();

        if(fileExt == "pdf" || fileExt == "jpg" || fileExt == "png" || fileExt == "jpeg" || fileExt == "gif"){
            //
        } else {
            alert('Please choose pdf file only.');
            $("#loi_file").val('');
            $("label[for='loi_file']").text('Click here to upload your file');
            return false;
        }
        $(this).valid();
        $.each(files, function(i, f) {
            var reader = new FileReader();
            reader.onload = function(e){
                $("label[for='loi_file_pre']").text(filename_img);
            };
            reader.readAsDataURL(f);
        });
    });

    });


    $(document).ready(function(){

        $("#amd_file").change(function () {
            console.log("Clicked");
            // $('.uploadResume').html('');
            let files = this.files;
            console.log(files);
            var fullPath = $('#amd_file').val();
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename_img = filename.substring(1);
            }
            var fileExt = filename.split('.').pop();

            if(fileExt == "pdf" || fileExt == "jpg" || fileExt == "png" || fileExt == "jpeg" || fileExt == "gif"){
                //
            } else {
                alert('Please choose pdf file only.');
                $("#amd_file").val('');
                $("label[for='amd_file']").text('Click here to upload your file');
                return false;
            }
            $(this).valid();
            $.each(files, function(i, f) {
                var reader = new FileReader();
                reader.onload = function(e){
                    $("label[for='amd_file_pre']").text(filename_img);
                };
                reader.readAsDataURL(f);
            });
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $("#final_will_file").change(function () {
        console.log("Clicked");
        // $('.uploadResume').html('');
        let files = this.files;
        console.log(files);
        var fullPath = $('#final_will_file').val();
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename_img = filename.substring(1);
        }
        var fileExt = filename.split('.').pop();

        if(fileExt == "pdf"){
            //
        } else {
            alert('Please choose pdf file only.');
            $("#final_will_file").val('');
            $("label[for='final_will_file']").text('Click here to upload your file');
            return false;
        }
        $(this).valid();
        $.each(files, function(i, f) {
            var reader = new FileReader();
            reader.onload = function(e){
                $("label[for='final_will_file_pre']").text(filename_img);
            };
            reader.readAsDataURL(f);
        });
    });

    });
</script>

<script>
$(document).ready(function(){
        $('#pdfUpload-form').validate({
            rules: {
                final_will_file:{
                    required: true,
                },
                loi_file:{
                    required: true,
                },
                will_location:{
                    required: true,
                    maxlength: 250,
                },
                address:{
                    required: true,
                    maxlength: 250,
                },
                // loi:{
                //     required: true,
                // },
                // amd_text:{
                //     required: true,
                // },
                amd_file:{
                    required: true,
                },
            },
            messages:{
                will_location:{
                    maxlength: 'Location no more than 250 characters',
                },
            },
            submitHandler:function(form){
            var pack = $('#pack').val();
            var uploadedFile = $('.uploadedFile').val();
            var file = '';

            if(pack == 1){
                file = $('#final_will_file').val();
            }else if(pack == 3){
                file = $('#loi_file').val();
            }else if(pack == 5){
                file = $('#amd_file').val();
            }

            var fileExt = file.split('.').pop();

            if(file.length == 0 && uploadedFile.length == 0 && (pack == 1 || pack == 3 || pack == 5)){
                $('.upload_file_error').html('This field is required');
                $('.upload_file_error').show();
                return false;
            }else if(fileExt != "pdf" && pack == 1){
                $('.upload_file_error').html('This field is required');
                $('.upload_file_error').show();
            }
            else{
                $('.upload_file_error.error').html('');
                $('.upload_file_error').hide();
                form.submit();
             }

         },
        });
    });
</script>

@endsection
