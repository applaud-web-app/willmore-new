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
                    <h2>Add @if(@$locPack->package_id ==1 )Beneficiaries @elseif(@$locPack->package_id == 5) Trusted Person @else Nominee @endif</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    @if(@$locPack->package_id ==1 )
                    <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="top_battn_new">Back to list</a>
                    @else
                    <a href="{{route('user.service.authorized',[@$will_id])}}" class="top_battn_new">Back to list</a>
                    @endif
                </div>

                <div class="dash-right-inr">
                @include('includes.message')

                    <form id="beneficiaries-form" method="POST" action="{{ route('save.beneficiaries') }}">
                        @csrf

                        <input type="hidden" class="rm_form_fild" name="will_id" id="will_id" value="{{@$will_id}}">
                        @if(@$locPack->package_id !=1 )
                        <input type="hidden" class="rm_form_fild" name="is_new_person" value="Y">
                        @endif
                        <div class="row login_rm02 for_dashboard">

                            <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                <h1>@if(@$locPack->package_id ==1 )Beneficiaries @elseif(@$locPack->package_id == 5) Trusted Person @else Nominee @endif Information</h1>
                            </div>

                            <label generated="true" class="name_error error mb-3 ml-3" style="display: none;">Please enter not more than 255 characters for First Name, Middle Name and Last Name</label>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="rm_form_fild" placeholder="Enter Here" name="first_name"
                                        value="{{old('first_name')}}">
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
                                        value="{{old('middle_name')}}">
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
                                        value="{{old('last_name')}}">
                                    @if($errors->has('last_name'))
                                    <span>
                                        <strong style="color: red !important">{{$errors->first('last_name')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Aadhar Number</label>
                                    <input type="text" name="aadhar_number" class="rm_form_fild"
                                        placeholder="Enter here" value="{{old('aadhar_number')}}" id="aadhar_number">
                                    @if($errors->has('aadhar_number'))
                                    <span>
                                        <strong
                                            style="color: red !important">{{$errors->first('aadhar_number')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Aadhar OR Passport OR PAN</label>
                                    <select name="doc_type" id="doc_type" class="rm_form_fild">
                                        <option value="1">Aadhar</option>
                                        <option value="2">PAN</option>
                                        <option value="3">Passport</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Identity Card Number</label>
                                    <input id="card_number" type="text" class="rm_form_fild" placeholder="Enter here"
                                    name="card_number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6"></div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input id="email" type="text" class="rm_form_fild" placeholder="Enter here"
                                        name="email" value="{{ old('email') }}" autocomplete="email">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group phncc-inpt">
                                    <label>Mobile number <span class="text-danger">*</span></label>
                                                <div class="phonecode-sec">
                                                    <select class="input_form_login p_input rm_form_fild" name="phonecode" id="singleSelectExample">
                                                            <option value="">Select</option>
                                                            @foreach($countrys as $phonecode)
                                                            <option value="{{$phonecode->id}}" {{$phonecode->phonecode == 91 ? 'selected' : ''}}>+{{$phonecode->phonecode}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                    <input type="text" placeholder="Enter here" id="mobile" name="mobile"
                                        class="rm_form_fild @error('mobile') is-invalid @enderror"
                                        value="{{old('mobile')}}">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Citizen of <span class="text-danger">*</span></label>
                                    <select class="input_form_login p_input rm_form_fild" name="nationality"
                                        id="nationality">
                                        <option value="">Select Country</option>

                                        @foreach(@$nationality as $n)
                                        <option phonecode="{{ $n->phonecode }}" value="{{$n->id}}" id="shop-n">
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
                                        <option value="S">Son of</option>
                                        <option value="W">Wife of</option>
                                        <option value="D">Daughter of</option>
                                        <option value="H">Husband of</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label id="relat_name">
                                        <!--F/o / H/o--> Name  <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="relationship" class="rm_form_fild" placeholder="Enter here"
                                        value="{{old('relationship')}}">
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
                                            id="shop-country">{{$country->name}}</option>
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
                                        value="{{old('state')}}">
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
                                        value="{{old('city')}}">
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
                                        value="{{old('address1')}}">
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
                                        value="{{old('address2')}}">
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
                                        value="{{@$user ? @$user->zip_code: ''}}">
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

                                @if(@$locPack->package_id ==1 )
                                <button type="submit" class="submit_rm bntt_collor" id="">Save</button>

                                <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Save & Continue</button>

                                @if(@$cash >0)
                                    <a href="{{route('user.manage.cash',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                @else
                                    <a href="{{route('user.add.cash',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                @endif

                                @if(@$executor >0)
                                    <a href="{{route('user.manage.executor',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                @else
                                    <a href="{{route('user.add.executor',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                @endif
                                @endif

                                @if(@$locPack->package_id !=1 )
                                    <button type="submit" name="newperson" class="submit_rm bntt_collor" value="Y">Save</button>
                                @endif
                            </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                </div>

                                <p>If you wish to add another @if(@$locPack->package_id ==1 )beneficiary @elseif(@$locPack->package_id == 5) Trusted Person @else nominee @endif, please click "Save" and add another @if(@$locPack->package_id ==1 )beneficiary @elseif(@$locPack->package_id == 5) Trusted Person @else nominee @endif.</p>
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
        $('.pdf_alrt').click(function() {
            var id = $(this).data('id');

            var checkWitness = $('.witnessExist').val();

            if(checkWitness == 1){
                Swal.fire({
                    title: 'Hope you have added all information pertaining to your assets! Do you wish to proceed with the completion of the Will?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // window.location.href = "{{url('download-pdf')}}/" + id;
                        url = "{{url('download-pdf')}}/" + id;
                        window.open(url, '_blank');
                    } else {
                        return false;
                    }
                });

            }else{
                Swal.fire({
                    title: 'Please add atleast one Witness to proceed',
                    icon: 'danger',
                    showCancelButton: false,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Ok'
                });
            }
        });
    });
</script>

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

        $.validator.addMethod("alpha_space", function(value, element) {
         return this.optional(element) || /^[a-zA-Z0-9\s\-\/]+$/.test(value);
         }, "Please enter only letters and numbers.");

    $("#beneficiaries-form").validate({
        rules: {
            first_name:{name_Regex:true,required: true,maxlength:100},
            middle_name:{name_Regex:true,maxlength:100},
            last_name:{name_Regex:true,required: true,maxlength:100},
            country_id: {
                required: true
            },
            phonecode: {
                required: true
            },
            card_number: {
                required: true,
                alpha_space:true,
            },
            mobile:{
                    required:true,
                    num_Regex: true ,
                    minlength: 9,
                    maxlength: 10,
                    remote: {
                    url: '{{ route("check.beneficiaries.mobile") }}',
                    dataType: 'json',
                    type:'post',
                    data: {
                        mobile: function() {
                            return $('#mobile').val();
                        },
                        will_id: function() {

                        var will_id = $('#will_id').val();
                        return will_id;
                        // return
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
                    url: '{{ route("check.beneficiaries.email") }}',
                    dataType: 'json',
                    type:'post',
                    data: {
                        email: function() {
                            return $('#email').val();
                        },
                        will_id: function() {

                        var will_id = $('#will_id').val();
                        return will_id;
                        // return
                        },
                        _token: '{{ csrf_token() }}'
                    }
                },
            },
            zip_code: {
                required: true,
                postcode:true,
                maxlength: 10
            },
            aadhar_number: {
                //required: true,
                num_Regex: true,
                //onlyNumbers:true,
                minlength: 12,
                maxlength: 12,
                remote: {
                    url: '{{ route("check.beneficiaries.aadharnumber") }}',
                    dataType: 'json',
                    type:'post',
                    data: {
                        aadhar_number: function() {
                            return $('#aadhar_number').val();
                        },
                        will_id: function() {

                        var will_id = $('#will_id').val();
                        return will_id;
                        // return
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
                minlength:'Please enter at least 9 digits.',
                maxlength:'Please enter not more than 10 digits.',
                remote:'Mobile number already in use on this service',
             },
            email: {
                maxlength: 'Please enter not more than 100 characters',
                remote:'Email already in use on this service',
            },
            relationship: {
                maxlength: 'Please enter not more than 100 characters'
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
