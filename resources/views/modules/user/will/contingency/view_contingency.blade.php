@extends('layouts.app')
@section('title','Add Contingency')
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

                    <h2>Edit Contingency</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    <a href="{{route('user.manage.contingency',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="contingency_form" method="POST" action="{{ route('update.contingency')}}">
                        @csrf
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}">
                        <input type="hidden" class="rm_form_fild" name="id" value="{{@$contingencyDetail->id}}">
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Select One Beneficiary</label>
                                        <select class="rm_form_fild" name="beneficiar_id">
                                            <option value="">Select</option>
                                            <option value="{{@$contingencyDetail->beneficiar_id}}" id="shop-n" selected>
                                                    {{@$contingencyDetail->getBeneficiar->name}}</option>
                                            @foreach(@$beneficiaries as $beneficiar)
                                                @if(!in_array($beneficiar->id, @$beneficiar_ids ))
                                                <option value="{{$beneficiar->id}}" id="shop-n">
                                                    {{$beneficiar->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Details</label>
                                        <textarea class="rm_form_fild rm_form_fild_trr" name="details"
                                            placeholder="Write the contingency clause and who will get the assets of the beneficiary">{{@$contingencyDetail->details}}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor" id="">Update</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Update & Continue</button>

                                    @if(@$witness >0)
                                        <a href="{{route('user.manage.witness',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.witness',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$liability >0)
                                        <a href="{{route('user.manage.liability',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.liability',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another contingency, please click "Update" and add another contingency.</p>
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

    $("#contingency_form").validate({
        rules: {
            beneficiar_id: {
                required: true
            },
            details: {
                required: true
            },

        },
        messages: {
            lender_name: {
                maxlength: 'Please enter not more than 100 characters'
            }
        },

        submitHandler: function(form) {

            form.submit();

        },

    });

});
</script>
@endsection
