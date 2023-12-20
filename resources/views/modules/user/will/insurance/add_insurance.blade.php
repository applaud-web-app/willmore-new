@extends('layouts.app')
@section('title','Add Insurance')
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
                    <h2> Add Insurance Policy</h2>
                    <a href="{{route('user.manage.insurance',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="insurance_form" method="POST" action="{{ route('save.insurance')}}">
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        @csrf
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">


                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Insurance Company Name <span class="text-danger">*</span></label>
                                        <input type="text" name="insurance_company_name"
                                            value="{{old('insurance_company_name')}}" class="rm_form_fild"
                                            placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Policy Number <span class="text-danger">*</span></label>
                                        <input type="text" name="policy_number" value="{{old('policy_number')}}"
                                            class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="type">
                                            <option value="">Select</option>
                                            <option value="Life"> Life </option>
                                            <option value="Health"> Health </option>
                                            <option value="Property"> Property </option>
                                            <option value="Vehicle"> Vehicle </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Beneficiary <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="beneficiar_id" id="bene">
                                            <option value="">Select</option>
                                            @foreach(@$beneficiaries as $beneficiar)
                                                <option value="{{$beneficiar->id}}" id="shop-n">{{$beneficiar->name}}</option>
                                            @endforeach
                                            <option value="add_new_ben">Add New Beneficiaries</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Policy Holder Name <span class="text-danger">*</span></label>
                                        <input type="text" name="policy_holder_name"
                                            value="{{old('policy_holder_name')}}" class="rm_form_fild"
                                            placeholder="Enter here">
                                    </div>
                                </div> --}}

                                {{-- <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Nominee Name <span class="text-danger">*</span></label>
                                        <input type="text" name="nominee_name" value="{{old('nominee_name')}}"
                                            class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div> --}}

                                {{-- <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Insurance Distribution Plan <span class="text-danger">*</span></label>
                                        <input type="text" name="insurance_distribution_plan"
                                            value="{{old('insurance_distribution_plan')}}" class="rm_form_fild"
                                            placeholder="Enter here">
                                    </div>
                                </div> --}}

                                <div class="w-100"></div>
                                {{--
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
                                                    <option value="{{$beneficiar->id}}" id="shop-n">
                                                        {{$beneficiar->name}}</option>
                                                    @endforeach
                                                        <option value="add_new_ben">Add New Beneficiaries</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="for_filter_srch001 cash_fix">
                                            <div class="form-group">
                                                <label>Percentage Allocation <span class="text-danger">*</span></label>
                                                <input type="text" name="percentageNum" id="percentageNum"
                                                    class="rm_form_fild percentageNum" placeholder="Enter Here" min="1" max="100">
                                                <span class="error percentage_err" style="display:none;">Total
                                                    percentage should be less than or equal to 100</span>
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
                                        <div class="mr-2"><p>Click on "ADD" button to save the beneficiary information and then click on the "Save" button to save your assets information.</p></div>


                                        <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                            <h1>Added Beneficiaries</h1>
                                            <p class="ml-0">Click on the "Reallocate" button if you wish to change the asset allocation </p>
                                            <span class="error ben_err" style="display:none;">Please add atleast one
                                                beneficiaries</span>
                                        </div>

                                        <div class="benef_section">

                                        </div>


                                    </div>
                                </div>
                                --}}

                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor save_btn" id="">Save</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor save_btn" id="">Save & Continue</button>

                                    @if(@$ppf >0)
                                        <a href="{{route('user.manage.ppf',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.ppf',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$mutualFund >0)
                                        <a href="{{route('user.manage.mutualFund',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.mutualFund',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another insurance policy, please click "Save" and add another insurance policy.
                                        If you do not have a insurance policy, you can press the "Skip" button. </p>
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
$(document).ready(function() {

    $.validator.addMethod("name_Regex", function(value, element) {
         return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
         }, "Name must contain only letters");

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^([a-zA-Z0-9./_ ,-])+$/.test(value)
    }, "Allow only (a-z, A-Z, 0-9, ./_ ,-)");

    $("#insurance_form").validate({
        rules: {
            policy_holder_name: {
                required: true,name_Regex: true,maxlength:100
            },
            type: {
                required: true
            },
            policy_number: {
                required: true,
                // number: true,
                alphanumeric: true,
                maxlength:30
            },
            beneficiar_id: {
                required: true,
            },
            insurance_company_name: {
                required: true,name_Regex: true,maxlength:100
            },
            // insurance_distribution_plan: {
            //     required: true,name_Regex: true,maxlength:100,
            // },
            // share_detail: {
            //     maxlength: 200,
            //     minlength: 3
            // },
            // percentageNum: {
            //     number: true
            // },
            // percentage: {
            //     number: true,
            //     minlength: 100,
            //     maxlength: 100
            // },

        },
        messages: {
            policy_holder_name: {
                maxlength: 'Please enter not more than 100 characters',
                name_Regex: 'Policy Holder Name must contain only letters',
            },
            policy_number: {
                number: 'Please enter a valid policy number.',
                digits: 'Please enter a valid number'
            },
            nominee_name: {
                name_Regex: 'Nominee Name must contain only letters',
                maxlength: 'Please enter not more than 100 characters'
            },
            insurance_company_name: {
                name_Regex: 'Insurance Company Name must contain only letters',
                maxlength: 'Please enter not more than 100 characters'
            },
            insurance_distribution_plan: {
                name_Regex: 'Insurance Distribution Plan Name must contain only letters',
                maxlength: 'Please enter not more than 100 characters'
            },
            share_detail: {
                minlength: 'Please enter atleast 3 characters',
                maxlength: 'Please enter not more than 200 characters'
            }
         },

        submitHandler: function(form) {
            $(".save_btn").prop('disabled', true);
                form.submit();
            // var percent = $('.percentage').val();
            // var beneficiar_id = $('.beneficiar_id').val();
            // var totalPercentage = calculatePercent();

            // if(totalPercentage == false){
            //     $(".ben_err").text("Total shares allocated to all the beneficiaries must be 100%");
            //     $(".ben_err").show();
            //     return false;
            // }

            // if((percent !== undefined && beneficiar_id !== undefined) && (percent !== null && beneficiar_id !== null)){
            //     $(".ben_err").hide();
            //     $(".save_btn").prop('disabled', true);
            //     form.submit();
            // }else{
            //     $(".ben_err").show();
            //     return false;
            // }

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
                    title: 'Are you sure you want to leave this page and want to add a new beneficiary? In that case all the data entered by you in this form will be lost.',
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
