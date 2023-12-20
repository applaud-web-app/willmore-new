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

                    <h2>Add Residual Asset</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.manage.residualAssets',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="residual_form" method="POST" action="{{ route('save.residualAssets')}}">
                        @csrf
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Select One Beneficiary <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="beneficiar_id" id="bene">
                                            <option value="">Select</option>
                                            @foreach(@$beneficiaries as $beneficiar)
                                                @if(!in_array($beneficiar->id, @$beneficiar_ids ))
                                                    <option value="{{$beneficiar->id}}" id="shop-n">{{$beneficiar->name}}</option>
                                                @endif
                                            @endforeach
                                                        <option value="add_new_ben">Add New Beneficiaries</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        {{-- <label>This text is mandatory and will reflect in the generated will: </label>
                                        <input type="hidden" class="rm_form_fild rm_form_fild_trr" name="description"
                                        value="Beneficiary for moveable and/or immoveable assets/properties not mentioned in this
                                        Will or which are acquired by me in future, after execution of this Will, but before my death.">
                                        <label>Beneficiary for moveable and/or immoveable assets/properties not mentioned in
                                            this Will or which are acquired by me in future, after execution of this Will, but before my death.</label> --}}
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor save_btn" id="">Save</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor save_btn" id="">Save & Continue</button>

                                    @if(@$liability >0)
                                        <a href="{{route('user.manage.liability',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.liability',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$otherAssets >0)
                                        <a href="{{route('user.manage.otherAssets',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.otherAssets',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another residual asset, please click "Save" and add another residual asset.
                                        If you do not have a residual asset, you can press the "Skip" button. </p>
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

    $("#residual_form").validate({
        rules: {
            beneficiar_id: {
                required: true
            },
            // description: {
            //     required: true
            // },

        },
        messages: {

        },

        submitHandler: function(form) {

            $(".save_btn").prop('disabled', true);
            form.submit();

        },

    });

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

});
</script>
@endsection
