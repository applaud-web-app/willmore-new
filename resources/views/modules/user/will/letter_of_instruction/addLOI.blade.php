@extends('layouts.app')
@section('title','Add Letter of instruction')
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
                <div class="cus-dashboard-right didlex des-chng">

                    <h2>Letter of Instruction</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                </div>
                @include('includes.message')
                <div class="dash-right-inr">
                    @if(@$loi)
                    <form id="loi_form" method="POST" action="{{ route('update.loi')}}">
                    @else
                    <form id="loi_form" method="POST" action="{{ route('save.loi')}}">
                    @endif
                        @csrf
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}">
                        <input type="hidden" class="rm_form_fild" name="loi_id" value="{{@$loi ? @$loi->id : ''}}">
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Please write your letter of instruction</label>
                                        <textarea class="rm_form_fild rm_form_fild_trr" name="instructions"
                                            placeholder="Write here">{{@$loi ? @$loi->instructions : old('instructions')}}</textarea>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-lg-12 mb-4 mt-1">
                                    <div class="doubleborder"></div>
                                    <div class="doubleborder"></div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor" id="">Save</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Save & Continue</button>

                                    @if(@$cash >0)
                                        <a href="{{route('user.manage.cash',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.cash',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$witness >0)
                                        <a href="{{route('user.manage.witness',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.witness',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
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

    $("#loi_form").validate({
        rules: {
            instructions: {
                required: true
            },

        },
        messages: {
            // lender_name: {
            //     maxlength: 'Please enter not more than 100 characters'
            // }
        },

        submitHandler: function(form) {

            form.submit();

        },

    });

});
</script>
@endsection
