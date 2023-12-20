@extends('layouts.app')
@section('title','Add Jewelry')
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
                    <h2>Add Jewellery</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.manage.jewelry',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>

                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="jewelry_form" method="POST" action="{{ route('save.jewelry')}}">
                        @csrf
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">
                            <span class="error main_err ml-3 mb-2" style="display:none;">Please fill atleast one of these fields - <strong>Gold Weight</strong>, <strong>Silver Weight</strong> or <strong>Description</strong></span>
                                <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                    <h1>Jewellery asset</h1>
                                </div>
                                {{--
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Gold Weight <strong>(gm)</strong></label>
                                        <input type="text" name="gold_weight" value="{{old('gold_weight')}}" id="gold_weight" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Silver Weight <strong>(gm)</strong></label>
                                        <input type="text" name="silver_weight" value="{{old('silver_weight')}}" id="silver_weight" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-9">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{old('address')}}" class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>--}}

                                <div class="col-lg-9 col-md-9">
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                            {{--<input type="text" name="description" value="{{old('description')}}"  id="description" class="rm_form_fild" placeholder="Enter here">--}}
                                            <textarea class="rm_form_fild " name="description" id="description"
                                            placeholder="Write here" style="height: 92px;">{{old('description')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-9">
                                    <div class="form-group">
                                        <label>Location <span class="text-danger">*</span></label>
                                        <input type="text" name="location" value="{{old('location')}}" class="rm_form_fild" placeholder="Enter here">
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
                                                    <option value="{{$beneficiar->id}}" id="shop-n">
                                                        {{$beneficiar->name}}</option>
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
                                        <div class="mr-2"><p>Click on "ADD" button to save the beneficiary information and then click on the "Save" button to save your assets information.</p></div>


                                        <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                            <h1>Added Beneficiaries</h1>
                                            <p class="ml-0">Click on the "Reallocate" button if you wish to change the asset allocation </p>
                                            <span class="error ben_err" style="display:none;">Please add atleast one beneficiaries</span>
                                        </div>

                                        <div class="benef_section">

                                        </div>


                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Save Information</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor save_btn" id="">Save</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor save_btn" id="">Save & Continue</button>

                                    @if(@$properties >0)
                                        <a href="{{route('user.manage.residentials',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.residentials',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$bank >0)
                                        <a href="{{route('user.manage.bank',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.bank',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>
                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another jewellery asset, please click "Save" and add another jewellery asset.
                                        If you do not have a jewellery asset, you can press the "Skip" button. </p>
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

    $("#jewelry_form").validate({
        rules: {
            // gold_weight: {
            //     //required: true,
            //     digits: true,maxlength:50
            // },
            // silver_weight: {
            //     //required: true,
            //     digits: true,maxlength:50
            // },
            location: {
                required: true,maxlength:200
            },
            // address: {
            //     required: true,maxlength:200
            // },
            description: {
                required: true,
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

        },
        messages: {
            address:{
               maxlength: 'Please enter not more than 200 characters'
            },
            gold_weight: {
                digits: 'Please enter a valid number'
            },
            silver_weight: {
                digits: 'Please enter a valid number'
            },
            location: {
                maxlength: 'Please enter not more than 200 characters'
            },
            description: {
                maxlength: 'Please enter not more than 200 characters'
            },
            share_detail: {
                minlength: 'Please enter atleast 3 characters',
                maxlength: 'Please enter not more than 200 characters'
            }
        },
        submitHandler: function(form) {
            // var gold_weight = $('#gold_weight').val();
            // var silver_weight = $('#silver_weight').val();
            var description = $('#description').val();
            var shareDetail = $('.shareDetail').val();
            var beneficiar_id = $('.beneficiar_id').val();
            var totalPercentage = calculatePercent();

            // if(gold_weight.length === 0 && silver_weight.length === 0 && description.length === 0){
            //     $(".main_err").show();
            //     return false;
            // }else{
            //     $(".main_err").hide();
            // }


            // if(totalPercentage == false){
            //     $(".ben_err").text("Total shares allocated to all the beneficiaries must be 100%");
            //     $(".ben_err").show();
            //     return false;
            // }

            if((shareDetail !== undefined && beneficiar_id !== undefined) && (shareDetail !== null && beneficiar_id !== null)){
                $(".ben_err").hide();
                $(".main_err").hide();
                $(".save_btn").prop('disabled', true);
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
    //var percent = $('.percentageNum').val();
    var share_detail = $('.share_detail').val();

    //if( beneficiarID.length > 0 && share_detail.length > 2){
    if( beneficiarID.length > 0){
      var html = `<div class="col-lg-12 col-md-12">
                    <div class="added_beneficiariess">
                        <h3>${beneficiarName}</h3>
                        <P style="${share_detail ? '' : 'display:none;'}">Additional Information : ${share_detail}</P>
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
