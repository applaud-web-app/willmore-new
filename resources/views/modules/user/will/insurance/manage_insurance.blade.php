@extends('layouts.app')
@section('title','Manage Insurance')
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

                    <h2>Manage Insurance</h2>
                    <a href="{{route('user.add.insurance',[@$will_id])}}" class="top_battn_new">Add Insurance Policy
                    </a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">

                            <div class="row amnt-tble">
                                {{-- <div class="cel_area amunt cess">Policy Holder Name</div> --}}
                                <div class="cel_area amunt cess">Insurance Company Name</div>
                                <div class="cel_area amunt cess">Policy Number</div>
                                <div class="cel_area amunt cess">Type</div>
                                <div class="cel_area amunt cess">Beneficiary Name</div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>
                            <!--table row-1-->
                            @if(count(@$insurance) > 0)
                            @foreach(@$insurance as $val)
                            <div class="row small_screen2 for_bg_color_01 table_box">
                                {{-- <div class="cel_area amunt-detail cess"> <span class="hide_big">Policy Holder
                                        Name</span> <span class="sm_size">{{@$val->policy_holder_name}}</span></div> --}}
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Insurance
                                    Company Name</span> <span class="sm_size">{{@$val->insurance_company_name}}</span>
                                </div>

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Policy
                                    Number</span> <span class="sm_size">{{@$val->policy_number}}</span></div>

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Type</span>
                                    <span class="sm_size">{{@$val->type}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Nominee
                                        Name</span> <span class="sm_size">{{@$val->getBeneficiar->getBeneficiar->name}}</span></div>

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li><a href="{{url('view-insurance/'.@$will_id.'/'.@$val->id)}}"
                                                class="css-tooltip-top color-blue"><span>Edit</span>
                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                        <li><a href="javascript:;" class="css-tooltip-top color-blue delete_insurance"
                                                data-id="{{@$val->id}}"><span>Delete</span>
                                                <img src="{{asset('public/images/remove1.png')}}" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="row small_screen2 for_bg_color_01">
                                <div class="cel_area amunt-detail cess">No Record Found</div>
                            </div>
                            @endif


                        </div>
                    </div>



                    <div class="col-lg-12">
                        {{$insurance->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                    <a href="{{route('user.add.insurance',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                        @if(count(@$insurance) > 0)
                        Add another Insurance Policy
                        @else
                        Add Insurance Policy
                        @endif
                    </a>
                    {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
                    </div>

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
    $('.delete_insurance').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this record ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-insurance')}}/" + id;
            } else {
                return false;
            }
        });
    });
});
</script>


@endsection
