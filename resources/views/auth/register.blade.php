@extends('layouts.app')
@section('title','Sign Up')
@section('links')
@include('includes.links')
<style>
    .ui-datepicker .ui-datepicker-title {
    margin: 0 28px 0 8px !important;
}
.login_rm02 .form-group label span{
    color: #f43930;
}
</style>
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<section class="pager-section login_bg overlay banner_small_rm">
    <div class="container">
        <div class="main-banner-content p-relative">
            @include('includes.social_links')
            <!--social-links end-->
            <div class="pager-content">

                <h2 class="page-title">Sign Up</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    <li><span>Sign Up </span></li>
                </ul>
                <!--breadcrumb end-->
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--pager-section end-->

<section class="block2 section_padding register-section">
    <div class="container">
        <div class="contact_section">
            <div class="row align-items-center">



                <div class="col-lg-12">
                    <div class="cnst-form login_rm02 for_signup_sec">
                    @include('includes.message')
                        <div class="section-title">
                            <h2 class="h-title dark-clr mw-100">Sign Up</h2>
                            <span>Please fill up the below fields to continue</span>
                        </div>

                        <div class="login_form_rm">
                            <form id="register-form" method="POST" action="{{ route('save.register.user') }}">
                            @csrf

                            <label generated="true" class="passport_error error mb-3 ml-3" style="display: none;width: 100%;">Please fill atleast one of these fields - <strong>Aadhar Number</strong> or <strong>Passport Number</strong>.</label>

                            <label generated="true" class="name_error error mb-3 ml-3" style="display: none;">Please enter not more than 255 characters for First Name, Middle Name and Last Name</label>
                                <div class="single_blocks">
                                    <h3 class="rblocktitle">Your Account Details</h3>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Email address <span>*</span></label>
                                                    <input id="email" type="text" class="rm_form_fild" placeholder="Enter here" name="email" value="{{ old('email') }}" autocomplete="email"  maxlength="200">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Password <span>*</span></label>
                                                <input type="password" class="rm_form_fild" id="password-field"  name="password" placeholder="***************">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                @if($errors->has('password'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('password')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                                <label class="password_error error"></label>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Confirm Password <span>*</span></label>
                                                <input type="password" class="rm_form_fild" id="password-field1" placeholder="***************" name="password_confirmation">
                                                <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>


                                    </div>
                                </div> 
                                
                                <div class="single_blocks">
                                    <h3 class="rblocktitle">Fill your Personal Details</h3>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>First Name <span>*</span></label>
                                                    <input type="text" class="rm_form_fild" placeholder="Enter Here" name="first_name" value="{{old('first_name')}}" maxlength="50">
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
                                                <input type="text" class="rm_form_fild" placeholder="Enter Here" name="middle_name" value="{{old('middle_name')}}" maxlength="50">
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
                                                <input type="text" class="rm_form_fild" placeholder="Enter Here" name="last_name" value="{{old('last_name')}}" maxlength="50">
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
                                                <input type="text" class="rm_form_fild calandar_iconn dob" placeholder="Select" id="datepicker" name="dob" value="{{old('dob')}}" readonly='true'>
                                                    @if($errors->has('dob'))
                                                        <span >
                                                        <strong style="color: red !important">{{$errors->first('dob')}}</strong>
                                                        </span>
                                                    @endif
                                                    <label for="chk" generated="true" class="dob_error error" style="display: none;"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group phncc-inpt">
                                                <label>Mobile number <span>*</span></label>
                                                    <div class="phonecode-sec">
                                                        <select class="input_form_login p_input rm_form_fild" name="phonecode" id="singleSelectExample">
                                                                @foreach($countrys as $phonecode)
                                                                    <option value="{{$phonecode->country_phone_code}}" {{$phonecode->country_phone_code == 91 ? 'selected' : ''}}>+{{$phonecode->country_phone_code}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="text" placeholder="Enter here" id="mobile" name="mobile" class="rm_form_fild @error('mobile') is-invalid @enderror" value="{{old('mobile')}}" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 for_genderr">
                                            <div class="form-group gender_box">
                                                <label>Gender <span>*</span></label>
                                                <label class="radio">
                                                    <input id="radio1" type="radio" name="gender" value="Male" class="gender1">
                                                    <span class="outer"><span class="inner"></span></span>Male</label>
    
                                                <label class="radio">
                                                    <input id="radio2" type="radio" name="gender" value="Female" class="gender2">
                                                    <span class="outer"><span class="inner"></span></span>Female</label>
    
                                                <label class="radio">
                                                    <input id="radio2" type="radio" name="gender" value="Others" class="gender3">
                                                    <span class="outer"><span class="inner"></span></span>Others</label>
                                            </div>
                                            <label generated="true" class="gender_error error mb-3 ml-3" style="display: none;width: 100%;">This field is required.</label>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Aadhar Number</label>
                                                <input type="text" name="aadhar_number" class="rm_form_fild" id="aadhar_number"
                                                    placeholder="Enter here" value="{{old('aadhar_number')}}">
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
                                                    placeholder="Enter here" value="{{old('pan_number')}}">
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
                                                    placeholder="Enter here" value="{{old('passport_number')}}">
                                                    @if($errors->has('passport_number'))
                                                        <span >
                                                        <strong style="color: red !important">{{$errors->first('passport_number')}}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
                                      

                                     

                                    </div>
                                </div> 

                                <div class="single_blocks">
                                    <h3 class="rblocktitle">Access Details</h3>
                                    <div class="row">
                                      

                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Address 1 <span>*</span></label>
                                                <input type="text" name="address1" class="rm_form_fild"
                                                    placeholder="Enter here" value="{{old('address1')}}">
                                                    @if($errors->has('address1'))
                                                        <span >
                                                        <strong style="color: red !important">{{$errors->first('address1')}}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Address 2 <span>*</span></label>
                                                <input type="text" name="address2" class="rm_form_fild"
                                                    placeholder="Enter here" value="{{old('address2')}}">
                                                    @if($errors->has('address2'))
                                                        <span >
                                                        <strong style="color: red !important">{{$errors->first('address2')}}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
    
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Post Code <span>*</span></label>
                                                <input type="text" name="zip_code" class="rm_form_fild"
                                                    placeholder="Enter here" value="{{old('zip_code')}}">
                                                    @if($errors->has('zip_code'))
                                                        <span >
                                                        <strong style="color: red !important">{{$errors->first('zip_code')}}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
    
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Country <span>*</span></label>
                                                <select class="input_form_login p_input rm_form_fild" name="country_id" id="countryList">
                                                        <option value="">Select Country</option>

                                                        @foreach($countrys as $country)
                                                            <option phonecode="{{ $country->country_phone_code }}" value="{{$country->country_name}}"  id="shop-country">{{$country->country_name}}</option>
                                                        @endforeach
                                                </select>
                                                <label class="country_err error" style="display: none;">Coming Soon to Your Country</label>
                                                @if($errors->has('country_id'))
                                                <span >
                                                <strong style="color: red !important">{{$errors->first('country_id')}}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>State <span>*</span></label>
                                                    <select class="input_form_login p_input rm_form_fild" name="state" id="stateList">
                                                        <option value="">Select State</option>
                                                    </select>
                                                    @if($errors->has('state'))
                                                        <span >
                                                        <strong style="color: red !important">{{$errors->first('state')}}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>City <span>*</span></label>
                                                <input type="text" name="city" class="rm_form_fild"
                                                    placeholder="Enter here" value="{{old('city')}}">
                                                    @if($errors->has('city'))
                                                        <span >
                                                        <strong style="color: red !important">{{$errors->first('city')}}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>


                                    </div>
                                </div> 

















                                <div class="row">

                                    {{-- <label generated="true" class="passport_error error mb-3 ml-3" style="display: none;width: 100%;">Please fill atleast one of these fields - <strong>Aadhar Number</strong> or <strong>Passport Number</strong>.</label>

                                    <label generated="true" class="name_error error mb-3 ml-3" style="display: none;">Please enter not more than 255 characters for First Name, Middle Name and Last Name</label>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>First Name <span>*</span></label>
                                                <input type="text" class="rm_form_fild" placeholder="Enter Here" name="first_name" value="{{old('first_name')}}" maxlength="50">
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
                                            <input type="text" class="rm_form_fild" placeholder="Enter Here" name="middle_name" value="{{old('middle_name')}}" maxlength="50">
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
                                            <input type="text" class="rm_form_fild" placeholder="Enter Here" name="last_name" value="{{old('last_name')}}" maxlength="50">
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
                                            <input type="text" class="rm_form_fild calandar_iconn dob" placeholder="Select" id="datepicker" name="dob" value="{{old('dob')}}" readonly='true'>
                                                @if($errors->has('dob'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('dob')}}</strong>
                                                    </span>
                                                @endif
                                                <label for="chk" generated="true" class="dob_error error" style="display: none;"></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-8 col-md-12 for_genderr">
                                        <div class="form-group gender_box">
                                            <label>Gender <span>*</span></label>
                                            <label class="radio">
                                                <input id="radio1" type="radio" name="gender" value="Male" class="gender1">
                                                <span class="outer"><span class="inner"></span></span>Male</label>

                                            <label class="radio">
                                                <input id="radio2" type="radio" name="gender" value="Female" class="gender2">
                                                <span class="outer"><span class="inner"></span></span>Female</label>

                                            <label class="radio">
                                                <input id="radio2" type="radio" name="gender" value="Others" class="gender3">
                                                <span class="outer"><span class="inner"></span></span>Others</label>
                                        </div>
                                        <label generated="true" class="gender_error error mb-3 ml-3" style="display: none;width: 100%;">This field is required.</label>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Aadhar Number</label>
                                            <input type="text" name="aadhar_number" class="rm_form_fild" id="aadhar_number"
                                                placeholder="Enter here" value="{{old('aadhar_number')}}">
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
                                                placeholder="Enter here" value="{{old('pan_number')}}">
                                                @if($errors->has('pan_number'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('pan_number')}}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Passport Number</label>
                                            <input type="text" name="passport_number" class="rm_form_fild panNum" id="passport_number"
                                                placeholder="Enter here" value="{{old('passport_number')}}">
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
                                            <input type="text" class="rm_form_fild calandar_iconn dob date_input passport_issued_date" placeholder="Select" id="datepicker2" name="passport_issued_date" value="{{old('passport_issued_date')}}" readonly='true'>
                                            <span class="clear_date">Clear <img src="{{asset('public/images/remove1.png')}}" alt=""></span>
                                                @if($errors->has('passport_issued_date'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('passport_issued_date')}}</strong>
                                                    </span>
                                                @endif
                                                <label for="chk" generated="true" class="issue_error error" style="display: none;"></label>
                                        </div>
                                        <label for="chk" generated="true" class="passport_idate_err error" style="display: none;">Please select a valid Issued date</label>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group expiryD">
                                            <label>Date of expiry</label>
                                            <input type="text" class="rm_form_fild calandar_iconn dob date_input passport_expiry_date" placeholder="Select" id="datepicker3" name="passport_expiry_date" value="{{old('passport_expiry_date')}}" readonly='true'>
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


                                    <div class="w-100"></div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Email address <span>*</span></label>
                                                <input id="email" type="text" class="rm_form_fild" placeholder="Enter here" name="email" value="{{ old('email') }}" autocomplete="email"  maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group phncc-inpt">
                                            <label>Mobile number <span>*</span></label>
                                                <div class="phonecode-sec">
                                                    <select class="input_form_login p_input rm_form_fild" name="phonecode" id="singleSelectExample">
                                                            @foreach($countrys as $phonecode)
                                                            <option value="{{$phonecode->id}}" {{$phonecode->phonecode == 91 ? 'selected' : ''}}>+{{$phonecode->phonecode}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                                <input type="text" placeholder="Enter here" id="mobile" name="mobile" class="rm_form_fild @error('mobile') is-invalid @enderror" value="{{old('mobile')}}" >
                                        </div>
                                    </div>

                                    <div class="w-100"></div>



                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Citizen of <span>*</span></label>
                                            <select class="input_form_login p_input rm_form_fild" name="nationality" id="nationality">
                                                    <option value="">Select Country</option>

                                                    @foreach($nationality as $n)
                                                    <option phonecode="{{ $n->phonecode }}" value="{{$n->id}}"  id="shop-n">{{$n->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Relationship description <span>*</span></label>
                                            <select class="rm_form_fild"name="user_relation" id="user_relation">
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
                                                <!--F/o / H/o--> Name <span>*</span>
                                            </label>
                                            <input type="text" name="relationship" class="rm_form_fild"
                                                placeholder="Enter here" value="{{old('relationship')}}" maxlength="100">
                                                @if($errors->has('relationship'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('relationship')}}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>



                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Address 1 <span>*</span></label>
                                            <input type="text" name="address1" class="rm_form_fild"
                                                placeholder="Enter here" value="{{old('address1')}}">
                                                @if($errors->has('address1'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('address1')}}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Address 2 <span>*</span></label>
                                            <input type="text" name="address2" class="rm_form_fild"
                                                placeholder="Enter here" value="{{old('address2')}}">
                                                @if($errors->has('address2'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('address2')}}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Post Code <span>*</span></label>
                                            <input type="text" name="zip_code" class="rm_form_fild"
                                                placeholder="Enter here" value="{{old('zip_code')}}">
                                                @if($errors->has('zip_code'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('zip_code')}}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>City <span>*</span></label>
                                            <input type="text" name="city" class="rm_form_fild"
                                                placeholder="Enter here" value="{{old('city')}}">
                                                @if($errors->has('city'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('city')}}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>State <span>*</span></label>
                                                <input type="text" name="state" class="rm_form_fild"
                                                placeholder="Enter here" value="{{old('state')}}">
                                                @if($errors->has('state'))
                                                    <span >
                                                    <strong style="color: red !important">{{$errors->first('state')}}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Country <span>*</span></label>
                                            <select class="input_form_login p_input rm_form_fild" name="country_id" id="countryList">
                                                    <option value="">Select Country</option>

                                                    @foreach($countrys as $country)
                                                    <option phonecode="{{ $country->phonecode }}" value="{{$country->id}}"  id="shop-country">{{$country->name}}</option>
                                                    @endforeach
                                            </select>
                                            <label class="country_err error" style="display: none;">Coming Soon to Your Country</label>
                                            @if($errors->has('country_id'))
                                            <span >
                                            <strong style="color: red !important">{{$errors->first('country_id')}}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="w-100"></div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Password <span>*</span></label>
                                            <input type="password" class="rm_form_fild" id="password-field"  name="password" placeholder="***************">
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            @if($errors->has('password'))
                                                <span >
                                                <strong style="color: red !important">{{$errors->first('password')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                            <label class="password_error error"></label>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password <span>*</span></label>
                                            <input type="password" class="rm_form_fild" id="password-field1" placeholder="***************" name="password_confirmation">
                                            <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div> --}}

                                    <div class="w-100"></div>

                                    <div class="rmm01 mm01">
                                        <div class="checkbox-group">
                                            <input id="checkiz" type="checkbox" class="agreeCheck" name="example2">
                                            <label for="checkiz">
                                                <span class="check"></span>
                                                <span class="box"></span>


                                                By clicking on the sign up, you agree that you have read, understood and
                                                accepted our <a href="{{route('terms_of_services')}}" class="link_rm">Terms of Services</a>, <a
                                                    href="{{route('terms_and_conditions')}}" class="link_rm">Terms and conditions</a> and <a href="{{route('privacy_policy')}}"
                                                    class="link_rm">Privacy Policy</a>.


                                            </label>
                                            <label for="chk" generated="true" class="agree_error error" style="display: none;">This field is required.</label>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <button type="submit" class="submit_rm" id="submit">Sign Up</button>
                                    </div>
                                    {{-- <label generated="true" class="passport_error error mb-3 ml-3" style="display: none;width: 100%;">Please fill atleast one of these fields - <strong>Aadhar Number</strong> or <strong>Passport Number</strong>.</label> --}}

                                    <div class="col-lg-12 donnt_account">
                                        <div class="form-group">
                                            Already have an Account? <a href="{{route('login')}}" class="link_rm">Login Now</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <div id="recaptcha-container" class="mb-3"></div>
                        </div>
                    </div>
                    <!--cnst-form end-->
                </div>
            </div>
        </div>
        <!--contact_section end-->
    </div>
</section>

@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
<script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
<script>
$(document).ready(function(){
   $(".toggle-password").click(function() {

   $(this).toggleClass("fa-eye fa-eye-slash");
   var input = $($(this).attr("toggle"));
   if (input.attr("type") == "password") {
      input.attr("type", "text");
   } else {
      input.attr("type", "password");
   }
   });

});
</script>
<script type="text/javascript">
    $(document).ready(function() {
       
       $('#password-field').change(function(){

         var password = $(this).val();
          var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[A-Z])(?=.*[@#$%&?!*]).*$/;
          if(pattern.test(password)){
            $('.password_error').html('');
              return true;
          }else{
            $('.password_error').html('Password minimum 8 character, at least one capital letter, one number, one special character from these (@ # $ % & ? ! * )');
            $('.password_error').css('display','block');
              $(this).val('');
              return false;
          }

      });
    });
</script>


<script>
    $(document).ready(function() {

        function isPassportPresent() {
            return $('#passport_number').val().length > 0;
        }

        function isIssuedDatePresent() {
            return $('.passport_issued_date').val().length > 0;
        }

        function isExpiryDatePresent() {
            return $('.passport_expiry_date').val().length > 0;
        }

        $.validator.addMethod("acc_noRegex", function(value, element) {
         return this.optional(element) || /[a-z].*[0-9]|[0-9].*[a-z]/i.test(value);
         }, "PAN Number must contain only letters and numbers.");

        $.validator.addMethod("passport_reg", function(value, element) {
         return this.optional(element) || /^[A-Z][0-9]\d\s?\d{4}[0-9]$/i.test(value);
         }, "Please enter valid Passport Number. First character is alphabet and 7 digit numbers.");

         $.validator.addMethod("alpha_space", function(value, element) {
         return this.optional(element) || /^[a-zA-Z0-9\s\-\/]+$/.test(value);
         }, "Please enter only letters and numbers.");

         $.validator.addMethod("name_Regex", function(value, element) {
         return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
         }, "Name must contain only letters");

         $.validator.addMethod("address_Regex", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9./_ ,-])+$/.test(value);
         }, "Please enter valid address");

         $.validator.addMethod("checkDate", function(date, element) {
                return this.optional(element) || date.match(/^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d+$/);
            }, "Please specify a valid date");

         $.validator.addMethod("onlyNumbers", function(value, element) {
         return this.optional(element) || /[0-9]/i.test(value);
         }, "Please enter a valid number");

         $.validator.addMethod("greaterThan",
            function(value, element, params) {

                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date($(params).val());
                }

                return isNaN(value) && isNaN($(params).val())
                    || (Number(value) > Number($(params).val()));
            },'Must be greater than Issued Date.');

         $.validator.addMethod("smallerThan",
            function(value, element, params) {

                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) < new Date($(params).val());
                }

                return isNaN(value) && isNaN($(params).val())
                    || (Number(value) < Number($(params).val()));
            },'Must be smaller than Expiry Date.');

     // validate the comment form when it is submitted
       $("#register-form").validate({
         rules: {
           first_name:{name_Regex:true,required: true,maxlength:100},
           middle_name:{name_Regex:true,maxlength:100},
           last_name:{name_Regex:true,required: true,maxlength:100},
           country_id:{required: true},
           phonecode:{required: true},
           dob:{required: true,date: true,checkDate: true},
           mobile:{
             required:true,
             minlength: 9,
             digits: 9,
             number:true,
             remote: {
                   url: '{{ route("user.mobile.check") }}',
                   type: "post",
                   data: {
                     mobile: function() {
                       return $( "#mobile" ).val();
                     },
                   _token: '{{ csrf_token() }}'
                   }
               }

           },
           email:{
                  required: true,
                  email:true,
                  maxlength: 200,
               	remote: {
	              	url: '{{ route("user.email.check") }}',
	              	type: "post",
	              	data: {
			             email: function() {
			               return $( "#email" ).val();
			             },
	               _token: '{{ csrf_token() }}'
	              	}
	            }

            },
           //gender:{required: true},
           aadhar_number:{digits: true, minlength: 12, maxlength: 12},
           pan_number:{acc_noRegex:true, minlength: 10, maxlength: 10},
           passport_number:{
                
                //passport_reg:true,
                alpha_space: true,
                //minlength: 8,
                maxlength: 20,
            },
           passport_issued_date:{
            required: function(element){
                    return $("#passport_number").val()!="" || $(".passport_expiry_date").val()!="";
                },
                date: true,
                checkDate: true,
                //smallerThan: "#datepicker3"
            },
            passport_expiry_date:{
            required: function(element){
                    return $("#passport_number").val()!="" || $(".passport_issued_date").val()!="";
                },
                date: true,
                checkDate: true,
                //greaterThan: "#datepicker2"
            },
           nationality:{required: true},
           user_relation:{required: true},
           relationship:{name_Regex:true,required: true,maxlength:100},
           address1:{required: true,address_Regex: true,maxlength:200},
           address2:{required: true,address_Regex: true,maxlength:200},
           zip_code:{
                required:true,
                minlength: 3,
                alphanumeric: true,
                maxlength: 10,
            },
           city:{name_Regex:true,required: true,maxlength:100},
           state:{name_Regex:true,required: true,maxlength:100},
           password:{required: true, minlength: 8},
           password_confirmation:{required: true, equalTo: "#password-field"}

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
            address1: {
                maxlength: 'Please enter not more than 200 characters'
            },
            address2: {
                maxlength: 'Please enter not more than 200 characters'
            },
            // address3: {
            //     maxlength: 'Please enter not more than 200 characters'
            // },
             mobile:{
                remote: 'This mobile number has already been taken',
                minlength:'Please enter at least 9 digits.',
                maxlength:'Please enter not more than 10 digits.'
             } ,
             password_confirmation:{
                equalTo: 'Password and Confirm Password must be same'
             },
             email:{
               remote: 'This email has already been taken',
               maxlength: 'Please enter not more than 200 characters'
            },
             city:{
                name_Regex: 'City Name must contain only letters'
            },
             state:{
                name_Regex: 'State Name must contain only letters'
            }
         },

        submitHandler:function(form){

            var aadhar_number = $('#aadhar_number').val();
            var passport_number = $('#passport_number').val();

            if(aadhar_number.length === 0 && passport_number.length === 0){
                $(".passport_error").show();
                $('html, body').animate({
                    scrollTop: $(".for_signup_sec").offset().top
                }, 500);
                return false;
            }

            var passport_issued_date = $('.passport_issued_date').val();
            var passport_expiry_date = $('.passport_expiry_date').val();

            if(passport_issued_date && passport_expiry_date){
                if(new Date(passport_issued_date) > new Date()){
                    $(".passport_idate_err").show();
                    return false;
                }

                if (!/Invalid|NaN/.test(new Date(passport_issued_date)) && (new Date(passport_issued_date) > new Date(passport_expiry_date))) {
                    $(".passport_date_err").show();
                        return false;
                    }
            }

            // console.log(passport_issued_date,passport_expiry_date);


            var gender = $('[name="gender"]').is(':checked');

            if(gender == false){
                $('.gender_error').show();
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

             }else if($('.agreeCheck:checkbox:checked').length == 0){
                $('.agree_error').show();
                return false;

             }else{
                 $('.dob_error.error').html('');
                 $('.agree_error.error').hide();
                 $('.name_error').hide();
                 $('.gender_error').hide();
                 $('.passport_error').hide();
                 $(".passport_date_err").hide();
                 $(".passport_idate_err").hide();
                 //$(".passport_date_err").hide();
                 form.submit();
             }
            //form.submit();
         },

       });


    });
</script>
<script>
  $(document).ready(function(){
    $(function() {
        $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
    });
    });

$(function() {
        $("#datepicker2").datepicker({
        changeMonth: true,
        changeYear: true,
        maxDate: 0,
        yearRange: "-100:+0"
    });
    });

$(function() {
        $("#datepicker3").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+10"
    });
    });

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
