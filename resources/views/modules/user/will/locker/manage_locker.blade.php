@extends('layouts.app')
@section('title','Manage Locker')
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

                    <h2>Manage Locker</h2>
                    <a href="{{route('user.add.locker',[@$will_id])}}" class="top_battn_new">Add Locker</a>
                </div>
                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">

                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Locker number</div>
                                <div class="cel_area amunt cess">Bank name</div>
                                {{--<div class="cel_area amunt cess">Authorized person</div>--}}
                                <div class="cel_area amunt cess">Passcode</div>
                                <div class="cel_area amunt cess">Key Location</div>
                                <div class="cel_area amunt cess">Bank Address</div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$locker) > 0)
                            @foreach(@$locker as $val)
                            <div class="row small_screen2 for_bg_color_01 table_box">
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Locker
                                        number</span> <span class="sm_size">{{@$val->locker_number}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Bank name</span>
                                    <span class="sm_size"> {{@$val->bank_name}}</span>
                                </div>
                                {{--
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Authorized
                                        person</span> <span class="sm_size">{{@$val->authorized_person}}</span></div>
                                        --}}
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Passcode</span> <span class="sm_size">{{@$val->passcode ? @$val->passcode : '-'}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Key
                                        Location</span> <span class="sm_size">{{@$val->key_location ? @$val->key_location : '-'}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Bank
                                        Address</span> <span class="sm_size">{{@$val->branch_address}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        <li><a href="{{url('view-locker/'.@$will_id.'/'.@$val->id)}}" class="css-tooltip-top color-blue"><span>Edit</span>
                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                        <li><a href="javascript:;" class="css-tooltip-top color-blue delete_locker" data-id="{{@$val->id}}"><span>Delete</span>
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
                        {{$locker->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                    <a href="{{route('user.add.locker',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                    @if(count(@$locker) > 0)    
                        Add another Locker
                        @else 
                        Add Locker
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
    $('.delete_locker').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this record ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-locker')}}/" + id;
            } else {
                return false;
            }
        });
    });
});
</script>


@endsection
