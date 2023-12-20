@extends('admin.layouts.app')
@section('title')
View Will
@endsection
@section('links')
@include('admin.includes.links')
<style>
.info-panel-will{
    display: flex;
}
.loi_downlod p{
    margin: 0px 40px 0px 0px;
}
</style>
@endsection
@section('headers')
@include('admin.includes.header')
@endsection
@section('sidebar')
@include('admin.includes.sidebar')
@endsection
@section('content')

<div class="content">
    <div class="wrapper container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">View Service</h4>
                <div class="pan-btns">
                    @if(@$locPack->package_id==1)
                        <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('admin.pdf.download',[@$will_id])}}" target="_blank">
                            <i class="fa fa-download" aria-hidden="true"></i> Download
                        </a>
                    @endif
                    <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.will')}}" > Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default panel-fill">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Service Information</h3>
                                    {{-- <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.will')}}" >
                                    Back
                                    </a> --}}
                                </div>

                                <div class="panel-body info-panel-will">
                                    <div class="about-info-p">
                                        <strong>ID :</strong>
                                        <p class="text-muted">#{{@$wills->id ? @$wills->id : '-'}}</p>
                                    </div>

                                    @if(@$wills->getPackage->master_will_id !=null)
                                    <div class="about-info-p">
                                        <strong>Master ID :</strong>
                                        <p class="text-muted">#{{@$wills->getPackage->master_will_id}}</p>
                                    </div>
                                    @endif
                                    <div class="about-info-p">
                                        <strong>Package Name :</strong>
                                        <p class="text-muted">{{@$wills->getPackage ? @$wills->getPackage->packageDetail->package_name : '-'}}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>User Name :</strong>
                                        <p class="text-muted" style="word-break: break-word;">{{@$wills->userDetails ? $wills->userDetails->name : '-' }}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Start Date :</strong>
                                        <p class="text-muted">{{@$wills->start_date ? date('d.m.Y',strtotime(@$wills->start_date)) : '-'}}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Status :</strong>
                                        <p class="text-muted">
                                            @if(@$wills->status==1)
                                            In Progress
                                            @elseif(@$wills->status==2)
                                                Finalized
                                            @elseif(@$wills->status==3)
                                                Completed
                                            @endif
                                        </p>
                                    </div>
                                    <div class="about-info-p m-b-0">
                                        <strong>Completed On :</strong>
                                        <p class="text-muted">{{@$wills->finalized_date ? date('d.m.Y',strtotime(@$wills->finalized_date)) : '-'}}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal-Information -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>

        {{-- Create Your Will --}}
        @if(@$locPack->package_id==1)

            {{-- Final Uploaded WIll --}}
            @if(@$wills->will_code)
                <div class="inner_page_area dashboard_inner">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Uploaded Will</h3>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="preview_all_will_mail">

                                    <!--00-->
                                        <!--01-->
                                        <div class="accordion_container">
                                            <div class="accordion_head" data-id="1"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span>  Soft Copy Of The Signed Will
                                                <span class="plusminus plusminus1">↓</span>
                                            </div>
                                            <div class="accordion_body aa1" style="display: none;">
                                                @if(@$wills->will_code)
                                                <div class="add_bene_name">
                                                    <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1></h1></div>
                                                        <ul class="all_will_infoo01">
                                                        <li><strong>Signed Will</strong><a href="{{url('storage\app\public\final_will_file')}}\{{@$wills->final_will_file}}" target="_blank"> View File </a></li>
                                                        <li><strong>Code</strong> {{@$wills->will_code}} </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>


                                        <!--02-->
                                        <div class="accordion_container">
                                        <div class="accordion_head" data-id="2"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Nominees Information
                                        <span class="plusminus plusminus2">↓</span></div>
                                        <div class="accordion_body aa2" style="display: none;">
                                            <?php $count1 = 0; ?>
                                            @if(@$willBeneficiariesW)
                                            @foreach(@$willBeneficiariesW as $key => $val)
                                                <div class="add_bene_name">
                                                    <div class="col-lg-12 col-md-12 fm_lrr">
                                                        <div class="beneficiaries_headingg"><h1>Nominee {{++$count1}}</h1></div>
                                                        <ul class="all_will_infoo01">
                                                        <li><strong>Name</strong> <span>{{@$val->getBen->name}}</span></li>
                                                        <li><strong>
                                                            @if(@$val->getBen->user_relation=='S')
                                                                Son of
                                                            @elseif(@$val->getBen->user_relation=='D')
                                                                Daughter of
                                                            @elseif(@$val->getBen->user_relation=='H')
                                                                Husband of
                                                            @elseif(@$val->getBen->user_relation=='W')
                                                                Wife of
                                                            @endif
                                                        </strong> {{@$val->getBen->relationship}} </li>
                                                        <li><strong>Email</strong> {{@$val->getBen->email}}</li>
                                                        <li><strong>Mobile</strong>  {{@$val->getBen->phonecode ? '+'.@$val->getBen->getPhonecode->phonecode : ''}} {{@$val->getBen->mobile}}</li>
                                                        <li><strong>Aadhar Number</strong> {{@$val->getBen->aadhar_number}}</li>
                                                        <li><strong>Citizen of</strong>  {{@$val->getBen->getNationality->name}}</li>
                                                        <li><strong>City</strong> {{@$val->getBen->city}}</li>
                                                        <li><strong>State</strong> {{@$val->getBen->state}} </li>
                                                        <li><strong>Country</strong> {{@$val->getBen->getCountry->name}} </li>
                                                        <li><strong>Post Code</strong> {{@$val->getBen->zip_code}} </li>
                                                        <li><strong>Address</strong> {{@$val->getBen->address1}}, {{@$val->getBen->address2}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                        <h3>Final Will Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                        @if(@$val->download_file_date)
                                                            <P>Final Will Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                            <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                            <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif

                                            @if(@$willExecutorsW)
                                            @foreach(@$willExecutorsW as $key => $val)
                                                <div class="add_bene_name">
                                                    <div class="col-lg-12 col-md-12 fm_lrr">
                                                        <div class="beneficiaries_headingg"><h1>Nominee {{++$count1}}</h1></div>
                                                        <ul class="all_will_infoo01">
                                                        <li><strong>Name</strong> <span>{{@$val->getExe->name}}</span></li>
                                                        <li><strong>
                                                            @if(@$val->getExe->user_relation=='S')
                                                                Son of
                                                            @elseif(@$val->getExe->user_relation=='D')
                                                                Daughter of
                                                            @elseif(@$val->getExe->user_relation=='H')
                                                                Husband of
                                                            @elseif(@$val->getExe->user_relation=='W')
                                                                Wife of
                                                            @endif
                                                        </strong> {{@$val->getExe->relationship}} </li>
                                                        <li><strong>Email</strong> {{@$val->getExe->email}}</li>
                                                        <li><strong>Mobile</strong> {{@$val->getExe->phonecode ? '+'.@$val->getExe->getPhonecode->phonecode : ''}} {{@$val->getExe->mobile}}</li>
                                                        <li><strong>Aadhar Number</strong> {{@$val->getExe->aadhar_number}}</li>
                                                        <li><strong>Citizen of</strong>  {{@$val->getExe->getNationality->name}}</li>
                                                        <li><strong>City</strong> {{@$val->getExe->city}}</li>
                                                        <li><strong>State</strong> {{@$val->getExe->state}} </li>
                                                        <li><strong>Country</strong> {{@$val->getExe->getCountry->name}} </li>
                                                        <li><strong>Post Code</strong> {{@$val->getExe->zip_code}} </li>
                                                        <li><strong>Address</strong> {{@$val->getExe->address1}}, {{@$val->getExe->address2}}</li>
                                                        </ul>
                                                    </div>
                                                        <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                            <h3>Final Will Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                            @if(@$val->download_file_date)
                                                                <P>Final Will Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                                <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                                <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                            @endif
                                                        </div>
                                                </div>
                                            @endforeach
                                            @endif

                                        </div>
                                        </div>


                                        <!--03-->
                                        {{-- <div class="accordion_container">
                                        <div class="accordion_head" data-id="3"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Beneficiaries Information
                                        <span class="plusminus plusminus3">↓</span></div>
                                        <div class="accordion_body aa3" style="display: none;">

                                            @if(@$willBeneficiariesW)
                                            @foreach(@$willBeneficiariesW as $key => $val)
                                                <div class="add_bene_name">
                                                    <div class="col-lg-12 col-md-12 fm_lrr">
                                                        <div class="beneficiaries_headingg"><h1>Beneficiary {{@$key+1}}</h1></div>
                                                        <ul class="all_will_infoo01">
                                                        <li><strong>Name</strong> <span>{{@$val->getBen->name}}</span></li>
                                                        <li><strong>
                                                            @if(@$val->getBen->user_relation=='S')
                                                                Son of
                                                            @elseif(@$val->getBen->user_relation=='D')
                                                                Daughter of
                                                            @elseif(@$val->getBen->user_relation=='H')
                                                                Husband of
                                                            @elseif(@$val->getBen->user_relation=='W')
                                                                Wife of
                                                            @endif
                                                        </strong> {{@$val->getBen->relationship}} </li>
                                                        <li><strong>Email</strong> {{@$val->getBen->email}}</li>
                                                        <li><strong>Mobile</strong>  {{@$val->getBen->phonecode ? '+'.@$val->getBen->getPhonecode->phonecode : ''}} {{@$val->getBen->mobile}}</li>
                                                        <li><strong>Aadhar Number</strong> {{@$val->getBen->aadhar_number}}</li>
                                                        <li><strong>Nationality</strong>  {{@$val->getBen->getNationality->name}}</li>
                                                        <li><strong>City</strong> {{@$val->getBen->city}}</li>
                                                        <li><strong>State</strong> {{@$val->getBen->state}} </li>
                                                        <li><strong>Country</strong> {{@$val->getBen->getCountry->name}} </li>
                                                        <li><strong>Post Code</strong> {{@$val->getBen->zip_code}} </li>
                                                        <li><strong>Address</strong> {{@$val->getBen->address1}}, {{@$val->getBen->address2}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                        <h3>Final Will Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                        @if(@$val->download_file_date)
                                                            <P>Final Will Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                            <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                            <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif

                                        </div>
                                        </div> --}}
                                    <!-- 000 -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="inner_page_area dashboard_inner">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="panel-heading">
                                <h3 class="panel-title">View Created Will Information</h3>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="preview_all_will_mail">

                                <?php
                                    if(@$user->user_relation == 'D'){
                                        $relation = 'daughter';
                                    }elseif(@$user->user_relation == 'S'){
                                        $relation = 'son';
                                    }elseif(@$user->user_relation == 'W'){
                                        $relation = 'wife';
                                    }elseif(@$user->user_relation == 'H'){
                                        $relation = 'husband';
                                    }else{
                                        $relation = '-';
                                    }

                                    //user age
                                    $from = new DateTime($user->dob);
                                    $to   = new DateTime('today');
                                    $age = $from->diff($to)->y;
                                ?>

                                <!--00-->
                                    <div class="accordion_container">
                                        <div class="accordion_head" data-id="18"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Executors
                                        <span class="plusminus plusminus18">↓</span></div>
                                        <div class="accordion_body aa18" style="display: none;">

                                        @if(@$executors)
                                        @foreach(@$executors as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Executors Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li>
                                                            {{getTitle(@$val->user_relation)}}. {{@$val->name}}, {{@$val->address1.', '.@$val->address2.', '.@$val->city.' - '.@$val->zip_code.', '.@$val->state.', '.@$val->getCountry->name}} @if(@$val->aadhar_number)(Aadhar No: {{$val->aadhar_number}})@endif  @if(@$val->mobile), {{@$val->phonecode ? '+'.@$val->getPhonecode->phonecode : ''}} {{@$val->mobile}} @endif <br>
                                                            <b>Relation between Executor and Will creator:</b> {{@$val->exe_willcreator_relation}}
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        @endforeach
                                        @endif

                                        </div>
                                        {{-- <a href="{{route('user.manage.executor',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>

                                    <!--01-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="1"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Cash
                                    <span class="plusminus plusminus1">↓</span></div>
                                    <div class="accordion_body aa1" style="display: none;">

                                            @if(@$cash)
                                            @foreach(@$cash as $val)
                                                <div class="add_bene_name">
                                                    <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Asset Information</h1></div>
                                                        <ul class="all_will_infoo01">
                                                        <li><strong>Cash Amount</strong> <span>₹ {{@$val->amount}}</span></li>
                                                        <li><strong>Amount In Words</strong> {{@$val->amount_in_words}} </li>
                                                        <li><strong>Location of the cash</strong> {{@$val->location_of_cash}}</li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 beneficiaries_headingg">
                                                    <h1>Beneficiaries</h1>
                                                    </div>
                                                    @if(@$val->beneficiars)
                                                    @foreach(@$val->beneficiars as $data)
                                                        <div class="added_beneficiariess">
                                                            <h3>{{@$data->getBeneficiar->name}}</h3>
                                                            <P>Shares allocated : {{@$data->percentage}}% </P>
                                                            @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                            @endif
                                    </div>
                                    {{-- <a href="{{route('user.manage.cash',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--02-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="2"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Bank Account
                                    <span class="plusminus plusminus2">↓</span></div>
                                    <div class="accordion_body aa2" style="display: none;">

                                        @if(@$bank)
                                        @foreach(@$bank as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Bank Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Account Type</strong> <span>{{@$val->account_type}}</span></li>
                                                    <li><strong>Account Number</strong> {{@$val->account_number}} </li>
                                                    <li><strong>Account Holder Name</strong> {{@$val->account_holder_name}}</li>
                                                    <li><strong>Bank Name</strong>  {{@$val->bank_name}} </li>
                                                    <li><strong>IFSC Code</strong>  {{@$val->ifsc_code}}</li>
                                                    <li><strong>Branch Address</strong> {{@$val->branch_address}}</li>
                                                    <li><strong>Ownership Type</strong> {{@$val->ownership_type}} </li>
                                                    @if(@$val->percentage_holding)<li><strong>Percentage Holding</strong> {{@$val->percentage_holding}} </li>@endif
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.bank',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--03-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="3"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Jewellery
                                    <span class="plusminus plusminus3">↓</span></div>
                                    <div class="accordion_body aa3" style="display: none;">

                                        @if(@$jewelry)
                                        @foreach(@$jewelry as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Jewellery Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        {{--@if(@$val->gold_weight)<li><strong> Gold</strong> <span>{{@$val->gold_weight." gm,"}} </span></li> @endif
                                                        @if(@$val->silver_weight)<li><strong> Silver</strong> <span>{{@$val->silver_weight." gm,"}} </span></li> @endif--}}
                                                        @if(@$val->description)<li><strong> Description</strong> <span>{{@$val->description}} </span></li> @endif
                                                        @if(@$val->location)<li><strong> Location</strong> <span>{{@$val->location}}</span></li> @endif
                                                        {{--@if(@$val->address)<li><strong> Address</strong> <span>{{@$val->address}}</span></li> @endif--}}
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        {{-- <P>Shares allocated : {{@$data->percentage}}% </P> --}}
                                                        @if(@$data->share_detail)<p>Additional Information : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.jewelry',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--04-->
                                    {{-- <div class="accordion_container">
                                    <div class="accordion_head" data-id="4"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Locker
                                    <span class="plusminus plusminus4">↓</span></div>
                                    <div class="accordion_body aa4" style="display: none;">

                                        @if(@$locker)
                                        @foreach(@$locker as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Locker Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Locker No</strong> <span> {{@$val->locker_number}}</span></li>
                                                        <li><strong>Bank Name</strong> <span> {{@$val->bank_name}}</span></li>
                                                        <li><strong>Branch address</strong> <span> {{@$val->branch_address}}</span></li>
                                                        <li><strong>Passcode</strong> <span> {{@$val->passcode ? @$val->passcode : 'N/A' }}</span></li>
                                                        <li><strong>Key Location</strong> <span> {{@$val->key_location ? @$val->key_location : 'N/A' }}</span></li>
                                                        @if(@$val->additional_info)
                                                        <li><strong>Additional Information</strong> <span> {{@$val->additional_info}}</span></li>
                                                        @endif
                                                    </ul>
                                                </div> --}}

                                                {{--  @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif --}}

                                            {{-- </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    </div> --}}


                                    <!--05-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="5"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Residential Property
                                    <span class="plusminus plusminus5">↓</span></div>
                                    <div class="accordion_body aa5" style="display: none;">

                                        @if(@$residential)
                                        @foreach(@$residential as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Residential Property Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Name of the property</strong> {{@$val->name}} </li>
                                                        {{--<li><strong>Carpet Area(sq. ft.)</strong> {{@$val->carpet_area}} </li>--}}
                                                        <li><strong>Address</strong> {{@$val->address}} </li>
                                                        @if(@$val->residential_type)<li><strong>Property Type</strong> {{@$val->residential_type}} </li>@endif
                                                        @if(@$val->plot_size)<li><strong>Area (Sq. ft)</strong> {{@$val->plot_size}} </li>@endif
                                                        <li><strong>Ownership Type</strong> {{@$val->ownership_type}} </li>
                                                        @if(@$val->percentage_holding)<li><strong>Percentage Holding</strong> {{@$val->percentage_holding}} </li>@endif
                                                        @if(@$val->litigation)<li><strong>Encumbrance </strong> {{@$val->litigation}} </li>@endif
                                                        @if(@$val->jurisdiction)<li><strong>Jurisdiction</strong> {{@$val->jurisdiction}} </li>@endif
                                                        @if(@$val->survey_number)<li><strong>Survey Number</strong> {{@$val->survey_number}}</li>@endif
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.residentials',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--06-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="6"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Commercial Property
                                    <span class="plusminus plusminus6">↓</span></div>
                                    <div class="accordion_body aa6" style="display: none;">

                                        @if(@$commercial)
                                        @foreach(@$commercial as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Commercial Property Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Name of the property</strong> {{@$val->name}} </li>
                                                        {{--<li><strong>Carpet Area(sq. ft.)</strong> {{@$val->carpet_area}} </li>--}}
                                                        <li><strong>Address</strong> {{@$val->address}} </li>
                                                        @if(@$val->commercial_type)<li><strong>Property Type</strong> {{@$val->commercial_type}} </li>@endif
                                                        @if(@$val->plot_size)<li><strong>Area (Sq. ft)</strong> {{@$val->plot_size}} </li>@endif
                                                        <li><strong>Ownership Type</strong> {{@$val->ownership_type}} </li>
                                                        @if(@$val->percentage_holding)<li><strong>Percentage Holding</strong> {{@$val->percentage_holding}} </li>@endif
                                                        @if(@$val->litigation)<li><strong>Encumbrance </strong> {{@$val->litigation}} </li>@endif
                                                        @if(@$val->jurisdiction)<li><strong>Jurisdiction</strong> {{@$val->jurisdiction}} </li>@endif
                                                        @if(@$val->survey_number)<li><strong>Survey Number</strong> {{@$val->survey_number}}</li>@endif
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.commercial',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--07-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="7"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Land
                                    <span class="plusminus plusminus7">↓</span></div>
                                    <div class="accordion_body aa7" style="display: none;">

                                        @if(@$land)
                                        @foreach(@$land as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Land Property Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Name</strong> {{@$val->name}} </li>
                                                        {{--<li><strong>Carpet Area(sq. ft.)</strong> {{@$val->carpet_area}} </li>--}}
                                                        <li><strong>Address</strong> {{@$val->address}} </li>
                                                        @if(@$val->land_type)<li><strong>Land Type</strong> {{@$val->land_type}} </li>@endif
                                                        @if(@$val->plot_size)<li><strong>Land Area</strong> {{@$val->plot_size}} {{@$val->land_area_unit}}</li>@endif
                                                        <li><strong>Ownership Type</strong> {{@$val->ownership_type}} </li>
                                                        @if(@$val->percentage_holding)<li><strong>Percentage Holding</strong> {{@$val->percentage_holding}} </li>@endif
                                                        @if(@$val->litigation)<li><strong>Encumbrance </strong> {{@$val->litigation}} </li>@endif
                                                        @if(@$val->jurisdiction)<li><strong>Jurisdiction</strong> {{@$val->jurisdiction}} </li>@endif
                                                        @if(@$val->survey_number)<li><strong>Survey Number</strong> {{@$val->survey_number}}</li>@endif
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.land',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--08-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="8"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Demat Account
                                    <span class="plusminus plusminus8">↓</span></div>
                                    <div class="accordion_body aa8" style="display: none;">

                                        @if(@$demat)
                                        @foreach(@$demat as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Demat Acount Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>DP Name:</strong> {{@$val->dp_name}}</li>
                                                        <li><strong>DP ID:</strong> {{@$val->account_name}}</li>
                                                        <li><strong>Account NO:</strong> {{@$val->demat_account_number}}</li>
                                                        <li><strong>Branch & Address:</strong> {{@$val->address}}</li>
                                                        <li><strong>Ownership Type</strong> {{@$val->ownership_type}} </li>
                                                        @if(@$val->percentage_holding)<li><strong>Percentage Holding</strong> {{@$val->percentage_holding}} </li>@endif
                                                        {{-- @if(@$val->equity)<li><strong>Equity & Quantity:</strong> {{@$val->equity}}</li> @endif
                                                        @if(@$val->quantity)<li><strong>Quantity:</strong> {{@$val->quantity}}</li> @endif
                                                        @if(@$val->custodian)<li><strong>Custodian:</strong> {{@$val->custodian}}</li> @endif --}}
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        {{-- <P>Shares allocated : {{@$data->percentage}}% </P> --}}
                                                        @if(@$data->share_detail)<p>Equity & Quantity : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.demat',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--09-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="9"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Mutual Funds & Bonds
                                    <span class="plusminus plusminus9">↓</span></div>
                                    <div class="accordion_body aa9" style="display: none;">

                                        @if(@$mutual_funds)
                                        @foreach(@$mutual_funds as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Mutual Funds Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Fund Name:</strong> {{@$val->investment_banker}}</li>
                                                        <li><strong>Scheme Name:</strong> {{@$val->account_name}}</li>
                                                        <li><strong>Acc NO:</strong> {{@$val->account_number}}</li>
                                                        <li><strong>Number of units:</strong> {{@$val->number_of_units}}</li>
                                                        <li><strong>Address of the Bank/Advisory:</strong> {{@$val->address}}</li>
                                                        <li><strong>Ownership Type</strong> {{@$val->ownership_type}} </li>
                                                        @if(@$val->percentage_holding)<li><strong>Percentage Holding</strong> {{@$val->percentage_holding}} </li>@endif
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                        <li><strong>Ownership Type</strong> {{@$val->ownership_type}} </li>
                                                        @if(@$val->percentage_holding)<li><strong>Percentage Holding</strong> {{@$val->percentage_holding}} </li>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.mutualFund',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--10-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="10"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Insurance
                                    <span class="plusminus plusminus10">↓</span></div>
                                    <div class="accordion_body aa10" style="display: none;">

                                        @if(@$insurance)
                                        @foreach(@$insurance as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Insurance Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        {{-- <li><strong>Policy Holder Name:</strong> {{@$val->policy_holder_name}}</li> --}}
                                                        <li><strong>Insurance Comapany Name:</strong> {{@$val->insurance_company_name}}</li>
                                                        <li><strong>Policy Number:</strong> {{@$val->policy_number}}</li>
                                                        <li><strong>Policy Type:</strong> {{@$val->type}}</li>
                                                        <li><strong>Beneficiary Name:</strong> {{@$val->getBeneficiar->getBeneficiar->name}}</li>
                                                        {{-- <li><strong>Distribution Plan:</strong> {{@$val->insurance_distribution_plan}}</li> --}}
                                                    </ul>
                                                </div>

                                                {{-- @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif --}}

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.insurance',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--11-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="11"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> PPF
                                    <span class="plusminus plusminus11">↓</span></div>
                                    <div class="accordion_body aa11" style="display: none;">

                                        @if(@$ppf)
                                        @foreach(@$ppf as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>PPF Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Acc NO:</strong> {{@$val->account_number}}</li>
                                                        <li><strong>Account Name:</strong> {{@$val->account_name}}</li>
                                                        <li><strong>Bank Name:</strong> {{@$val->bank_name}}</li>
                                                        <li><strong>Branch address:</strong> {{@$val->branch_address}}</li>
                                                        {{-- <li><strong>Nominee Name:</strong> {{@$val->nominee_name}}</li> --}}
                                                        {{--<li><strong>Start Date:</strong> {{date('j M Y', strtotime(@$val->start_date))}}</li>
                                                        <li><strong>End Date:</strong> {{date('j M Y', strtotime(@$val->end_date))}}</li>--}}
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.ppf',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--12-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="12"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Vehicles
                                    <span class="plusminus plusminus12">↓</span></div>
                                    <div class="accordion_body aa12" style="display: none;">

                                        @if(@$vehicles)
                                        @foreach(@$vehicles as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Vehicles Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Registration No</strong> {{@$val->registration_number}}</li>
                                                    <li><strong>Make & Model</strong> {{@$val->brand_name}}</li>
                                                    <li><strong>Type</strong> {{@$val->type}}</li>
                                                    <li><strong>Manufacture Year</strong> {{@$val->manufacture_year}}</li>
                                                    <li><strong>Location</strong> {{@$val->location}}</li>
                                                    {{--<li><strong>Ownership Type</strong> {{@$val->ownership_type}} </li>
                                                        @if(@$val->percentage_holding)<li><strong>Percentage Holding</strong> {{@$val->percentage_holding}} </li>@endif --}}
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        {{-- <P>Shares allocated : {{@$data->percentage}}% </P> --}}
                                                        @if(@$data->share_detail)<p>Additional Information : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.vehicles',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--13-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="13"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Art
                                    <span class="plusminus plusminus13">↓</span></div>
                                    <div class="accordion_body aa13" style="display: none;">

                                        @if(@$art)
                                        @foreach(@$art as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Art Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Art Name</strong> {{@$val->art_name}}</li>
                                                        <li><strong>Type</strong> {{@$val->type}}</li>
                                                        <li><strong>Location</strong> {{@$val->location}}</li>
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        {{-- @if(@$data->percentage)<P>Shares allocated : {{@$data->percentage}}% </P>@endif --}}
                                                        @if(@$data->share_detail)<p>Additional Information : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.art',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--14-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="14"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Liability
                                    <span class="plusminus plusminus14">↓</span></div>
                                    <div class="accordion_body aa14" style="display: none;">

                                        @if(@$liability)
                                        @foreach(@$liability as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Liability Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Type</strong> {{@$val->type}}</li>
                                                        <li><strong>Amount's outstanding </strong>  Rs. {{@$val->amount}}</li>
                                                        <li><strong>Payment Schedule</strong>  {{@$val->payment_schedule}}</li>
                                                        <li><strong>Payment amount:</strong>  {{@$val->payment_amount}}</li>
                                                        <li><strong>Lender Name</strong>  {{@$val->lender_name}}</li>
                                                        <li><strong>Lender Branch & Address</strong>  {{@$val->lender_address}}</li>
                                                        <li><strong> Libility to be paid by</strong>  {{@$val->description}}</li>
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    {{-- <a href="{{route('user.manage.liability',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--16-->
                                    <div class="accordion_container">
                                        <div class="accordion_head" data-id="16"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Other Assets
                                        <span class="plusminus plusminus16">↓</span></div>
                                        <div class="accordion_body aa16" style="display: none;">

                                        @if(@$other)
                                        @foreach(@$other as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Other Assets Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Beneficiary </strong> {{@$val->getBeneficiar->name}}</li>
                                                        <li>{{@$val->description}}</li>
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                            @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                        </div>
                                        {{-- <a href="{{route('user.manage.residualAssets',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>

                                    <!--15-->
                                    <div class="accordion_container">
                                        <div class="accordion_head" data-id="15"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Residual Assets
                                        <span class="plusminus plusminus15">↓</span></div>
                                        <div class="accordion_body aa15" style="display: none;">

                                        @if(@$residual)
                                        @foreach(@$residual as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Residual Assets Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>To </strong> {{@$val->getBeneficiar->name}}</li>
                                                        <li>{{@$val->description}}</li>
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                            @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                        </div>
                                        {{-- <a href="{{route('user.manage.residualAssets',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>


                                    <!--16-->
                                    {{--
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="16"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Contingency
                                    <span class="plusminus plusminus16">↓</span></div>
                                    <div class="accordion_body aa16" style="display: none;">

                                        @if(@$contingency)
                                        @foreach(@$contingency as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Contingency Information</h1></div>
                                                    <ul class="all_will_infoo01">7
                                                        <li><strong>To </strong>{{@$val->getBeneficiar->name}}</li>
                                                        <li>{{@$val->details}}</li>
                                                    </ul>
                                                </div>

                                                @if(@$val->beneficiars)
                                                @foreach(@$val->beneficiars as $data)
                                                    <div class="added_beneficiariess">
                                                        <h3>{{@$data->getBeneficiar->name}}</h3>
                                                        <P>Shares allocated : {{@$data->percentage}}% </P>
                                                        @if(@$data->share_detail)<p>Share Detail : {{@$data->share_detail}} </p>@endif
                                                    </div>
                                                @endforeach
                                                @endif

                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    <a href="{{route('user.manage.contingency',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a>
                                    </div>
                                    --}}

                                    <!--17-->
                                    <div class="accordion_container">
                                        <div class="accordion_head" data-id="17"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Witness
                                        <span class="plusminus plusminus17">↓</span></div>
                                        <div class="accordion_body aa17" style="display: none;">

                                        @if(@$witness)
                                        @foreach(@$witness as $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Witness Information</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        <li><strong>Name</strong> {{@$val->salutation}} {{@$val->name}}</li>
                                                        @if(@$val->aadhar_number)<li><strong>Aadhaar Card No</strong> {{@$val->aadhar_number}}</li>@endif
                                                        <li><strong>Address</strong> {{@$val->address1}}, {{@$val->address2}}, {{@$val->city}}, {{@$val->state}}-{{@$val->zip_code}},</li>
                                                        <li><strong>Date</strong> {{date('d/m/Y')}}</li>
                                                    </ul>
                                                </div>

                                            </div>
                                        @endforeach
                                        @endif

                                        </div>
                                        {{-- <a href="{{route('user.manage.witness',[@$will_id])}}"><img src="{{asset('public/images/eedd.png')}}" alt="icon"> Edit</a> --}}
                                    </div>
                                <!-- 000 -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        {{-- Location Stor --}}
        @if(@$locPack->package_id==2)
            <div class="inner_page_area dashboard_inner">
                <div class="container">
                    <div class="row">

                        {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="cus-dashboard-right didlex">
                                <h2>Preview Will</h2>
                            </div>
                        </div> --}}

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="preview_all_will_mail">

                                <!--00-->
                                    <!--01-->
                                    <div class="accordion_container">
                                        <div class="accordion_head" data-id="1"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Location of physical copy of will
                                            <span class="plusminus plusminus1">↓</span>
                                        </div>
                                        <div class="accordion_body aa1" style="display: none;">
                                            @if(@$wills->will_code)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                <div class="beneficiaries_headingg"><h1>Will Storage Location</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Location</strong> <span>{{@$wills->will_location}}</span></li>
                                                    <li><strong>Address</strong> <span>{{@$wills->address}}</span></li>
                                                    <li><strong>Code</strong> {{@$wills->will_code}} </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>


                                    <!--02-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="2"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Nominees Information
                                    <span class="plusminus plusminus2">↓</span></div>
                                    <div class="accordion_body aa2" style="display: none;">
                                        <?php $count2 = 0; ?>
                                        @if(@$willBeneficiariesL)
                                        @foreach(@$willBeneficiariesL as $key => $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Nominee {{++$count2}}</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Name</strong> <span>{{@$val->getBen->name}}</span></li>
                                                    <li><strong>
                                                        @if(@$val->getBen->user_relation=='S')
                                                            Son of
                                                        @elseif(@$val->getBen->user_relation=='D')
                                                            Daughter of
                                                        @elseif(@$val->getBen->user_relation=='H')
                                                            Husband of
                                                        @elseif(@$val->getBen->user_relation=='W')
                                                            Wife of
                                                        @endif
                                                    </strong> {{@$val->getBen->relationship}} </li>
                                                    <li><strong>Email</strong> {{@$val->getBen->email}}</li>
                                                    <li><strong>Mobile</strong> {{@$val->getBen->phonecode ? '+'.@$val->getBen->getPhonecode->phonecode : ''}} {{@$val->getBen->mobile}}</li>
                                                    <li><strong>Aadhar Number</strong> {{@$val->getBen->aadhar_number}}</li>
                                                    <li><strong>Citizen of</strong>  {{@$val->getBen->getNationality->name}}</li>
                                                    <li><strong>City</strong> {{@$val->getBen->city}}</li>
                                                    <li><strong>State</strong> {{@$val->getBen->state}} </li>
                                                    <li><strong>Country</strong> {{@$val->getBen->getCountry->name}} </li>
                                                    <li><strong>Post Code</strong> {{@$val->getBen->zip_code}} </li>
                                                    <li><strong>Address</strong> {{@$val->getBen->address1}}, {{@$val->getBen->address2}}</li>
                                                    </ul>
                                                </div>
                                                <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                    <h3>Location Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                    @if(@$val->download_file_date)
                                                        <P>Location Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                        <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                        <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif

                                        @if(@$willExecutorsL)
                                        @foreach(@$willExecutorsL as $key => $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Nominee {{++$count2}}</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Name</strong> <span>{{@$val->getExe->name}}</span></li>
                                                    <li><strong>
                                                        @if(@$val->getExe->user_relation=='S')
                                                            Son of
                                                        @elseif(@$val->getExe->user_relation=='D')
                                                            Daughter of
                                                        @elseif(@$val->getExe->user_relation=='H')
                                                            Husband of
                                                        @elseif(@$val->getExe->user_relation=='W')
                                                            Wife of
                                                        @endif
                                                    </strong> {{@$val->getExe->relationship}} </li>
                                                    <li><strong>Email</strong> {{@$val->getExe->email}}</li>
                                                    <li><strong>Mobile</strong> {{@$val->getExe->phonecode ? '+'.@$val->getExe->getPhonecode->phonecode : ''}} {{@$val->getExe->mobile}}</li>
                                                    <li><strong>Aadhar Number</strong> {{@$val->getExe->aadhar_number}}</li>
                                                    <li><strong>Citizen of</strong>  {{@$val->getExe->getNationality->name}}</li>
                                                    <li><strong>City</strong> {{@$val->getExe->city}}</li>
                                                    <li><strong>State</strong> {{@$val->getExe->state}} </li>
                                                    <li><strong>Country</strong> {{@$val->getExe->getCountry->name}} </li>
                                                    <li><strong>Post Code</strong> {{@$val->getExe->zip_code}} </li>
                                                    <li><strong>Address</strong> {{@$val->getExe->address1}}, {{@$val->getExe->address2}}</li>
                                                    </ul>
                                                </div>
                                                    <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                        <h3>Location Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                        @if(@$val->download_file_date)
                                                            <P>Location Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                            <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                            <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                        @endif
                                                    </div>
                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    </div>


                                    <!--03-->
                                    {{--<div class="accordion_container">
                                    <div class="accordion_head" data-id="3"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Beneficiaries Information
                                    <span class="plusminus plusminus3">↓</span></div>
                                    <div class="accordion_body aa3" style="display: none;">

                                        @if(@$willBeneficiariesL)
                                        @foreach(@$willBeneficiariesL as $key => $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Beneficiary {{@$key+1}}</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Name</strong> <span>{{@$val->getBen->name}}</span></li>
                                                    <li><strong>
                                                        @if(@$val->getBen->user_relation=='S')
                                                            Son of
                                                        @elseif(@$val->getBen->user_relation=='D')
                                                            Daughter of
                                                        @elseif(@$val->getBen->user_relation=='H')
                                                            Husband of
                                                        @elseif(@$val->getBen->user_relation=='W')
                                                            Wife of
                                                        @endif
                                                    </strong> {{@$val->getBen->relationship}} </li>
                                                    <li><strong>Email</strong> {{@$val->getBen->email}}</li>
                                                    <li><strong>Mobile</strong> {{@$val->getBen->phonecode ? '+'.@$val->getBen->getPhonecode->phonecode : ''}} {{@$val->getBen->mobile}}</li>
                                                    <li><strong>Aadhar Number</strong> {{@$val->getBen->aadhar_number}}</li>
                                                    <li><strong>Nationality</strong>  {{@$val->getBen->getNationality->name}}</li>
                                                    <li><strong>City</strong> {{@$val->getBen->city}}</li>
                                                    <li><strong>State</strong> {{@$val->getBen->state}} </li>
                                                    <li><strong>Country</strong> {{@$val->getBen->getCountry->name}} </li>
                                                    <li><strong>Post Code</strong> {{@$val->getBen->zip_code}} </li>
                                                    <li><strong>Address</strong> {{@$val->getBen->address1}}, {{@$val->getBen->address2}}</li>
                                                    </ul>
                                                </div>
                                                <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                    <h3>Location Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                    @if(@$val->download_file_date)
                                                        <P>Location Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                        <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                        <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    </div>--}}
                                <!-- 000 -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- LOI --}}
        @if(@$locPack->package_id==3)
            <div class="inner_page_area dashboard_inner">
                <div class="container">
                    <div class="row">

                        {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="cus-dashboard-right didlex">
                                <h2>Preview Will</h2>
                            </div>
                        </div> --}}

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="preview_all_will_mail">

                                <!--00-->
                                    <!--01-->
                                    <div class="accordion_container">
                                        <div class="accordion_head" data-id="1"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Letter Of Instruction
                                            <span class="plusminus plusminus1">↓</span>
                                        </div>
                                        <div class="accordion_body aa1" style="display: none;">
                                            @if(@$wills->will_code)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                <div class="beneficiaries_headingg"><h1>Letter Of Instruction</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        {{-- <li> <span>{{@$wills->loi}}</span></li> --}}
                                                        @if(@$wills->loi_file != null)
                                                        <li><strong>LOI File</strong> <a href="{{url('storage\app\public\loi_file')}}\{{@$wills->loi_file}}" target="_blank"> View File </a> </li>
                                                        @endif
                                                        <li><strong>Code</strong> {{@$wills->will_code}} </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>


                                    <!--02-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="2"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Nominees Information
                                    <span class="plusminus plusminus2">↓</span></div>
                                    <div class="accordion_body aa2" style="display: none;">
                                        <?php $count3 = 0; ?>
                                        @if(@$willBeneficiariesLI)
                                        @foreach(@$willBeneficiariesLI as $key => $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Nominee {{++$count3}}</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Name</strong> <span>{{@$val->getBen->name}}</span></li>
                                                    <li><strong>
                                                        @if(@$val->getBen->user_relation=='S')
                                                            Son of
                                                        @elseif(@$val->getBen->user_relation=='D')
                                                            Daughter of
                                                        @elseif(@$val->getBen->user_relation=='H')
                                                            Husband of
                                                        @elseif(@$val->getBen->user_relation=='W')
                                                            Wife of
                                                        @endif
                                                    </strong> {{@$val->getBen->relationship}} </li>
                                                    <li><strong>Email</strong> {{@$val->getBen->email}}</li>
                                                    <li><strong>Mobile</strong> {{@$val->getBen->phonecode ? '+'.@$val->getBen->getPhonecode->phonecode : ''}} {{@$val->getBen->mobile}}</li>
                                                    <li><strong>Aadhar Number</strong> {{@$val->getBen->aadhar_number}}</li>
                                                    <li><strong>Citizen of</strong>  {{@$val->getBen->getNationality->name}}</li>
                                                    <li><strong>City</strong> {{@$val->getBen->city}}</li>
                                                    <li><strong>State</strong> {{@$val->getBen->state}} </li>
                                                    <li><strong>Country</strong> {{@$val->getBen->getCountry->name}} </li>
                                                    <li><strong>Post Code</strong> {{@$val->getBen->zip_code}} </li>
                                                    <li><strong>Address</strong> {{@$val->getBen->address1}}, {{@$val->getBen->address2}}</li>
                                                    </ul>
                                                </div>
                                                <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                    <h3>LOI Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                    @if(@$val->download_file_date)
                                                        <P>LOI Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                        <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                        <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif

                                        @if(@$willExecutorsLI)
                                        @foreach(@$willExecutorsLI as $key => $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Nominee {{++$count3}}</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Name</strong> <span>{{@$val->getExe->name}}</span></li>
                                                    <li><strong>
                                                        @if(@$val->getExe->user_relation=='S')
                                                            Son of
                                                        @elseif(@$val->getExe->user_relation=='D')
                                                            Daughter of
                                                        @elseif(@$val->getExe->user_relation=='H')
                                                            Husband of
                                                        @elseif(@$val->getExe->user_relation=='W')
                                                            Wife of
                                                        @endif
                                                    </strong> {{@$val->getExe->relationship}} </li>
                                                    <li><strong>Email</strong> {{@$val->getExe->email}}</li>
                                                    <li><strong>Mobile</strong> {{@$val->getExe->phonecode ? '+'.@$val->getExe->getPhonecode->phonecode : ''}} {{@$val->getExe->mobile}}</li>
                                                    <li><strong>Aadhar Number</strong> {{@$val->getExe->aadhar_number}}</li>
                                                    <li><strong>Citizen of</strong>  {{@$val->getExe->getNationality->name}}</li>
                                                    <li><strong>City</strong> {{@$val->getExe->city}}</li>
                                                    <li><strong>State</strong> {{@$val->getExe->state}} </li>
                                                    <li><strong>Country</strong> {{@$val->getExe->getCountry->name}} </li>
                                                    <li><strong>Post Code</strong> {{@$val->getExe->zip_code}} </li>
                                                    <li><strong>Address</strong> {{@$val->getExe->address1}}, {{@$val->getExe->address2}}</li>
                                                    </ul>
                                                </div>
                                                    <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                        <h3>LOI Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                        @if(@$val->download_file_date)
                                                            <P>LOI Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                            <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                            <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                        @endif
                                                    </div>
                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    </div>


                                    <!--03-->
                                    {{-- <div class="accordion_container">
                                    <div class="accordion_head" data-id="3"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Beneficiaries Information
                                    <span class="plusminus plusminus3">↓</span></div>
                                    <div class="accordion_body aa3" style="display: none;">

                                        @if(@$willBeneficiariesLI)
                                        @foreach(@$willBeneficiariesLI as $key => $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Beneficiary {{@$key+1}}</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Name</strong> <span>{{@$val->getBen->name}}</span></li>
                                                    <li><strong>
                                                        @if(@$val->getBen->user_relation=='S')
                                                            Son of
                                                        @elseif(@$val->getBen->user_relation=='D')
                                                            Daughter of
                                                        @elseif(@$val->getBen->user_relation=='H')
                                                            Husband of
                                                        @elseif(@$val->getBen->user_relation=='W')
                                                            Wife of
                                                        @endif
                                                    </strong> {{@$val->getBen->relationship}} </li>
                                                    <li><strong>Email</strong> {{@$val->getBen->email}}</li>
                                                    <li><strong>Mobile</strong> {{@$val->getBen->phonecode ? '+'.@$val->getBen->getPhonecode->phonecode : ''}} {{@$val->getBen->mobile}}</li>
                                                    <li><strong>Aadhar Number</strong> {{@$val->getBen->aadhar_number}}</li>
                                                    <li><strong>Nationality</strong>  {{@$val->getBen->getNationality->name}}</li>
                                                    <li><strong>City</strong> {{@$val->getBen->city}}</li>
                                                    <li><strong>State</strong> {{@$val->getBen->state}} </li>
                                                    <li><strong>Country</strong> {{@$val->getBen->getCountry->name}} </li>
                                                    <li><strong>Post Code</strong> {{@$val->getBen->zip_code}} </li>
                                                    <li><strong>Address</strong> {{@$val->getBen->address1}}, {{@$val->getBen->address2}}</li>
                                                    </ul>
                                                </div>
                                                <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                    <h3>LOI Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                    @if(@$val->download_file_date)
                                                        <P>LOI Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                        <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                        <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    </div> --}}
                                <!-- 000 -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- AMD --}}
        @if(@$locPack->package_id==5)
            <div class="inner_page_area dashboard_inner">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="preview_all_will_mail">

                                <!--00-->
                                    <!--01-->
                                    <div class="accordion_container">
                                        <div class="accordion_head" data-id="1"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic01.png')}}" alt="icon"> </span> Advance Medical Directive
                                            <span class="plusminus plusminus1">↓</span>
                                        </div>
                                        <div class="accordion_body aa1" style="display: none;">
                                            @if(@$wills->will_code)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                <div class="beneficiaries_headingg"><h1>Advance Medical Directive</h1></div>
                                                    <ul class="all_will_infoo01">
                                                        {{-- <li> <span>{{@$wills->amd_text}}</span></li> --}}
                                                        @if(@$wills->amd_file != null)
                                                        <li><strong>AMD File</strong> <a href="{{url('storage\app\public\amd_file')}}\{{@$wills->amd_file}}" target="_blank"> View File </a> </li>
                                                        @endif
                                                        <li><strong>Code</strong> {{@$wills->will_code}} </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>


                                    <!--02-->
                                    <div class="accordion_container">
                                    <div class="accordion_head" data-id="2"> <span class="all_perv_icn"><img src="{{asset('public/images/will_pic02.png')}}" alt="icon"> </span> Trusted Information
                                    <span class="plusminus plusminus2">↓</span></div>
                                    <div class="accordion_body aa2" style="display: none;">
                                        <?php $count4 = 0; ?>
                                        @if(@$willBeneficiariesAMD)
                                        @foreach(@$willBeneficiariesAMD as $key => $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Trusted {{++$count4}}</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Name</strong> <span>{{@$val->getBen->name}}</span></li>
                                                    <li><strong>
                                                        @if(@$val->getBen->user_relation=='S')
                                                            Son of
                                                        @elseif(@$val->getBen->user_relation=='D')
                                                            Daughter of
                                                        @elseif(@$val->getBen->user_relation=='H')
                                                            Husband of
                                                        @elseif(@$val->getBen->user_relation=='W')
                                                            Wife of
                                                        @endif
                                                    </strong> {{@$val->getBen->relationship}} </li>
                                                    <li><strong>Email</strong> {{@$val->getBen->email}}</li>
                                                    <li><strong>Mobile</strong> {{@$val->getBen->phonecode ? '+'.@$val->getBen->getPhonecode->phonecode : ''}} {{@$val->getBen->mobile}}</li>
                                                    <li><strong>Aadhar Number</strong> {{@$val->getBen->aadhar_number}}</li>
                                                    <li><strong>Citizen of</strong>  {{@$val->getBen->getNationality->name}}</li>
                                                    <li><strong>City</strong> {{@$val->getBen->city}}</li>
                                                    <li><strong>State</strong> {{@$val->getBen->state}} </li>
                                                    <li><strong>Country</strong> {{@$val->getBen->getCountry->name}} </li>
                                                    <li><strong>Post Code</strong> {{@$val->getBen->zip_code}} </li>
                                                    <li><strong>Address</strong> {{@$val->getBen->address1}}, {{@$val->getBen->address2}}</li>
                                                    </ul>
                                                </div>
                                                <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                    <h3>AMD Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                    @if(@$val->download_file_date)
                                                        <P>AMD Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                        <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                        <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif

                                        @if(@$willExecutorsAMD)
                                        @foreach(@$willExecutorsAMD as $key => $val)
                                            <div class="add_bene_name">
                                                <div class="col-lg-12 col-md-12 fm_lrr">
                                                    <div class="beneficiaries_headingg"><h1>Trusted {{++$count4}}</h1></div>
                                                    <ul class="all_will_infoo01">
                                                    <li><strong>Name</strong> <span>{{@$val->getExe->name}}</span></li>
                                                    <li><strong>
                                                        @if(@$val->getExe->user_relation=='S')
                                                            Son of
                                                        @elseif(@$val->getExe->user_relation=='D')
                                                            Daughter of
                                                        @elseif(@$val->getExe->user_relation=='H')
                                                            Husband of
                                                        @elseif(@$val->getExe->user_relation=='W')
                                                            Wife of
                                                        @endif
                                                    </strong> {{@$val->getExe->relationship}} </li>
                                                    <li><strong>Email</strong> {{@$val->getExe->email}}</li>
                                                    <li><strong>Mobile</strong> {{@$val->getExe->phonecode ? '+'.@$val->getExe->getPhonecode->phonecode : ''}} {{@$val->getExe->mobile}}</li>
                                                    <li><strong>Aadhar Number</strong> {{@$val->getExe->aadhar_number}}</li>
                                                    <li><strong>Citizen of</strong>  {{@$val->getExe->getNationality->name}}</li>
                                                    <li><strong>City</strong> {{@$val->getExe->city}}</li>
                                                    <li><strong>State</strong> {{@$val->getExe->state}} </li>
                                                    <li><strong>Country</strong> {{@$val->getExe->getCountry->name}} </li>
                                                    <li><strong>Post Code</strong> {{@$val->getExe->zip_code}} </li>
                                                    <li><strong>Address</strong> {{@$val->getExe->address1}}, {{@$val->getExe->address2}}</li>
                                                    </ul>
                                                </div>
                                                    <div class="added_beneficiariess loi_downlod" style="width: auto">
                                                        <h3>AMD Viewed : @if(@$val->download_file_date == null)NO @else YES @endif</h3>
                                                        @if(@$val->download_file_date)
                                                            <P>AMD Viewed On: {{@$val->download_file_date ? date('d.m.Y',strtotime(@$val->download_file_date)) : '-'}}</P>
                                                            <p>Uploaded File Type : @if(@$val->upload_file_type == 'LI') Letter of instruction @else Death Certificate @endif</p>
                                                            <p><a href="{{url('storage\app\public\will_download_prof')}}\{{@$val->upload_file_name}}" target="_blank"> View File </a> </p>
                                                        @endif
                                                    </div>
                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

	</div>
</div>

@endsection
@section('footer')
@include('admin.includes.footer')
@endsection
@section('script')
@include('admin.includes.scripts')
<script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>

  <!--left panel toggle and faq-->
  <script type="text/javascript">

  $(document).ready(function(){
    //toggle the componenet with class accordion_body
    $(".accordion_head").click(function(){
      var id=$(this).data('id');
      if ($('.aa'+id).is(':visible')) {
        $(".aa"+id).slideUp(600);
        $(".plusminus"+id).text('↓');
      }
      else
      {
        $(".accordion_body").slideUp(600);
        $(".plusminus").text('↓');
        $(this).next(".accordion_body").slideDown(600);
        $(this).children(".plusminus"+id).text('↑');
      }

    });
  });
  </script>
  <!--faq-->


@endsection
