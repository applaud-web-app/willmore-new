@extends('layouts.app')
@section('title','View Vehicles')
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
                    <h2> Edit Vehicle</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.manage.vehicles',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="vehicles_form" method="POST" action="{{ route('update.vehicles')}}">
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        <input type="hidden" class="rm_form_fild" name="id" value="{{@$vehiclesDetail->id}}">
                        @csrf
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Make & Model <span class="text-danger">*</span></label>
                                        <input type="text" name="brand_name" value="{{@$vehiclesDetail->brand_name}}"
                                            class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Registration Number <span class="text-danger">*</span></label>
                                        <input type="text" name="registration_number"
                                            value="{{@$vehiclesDetail->registration_number}}" class="rm_form_fild"
                                            placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Year of Manufacturer <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="manufacture_year">
                                            <option value="">Select</option>
                                            @foreach(range(date('Y'), 1950) as $x)
                                            <option value="{{$x}}" {{@$vehiclesDetail->manufacture_year == $x ? 'selected' : '' }}>{{$x}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" name="location" value="{{@$vehiclesDetail->location}}"
                                            class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="type">
                                            <option value="">Select</option>
                                            <option value="Two Wheeler" {{@$vehiclesDetail->type == 'Two Wheeler' ? 'selected' : ''}}> Two Wheeler </option>
                                            <option value="Four Wheeler" {{@$vehiclesDetail->type == 'Four Wheeler' ? 'selected' : ''}}> Four Wheeler </option>
                                            <option value="Commercial Vehicle" {{@$vehiclesDetail->type == 'Commercial Vehicle' ? 'selected' : ''}}> Commercial Vehicle </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                {{--<div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Ownership Type</label>
                                        <select class="rm_form_fild" name="ownership_type" id="ownership_type">
                                            <option value="">Select</option>
                                            <option value="Individual" {{@$vehiclesDetail->ownership_type == 'Individual' ? 'selected' : ''}}> Individual </option>
                                            <option value="Joint" {{@$vehiclesDetail->ownership_type == 'Joint' ? 'selected' : ''}}> Joint </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group per_hold" @if(@$vehiclesDetail->ownership_type=='Joint') style="display:block;" @else style="display:none;" @endif>
                                        <label>Percentage Holding (If Joint)</label>
                                        <input type="text" name="percentage_holding" id="percentage_holding" value="{{@$vehiclesDetail->percentage_holding}}" class="rm_form_fild" placeholder="Enter here" min="1" max="100">
                                    </div>
                                </div>--}}

                                <div class="w-100"></div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="add_bene_name">

                                        <h2 class="subb_hedd">Beneficiaries</h2>
                                        <p>You can bequeath only what you own. ( If you own an asset jointly, you can only allocate your share to your beneficiaries.)</p>
                                        <div class="for_filter_srch001">
                                            <div class="form-group">
                                                <label>Select Beneficiaries <span class="text-danger">*</span></label>
                                                <select class="rm_form_fild" id="bene">
                                                    <option value="">Select</option>
                                                    @foreach(@$beneficiaries as $beneficiar)
                                                        @if(!in_array($beneficiar->id, @$beneficiar_ids ))
                                                        <option value="{{$beneficiar->id}}" id="shop-n">
                                                            {{$beneficiar->name}}</option>
                                                        @endif
                                                    @endforeach
                                                        <option value="add_new_ben">Add New Beneficiaries</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="for_filter_srch001">
                                            <div class="form-group">
                                                <label>Additional Information</label>
                                                <input type="text" name="percentageNum" id="percentageNum" class="rm_form_fild percentageNum" placeholder="Enter Here" min="1" max="100" style="display:none;">
                                                <input type="text" name="share_detail" id="share_detail" placeholder="Enter Here" class="rm_form_fild share_detail">
                                                <span class="error percentage_err" style="display:none;">Total percentage should be less than or equal to 100</span>
                                            </div>
                                        </div>

                                        <div class="for_filter_srch002">
                                            <button type="button" class="submit_rm for_badd add_more_bbtn" id="submit">ADD</button>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="mr-2"><p>“Click on "ADD" button to save the beneficiary information and then click on the "Update" button to save your assets information.”</p></div>


                                        <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                            <h1>Added Beneficiaries</h1>
                                            <p class="ml-0">Click on the "Reallocate" button if you wish to change the asset allocation </p>
                                            <span class="error ben_err" style="display:none;">Please add atleast one beneficiaries</span>
                                        </div>

                                        <div class="benef_section">
                                        @if(count(@$UserAssetsBeneficiaries) > 0)
                                        @foreach(@$UserAssetsBeneficiaries as $val)
                                            <div class="col-lg-12 col-md-12">
                                                <div class="added_beneficiariess">
                                                    <h3>{{@$val->getBeneficiar->name}}</h3>
                                                    @if(@$val->share_detail)<P>Additional Information : {{@$val->share_detail}}</P>@endif
                                                    <input type="hidden" name="beneficiar_id[]" class="beneficiar_id" value="{{@$val->beneficiar_id}}">
                                                    <input type="hidden" name="beneficiarName[]" class="beneficiarName" value="{{@$val->getBeneficiar->name}}">
                                                    <input type="hidden" name="share_detail[]" class="shareDetail" value="{{@$val->share_detail}}">
                                                    <a href="javascript:;" class="css-tooltip-top color-blue remCF top_battn_new">Reallocate</a>
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif
                                        </div>


                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor" id="">Update</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Update & Continue</button>

                                    @if(@$art >0)
                                        <a href="{{route('user.manage.art',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.art',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$ppf >0)
                                        <a href="{{route('user.manage.ppf',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.ppf',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another vehicle, please click "Update" and add another vehicle.
                                        If you do not have a vehicle, you can press the "Skip" button. </p>
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
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')


<script>
    $(document).ready(function (e) {

    $('#ownership_type').change(function(){

        var ownership_type= $('#ownership_type').val();

        if(ownership_type == 'Joint'){

            $('.per_hold').css('display','block');
            $('.per_hold').slideDown();
            $('#percentage_holding').addClass('required');

        }else if(ownership_type == 'Individual'){

            $('.per_hold').slideUp();
            $('#percentage_holding').val(' ');
            $('#percentage_holding').removeClass('required');
        }

    });
});
</script>

<script>
$(document).ready(function() {

    $.validator.addMethod("name_Regex", function(value, element) {
         return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
         }, "Name must contain only letters");

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^([a-zA-Z0-9./_ ,-])+$/.test(value)
    }, "Allow only (a-z, A-Z, 0-9, ./_ ,-)");

    $("#vehicles_form").validate({
        rules: {
            brand_name: {
                required: true,alphanumeric: true,maxlength:100
            },
            type: {
                required: true
            },
            registration_number: {
                required: true,
                alphanumeric: true,
                maxlength:30
            },
            manufacture_year: {
                required: true
            },
            location: {
                required: true,maxlength:200
            },
            share_detail: {
                maxlength: 200,
                minlength: 3
            },
            // percentageNum: {
            //     number: true
            // },
            // percentage: {
            //     number: true,
            //     minlength: 100,
            //     maxlength: 100
            // },
            // ownership_type: {
            //     required: true
            // },
            // percentage_holding: {
            //     number: true,
            //     maxlength: 5,
            //     // number_Regex: true
            // },
        },
        messages: {
            brand_name: {
                maxlength: 'Please enter not more than 100 characters',
                name_Regex: 'Make & Model name must contain only letters',
            },
            registration_number: {
                number: 'Please enter a valid registration  number.',
                digits: 'Please enter a valid number'
            },
            location: {
                maxlength: 'Please enter not more than 200 characters'
            },
            share_detail: {
                minlength: 'Please enter atleast 3 characters',
                maxlength: 'Please enter not more than 200 characters'
            }
         },
        submitHandler: function(form) {
            var percent = $('.percentage').val();
            var beneficiar_id = $('.beneficiar_id').val();
            //var totalPercentage = calculatePercent();
            var shareDetail = $('.shareDetail').val();

            // if(totalPercentage == false){
            //     $(".ben_err").text("Total shares allocated to all the beneficiaries must be 100%");
            //     $(".ben_err").show();
            //     return false;
            // }

            if((shareDetail !== undefined && beneficiar_id !== undefined) && (shareDetail !== null && beneficiar_id !== null)){
                $(".ben_err").hide();
                form.submit();
            }else{
                $(".ben_err").show();
                return false;
            }

        },

    });

    function calculatePercent(){

        var group = $('.percentage');
        var totalPercent = 0;
        if (group.length > 0){
            $('.percentage').each(function (index,element) {
                totalPercent = parseFloat(totalPercent) + parseFloat($(element).val());
                //console.log('percent ',$(this).val(), totalPercent);
            });
        }
        if(parseFloat(totalPercent) !== 100){
            return false;
        }else{
            return true;
        }
}
$('#bene').on('change', function() {
    var option = $(this).val();

    if(option == 'add_new_ben'){
        var willID = $('#will_id').val();
        Swal.fire({
                    title: 'Are you sure you want to leave this page and want to add a new beneficiary? In that case all the updated data entered by you in this form will be lost.',
                    icon: 'success',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href ="{{url('add-beneficiaries')}}/"+willID;
                    }
                    else{
                        $(this).val('');
                    }
                });
    }

});
$('#percentageNum').on('input', function() {
        var per = $('#percentageNum').val();
        var group = $('.percentage');
        var totalPercent = 0;
        if (group.length > 0){
            group.each(function () {
                totalPercent = parseFloat(totalPercent) + parseFloat($(this).val());
                //console.log('percent ',$(this).val(), totalPercent);
            });
        }
        let final = parseFloat(totalPercent) + parseFloat(per);
        if(final > 100){
            $(".add_more_bbtn").prop('disabled',true);
            $(".percentage_err").show();
        }else{
            $(".add_more_bbtn").prop('disabled',false);
            $(".percentage_err").hide();
        }
});

$(".add_more_bbtn").click(function(){
    $(".ben_err").hide();
    var beneficiarID = $('#bene option:selected').val();
    var beneficiarName = $('#bene option:selected').text();
    //var percent = $('.percentageNum').val();
    var share_detail = $('.share_detail').val();

    //if(beneficiarID.length > 0 && share_detail.length > 2){
    if(beneficiarID.length > 0){
      var html = `<div class="col-lg-12 col-md-12">
                    <div class="added_beneficiariess">
                        <h3>${beneficiarName}</h3>
                        <P style="${share_detail ? '' : 'display:none;'}">Shares allocated : ${share_detail}</P>
                        <input type="hidden" name="beneficiar_id[]" class="beneficiar_id" value="${beneficiarID}">
                        <input type="hidden" name="beneficiarName[]" class="beneficiarName" value="${beneficiarName}">
                        <input type="hidden" name="share_detail[]" class="shareDetail" value="${share_detail}">
                        <a href="javascript:;" class="css-tooltip-top color-blue remCF top_battn_new">Reallocate</a>
                    </div>
                </div>`;

        $(".benef_section").append(html);
        $('#bene').prop('selectedIndex',0);
        $('.percentageNum').val('');
        $('.share_detail').val('');
        $("#bene option[value='"+beneficiarID+"']").remove();

    }
});

$("body").on('click','.remCF',function(){
    $(this).parent().remove();
    var beneficiarID = $(this).parent().find('.beneficiar_id').val();
    var beneficiarName = $(this).parent().find('.beneficiarName').val();
    $('#bene option:last').before(`<option value="${beneficiarID}">${beneficiarName}</option>`);

});

});
</script>
@endsection
