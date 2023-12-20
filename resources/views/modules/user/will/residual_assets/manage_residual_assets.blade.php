@extends('layouts.app')
@section('title','Manage Contingency')
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

                    <h2>Manage Residual Assets</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    @if(count(@$residual) < 1)
                    <a href="{{route('user.add.residualAssets',[@$will_id])}}" class="top_battn_new">Add Residual Asset</a>
                    @endif
                </div>
                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">

                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess col-md-10">Beneficiaries</div>
                                {{-- <div class="cel_area amunt cess maintain_wdth">Description</div> --}}
                                <div class="cel_area amunt cess col-md-2">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$residual) > 0)
                            @foreach(@$residual as $val)
                            <div class="row small_screen2 for_bg_color_01 table_box">

                                <div class="cel_area amunt-detail cess">
                                    <span class="hide_big"> Beneficiaries </span>
                                    <span class="sm_size">{{@$val->getBeneficiar->name}}</span>
                                </div>

                                {{-- <div class="cel_area amunt-detail cess">
                                    <span class="hide_big">Description</span>
                                    <span class="sm_size">
                                        @if(strlen(@$val->description)>60)
                                        {{ substr(@$val->description,0,60) . '...' }}
                                        @else
                                        {{ @$val->description }}
                                        @endif
                                    </span>
                                </div> --}}

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li>
                                            <a href="{{url('edit-residual-assets/'.@$will_id.'/'.@$val->id)}}" class="css-tooltip-top color-blue">
                                                <span>Edit</span> <img src="{{asset('public/images/edit.png')}}" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="css-tooltip-top color-blue delete_residual" data-id="{{@$val->id}}">
                                                <span>Delete</span> <img src="{{asset('public/images/remove1.png')}}" alt="">
                                            </a>
                                        </li>
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
                        {{$residual->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                    @if(count(@$residual) < 1)
                    <a href="{{route('user.add.residualAssets',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                        {{-- @if(count(@$residual) > 0)
                        Add another Residual Asset
                        @else --}}
                        Add Residual Asset
                        {{-- @endif --}}
                    </a>
                    @endif
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
    $('.delete_residual').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this record ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-residual-assets')}}/" + id;
            } else {
                return false;
            }
        });
    });
});
</script>


@endsection
