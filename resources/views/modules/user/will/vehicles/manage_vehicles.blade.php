@extends('layouts.app')
@section('title','Manage Vehicles')
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

                    <h2>Manage Vehicles</h2>
                    <p>If you wish to add a new beneficiary please add that before adding the asset details.</p>
                    <a href="{{route('user.add.vehicles',[@$will_id])}}" class="top_battn_new">Add a Vehicle
                    </a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">

                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Make & Model</div>
                                <div class="cel_area amunt cess">Registration Number</div>
                                <div class="cel_area amunt cess">Year of Manufacturer </div>
                                <div class="cel_area amunt cess">Location</div>
                                <div class="cel_area amunt cess">Type</div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$vehicles) > 0)
                            @foreach(@$vehicles as $val)
                            <div class="row small_screen2 for_bg_color_01 table_box">
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Brand
                                        Name</span> <span class="sm_size">{{@$val->brand_name}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Registration
                                        Number</span> <span class="sm_size">{{@$val->registration_number}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Year of
                                        Manufacturer</span> <span class="sm_size">{{@$val->manufacture_year}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Location</span>
                                    <span class="sm_size">{{@$val->location}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Type</span>
                                    <span class="sm_size">{{@$val->type}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li><a href="{{url('view-vehicles/'.@$will_id.'/'.@$val->id)}}"
                                                class="css-tooltip-top color-blue"><span>Edit</span>
                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                        <li><a href="javascript:;" class="css-tooltip-top color-blue delete_vehicles"
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
                        {{$vehicles->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                    <a href="{{route('user.add.vehicles',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                        @if(count(@$vehicles) > 0)
                        Add another Vehicle
                        @else
                        Add a Vehicle
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
    $('.delete_vehicles').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this record ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-vehicles')}}/" + id;
            } else {
                return false;
            }
        });
    });
});
</script>


@endsection