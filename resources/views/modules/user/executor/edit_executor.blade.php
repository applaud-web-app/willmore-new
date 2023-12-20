@extends('layouts.app')
@section('title','View Executor')
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
                    <h2>Edit Executor</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    <a href="{{route('user.manage.executor',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                <div class="dash-right-inr">
                @include('includes.message')

                    <form id="executor-form" method="POST" action="{{ route('update.executor') }}">
                        @csrf

                        <input type="hidden" class="rm_form_fild" name="will_id" id="will_id" value="{{@$will_id}}">
                        <input type="hidden" class="rm_form_fild" name="id" id="id" value="{{@$executorDetail->id}}">
                        <div class="row login_rm02 for_dashboard">

                            <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                <h1>Executor's Information</h1>
                            </div>

                            <label generated="true" class="name_error error mb-3 ml-3" style="display: none;">Please enter not more than 255 characters for First Name, Middle Name and Last Name</label>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here" name="first_name"
                                        value="{{@$executorDetail->first_name}}">
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
                                        value="{{@$executorDetail->middle_name}}">
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
                                        value="{{@$executorDetail->last_name}}">
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
                                        placeholder="Enter here" value="{{@$executorDetail->aadhar_number}}">
                                    @if($errors->has('aadhar_number'))
                                    <span>
                                        <strong
                                            style="color: red !important">{{$errors->first('aadhar_number')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input id="email" name="email" type="text" class="rm_form_fild" placeholder="Enter here"
                                         value="{{@$executorDetail->email}}" autocomplete="email">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group phncc-inpt">
                                    <label>Mobile number <span class="text-danger">*</span></label>
                                                <div class="phonecode-sec">
                                                    <select class="input_form_login p_input rm_form_fild" name="phonecode" id="singleSelectExample">
                                                            @foreach($countrys as $phonecode)
                                                            <option value="{{$phonecode->id}}" @if(@$executorDetail->phonecode == @$phonecode->id) selected @elseif($phonecode->phonecode == 91) selected @endif >+{{$phonecode->phonecode}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                    <input type="text" placeholder="Enter here" name="mobile" id="mobile"
                                        class="rm_form_fild @error('mobile') is-invalid @enderror"
                                        value="{{@$executorDetail->mobile}}">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Citizen of <span class="text-danger">*</span></label>
                                    <select class="input_form_login p_input rm_form_fild" name="nationality"
                                        id="nationality">
                                        <option value="">Select Country</option>

                                        @foreach($nationality as $n)
                                        <option phonecode="{{ $n->phonecode }}" value="{{$n->id}}" {{@$executorDetail->nationality == $n->id ? 'selected' : ''}} id="shop-n">
                                            {{$n->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Relationship Description <span class="text-danger">*</span></label>
                                    <select class="rm_form_fild" name="user_relation" id="user_relation">
                                        <option value="">Select</option>
                                        <option value="S" {{@$executorDetail->user_relation == 'S' ? 'selected' : ''}}>Son of</option>
                                        <option value="W" {{@$executorDetail->user_relation == 'W' ? 'selected' : ''}}>Wife of</option>
                                        <option value="D" {{@$executorDetail->user_relation == 'D' ? 'selected' : ''}}>Daughter of</option>
                                        <option value="H" {{@$executorDetail->user_relation == 'H' ? 'selected' : ''}}>Husband of</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label id="relat_name">
                                        @if(@$executorDetail->user_relation == 'S')
                                            Fathers Name
                                        @elseif(@$executorDetail->user_relation == 'W')
                                            Husbands Name
                                        @elseif(@$executorDetail->user_relation == 'D')
                                            Fathers Name
                                        @elseif(@$executorDetail->user_relation == 'H')
                                            Wifes Name
                                        @endif
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="relationship" class="rm_form_fild" placeholder="Enter here"
                                        value="{{@$executorDetail->relationship}}">
                                    @if($errors->has('relationship'))
                                    <span>
                                        <strong
                                            style="color: red !important">{{$errors->first('relationship')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <select class="input_form_login p_input rm_form_fild" name="country_id"
                                        id="countryList">
                                        <option value="">Select Country</option>

                                        @foreach($countrys as $country)
                                        <option phonecode="{{ $country->phonecode }}" value="{{$country->id}}"
                                            id="shop-country" {{@$executorDetail->country == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
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
                                        value="{{@$executorDetail->state}}">
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
                                        value="{{@$executorDetail->city}}">
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
                                        value="{{@$executorDetail->address1}}">
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
                                        value="{{@$executorDetail->address2}}">
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
                                        value="{{@$executorDetail->zip_code}}">
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-6">
                                <div class="form-group">
                                    <label>Relation between Executor and Will creator <span class="text-danger">*</span></label>
                                    <input type="text" name="exe_willcreator_relation" class="rm_form_fild" placeholder="Enter here"
                                        value="{{@$executorDetail->exe_willcreator_relation}}">
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
                                @if(@$locPack->package_id ==1 )
                                <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Update & Continue</button>

                                @if(@$beneficiaries >0)
                                    <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                @else
                                    <a href="{{route('user.add.beneficiaries',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                @endif

                                {{-- @if(@$beneficiaries >0)
                                    <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                @else
                                    <a href="{{route('user.add.beneficiaries',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                @endif --}}
                                @endif
                            </div>

                            {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                </div>

                            {{-- @if(@$countExecutor < 2)
                            <p>If you wish to add another executor, please click "Update" and add another executor.</p>
                            @endif --}}
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

         $.validator.addMethod("num_Regex", function(value, element) {
         return this.optional(element) || /^[\d+ ]*$/.test(value);
         }, "Please endter a valid number!");

         $.validator.addMethod("postcode", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9 ])+$/.test(value)
        }, "Allow only (a-z, A-Z, 0-9, )");


    $("#executor-form").validate({
        rules: {
            first_name:{name_Regex:true,required: true,maxlength:200},
            middle_name:{name_Regex:true,maxlength:100},
            last_name:{name_Regex:true,required: true,maxlength:200},
            country_id: {
                required: true
            },
            phonecode: {
                required: true
            },
            mobile:{
                    required:true,
                    num_Regex: true ,
                    minlength: 9,
                    maxlength: 10,
                    remote: {
                    url: '{{ route("check.executor.mobile") }}',
                    dataType: 'json',
                    type:'post',
                    data: {
                        mobile: function() {
                            return $('#mobile').val();
                        },
                        will_id: function() {

                        var will_id = $('#will_id').val();
                        return will_id;
                        },
                        id: function() {

                        var id = $('#id').val();
                        return id;
                        },
                        _token: '{{ csrf_token() }}'
                    }
                },
            },
            email: {
                required: true,
                email: true,
                maxlength: 100,
                remote: {
                    url: '{{ route("check.executor.email") }}',
                    dataType: 'json',
                    type:'post',
                    data: {
                        email: function() {
                            return $('#email').val();
                        },
                        will_id: function() {

                        var will_id = $('#will_id').val();
                        return will_id;
                        },
                        id: function() {

                        var id = $('#id').val();
                        return id;
                        },
                        _token: '{{ csrf_token() }}'
                    }
                },
            },
            zip_code: {
                required: true,
                postcode: true,
                //onlyNumbers:true,
                maxlength: 10
            },
            aadhar_number: {
                //required: true,
                num_Regex: true,
                minlength: 12,
                maxlength: 12,
                remote: {
                    url: '{{ route("check.executor.aadharnumber") }}',
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
                        id: function() {

                        var id = $('#id').val();
                        return id;
                        },
                        _token: '{{ csrf_token() }}'
                    }
                },
            },
            nationality: {
                required: true
            },
            user_relation: {
                required: true
            },
            relationship:{name_Regex:true,required: true,maxlength:100},
            exe_willcreator_relation:{required: true,maxlength:100},
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
            mobile:{
                remote:'Mobile number already in use on this service',
                minlength:'Please enter at least 9 digits.',
                maxlength:'Please enter not more than 10 digits.',
             },
            email: {
                maxlength: 'Please enter not more than 100 characters',
                remote:'Email already in use on this service',
            },
            relationship: {
                maxlength: 'Please enter not more than 100 characters'
            },
            exe_willcreator_relation: {
                maxlength: 'Please enter not more than 200 characters',
            },
            city:{
               maxlength: 'Please enter not more than 100 characters'
            },
            state:{
               maxlength: 'Please enter not more than 100 characters'
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
    $(document).ready(function (e) {

    $('#user_relation').change(function(){

        var user_relation= $('#user_relation').val();

        if(user_relation == 'S'){

            $('#relat_name').html('Fathers Name');

        }else if(user_relation == 'W'){

            $('#relat_name').html('Husbands Name');

        }else if(user_relation == 'D'){

            $('#relat_name').html('Fathers Name');

        }else if(user_relation == 'H'){

            $('#relat_name').html('Wifes Name');

        }

    });
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

$(document).ready(
function () {

    // Single select example if using params obj or configuration seen above
    var configParamsObj = {
        placeholder: 'Select an option...', // Place holder text to place in the select
        minimumResultsForSearch: 3 // Overrides default of 15 set above
    };
    $("#singleSelectExample").select2(configParamsObj);
});

</script>

@endsection
