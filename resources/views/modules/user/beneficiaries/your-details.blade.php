@extends('layouts.app')
@section('title','Add Executor')
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
                @include('includes.will_sidebar')
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="cus-dashboard-right didlex nwdes-sec">
                    <h2>Your Details</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    @if(@$locPack->package_id ==1 )
                    <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="top_battn_new">Back to list</a>
                    @else
                    <a href="{{route('user.service.authorized',[@$will_id])}}" class="top_battn_new">Back to list</a>
                    @endif
                </div>

                <div class="dash-right-inr">
                    @include('includes.message')
                    <form  method="POST" action="{{route('user.save-your-details')}}" name="register-form" id="register-form">
                        @csrf
                        <label generated="true" class="passport_error error mb-3 ml-3" style="display: none;width: 100%;">Please fill atleast one of these fields - <strong>Aadhar Number</strong> or <strong>Passport Number</strong>.</label>
                        <input type="hidden" class="rm_form_fild" name="will_id" id="will_id" value="{{@$will_id}}">
                        
                        <div class="row login_rm02 for_dashboard">

                            <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                <h1>Your Details</h1>
                            </div>
                          
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here"
                                        value="{{Auth::user()->name}}" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Address 1</label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here"
                                        value="{{Auth::user()->address}}" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here"
                                        value="{{Auth::user()->address2.' '.Auth::user()->city.' '.Auth::user()->state.' '.Auth::user()->country.' '.Auth::user()->zip_code}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <p class="text-muted">
                                    <span class="pp_icnn"><img src="{{asset('public/images/dp01.png')}}" alt="icon"> </span>To edit your personal information, please go to <a href="{{url('edit-profile')}}" class="text-reset "><u>My Profile</u></a> page.
                                  </p>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Aadhar Number</label>
                                    <input type="text" name="aadhar_number" class="rm_form_fild" id="aadhar_number"
                                        placeholder="Enter here" value="{{Auth::user()->aadhar_number}}">
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
                                        placeholder="Enter here" value="{{Auth::user()->pan_number}}">
                                        @if($errors->has('pan_number'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('pan_number')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-12"></div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Passport Number</label>
                                    <input type="text" name="passport_number" class="rm_form_fild panNum" id="passport_number"
                                        placeholder="Enter here" value="{{Auth::user()->passport_number}}">
                                        @if($errors->has('passport_number'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('passport_number')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                         
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Place of Issue</label>
                                    <input type="text" name="place_of_issue" class="rm_form_fild" id="place_of_issue"
                                        placeholder="Enter here" value="{{Auth::user()->place_of_issue}}">
                                        @if($errors->has('place_of_issue'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('place_of_issue')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group expiryD">
                                    <label>Date of expiry</label>
                                    <input type="text" class="rm_form_fild calandar_iconn dob date_input passport_expiry_date" placeholder="Select" id="datepicker3" name="passport_expiry_date" value="{{Auth::user()->passport_expiry_date!=null ? date('m/d/Y',strtotime(Auth::user()->passport_expiry_date)): ''}}" readonly='true'>
                                    <span class="clear_date">Clear <img src="{{asset('public/images/remove1.png')}}" alt=""></span>
                                        @if($errors->has('passport_expiry_date'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('passport_expiry_date')}}</strong>
                                            </span>
                                        @endif
                                        <label for="chk" generated="true" class="expiry_error error" style="display: none;"></label>
                                </div>
                                <label for="chk" generated="true" class="passport_date_err error" style="display: none;">Date of expiry must be greater than issued date</label>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Citizen of <span>*</span></label>
                                    <select class="input_form_login p_input rm_form_fild" name="nationality" id="nationality">
                                            <option value="">Select Country</option>

                                            @foreach($countrys as $country)
                                                <option phonecode="{{ $country->country_phone_code }}" value="{{$country->country_name}}"  id="shop-country" {{Auth::user()->nationality==$country->country_name ? 'selected':''}}>{{$country->country_name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Relationship description <span>*</span></label>
                                    <select class="rm_form_fild"name="user_relation" id="user_relation">
                                        <option value="">Select</option>
                                        <option value="S" {{Auth::user()->user_relation=="S" ? 'selected':''}}>Son of</option>
                                        <option value="W" {{Auth::user()->user_relation=="W" ? 'selected':''}}>Wife of</option>
                                        <option value="D" {{Auth::user()->user_relation=="D" ? 'selected':''}}>Daughter of</option>
                                        <option value="H" {{Auth::user()->user_relation=="H" ? 'selected':''}}>Husband of</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label id="relat_name">
                                        Name Of Relative <span>*</span>
                                    </label>
                                    <input type="text" name="relationship" class="rm_form_fild"
                                        placeholder="Enter here" value="{{Auth::user()->relationship}}" maxlength="100">
                                        @if($errors->has('relationship'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('relationship')}}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                <div class="btn-sec">
                                    <div class="btn-sec-lft">
                                        <button type="submit" class="submit_rm bntt_collor" id="">Save & Continue</button>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100"></div>

                    </form>
                </div>
                <div style="min-height: 500px;">

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
     $("#datepicker3").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+10"
    });
</script>
<script>
    $(document).ready(function (e) {
        $(".clear_date").click(function () {
            $(this).parent().find('.date_input').val('');
        });

        $('#user_relation').change(function(){
            var user_relation= $('#user_relation').val();

            if(user_relation == 'S'){

                $('#relat_name').html('Fathers Name <span>*</span>');

            }else if(user_relation == 'W'){

                $('#relat_name').html('Husbands Name <span>*</span>');

            }else if(user_relation == 'D'){

                $('#relat_name').html('Fathers Name <span>*</span>');

            }else if(user_relation == 'H'){

                $('#relat_name').html('Wifes Name <span>*</span>');
            }
        });
    });
</script>

<script>
    $.validator.addMethod("acc_noRegex", function(value, element) {
    return this.optional(element) || /[a-z].*[0-9]|[0-9].*[a-z]/i.test(value);
    }, "PAN Number must contain only letters and numbers.");

    $.validator.addMethod("name_Regex", function(value, element) {
         return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
         }, "Name must contain only letters");

    $.validator.addMethod("checkDate", function(date, element) {
        return this.optional(element) || date.match(/^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d+$/);
    }, "Please specify a valid date");

    $.validator.addMethod("alpha_space", function(value, element) {
         return this.optional(element) || /^[a-zA-Z0-9\s\-\/]+$/.test(value);
         }, "Please enter only letters and numbers.");

    $("#register-form").validate({
         rules: {
           aadhar_number:{digits: true, minlength: 12, maxlength: 12},
           pan_number:{acc_noRegex:true, minlength: 10, maxlength: 10},
           passport_number:{
                // required: true,
                alpha_space: true,
                maxlength: 20,
            },
            passport_expiry_date:{
            // required: true,
                date: true,
                checkDate: true,
            },
           nationality:{required: true},
           user_relation:{required: true},
           relationship:{name_Regex:true,required: true,maxlength:100},
         },
         messages: {
            relationship: {
                maxlength: 'Please enter not more than 100 characters',
                name_Regex: 'Relationship must contain only letters'
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
         },

        submitHandler:function(form){

            var aadhar_number = $('#aadhar_number').val();
            var passport_number = $('#passport_number').val();
            var place_issue = $('input[name=place_of_issue]').val();
            var exp_date = $('input[name=passport_expiry_date]').val();

            if(aadhar_number.length === 0 && passport_number.length === 0){
                
                $(".passport_error").show().html(`Please fill atleast one of these fields - <strong>Aadhar Number</strong> or <strong>Passport Number</strong>.`);
                return false;
            }

            if(passport_number.length > 0){
                if(place_issue.length === 0 || exp_date.length === 0){
                    $(".passport_error").show().html(`Please fill these fields - <strong>Place of Issue</strong> and  <strong>Date of expiry
                    </strong>`);
                    return false;
                }
            }

            $('.passport_error').hide();
            $(".passport_date_err").hide();
            form.submit();
            
         },

       });
</script>

@endsection
