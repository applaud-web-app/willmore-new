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

                    <h2>Edit Any Other Assets</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.manage.otherAssets',[@$will_id])}}" class="top_battn_new">Back to list</a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr">

                    <form id="other_form" method="POST" action="{{ route('update.otherAssets')}}">
                        @csrf
                        <input type="hidden" class="rm_form_fild" name="will_id" value="{{@$will_id}}" id="will_id">
                        <input type="hidden" class="rm_form_fild" name="id" value="{{@$otherDetail->id}}">
                        <div class="col-lg-12 col-md-12">
                            <div class="row login_rm02 for_dashboard rr_border">

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label>Select One Beneficiary <span class="text-danger">*</span></label>
                                        <select class="rm_form_fild" name="beneficiar_id" id="bene">
                                            <option value="">Select</option>
                                            @foreach(@$beneficiaries as $beneficiar)
                                                <option value="{{$beneficiar->id}}" @if(@$beneficiar->id == @$otherDetail->getBeneficiar->id) selected @endif>{{$beneficiar->name}}</option>
                                            @endforeach
                                                        <option value="add_new_ben">Add New Beneficiaries</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea class="rm_form_fild rm_form_fild_trr" name="description"
                                        value="{{ @$otherDetail->description }}">{!! @$otherDetail->description !!}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    {{-- <button type="submit" class="submit_rm bntt_collor" id="">Update Information</button> --}}
                                    <div class="btn-sec">
                                        <div class="btn-sec-lft">
                                    <button type="submit" class="submit_rm bntt_collor" id="">Update</button>

                                    <button type="submit" name="SaveConti" value="SQ" class="submit_rm bntt_collor" id="">Update & Continue</button>

                                    @if(@$residualAssets >0)
                                        <a href="{{route('user.manage.residualAssets',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @else
                                        <a href="{{route('user.add.residualAssets',[@$will_id])}}" class="submit_rm bntt_collor" id="">Skip</a>
                                    @endif

                                    @if(@$art >0)
                                        <a href="{{route('user.manage.art',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @else
                                        <a href="{{route('user.add.art',[@$will_id])}}" class="submit_rm bntt_collor" id="">Back</a>
                                    @endif
                                </div>

                                {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                                    </div>
                                    <p>If you wish to add another any other assets, please click "Update" and add another any other assets.
                                        If you do not have a any other assets, you can press the "Skip" button. </p>
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

    $("#other_form").validate({
        rules: {
            beneficiar_id: {
                required: true
            },
            description: {
                required: true
            },

        },
        messages: {

        },

        submitHandler: function(form) {

            form.submit();

        },

    });

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

});
</script>
@endsection
