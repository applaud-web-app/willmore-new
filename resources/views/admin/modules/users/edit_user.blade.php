@extends('admin.layouts.app')
@section('title')
Professionals Details
@endsection
@section('links')
@include('admin.includes.links')
{{-- <link rel="stylesheet" href="{{asset('public/css/chosen.css')}}"> --}}
<style type="text/css">
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #000!important;
    cursor: pointer;
    display: inline-block;
    font-weight: 300!important;
    margin-left: 6px!important;
    font-size: 19px!important;
    float: right!important;
    /* position: relative!important;
    left: 45px!important; */
    width: 20px!important;
    margin-top: -1px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #eff9ff!important;
    border: none!important;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 11px!important;
    padding: 5px 10px!important;
    font-size: 13px!important;
}

.custom-dash-field span {
    position: unset!important;
    right: unset!important;
    top: unset!important;
    width: 100%!important;
    
}

.select2-container--default .select2-selection--multiple {
    min-height: 48px!important;
    width: 100%!important;
    border: 1px solid #c7d8dd!important;
    height:50px !important;
    overflow-y:scroll;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    /* overflow-y: scroll!important;
    height: 48px!important; */
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
                <h2 class="pageheader-title">Professionals Details</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('manage.provider')}}" class="breadcrumb-link">Manage Professionals</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Professionals Details</li>
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
                <div class="main-infor">
                    <div class="edit-froms">
                        <form id="edit-profile-form" method="POST" action="{{ route('update.provider',$user->id) }}" enctype="multipart/form-data" autocomplete="off" autocomplete="chrome-off">
                          @csrf
                          <input type="hidden" value="redirect_url" value="{{ Route::currentRouteName() }}">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">First Name <b class="req_sy">*</b></label>
                                        <input type="text" placeholder="First Name" class="input-type-text" name="first_name" value="{{ $user ? $user->first_name : ''}}">
                                    </div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Last Name <b class="req_sy">*</b></label>
                                        <input type="text" placeholder="Last Name" class="input-type-text" name="last_name" value="{{ $user ? $user->last_name : ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Email <b class="req_sy">*</b>
                                            <a href="javascript:void(0);" id="change-email" class="yu-yu-col-cls tooltip custom-tooltrip">Change
                                                <span class="hhlp01"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                                <p class="dddd01">If logged in with Google or Linkedin Accounts, your login will still remain the same and this email ID will be used only for communication purpose..</p>
                                            </a>
                                        </label>
                                        <input type="text" placeholder="email@example.com" class="input-type-text" value="{{ $user ? $user->email : ''}}" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form_group ft_mpn20">
                                        <label class="label_input_title">Phone Number <b class="req_sy">*</b> 
                                            @if(@$user->is_mobile_verified=='Y')
                                                <a href="javascript:void(0);" class="yu-yu-col-cls">Verified</a>
                                            @else
                                                <a href="javascript:void(0);" class="yu-yu-cls">Not Verified</a>
                                            @endif
                                        </label>
                                        <input type="text" placeholder="Type here" class="input-type-text  @error('mobile') is-invalid @enderror" value="{{ $user ? $user->mobile : ''}}" name="mobile" id="mobile" maxlength="11" minlength="10">
                                        <span class="ft_mpnoo" id="phonecode">{{@$user->pnonecode}}</span>
                                    </div>
                                    <label for="mobile" generated="true" class="error" style="display: none;">Please enter at least 10 characters.</label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 new-email-div" style="{{ @$user->temp_email?'':'display: none;' }}">
                                    <div class="form_group">
                                        <label class="label_input_title">New Email {{ @$user->temp_email?'(Not Verified)':'' }}
                                            {{-- <a href="javascript:void(0);" id="change-email" class="yu-yu-col-cls">Change</a> --}}
                                        </label>
                                        <input name="email" id="email" type="text" placeholder="email@example.com" class="input-type-text" value="{{ $user->temp_email ? $user->temp_email : ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Tagline <b class="req_sy">*</b></label>
                                        <input type="text" placeholder="Tagline" class="input-type-text" name="tagline" value="">
                                    </div> 
                                </div>
                                @php
                                $lng = [];
                                if(count($user->getLanguage)>0){
                                    foreach ($user->getLanguage as $key => $value) {
                                        $lng[] = $value->language_id;
                                    }
                                }
                                // dd($lng);
                                @endphp
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="name">Languages</label>
                                <div class="dash-field custom-dash-field">
                                <select class="progLang" 
                                        multiple="true" name="other_language[]">
                                        @foreach($language as $languages)
                                            <option value="{{$languages->id}}" {{in_array($languages->id,$lng) ? 'selected' : ''}}> {{$languages->language}}</option> 
                                        @endforeach 
                                </select>
                                
                               </div>
                               </div>
                               <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Hourly Rate($)</label>
                                        <input type="text" placeholder="Hourly Rate" class="input-type-text" name="first_name" value="{{ $user ? $user->hourly_rate : ''}}">
                                    </div> 
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    
                                        <label class="label_input_title">About Me <b class="req_sy">*</b></label>
                                        <textarea name="about_me"placeholder="Enter your description here..."></textarea>
                                
                                </div>
                                <div class="col-sm-12" style="margin:10px 0;">
                                    <h2>Social Media Linking</h2>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">LinkedIn</label>
                                        <input type="text" placeholder="" class="input-type-text" name="linkedin_link" value="{{ $user ? $user->linkedin_link : ''}}">
                                    </div> 
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Github </label>
                                        <input type="text" placeholder="" class="input-type-text" name="gitHub_link" value="{{ $user ? $user->gitHub_link : ''}}">
                                    </div> 
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Gitlab </label>
                                        <input type="text" placeholder="" class="input-type-text" name="gitlab_link" value="{{ $user ? $user->gitlab_link : ''}}">
                                    </div> 
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Stack Overflow </label>
                                        <input type="text" placeholder="" class="input-type-text" name="stackoverflow_link" value="{{ $user ? $user->stackoverflow_link : ''}}">
                                    </div> 
                                </div>
                                <div class="col-sm-12" style="margin:10px 0;">
                                    <h2>Address</h2>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Address <b class="req_sy">*</b></label>
                                        <input type="text" placeholder="Type here" class="input-type-text" value="{{ $user ? $user->address : ''}}" name="address">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">City <b class="req_sy">*</b></label>
                                        <input type="text" placeholder="Type here" class="input-type-text" value="{{ $user ? $user->city : ''}}" name="city">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Zip Code <b class="req_sy">*</b></label>
                                        <input type="text" placeholder="Type here" class="input-type-text" value="{{ $user ? $user->zip_code : ''}}" name="zip_code">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                  <div class="form_group">
                                      <label class="label_input_title">State <b class="req_sy">*</b></label>
                                        <select class="hire-type hire-select state_id" name="state_id" id="state_id">
                                            <option value="">Select State</option>
                                            @foreach($states as $state) 
                                                <option value="{{ $state->id }}" {{@$user->state == $state->id ? 'selected' : ''}}>{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                  </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <label class="label_input_title">Country <b class="req_sy">*</b></label>
                                        <select class="hire-type hire-select country_id" name="country_id" id="countryList">
                                            <option value="">Select Country</option>
                                            <option value="101" {{@$user->country== 101 ? 'selected' :''}} >India</option>

                                                <!-- @foreach($countrys as $country)
                                                  <option  value="{{$country->id}}" phonecode="{{ $country->phonecode }}"  id="shop-country" {{@$user->country == $country->id ? 'selected' : ''}}>{{$country->name}}
                                                  </option> 
                                                @endforeach -->
                                        </select>
                                    </div>
                                </div>
                                 
                                
                              
                                 
                               
                                 
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                  <div class="form_group">
                                      <label class="label_input_title">Open for a Permanent Opportunity <b class="req_sy">*</b></label>
                                      <input type="radio" class="input-type-text" name="opportunity"  value="YES" {{@$user->opportunity == 'YES' ? 'checked' : ''}}> Yes
                                      <input type="radio" class="input-type-text" name="opportunity"  value="NO" {{@$user->opportunity == 'NO' ? 'checked' : ''}}> No
                                  </div>
                                </div> -->
                              
                             
                            
                               
                                <div class="col-sm-12">
                                    <div class="save_btn_box">
                                        <button style="text-transform: capitalize;" type="submit" class="save_all_changes_btn">Save all changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reportstory">
    <div class="modal-dialog modal-auto">
        <div class="modal-content seller_modal_contact">
            <div class="modal-header">
                <h3 style="margin-left: 20px;">Update User Name</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <div class="modal-body">
                    <div class="Srarch_filterBox">
                        <form id="usernamefrm" action="{{route('update.username')}}" method="post">
                            @csrf
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{@$employer->id}}">
                            <div class="form-group col-xl-8 col-lg-8 col-md-6 col-sm-5 col-12 pad-r">
                                <label class="col-form-label">User Name </label>
                                <input type="text" name="username" class="form-control username required" placeholder="Type here" value="{{@$employer->username}}">
                            </div>
                            <div class="form-group col-xl-2 col-lg-2 col-md-6 col-sm-3 col-12 pad-l">
                                <label for="inputPassword" class="col-form-label hide_label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary search_btnUser">Update</a>
                            </div>
                        </div>
                    </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.18/zebra_datepicker.min.js" integrity="sha512-+jF6u7aOmduPkX9JBkvp1B5XgGqvfc3fPGWJG43Ci18tZ4hR1jgHMrlWrM8ai73KzuMc6hvp+9S2k9ggGKYTiw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.18/css/metallic/zebra_datepicker.min.css" integrity="sha512-VeBd1mVDXcj9onaSbaf8Z/fJVd7qR08qMtdSDttUN8ds+75TZ+fb6vkjltv26K7FjedTDl1wteDyS99UnHhzDw==" crossorigin="anonymous" />
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>




<script src="{{asset('public/js/init.js')}}" type="text/javascript" charset="utf-8"></script>



    <script>
    $(document).ready(function(){
        $('#datepicker-example8').Zebra_DatePicker({
            direction: -1,    
            format: 'm-d-Y'
        });
        $("#datepicker-example8").prop('readonly', false);



        $('#change-email').click(function(){
            $('.new-email-div').toggle();
        });
        $(".js-example-basic-multiple").select2();

        $('.currency').change(function(){
            $('.hourly_rate').val('');
            $('.hourly_rate').removeClass('error');
            $('.currency').removeClass('error');
            $('.rate_err').html('');
            $('.currency_err').html('');
        });
        $('.hourly_rate').change(function(){
            var rate = Number($(this).val());
            var min_rate_inr = Number($('.min_rate_inr').val());
            var max_rate_inr = Number($('.max_rate_inr').val());

            var min_rate_usd = Number($('.min_rate_usd').val());
            var max_rate_usd = Number($('.max_rate_usd').val());
            var currency = Number($('.currency').val());
            console.log(currency,min_rate_inr,max_rate_inr,min_rate_usd,max_rate_usd)    
            if(currency==1 ){        
                if(min_rate_inr <= rate && rate <= max_rate_inr){
                    $(this).removeClass('error');
                    $('.rate_err').html('');
                    return true; 
                } else {
                    $('.rate_err').html('Please enter hourly rate between '+min_rate_inr+' to '+max_rate_inr+'.');
                    $(this).addClass('error');
                    $(this).val('');
                    return false;
                }
            }
            if(currency==2){
                if(min_rate_usd <= rate && rate <= max_rate_usd){
                    $(this).removeClass('error');
                    $('.rate_err').html('');
                    return true; 
                } 
                else {
                    $('.rate_err').html('Please enter hourly rate between '+min_rate_usd+' to '+max_rate_usd+'.');
                    $(this).addClass('error');
                    $(this).val('');
                    return false;
                }
            }
        });


        $('.country_id').change(function(){
            var reqData = {
                'jsonrpc' : '2.0',                
                '_token'  : '{{csrf_token()}}',
                'data'    : {
                'country_id'    : $(this).val()
                }
            };
            $.ajax(
            {
                url: '{{ route('get.states') }}',
                dataType: 'json',
                data: reqData,
                type: 'post',
                success: function(response) 
                {
                    html='<option value="">Select</option>';
                         response.result.state.forEach(function(item, index){
                             html+='<option value="'+item.id+'">'+item.name+'</option>';
                         });
                         $('.state_id').html(html);
                    
                },
                error:function(error) 
                {
                    console.log(error.responseText);
                }
            });
        });
    });    
        
    </script>

<script>
    $(document).ready(function(){
    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[A-Za-z0-9]+$/.test(value);
    }, "Please enter only latter and number.");
      $('#edit-profile-form').validate({
         rules:{
            first_name:{ required:true },
            first_name:{ required:true },
            last_name:{ required:true }, 
            hourly_rate:{ number:true }, 
            mobile:{ 
                    required:true,
                    // minlength: 8,
                    number:true,
                    remote: {
                           url: '{{ route("admin.provider.mobile.check") }}',
                           type: "post",
                           data: {
                            user_id:{{@$user->id}},
                             mobile: function() {
                               return $( "#mobile" ).val();
                             },
                           _token: '{{ csrf_token() }}'
                           }
                       }   

                    }, 
            email:{
                required:true,
                email:true,
                remote: {
                    url: '{{ route("admin.provider.email.check") }}',
                    type: "post",
                    data: {
                        user_id:{{@$user->id}},
                        email: function() {
                        return $( "#email" ).val();
                        },
                    _token: '{{ csrf_token() }}'
                    }
                }
            }, 
            address:{ required:true },
            state_id:{ required:true },
            city:{ required:true },
            country:{required: true},
            work_exp:{required: true},
            zip_code:{ required:true, alphanumeric:true },
            
         },
         messages: {
            mobile:{
                remote: 'This mobile number is already in use'  
            },
            email:{
                remote: 'This email is already in use'
            }
         },
         submitHandler:function(form){
            var age = $('#datepicker-example8').val();
            var getAge = Math.floor((new Date() - new Date(age).getTime()) / 3.15576e+10)
            if(getAge<18){
                 $('.dob_error').html('Sorry, you must be 18 years of age.');
                 $('.dob_error').show();
                 return false;
             }
             else{
                 $('#datepicker-example8 .error').html('');
             }
            if($('.dignity_level').val()==='L1' || $('.dignity_level').val()==='L2' || $('.dignity_level').val()==='L3' || $('.dignity_level').val()==='L4' ){
                var rate = Number($('.hourly_rate').val());
                var min_rate_inr = Number($('.min_rate_inr').val());
                var max_rate_inr = Number($('.max_rate_inr').val());

                var min_rate_usd = Number($('.min_rate_usd').val());
                var max_rate_usd = Number($('.max_rate_usd').val());
                var currency = Number($('.currency').val());
                if(currency==1 ){        
                    if(min_rate_inr <= rate && rate <= max_rate_inr){
                        $('.hourly_rate').removeClass('error');
                        $('.rate_err').html('');
                        form.submit();
                    } else {
                        $('.rate_err').html('Please enter hourly rate between '+min_rate_inr+' to '+max_rate_inr+'.');
                        $('.hourly_rate').addClass('error');
                        $('.hourly_rate').val('');
                        // return false;
                    }
                }
                else if(currency==2){
                    if(min_rate_usd <= rate && rate <= max_rate_usd){
                        $('.hourly_rate').removeClass('error');
                        $('.rate_err').html('');
                        form.submit();
                    } 
                    else {
                        $('.rate_err').html('Please enter hourly rate between '+min_rate_usd+' to '+max_rate_usd+'.');
                        $('.hourly_rate').addClass('error');
                        $('.hourly_rate').val('');
                        // return false;
                    }
                } else {
                    $('.currency_err').html('Please select currency.');
                    $('.currency').addClass('error');
                    $('.currency').val('');
                }
            }else{
                form.submit();
            }
        },
      });
    });
   </script>
   <script>
       let countryList = document.getElementById("countryList") //select list with id countryList
       let phoneCode = document.getElementById('phonecode') //span with id phonecode
       countryList.addEventListener('change', function(){
        phoneCode.textContent = '+'+this.options[this.selectedIndex].getAttribute("phonecode");
       });
    </script>
    <script>
        $('#other_language_chosen > .chosen-choices > .search-field > .chosen-search-input').prop('readonly', true);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />
<script>
$(document).ready(function () {
                //Select2
                $(".progLang").select2();
    });
</script>
@endsection