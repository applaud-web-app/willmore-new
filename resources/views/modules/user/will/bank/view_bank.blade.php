@extends('layouts.app')
@section('title','View Cash')
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
                    <h2>Edit Bank</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.manage.bank',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="bank_form" method="POST" action="{{ route('update.bank')}}">
                        @csrf
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        <input type="hidden" class="rm_form_fild" name="id" value="{{@$bankDetail->id}}">
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                    <h1>Bank account</h1>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Account Type <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="account_type">
                                            <option value="">Select</option>
                                            <option value="Savings" {{@$bankDetail->account_type == 'Savings' ? 'selected' : ''}}> Savings </option>
                                            <option value="Current" {{@$bankDetail->account_type == 'Current' ? 'selected' : ''}}> Current </option>
                                            <option value="Fixed deposits" {{@$bankDetail->account_type == 'Fixed deposits' ? 'selected' : ''}}> Fixed deposits </option>
                                            <option value="Recurring deposits" {{@$bankDetail->account_type == 'Recurring deposits' ? 'selected' : ''}}> Recurring deposits </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Account Number <span class="text-danger">*</span></label>
                                        <input type="text" name="account_number" value="{{@$bankDetail->account_number}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Account Holder Name <span class="text-danger">*</span></label>
                                        <input type="text" name="account_holder_name" value="{{@$bankDetail->account_holder_name}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Bank Name <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" value="{{@$bankDetail->bank_name}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>IFSC Code <span class="text-danger">*</span></label>
                                        <input type="text" name="ifsc_code" value="{{@$bankDetail->ifsc_code}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Branch Address <span class="text-danger">*</span></label>
                                        <input type="text" name="branch_address" value="{{@$bankDetail->branch_address}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Ownership Type <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="ownership_type" id="ownership_type">
                                            <option value="">Select</option>
                                            <option value="Individual" {{@$bankDetail->ownership_type == 'Individual' ? 'selected' : ''}}> Individual </option>
                                            <option value="Joint" {{@$bankDetail->ownership_type == 'Joint' ? 'selected' : ''}}> Joint </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group per_hold" @if(@$bankDetail->ownership_type=='Joint') style="display:block;" @else style="display:none;" @endif>
                                        <label>Percentage Holding (If Joint) <span class="text-danger">*</span></label>
                                        <input type="text" name="percentage_holding" id="percentage_holding" value="{{@$bankDetail->percentage_holding}}" class="rm_form_fild" placeholder="Enter here" min="1" max="100">
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
                                        @if(count(@$cashBeneficiaries) > 0)
                                        @foreach(@$cashBeneficiaries as $val)
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

                                    @if(@$jewelry >0)
                                        <a href="{{route('user.manage.jewelry',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.jewelry',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$cash >0)
                                        <a href="{{route('user.manage.cash',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.cash',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another bank account, please click "Update" and add another bank account.
                                        If you do not have a bank account, you can press the "Skip" button. </p>
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

    $.validator.addMethod("percent_Regex", function(value, element) {
         return this.optional(element) || /^[\d+ ]*$/.test(value);
         }, "Please endter a valid number!");

    $.validator.addMethod("name_Regex", function(value, element) {
         return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
         }, "Name must contain only letters");

    $("#bank_form").validate({
        rules: {
            account_type: {
                required: true
            },
            account_number: {
                required: true,digits: true,maxlength:30
            },
            account_holder_name: {
                required: true,maxlength:100,name_Regex:true
            },
            ifsc_code: {
                required: true,maxlength:50
            },
            branch_address: {
                required: true,maxlength:200
            },
            bank_name: {
                required: true,maxlength:100,name_Regex:true
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
            ownership_type: {
                required: true
            },
            percentage_holding: {
                //number: true,
                maxlength: 5,
                percent_Regex: true
            },
        },
        messages: {
            account_number: {
                number: 'Please enter a valid account number.',
                digits: 'Please enter a valid number'
            },
            account_holder_name: {
                name_Regex: 'Account holder name must contain only letters',
                maxlength: 'Please enter not more than 100 characters'
            },
            bank_name: {
                name_Regex: 'Bank name in words must contain only letters',
                maxlength: 'Please enter not more than 100 characters'
            },
            branch_address: {
                maxlength: 'Please enter not more than 200 characters'
            },
            ifsc_code: {
                maxlength: 'Please enter not more than 50 characters'
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
                    title: 'Are you sure you want to leave this page and want to add a new beneficiary? In that case all updated data entered by you in this form will be lost',
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
