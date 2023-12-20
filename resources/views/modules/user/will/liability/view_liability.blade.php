@extends('layouts.app')
@section('title','View Liability')
@section('links')
@include('includes.links')
<style>
    .ui-datepicker .ui-datepicker-title {
    margin: 0 28px 0 8px !important;
}
</style>
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

                    <h2>Edit Liability</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.manage.liability',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="liability_form" method="POST" action="{{ route('update.liability')}}">
                        @csrf
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}">
                        <input type="hidden" class="rm_form_fild" name="id" value="{{@$liabilityDetail->id}}">
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="type">
                                            <option value="">Select</option>
                                            <option value="Loan" {{@$liabilityDetail->type == 'Loan' ? 'selected' : ''}}>Loan</option>
                                            <option value="Mortgage" {{@$liabilityDetail->type == 'Mortgage' ? 'selected' : ''}}>Mortgage</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Lender Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lender_name" value="{{@$liabilityDetail->lender_name}}"
                                            class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Lender Branch & Address <span class="text-danger">*</span></label>
                                        <input type="text" name="lender_address" value="{{@$liabilityDetail->lender_address}}"
                                            class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Amount's Outstanding <span class="text-danger">*</span></label>
                                        <input type="text" name="amount" value="{{@$liabilityDetail->amount}}"
                                            class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Payment Schedule <span class="text-danger">*</span></label>
                                        <input type="text" name="payment_schedule" value="{{@$liabilityDetail->payment_schedule}}"
                                            class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Payment Amount<span class="text-danger">*</span></label>
                                        <input type="text" name="payment_amount" value="{{@$liabilityDetail->payment_amount}}"
                                        class="rm_form_fild" placeholder="Enter here">
                                    </div>
                                </div>





                                <div class="w-100"></div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Description (how is the liability to be paid) <span class="text-danger">*</span></label>
                                        <textarea class="rm_form_fild rm_form_fild_trr" name="description"
                                            placeholder="Write here">{{@$liabilityDetail->description}}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor" id="">Update</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Update & Continue</button>

                                    @if(@$contingency >0)
                                        <a href="{{route('user.manage.witness',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.witness',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$residualAssets >0)
                                        <a href="{{route('user.manage.residualAssets',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.residualAssets',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>


                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another liability, please click "Update" and add another liability.
                                        If you do not have a liability, you can press the "Skip" button. </p>
                                </div>

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

         $.validator.addMethod("checkDate", function(date, element) {
                return this.optional(element) || date.match(/^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d+$/);
            }, "Please specify a valid date");

        $.validator.addMethod("onlyNumbers", function(value, element) {
         return this.optional(element) || /[0-9]/i.test(value);
         }, "Please enter a valid number");

    $("#liability_form").validate({
        rules: {
            type: {
                required: true
            },
            lender_name: {
                name_Regex:true,required: true,maxlength:100
            },
            lender_address: {
                required: true,maxlength:200
            },
            amount: {
                required: true,number:true,onlyNumbers:true,min:1,maxlength:50
            },
            payment_schedule: {
                required: true,
                // date: true,checkDate: true
            },
            description: {
                required: true,
            },
            payment_amount: {
                required: true,number:true,onlyNumbers:true,min:1,maxlength:50
            },
        },
        messages: {
            lender_name: {
                maxlength: 'Please enter not more than 100 characters',
                name_Regex: 'Lender Name must contain only letters'
            },
            description: {
                maxlength: 'Please enter not more than 200 characters'
            }
        },

        submitHandler: function(form) {
            var sDate = $('.payment_schedule').val();
            var year = new Date(sDate).getFullYear();
            var curentYear = new Date().getFullYear();

            if(year < curentYear){
                $('.date_error').html('Sorry, Date is not valid');
                 $('.date_error').show();
            }else{
                $('.date_error').hide();
                form.submit();
            }

        },

    });

});
</script>
<script>
        $(document).ready(function () {
            $(function () {
                var year = (new Date).getFullYear();
                $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                minDate: 0
            });
            });
        });
    </script>
@endsection
