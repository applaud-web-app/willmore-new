@extends('layouts.app')
@section('title','Manage PPF')
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

                    <h2>Manage PPF</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.add.ppf',[@$will_id])}}" class="top_battn_new">Add a PPF Account
                    </a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">

                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Account Name</div>
                                <div class="cel_area amunt cess">Account No.</div>
                                <div class="cel_area amunt cess">Bank Name</div>
                                <div class="cel_area amunt cess">Branch Address</div>
                                <div class="cel_area amunt cess">Nominee</div>
                                {{--<div class="cel_area amunt cess">Start Date</div>
                                <div class="cel_area amunt cess">End Date</div>--}}
                                <div class="cel_area amunt cess">Action</div>
                            </div>
                            <!--table row-1-->
                            @if(count(@$ppf) > 0)
                            @foreach(@$ppf as $val)
                            <div class="row small_screen2 for_bg_color_01 table_box">
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Account
                                        Name</span> <span class="sm_size">{{@$val->account_name}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Account
                                        No.</span> <span class="sm_size">{{@$val->account_number}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Bank Name</span>
                                    <span class="sm_size">{{@$val->bank_name}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Branch
                                        Address</span> <span class="sm_size">{{@$val->branch_address}}</span></div>
                                {{-- <div class="cel_area amunt-detail cess"> <span class="hide_big">Nominee</span>
                                    <span class="sm_size">{{@$val->nominee_name}}</span>
                                </div> --}}
                                {{--
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Start
                                        Date</span> <span class="sm_size">{{@$val->start_date ? date('d.m.Y',strtotime(@$val->start_date)) : '-'}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">End Date</span>
                                    <span class="sm_size">{{@$val->end_date ? date('d.m.Y',strtotime(@$val->end_date)) : '-'}}</span>
                                </div>
                                --}}
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li><a href="{{url('view-ppf/'.@$will_id.'/'.@$val->id)}}"
                                                class="css-tooltip-top color-blue"><span>Edit</span>
                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                        <li><a href="javascript:;" class="css-tooltip-top color-blue delete_ppf"
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
                        {{$ppf->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                    <a href="{{route('user.add.ppf',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                        @if(count(@$ppf) > 0)
                        Add another PPF Account
                        @else
                        Add a PPF Account
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
    $('.delete_ppf').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this record ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-ppf')}}/" + id;
            } else {
                return false;
            }
        });
    });
});
</script>


@endsection
