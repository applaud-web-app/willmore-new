@extends('layouts.app')
@section('title','Dashboard')
@section('links')
@include('includes.links')
<style>
    .prof_img img{
        margin-right: 8px;
        width: 50px;
        height: 50px;
        border-radius: 100%;
        object-fit: cover;
        cursor: pointer;
        position: relative;
        top: 32px;
}
</style>
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<div class="inner_page_area dashboard_inner">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-12 col-sm-12">
                @include('includes.sidebar')
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12 pb-5">
                <div class="cus-dashboard-right didlex">
                    <h2>Edit Profile</h2>
                </div>
                @include('includes.message')
                <div class="dash-right-inr mb-4">

                        <form id="profileForm" name="profileForm" method="POST" action="{{ route('user.update.profile') }}" enctype="multipart/form-data">
                            @csrf
                            <label generated="true" class="passport_error error mb-3 ml-3" style="display: none;width: 100%;">Please fill atleast one of these fields - <strong>Aadhar Number</strong> or <strong>Passport Number</strong>.</label>
                            <label generated="true" class="name_error error mb-3 ml-3" style="display: none;">Please enter not more than 255 characters for First Name, Middle Name and Last Name</label>
                        <div class="row login_rm02 for_dashboard">

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>First Name <span>*</span></label>
                                        <input type="text" class="rm_form_fild" placeholder="Enter Here" name="first_name" value="{{old('first_name',(@$user ? @$user->first_name: ''))}}" maxlength="50">
                                        @if($errors->has('first_name'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('first_name')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here" name="middle_name" value="{{old('middle_name',(@$user ? @$user->middle_name: ''))}}" maxlength="50">
                                        @if($errors->has('middle_name'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('middle_name')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Last Name <span>*</span></label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here" name="last_name" value="{{old('last_name',(@$user ? @$user->last_name: ''))}}" maxlength="50">
                                        @if($errors->has('last_name'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('last_name')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth (mm/dd/yyyy) <span>*</span></label>
                                    <input type="text" class="rm_form_fild calandar_iconn dob" placeholder="Select" id="datepicker" name="dob" value="{{date('m/d/Y',strtotime($user->dob))}}" readonly='true'>
                                        @if($errors->has('dob'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('dob')}}</strong>
                                            </span>
                                        @endif
                                        <label for="chk" generated="true" class="dob_error error" style="display: none;"></label>
                                        
                                </div>
                            </div>
                            
                            <div class="col-lg-8 col-md-6 for_genderr">
                                <div class="form-group gender_box">
                                    <label>Gender <span>*</span></label>
                                    <label class="radio">
                                        <input id="radio1" type="radio" name="gender" value="Male" class="gender1" {{@$user && @$user->gender=='Male' ? 'checked': ''}}>
                                        <span class="outer"><span class="inner"></span></span>Male</label>

                                    <label class="radio">
                                        <input id="radio2" type="radio" name="gender" value="Female" class="gender2" {{@$user && @$user->gender=='Female' ? 'checked': ''}}>
                                        <span class="outer"><span class="inner"></span></span>Female</label>

                                    <label class="radio">
                                        <input id="radio2" type="radio" name="gender" value="Others" class="gender3" {{@$user && @$user->gender=='Others' ? 'checked': ''}}>
                                        <span class="outer"><span class="inner"></span></span>Others</label>
                                </div>
                                <label generated="true" class="gender_error error mb-3 ml-3" style="display: none;width: 100%;">This field is required.</label>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Aadhar Number</label>
                                    <input type="text" name="aadhar_number" class="rm_form_fild" id="aadhar_number"
                                        placeholder="Enter here" value="{{old('aadhar_number',(@$user ? @$user->aadhar_number: ''))}}">
                                        @if($errors->has('aadhar_number'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('aadhar_number')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>PAN Number</label>
                                    <input type="text" name="pan_number" class="rm_form_fild panNum" id="pan_number"
                                        placeholder="Enter here" value="{{old('pan_number',(@$user ? @$user->pan_number: ''))}}">
                                        @if($errors->has('pan_number'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('pan_number')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Passport Number</label>
                                    <input type="text" name="passport_number" class="rm_form_fild panNum" id="passport_number"
                                        placeholder="Enter here" value="{{old('passport_number',(@$user ? @$user->passport_number: ''))}}">
                                        @if($errors->has('passport_number'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('passport_number')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Email address</label>
                                    {{-- <a href="javascript:;" data-toggle="modal" data-target="#editEmailModal">Edit</a> --}}
                                    <input type="text" class="rm_form_fild" placeholder="Enter here"  value="{{@$user ? @$user->email: ''}}" readonly disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Mobile number</label>
                                    <a href="javascript:;" data-toggle="modal" data-target="#editMobileModal">Edit</a>
                                    <input type="text" placeholder="Enter here" id="" class="rm_form_fild @error('mobile') is-invalid @enderror" value="{{@$user->getPhonecode ? '+'.@$user->getPhonecode->phonecode : ''}} {{@$user ? @$user->mobile: ''}}" readonly>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="rm_form_fild country_id" name="country_id" id="countryList">
                                        <option value="">Select Country</option>
                                        @foreach($countrys as $country)
                                            <option phonecode="{{ $country->country_phone_code }}" value="{{$country->country_name}}"  id="shop-country" {{$country->country_name==$user->country ? 'selected':''}}>{{$country->country_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="input_form_login p_input rm_form_fild" name="state" id="stateList">
                                        <option value="">Select State</option>
                                        @foreach ($states as $item)
                                            <option value="{{$item->state_name}}" {{$item->state_name==$user->state ? 'selected':''}}>{{$item->state_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="rm_form_fild" placeholder="Enter here" value="{{@$user ? @$user->city: ''}}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Address 1</label>
                                    <input type="text" name="address1" class="rm_form_fild" placeholder="Enter here" value="{{@$user ? @$user->address1: ''}}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <input type="text" name="address2" class="rm_form_fild" placeholder="Enter here" value="{{@$user ? @$user->address2: ''}}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Postcode</label>
                                    <input type="text" name="zip_code" class="rm_form_fild" placeholder="Enter here" value="{{@$user ? @$user->zip_code: ''}}">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Upload Profie Picture <span class="text-danger"></span></label>
                                </div>
                                <div class="uplodimg gigupld">
                                    <div class="uplodimgfil">
                                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="inputfile inputfile-1" />
                                        <label for="profile_picture">Click here to upload<img src="{{asset('public/images/clickhe.png')}}" alt=""></label>
                                    </div>
                                    <label style="margin-top: 10px" for="profile_picture_pre">Allowed file type (images only)*</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="atz-btn view-atz prof_img">
                                    @if(Auth::user()->profile_picture != null)
                                        <img id="preview-image" src="{{url('storage\app\public\profile_picture')}}\{{Auth::user()->profile_picture}}" alt="">
                                    @elseif(Auth::user()->profile_picture == null && Auth::user()->gender == 'Male')
                                        <img id="preview-image" src="{{asset('public/images/dash_user1.png')}}" alt="">
                                    @elseif(Auth::user()->profile_picture == null && Auth::user()->gender == 'Female')
                                        <img id="preview-image" src="{{asset('public/images/dash_user2.png')}}" alt="">
                                    @else
                                        <img id="preview-image" src="{{asset('public/images/avatar.png')}}" alt="">
                                    @endif
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-12 mb-4 mt-4">
                                <div class="doubleborder"></div>
                                <div class="doubleborder"></div>
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" class="submit_rm" id="submit">Save all changes</button>
                            </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="editEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Your Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="emailForm" method="POST" action="{{ route('user.update.email') }}">
        @csrf
      <div class="modal-body">
        <div class="row login_rm02">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Enter Email address</label>
                    <input id="email" type="text" class="rm_form_fild" placeholder="Enter here" name="email" value="{{@$user->temp_email ? @$user->temp_email: ''}}" autocomplete="email">
                </div>
                <button type="submit" class="submit_rm submitModal" id="submit">Save changes</button>
            </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editMobileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Your Mobile number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="mobileForm" method="POST" action="{{ route('user.update.email') }}">
        @csrf
      <div class="modal-body">
        <div class="row login_rm02">
            <div class="col-lg-12 col-md-12">
                <div class="form-group phncc-inpt">
                    <label>Enter Mobile number</label>
                                                <div class="phonecode-sec">
                                                    <select class="input_form_login p_input rm_form_fild" name="phonecode" id="singleSelectExample">
                                                            <option value="">Select</option>
                                                            {{-- @foreach($countrys as $phonecode)
                                                            <option value="{{$phonecode->id}}" {{$phonecode->phonecode == 91 ? 'selected' : ''}}>+{{$phonecode->phonecode}}</option>
                                                            @endforeach --}}
                                                            @foreach($countrys as $phonecode)
                                                            <option value="{{$phonecode->country_phone_code}}" {{$phonecode->country_phone_code == 91 ? 'selected' : ''}}>+{{$phonecode->country_phone_code}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                    <input type="text" placeholder="Enter here" id="mobile" name="mobile" class="rm_form_fild @error('mobile') is-invalid @enderror" value="{{old('mobile')}}" >
                </div>
                <button type="submit" class="submit_rm submitModal" id="submit">Save changes</button>
            </div>
        </div>
      </div>
      </form>
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
      $.validator.addMethod("acc_noRegex", function(value, element) {
         return this.optional(element) || /[a-z].*[0-9]|[0-9].*[a-z]/i.test(value);
         }, "PAN Number must contain only letters and numbers.");

         $.validator.addMethod("name_Regex", function(value, element) {
         return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
         }, "Name must contain only letters");

         $.validator.addMethod("address_Regex", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9./_ ,-])+$/.test(value);
         }, "Please enter valid address");

         $.validator.addMethod("onlyNumbers", function(value, element) {
         return this.optional(element) || /[0-9]/i.test(value);
         }, "Please enter a valid number");
         $.validator.addMethod("checkDate", function(date, element) {
            return this.optional(element) || date.match(/^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d+$/);
        }, "Please specify a valid date");

        $.validator.addMethod("alpha_space", function(value, element) {
         return this.optional(element) || /^[a-zA-Z0-9\s\-\/]+$/.test(value);
         }, "Please enter only letters and numbers.");

       $("#profileForm").validate({
         rules: {
           country_id:{required: true},
           address1:{required: true,address_Regex: true,maxlength:200},
           address2:{required: true,address_Regex: true,maxlength:200},
           zip_code:{required: true,maxlength:10,alphanumeric:true},
           city:{name_Regex:true,required: true,maxlength:100},
           state:{name_Regex:true,required: true,maxlength:100},
           first_name:{name_Regex:true,required: true,maxlength:100},
           middle_name:{name_Regex:true,maxlength:100},
           last_name:{name_Regex:true,required: true,maxlength:100},
           country_id:{required: true},
           phonecode:{required: true},
           dob:{required: true,date: true,checkDate: true},
           aadhar_number:{digits: true, minlength: 12, maxlength: 12},
           pan_number:{acc_noRegex:true, minlength: 10, maxlength: 10},
           passport_number:{
                // required: true,
                //passport_reg:true,
                alpha_space: true,
                //minlength: 8,
                maxlength: 20,
            }

         },
         messages: {
            first_name: {
                maxlength: 'Please enter not more than 100 characters',
                name_Regex: 'First Name must contain only letters'
            },
            middle_name: {
                maxlength: 'Please enter not more than 100 characters',
                name_Regex: 'Middle Name must contain only letters'
            },
            last_name: {
                maxlength: 'Please enter not more than 100 characters',
                name_Regex: 'Last Name must contain only letters'
            },
            aadhar_number: {
                digits: 'Please enter a valid number',
                minlength:'Please enter at least 12 digits.',
                maxlength:'Please enter not more than 12 digits.'
            },
            passport_number: {
                //acc_noRegex: 'Please enter a valid number',
                maxlength:'Please enter not more than 20 digits.'
            },
          city:{
               maxlength: 'Please enter not more than 100 characters',
               name_Regex: 'City Name must contain only letters'
            },
            state:{
               maxlength: 'Please enter not more than 100 characters',
               name_Regex: 'State Name must contain only letters'
            },
            address1:{
               maxlength: 'Please enter not more than 200 characters'
            },
            address2:{
               maxlength: 'Please enter not more than 200 characters'
            }
         },
        submitHandler:function(form){
            var aadhar_number = $('#aadhar_number').val();
            var passport_number = $('#passport_number').val();
            if(aadhar_number.length === 0 && passport_number.length === 0){
                $(".passport_error").show();
                return false;
            }
            var fname = $('[name="first_name"]').val();
            var lname = $('[name="last_name"]').val();
            var mname = $('[name="middle_name"]').val();
            var totalLength = parseInt(fname.length) + parseInt (mname.length) + parseInt(lname.length);

            if(totalLength > 255){
                $('.name_error').show();
                return false;
            }
            var age = $('.dob').val();
             //check valid dob
                //console.log("dmy ",age.length);

             var getAge = Math.floor((new Date() - new Date(age).getTime()) / 3.15576e+10)
             if(age.length != 10 || age.includes('/') == false){
                    $('.dob_error').html('Date of Birth must be in mm/dd/yy format');
                    $('.dob_error').show();
                    return false;

            }else if(getAge<18){
                 $('.dob_error').html('Sorry, you must be 18 years of age to register');
                 $('.dob_error').show();
                 return false;

             }else{
                 $('.dob_error.error').html('');
                 $('.name_error').hide();
                 $('.gender_error').hide();
                 $('.passport_error').hide();
                 document.profileForm.submit();
             }
         },

       });


       $("#emailForm").validate({
         rules: {
           email:{
                  required: true,
                  email:true,
                  maxlength: 100,
               	remote: {
	              	url: '{{ route("email.check") }}',
	              	type: "post",
	              	data: {
			             email: function() {
			               return $( "#email" ).val();
			             },
	               _token: '{{ csrf_token() }}'
	              	}
	            }

            },

         },
         messages: {
             email:{
               remote: 'This email has already been taken',
               maxlength: 'Please enter not more than 100 characters'
            }
         },

        submitHandler:function(form){
            form.submit();
         },

       });

       $("#mobileForm").validate({
         rules: {
          phonecode:{ required:true,},
            mobile:{
             required:true,
             minlength: 9,
             maxlength: 10,
             digits:true,
             remote: {
                   url: '{{ route("mobile.check") }}',
                   type: "post",
                   data: {
                     mobile: function() {
                       return $( "#mobile" ).val();
                     },
                     phonecode: function() {
                       return $( "#singleSelectExample" ).val();
                     },
                   _token: '{{ csrf_token() }}'
                   }
               }

           },

         },
         messages: {
            mobile:{
                remote: 'This mobile number has already been taken',
                minlength:'Please enter at least 9 digits.',
                maxlength:'Please enter not more than 10 digits.'
             }
         },

        submitHandler:function(form){
            form.submit();
         },

       });



$(document).ready(function() {
        // Setting default configuration here or you can set through configuration object as seen below
    $.fn.select2.defaults = $.extend($.fn.select2.defaults, {
        allowClear: true, // Adds X image to clear select
        closeOnSelect: true, // Only applies to multiple selects. Closes the select upon selection.
        placeholder: 'Select...',
        minimumResultsForSearch: 15 // Removes search when there are 15 or fewer options
    });
});

$(document).ready(function(){
    $(function() {
        $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
    });
    });
});

$(document).ready(
function () {

    // Single select example if using params obj or configuration seen above
    var configParamsObj = {
        placeholder: 'Select an option...', // Place holder text to place in the select
        minimumResultsForSearch: 3 // Overrides default of 15 set above
    };
    $("#singleSelectExample").select2(configParamsObj);
});
});


</script>

<script type="text/javascript">
    $(document).ready(function(){

        $("#profile_picture").change(function () {
        console.log("Clicked");
        // $('.uploadResume').html('');
        let files = this.files;
        console.log(files);
        var fullPath = $('#profile_picture').val();
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename_img = filename.substring(1);
        }
        var fileExt = filename.split('.').pop();

        if(fileExt == "jpg" || fileExt == "png" || fileExt == "jpeg" || fileExt == "gif"){
            //
        } else {
            alert('Please choose Image file only.');
            $("#profile_picture").val('');
            $("label[for='profile_picture']").text('Click here to upload your file');
            return false;
        }
        $(this).valid();
        $.each(files, function(i, f) {
            var reader = new FileReader();
            reader.onload = function(e){
                $("label[for='profile_picture_pre']").text(filename_img);
            };
            reader.readAsDataURL(f);
        });
    });

    });
    $(document).ready(function (e) {

        $('#profile_picture').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        });
    });
</script>

<script>
    $(document).ready(function (e) {
        $("#countryList").on('change',function(){
            var country = $(this).val();
            var str = '<option value="">Select State</option>';
            if(country!=''){
                $("#stateList").html('<option value="">Loading...</option>');
                $.post('{{url("get-country-state-api")}}',{'_token':'{{csrf_token()}}','country':country},function(data){
                    var str = '<option value="">Select State</option>';
                    for(var i in data){
                        str+=`<option value="${data[i].state_name}">${data[i].state_name}</option>`;
                    }
                    str+=`<option value="Other">Other</option>`;
                    $("#stateList").html(str);
                })
            }else{
                $("#stateList").html(str);
            }
        })
    });
</script>

@endsection
