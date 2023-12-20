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

                    <h2>Manage Contingency</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    <a href="{{route('user.add.contingency',[@$will_id])}}" class="top_battn_new">Add Contingency</a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">

                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Beneficiary Name</div>
                                <div class="cel_area amunt cess maintain_wdth">Details</div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$contingency) > 0)
                            @foreach(@$contingency as $val)
                            <div class="row small_screen2 for_bg_color_01 table_box">
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Beneficiary
                                        Name</span> <span class="sm_size">{{@$val->getBeneficiar->name}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Details</span>
                                    <span class="sm_size">
                                        @if(strlen(@$val->details)>60)
                                        {{ substr(@$val->details,0,60) . '...' }}
                                        @else
                                        {{ @$val->details }}
                                        @endif
                                    </span>
                                </div>

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li><a href="{{url('view-contingency/'.@$will_id.'/'.@$val->id)}}"
                                                class="css-tooltip-top color-blue"><span>Edit</span>
                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                        <li><a href="javascript:;" class="css-tooltip-top color-blue delete_contingency"
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
                        {{$contingency->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                    <a href="{{route('user.add.contingency',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">Add Contingency</a>
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
    $('.delete_contingency').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this record ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-contingency')}}/" + id;
            } else {
                return false;
            }
        });
    });
});
</script>


@endsection
