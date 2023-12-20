@extends('layouts.app')
@section('title','Manage Beneficiaries')
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
                    @if(@$locPack->package_id == 5)
                        <h2>Manage Trusted Person</h2>
                    @else
                        <h2>Manage Nominee</h2>
                    @endif
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                </div>


                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                <?php
                    if(@$locPack->package_id == 1){
                        $pckg_name = 'Will';
                    }elseif(@$locPack->package_id == 2){
                        $pckg_name = 'Will Location Registry';
                    }elseif(@$locPack->package_id == 3){
                        $pckg_name = 'LOI';
                    }elseif(@$locPack->package_id == 5){
                        $pckg_name = 'Advance Medical Directive';
                    }
                    ?>

                    <form role="form" action="{{route('save.service.authorized') }}" method="post"
                        id="serviceAuthorized">
                        @csrf

                    <input type="hidden" name="will_id" value="{{@$will_id}}" id="will_id">

                    <div class="col-lg-12 mt-1 mb-4">
                        <div class="row align-items-strech">
                            <div class="col-lg-12">
                                @if(count(@$allexistBen) > 0 || count(@$allexistExe) > 0 || count(@$allNewPerson) > 0)
                                <p>Please either select at least one person to authorize them to access your {{@$pckg_name}} or ADD a
                                    @if(@$locPack->package_id == 5) Trusted Person. @else Nominee. @endif</p>
                                @endif
                                {{@$currentWill->will_code}}
                            </div>

                            @if(count(@$allexistBen) > 0)
                            <div class="col-lg-4 col-md-4">
                                <div class="will-clm-box">
                                    <h3>
                                        Existing Beneficiaries
                                    </h3>
                                    <div class="will-clm-inr">
                                        @foreach(@$allexistBen as $beneficiar)
                                        <div class="clm-paper clm-paper2">
                                            <div class="clm-pp-top">
                                                    <div class="checkbox-group">
                                                            <input type="checkbox" name="beneficiaries[]"
                                                                value="{{@$beneficiar->id}}"
                                                                id="beneficiaries{{@$beneficiar->id}}"
                                                                {{@in_array(@$beneficiar->id, @$existAccessBen) ?'checked':''}}>
                                                            <label for="beneficiaries{{@$beneficiar->id}}"><span
                                                                    class="check"></span><span class="box"></span>
                                                                {{@$beneficiar->name}}
                                                            </label>
                                                        </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            @endif

                            @if(count(@$allexistExe) > 0)
                            <div class="col-lg-4 col-md-4">
                                <div class="will-clm-box">
                                    <h3>
                                    Existing Executor
                                    </h3>
                                    <div class="will-clm-inr">
                                        @foreach(@$allexistExe as $executor)
                                        <div class="clm-paper clm-paper2">
                                            <div class="clm-pp-top">
                                                <div class="checkbox-group">
                                                    <input type="checkbox" name="executors[]" value="{{@$executor->id}}"
                                                        id="executors{{@$executor->id}}"
                                                        {{@in_array(@$executor->id, @$existAccessExe) ?'checked':''}}>
                                                    <label for="executors{{@$executor->id}}"><span
                                                            class="check"></span><span class="box"></span>
                                                        {{@$executor->name}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            @endif

                            @if(count(@$allNewPerson) > 0)
                            <div class="col-lg-4 col-md-4">
                                <div class="will-clm-box">
                                    <h3>
                                        @if(@$locPack->package_id == 5) Trusted Person @else Nominee @endif
                                    </h3>
                                    <div class="will-clm-inr">
                                        @foreach(@$allNewPerson as $newperson)
                                        <div class="clm-paper clm-paper2">
                                            <div class="clm-pp-top">
                                                <div class="checkbox-group">
                                                    <input type="checkbox" name="newpersons[]"
                                                        value="{{@$newperson->id}}" id="newpersons{{@$newperson->id}}"
                                                        {{@in_array(@$newperson->id, @$existnewperson) ?'checked':''}}>
                                                    <label for="newpersons{{@$newperson->id}}"><span
                                                            class="check"></span><span class="box"></span>
                                                        {{@$newperson->name}}
                                                    </label>
                                                </div>
                                                <div class="checkbox-btns">
                                                    <ul>
                                                        @if(@$will_id == @$newperson->will_master_id)
                                                        <li><a href="{{url('view-beneficiar/'.@$will_id.'/'.@$newperson->slug)}}"
                                                                class="css-tooltip-top color-blue"><span>View</span>
                                                                <img src="{{asset('public/images/view.png')}}" alt=""></a></li>
                                                        <li><a href="{{url('update-beneficiaries/'.@$will_id.'/'.@$newperson->slug)}}"
                                                                class="css-tooltip-top color-blue"><span>Edit</span>
                                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                                        <li><a href="javascript:;"
                                                                class="css-tooltip-top color-blue delete_beneficiar"
                                                                data-id="{{@$newperson->id}}"><span>Delete</span>
                                                                <img src="{{asset('public/images/remove1.png')}}" alt=""></a>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            @endif


                        </div>
                    </div>
                    <div class="col-lg-12">
                            <div class="atz-btn">
                                @if(count(@$allexistBen) > 0 || count(@$allexistExe) > 0 || count(@$allNewPerson) > 0)
                                <button type="submit">Save</button>
                                @endif
                                @if(@$locPack->package_id != 1)
                                <a href="{{route('user.add.beneficiaries',[@$will_id])}}">Add @if(@$locPack->package_id == 5) Trusted Person @else Nominee @endif </a>
                                @endif
                            </div>
                        </div>
                    </form>



                    <!-- END -->


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
    $('.delete_beneficiar').click(function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Delete this nominee ? ',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{url('delete-nominee')}}/" + id;
            } else {
                return false;
            }
        });
    });
});
</script>

@endsection
