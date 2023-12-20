@extends('layouts.app')
@section('title','View Land')
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
                    <h2> Edit Land</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.manage.land',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="land_form" method="POST" action="{{ route('update.land')}}">
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        <input type="hidden" class="rm_form_fild" name="id" value="{{@$landDetail->id}}">
                        @csrf
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                    <h1>Land asset</h1>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="pname" value="{{@$landDetail->name}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-6">
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address" value="{{@$landDetail->address}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                    <label>Land Type <span class="text-danger">*</span></label>
                                    <select class="rm_form_fild" name="land_type">
                                            <option value="">Select</option>
                                            <option value="Agriculture" {{@$landDetail->land_type == 'Agriculture' ? 'selected' : ''}}>Agriculture</option>
                                            <option value="Non Agriculture" {{@$landDetail->land_type == 'Non Agriculture' ? 'selected' : ''}}>Non Agriculture</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Land Area <span class="text-danger">*</span></label>
                                        <input type="text" name="plot_size" value="{{@$landDetail->plot_size}}" class="rm_form_fild" placeholder="Enter here" min="1">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Land Area Unit <strong>(Acres/Square ft)</strong><span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="land_area_unit">
                                            <option value="">Select</option>
                                            <option value="Acres" {{@$landDetail->land_area_unit == 'Acres' ? 'selected' : ''}}>Acres</option>
                                            <option value="Square ft" {{@$landDetail->land_area_unit == 'Square ft' ? 'selected' : ''}}>Square ft</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Ownership Type <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="ownership_type" id="ownership_type">
                                            <option value="">Select</option>
                                            <option value="Individual" {{@$landDetail->ownership_type == 'Individual' ? 'selected' : ''}}> Individual </option>
                                            <option value="Joint" {{@$landDetail->ownership_type == 'Joint' ? 'selected' : ''}}> Joint </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group per_hold" @if(@$landDetail->ownership_type=='Joint') style="display:block;" @else style="display:none;" @endif>
                                        <label>Percentage Holding (If Joint) <span class="text-danger">*</span></label>
                                        <input type="text" name="percentage_holding" id="percentage_holding" value="{{@$landDetail->percentage_holding}}" class="rm_form_fild" placeholder="Enter here" min="1" max="100">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Encumbrance (if any)</label>
                                        <input type="text" name="litigation" value="{{@$landDetail->litigation}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Jurisdiction</label>
                                        <input type="text" name="jurisdiction" value="{{@$landDetail->jurisdiction}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Survey Number</label>
                                        <input type="text" name="survey_number" value="{{@$landDetail->survey_number}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>


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

                                        <div class="for_filter_srch001 cash_fix">
                                            <div class="form-group">
                                                <label>Percentage Allocation <span class="text-danger">*</span></label>
                                                <input type="text" name="percentageNum" id="percentageNum" class="rm_form_fild percentageNum" placeholder="Enter Here" min="1" max="100">
                                                <span class="error percentage_err" style="display:none;">Total percentage should be less than or equal to 100</span>
                                            </div>
                                        </div>

                                        <div class="for_filter_srch001 cash_fix_1">
                                            <div class="form-group">
                                                <label>Additional Information</label>
                                                <input type="text" name="share_detail" id="share_detail" class="rm_form_fild share_detail" placeholder="Enter Here">
                                            </div>
                                        </div>
                                        <div class="for_filter_srch002 cash_fix_btn new_mars">
                                            <button type="button" class="submit_rm for_badd add_more_bbtn mt-2" id="submit">ADD</button>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="mr-2"><p>“Click on "ADD" button to save the beneficiary information and then click on the "Update" button to save your assets information.”</p></div>


                                        <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                            <h1>Added Beneficiaries</h1>
                                            <p class="ml-0">Click on the "Reallocate" button if you wish to change the asset allocation </p>
                                            <span class="error ben_err" style="display:none;">Please add atleast one beneficiaries</span>
                                        </div>

                                        <div class="benef_section">
                                        @if(count(@$PropertyBeneficiaries) > 0)
                                        @foreach(@$PropertyBeneficiaries as $val)
                                            <div class="col-lg-12 col-md-12">
                                                <div class="added_beneficiariess">
                                                    <h3>{{@$val->getBeneficiar->name}}</h3>
                                                    <P>Percentage Allocation : {{@$val->percentage}}% {{@$val->share_detail ? ','.@$val->share_detail : ''}}</P>
                                                    <input type="hidden" name="beneficiar_id[]" class="beneficiar_id" value="{{@$val->beneficiar_id}}">
                                                    <input type="hidden" name="beneficiarName[]" class="beneficiarName" value="{{@$val->getBeneficiar->name}}">
                                                    <input type="hidden" name="percentage[]" class="percentage" value="{{@$val->percentage}}">
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

                                    @if(@$demat >0)
                                        <a href="{{route('user.manage.demat',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.demat',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$properties >0)
                                        <a href="{{route('user.manage.commercial',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.commercial',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another land asset, please click "Update" and add another land asset.
                                        If you do not have a land asset, you can press the "Skip" button. </p>
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

    $.validator.addMethod("number_Regex", function(value, element) {
         return this.optional(element) || /[0-9]/.test(value);
         }, "Please enter a valid number.");

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^([a-zA-Z0-9./_ ,-])+$/.test(value)
    }, "Allow only (a-z, A-Z, 0-9, ./_ ,-)");

    $("#land_form").validate({
        rules: {
            pname: {
                required: true,maxlength:100
            },
            address: {
                required: true,maxlength:150
            },
            land_type: {
                required: true
            },
            plot_size: {
                required: true,
                // number_Regex: true,
                number: true,
                maxlength: 50
            },
            land_area_unit:{
                required: true,
            },
            ownership_type: {
                required: true
            },
            percentage_holding: {
                number: true,
                maxlength: 5,
                // number_Regex: true
            },
            survey_number: {
                // required: true,
                // digits: true,
                maxlength: 200,
                alphanumeric: true,
            },
            litigation: {
                maxlength:100
            },
            jurisdiction: {
                maxlength:100
            },
            share_detail: {
                maxlength: 200,
                minlength: 3
            },
            percentageNum: {
                number: true
            },
            percentage: {
                number: true,
                minlength: 100,
                maxlength: 100
            },

        },
        messages: {
            pname: {
                maxlength: 'Please enter not more than 100 characters'
            },
            litigation: {
                maxlength: 'Please enter not more than 100 characters'
            },
            jurisdiction: {
                maxlength: 'Please enter not more than 100 characters'
            },
            address: {
                maxlength: 'Please enter not more than 100 characters'
            },
            share_detail: {
                minlength: 'Please enter atleast 3 characters',
                maxlength: 'Please enter not more than 200 characters'
            }
        },

        submitHandler: function(form) {
            var percent = $('.percentage').val();
            var beneficiar_id = $('.beneficiar_id').val();
            var totalPercentage = calculatePercent();

            if(totalPercentage == false){
                $(".ben_err").text("Total shares allocated to all the beneficiaries must be 100%");
                $(".ben_err").show();
                return false;
            }

            if((percent !== undefined && beneficiar_id !== undefined) && (percent !== null && beneficiar_id !== null)){
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
    var percent = $('.percentageNum').val();
    var sd = $('.share_detail').val();
    var share_detail = sd.length > 2 ? sd : '';

    if($.isNumeric(percent) && beneficiarID.length > 0 && percent.length > 0 && parseFloat(percent) !== 0){
    var html = `<div class="col-lg-12 col-md-12">
                    <div class="added_beneficiariess">
                        <h3>${beneficiarName}</h3>
                        <P>Percentage Allocation : ${percent}% ${share_detail ? ', '+share_detail : ''}</P>
                        <input type="hidden" name="beneficiar_id[]" class="beneficiar_id" value="${beneficiarID}">
                        <input type="hidden" name="beneficiarName[]" class="beneficiarName" value="${beneficiarName}">
                        <input type="hidden" name="percentage[]" class="percentage" value="${percent}">
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
