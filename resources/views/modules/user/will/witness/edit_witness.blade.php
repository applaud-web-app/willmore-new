@extends('layouts.app')
@section('title','Edit Witness')
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
                    <h2>Edit Witness</h2>
                    {{-- <p>If you wish to add a new beneficiary please add that before adding the asset details.</p> --}}
                    <p>Please note that a Witness has to be over the age of 18 years and
                        should not be a beneficiary of the Will.</p>
                    <a href="{{route('user.manage.witness',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                <div class="dash-right-inr">
                @include('includes.message')

                    <form id="witness-form" method="POST" action="{{ route('update.witness') }}">
                        @csrf

                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        <input type="hidden" class="rm_form_fild" name="id" value="{{@$witnessDetail->id}}" id="witness_id">
                        <div class="row login_rm02 for_dashboard">

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Salutation <span class="text-danger">*</span></label>
                                    <select class="rm_form_fild" name="salutation">
                                        <option value="">Select</option>
                                        <option value="Mr." @if(@$witnessDetail->salutation == 'Mr.') Selected @endif>Mr.</option>
                                        <option value="Ms." @if(@$witnessDetail->salutation == 'Ms.') Selected @endif>Ms.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-100"></div>

                            <label generated="true" class="name_error error mb-3 ml-3" style="display: none;">Please enter not more than 255 characters for First Name, Middle Name and Last Name</label>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here" name="first_name"
                                        value="{{@$witnessDetail->first_name}}">
                                    @if($errors->has('first_name'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('first_name')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here" name="middle_name"
                                        value="{{@$witnessDetail->middle_name}}">
                                    @if($errors->has('middle_name'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('middle_name')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here" name="last_name"
                                        value="{{@$witnessDetail->last_name}}">
                                    @if($errors->has('last_name'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('last_name')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Aadhar Number</label>
                                    <input type="text" name="aadhar_number" class="rm_form_fild" id="aadhar_number"
                                        placeholder="Enter here" value="{{@$witnessDetail->aadhar_number}}">
                                    @if($errors->has('aadhar_number'))
                                    <span>
                                        <strong
                                            style="color: red !important">{{$errors->first('aadhar_number')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            {{--
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Place of Signature</label>
                                    <input type="text" name="sign_place" class="rm_form_fild"
                                        placeholder="Enter here" value="{{@$witnessDetail->sign_place}}">
                                    @if($errors->has('sign_place'))
                                    <span>
                                        <strong
                                            style="color: red !important">{{$errors->first('sign_place')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group signDate">
                                    <label>Date of Signature <span class="text-danger">*</span></label>
                                        <input type="text" name="sign_date" value="{{@$witnessDetail->sign_date}}" class="rm_form_fild calandar_iconn sign_date"
                                            placeholder="Select" id="datepicker" readonly="true">
                                    @if($errors->has('sign_date'))
                                    <span>
                                        <strong
                                            style="color: red !important">{{$errors->first('sign_date')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            --}}


                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <select class="input_form_login p_input rm_form_fild" name="country_id"
                                        id="countryList">
                                        <option value="">Select Country</option>

                                        @foreach($countrys as $country)
                                        <option phonecode="{{ $country->phonecode }}" value="{{$country->id}}"
                                            id="shop-country" {{@$witnessDetail->country == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="country_err error" style="display: none;">Coming Soon to Your
                                        Country</label>
                                    @if($errors->has('country_id'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('country_id')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>State <span class="text-danger">*</span></label>
                                    <input type="text" name="state" class="rm_form_fild" placeholder="Enter here"
                                        value="{{@$witnessDetail->state}}">
                                    @if($errors->has('state'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('state')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="rm_form_fild" placeholder="Enter here"
                                        value="{{@$witnessDetail->city}}">
                                    @if($errors->has('city'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('city')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Address 1 <span class="text-danger">*</span></label>
                                    <input type="text" name="address1" class="rm_form_fild" placeholder="Enter here"
                                        value="{{@$witnessDetail->address1}}">
                                    @if($errors->has('address1'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('address1')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Address 2 <span class="text-danger">*</span></label>
                                    <input type="text" name="address2" class="rm_form_fild" placeholder="Enter here"
                                        value="{{@$witnessDetail->address2}}">
                                    @if($errors->has('address2'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('address2')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Postcode <span class="text-danger">*</span></label>
                                    <input type="text" name="zip_code" class="rm_form_fild" placeholder="Enter here"
                                        value="{{@$witnessDetail->zip_code}}">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-4 mt-1">
                                <div class="doubleborder"></div>
                                <div class="doubleborder"></div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                <div class="btn-sec">
                                    <div class="btn-sec-lft">
                                <button type="submit" class="submit_rm bntt_collor" id="">Update</button>

                                {{-- <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Update & Continue</button> --}}

                                @if(@$executor >0)
                                    <a href="{{route('user.manage.executor',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                @else
                                    <a href="{{route('user.add.executor',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                @endif

                                @if(@$contingency >0)
                                    <a href="{{route('user.manage.liability',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                @else
                                    <a href="{{route('user.add.liability',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                @endif
                            </div>


                            {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                </div>

                                <p>If you wish to add another witness, please click "Update" and add another witness.
                                    If you do not have a witness, you can press the "Skip" button. </p>
                            </div>


                            <div class="w-100"></div>

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

         $.validator.addMethod("postcode", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9 ])+$/.test(value)
        }, "Allow only (a-z, A-Z, 0-9, )");


    $("#witness-form").validate({
        rules: {
            first_name:{name_Regex:true,required: true,maxlength:100},
            middle_name:{name_Regex:true,maxlength:100},
            last_name:{name_Regex:true,required: true,maxlength:100},
            country_id: {
                required: true
            },
            salutation: {
                required: true
            },
            zip_code: {
                required: true,
                postcode: true,
                //onlyNumbers:true,
                maxlength: 10
            },
            aadhar_number: {
                //required: true,
                digits: true,
                //onlyNumbers:true,
                minlength: 12,
                maxlength: 12,
                remote: {
                    url: '{{ route("check.witness.aadharnumber") }}',
                    dataType: 'json',
                    type:'post',
                    data: {
                        aadhar_number: function() {
                            return $('#aadhar_number').val();
                        },
                        will_id: function() {

                        var will_id = $('#will_id').val();
                        return will_id;
                        },
                        witness_id: function() {

                        var witness_id = $('#witness_id').val();
                        return witness_id;
                        },
                        _token: '{{ csrf_token() }}'
                    }
                },
            },
            // sign_place: {
            //     //required: true,
            //     maxlength: 100,
            // },
            // sign_date: {
            //     required: true,
            //     remote: {
            //         url: '{{ route("witness.date.check") }}',
            //         dataType: 'json',
            //         type:'post',
            //         data: {
            //             sign_date: function() {
            //                 return $('.sign_date').val();
            //             },
            //             will_id: function() {

            //             var will_id = $('#will_id').val();
            //             return will_id;
            //             },
            //             witness_id: function() {

            //             var witness_id = $('#witness_id').val();
            //             return witness_id;
            //             },
            //             _token: '{{ csrf_token() }}'
            //         }
            //     },
            // },
            relationship:{name_Regex:true,required: true,maxlength:100},
           address1:{required: true,address_Regex: true,maxlength:200},
           address2:{required: true,address_Regex: true,maxlength:200},
           city:{name_Regex:true,required: true,maxlength:100},
           state:{name_Regex:true,required: true,maxlength:100},

        },
        messages: {
            first_name: {
                maxlength: 'Please enter not more than 100 characters'
            },
            middle_name: {
                maxlength: 'Please enter not more than 100 characters'
            },
            last_name: {
                maxlength: 'Please enter not more than 100 characters'
            },
            sign_place: {
                maxlength: 'Please enter not more than 100 characters',
            },
            // sign_date: {
            //     remote: 'Date does not match with the sign date of other witness',
            // },
            city:{
               maxlength: 'Please enter not more than 100 characters',
               name_Regex: 'City name must contain only letters'
            },
            state:{
               maxlength: 'Please enter not more than 100 characters',
               name_Regex: 'State name must contain only letters'
            },
            zip_code: {
                digits: 'Please enter a valid number'
            },
            aadhar_number: {
                digits: 'Please enter a valid number',
                minlength:'Please enter at least 12 digits.',
                maxlength:'Please enter not more than 12 digits.',
                remote:'Aadhar Number already in use on this service',
            },
            address1: {
                maxlength: 'Please enter not more than 200 characters'
            },
            address2: {
                maxlength: 'Please enter not more than 200 characters'
            }
        },

        submitHandler: function(form) {
            var fname = $('[name="first_name"]').val();
            var lname = $('[name="last_name"]').val();
            var mname = $('[name="middle_name"]').val();
            var totalLength = parseInt(fname.length) + parseInt (mname.length) + parseInt(lname.length);

            if(totalLength > 255){
                $('.name_error').show();
                return false;
            }else {
                $('.name_error').hide();
                form.submit();
            }
        },

    });


});
</script>

<script>
    $(document).ready(function () {
        $('.sign_date').on('change', function() {
        var sign_date = $('.sign_date').val();
        var will_id = $('#will_id').val();
        var witness_id = $('#witness_id').val();
        //console.log('sign_date ',sign_date);
        var reqData = {
                'jsonrpc' : '2.0',
                '_token'  : '{{csrf_token()}}',
                'will_id'    : will_id,
                'witness_id'    : witness_id,
                'sign_date'    : sign_date,
            };
            $.ajax(
            {
                url: "{{ route('witness.date.check') }}",
                dataType: 'json',
                data: reqData,
                type: 'post',
                success: function(response)
                {
                    //console.log('sign_date ',response);
                    if(response == true){
                        $('.signDate label.error').css('display','none');
                        $('.sign_date').removeClass('error');
                    }

                },
                error:function(error)
                {
                    console.log(error.responseText);
                }
            });
        });

        $(function () {
            $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            maxDate: new Date()
        });
        });

    });
</script>

@endsection
