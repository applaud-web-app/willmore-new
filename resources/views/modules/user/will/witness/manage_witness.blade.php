
@extends('layouts.app')
@section('title','Manage Witness')
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
                    <h2>Manage Witness</h2>
                    {{-- <p>If you wish to add a new beneficiary please add that before adding the asset details.</p> --}}
                    <a href="{{route('user.add.witness',[@$will_id])}}" class="top_battn_new">Add Witness</a>
                </div>


                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">
                    <p class="ml-3">Add at least two witnesses to complete the will.</p>
                    <p class="ml-3 mb-3">Please note that a Witness has to be over the age of 18 years and
                    should not be a beneficiary of the Will.</p>
                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">

                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Name</div>
                                <div class="cel_area amunt cess">Aadhar Number</div>
                                {{--<div class="cel_area amunt cess">Place of Signature</div>
                                <div class="cel_area amunt cess">Date of Signature</div>--}}
                                <div class="cel_area amunt cess">Address</div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$witness) > 0)
                            @foreach(@$witness as $witns)
                            <div class="row small_screen2 for_bg_color_01">

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Name</span>
                                    <span class="sm_size">{{@$witns->salutation}} {{@$witns->name}}</span>
                                </div>

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Aadhar Number</span>
                                    <span class="sm_size">{{@$witns->aadhar_number}} </span>
                                </div>
                                {{--
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Place of Signature</span>
                                    <span class="sm_size">{{@$witns->sign_place}} </span>
                                </div>

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Date of Signature</span>
                                    <span class="sm_size">{{@$witns->sign_date}} </span>
                                </div> --}}

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Address</span>
                                    <span class="sm_size">{{@$witns->address1.', '.@$witns->address2.', '.@$witns->zip_code}}</span>
                                </div>

                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li>
                                            <a href="{{url('view-witness/'.@$will_id.'/'.@$witns->slug)}}" class="css-tooltip-top color-blue">
                                                <span>View</span> <img src="{{asset('public/images/view.png')}}" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{url('edit-witness/'.@$will_id.'/'.@$witns->slug)}}" class="css-tooltip-top color-blue">
                                                <span>Edit</span> <img src="{{asset('public/images/edit.png')}}" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="css-tooltip-top color-blue delete_witness" data-id="{{@$witns->id}}">
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
                    {{$witness->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                    <a href="{{route('user.add.witness',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                        @if(count(@$witness) > 0)
                        Add another Witness
                        @else
                        Add Witness
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
  $(document).ready(function(){
    $('.delete_witness').click(function(){
            var id = $(this).data('id');
            Swal.fire({
                    title: 'Delete this Witness ? ',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                         window.location.href ="{{url('delete-witness')}}/"+id;
                    }
                    else{
                        return false;
                    }
                });
        });
});
</script>


@endsection
