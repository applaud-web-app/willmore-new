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
                    <h2>Edit (Cash & Equivalent) <img src="{{asset('public/images/pagright.png')}}" alt="icon"> Edit Cash</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.manage.cash',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="cash_form" method="POST" action="{{ route('update.cash')}}">
                        @csrf
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        <input type="hidden" class="rm_form_fild" name="id" value="{{@$cashDetail->id}}">
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                    <h1>Cash asset</h1>
                                </div>


                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Cash Amount <span class="text-danger">*</span></label>
                                        <input type="text" name="amount" value="{{number_format(@$cashDetail->amount,0,'','')}}" min="1" class="rm_form_fild cashAmt" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Amount In Words <span class="text-danger">*</span></label>
                                        <input type="text" name="amount_in_words" value="{{@$cashDetail->amount_in_words}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Location of the cash <span class="text-danger">*</span></label>
                                        <input type="text" name="location_of_cash" value="{{@$cashDetail->location_of_cash}}"  class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="add_bene_name">

                                        <h2 class="subb_hedd">Beneficiaries</h2>
                                        <p>You can bequeath only what you own. ( If you own an asset jointly, you can only allocate your share to your beneficiaries.)</p>
                                        <div>
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

                                            <div class="for_filter_srch001 cash_fix_1 new_mars">
                                                <div class="form-group">
                                                    <label class="badge badge-secondary text-light">Amount</label>
                                                    <h4 class="text-left subb_hedd m-0">₹ <span id="sharedAmt">0.00</span></h4>
                                                </div>
                                            </div>
                                            <div class="for_filter_srch002 cash_fix_btn new_mars">
                                                <button type="button" class="submit_rm for_badd add_more_bbtn" id="submit">ADD</button>
                                            </div>
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
                                                    <P>Percentage Allocation : {{@$val->percentage}}% - ₹ {{number_format((@$cashDetail->amount/100) * @$val->percentage,2,'.','')}}</P>
                                                    <input type="hidden" name="beneficiar_id[]" class="beneficiar_id" value="{{@$val->beneficiar_id}}">
                                                    <input type="hidden" name="beneficiarName[]" class="beneficiarName" value="{{@$val->getBeneficiar->name}}">
                                                    <input type="hidden" name="percentage[]" class="percentage" value="{{@$val->percentage}}">
                                                    <a href="javascript:;" class="css-tooltip-top color-blue remCF top_battn_new">Reallocate</a>
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif
                                        </div>


                                    </div>
                                </div>



                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor" id="">Update</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Update & Continue</button>

                                    @if(@$bank >0)
                                        <a href="{{route('user.manage.bank',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.bank',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                        <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back </a>
                                    </div>

                                    {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another cash asset, please click "Update" and add another cash asset.
                                        If you do not have a cash asset, you can press the "Skip" button. </p>
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

         $.validator.addMethod("onlyNumbers", function(value, element) {
         return this.optional(element) || /[0-9]/i.test(value);
         }, "Please enter a valid number");

         $.validator.addMethod("num_Regex", function(value, element) {
         return this.optional(element) || /^[\d+. ]*$/.test(value);
         }, "Please enter a valid number!");

    $("#cash_form").validate({
        rules: {
            amount: {
                required: true,
                num_Regex: true,maxlength:30
            },
            amount_in_words: {
                required: true,name_Regex:true,maxlength:200
            },
            location_of_cash: {
                required: true,maxlength:200
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
            amount_in_words: {
                name_Regex: 'Amount in words must contain only letters',
                maxlength: 'Please enter not more than 200 characters'
            },
            location_of_cash: {
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
        var cashAmt = $('.cashAmt').val();
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


        if(cashAmt.length > 0 && per > 0){
                var total_amt = ((cashAmt/100) * per).toFixed(2);
                $('#sharedAmt').text(total_amt);
            }else{
                $('#sharedAmt').text('0.00');
            }

});

$('.cashAmt').on('input', function() {
            var per = $('#percentageNum').val();
            var cashAmt = $('.cashAmt').val();

            if(cashAmt.length > 0 && per > 0){
                var total_amt = ((cashAmt/100) * per).toFixed(2);
                $('#sharedAmt').text(total_amt);
            }else{
                $('#sharedAmt').text('0.00');
            }

    });

$(".add_more_bbtn").click(function(){
    $(".ben_err").hide();
    var beneficiarID = $('#bene option:selected').val();
    var beneficiarName = $('#bene option:selected').text();
    var percent = $('.percentageNum').val();
    var cashAmt = $('.cashAmt').val();
    var per = $('#percentageNum').val();

    if($.isNumeric(percent) && beneficiarID.length > 0 && percent.length > 0 && parseFloat(percent) !== 0){
      var total_amt = ((cashAmt/100) * per).toFixed(2);

      var html = `<div class="col-lg-12 col-md-12">
                    <div class="added_beneficiariess">
                        <h3>${beneficiarName}</h3>
                        <P>Percentage Allocation : ${percent}% - ₹ ${total_amt}</P>
                        <input type="hidden" name="beneficiar_id[]" class="beneficiar_id" value="${beneficiarID}">
                        <input type="hidden" name="beneficiarName[]" class="beneficiarName" value="${beneficiarName}">
                        <input type="hidden" name="percentage[]" class="percentage" value="${percent}">
                        <a href="javascript:;" class="css-tooltip-top color-blue remCF top_battn_new">Reallocate</a>
                    </div>
                </div>`;

        $(".benef_section").append(html);
        $('#bene').prop('selectedIndex',0);
        $('.percentageNum').val('');
        $("#bene option[value='"+beneficiarID+"']").remove();
        $('#sharedAmt').text('0.00');

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
