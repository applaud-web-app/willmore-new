<!DOCTYPE html>
<html>
   <head>
      <title>Will Document.</title>
      <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Overlock:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');
        /* font-family: 'Overlock', cursive; */
        *{
            font-family: 'Cormorant', serif !important;
        }
        table, th, td {
        border: 1px solid #918b8b;
        border-collapse: collapse;
        text-align:left;
        }

        th,td{
            padding:5px;
            color: #363839;
        }
        th{
            font-weight: 400 !important;
        }
        td{
            font-weight: normal !important;
            vertical-align: top !important;
        }
        td p{
            word-break: break-word !important;
        }
        .width-1{
            width:2% !important;
            padding-top: 25px !important;
        }
        .width-2{
            width:40% !important;
        }
        .width-3{
            width:58% !important;
        }
        .witnesstable, .witnesstable th, .witnesstable td {
        border: none !important;
        border-collapse: collapse;
        text-align:left;
        }
        .width-11{
            width:2% !important;
            padding-top: 8px !important;
        }
        .width-22{
            width:70% !important;
        }
        .width-33{
            width:30% !important;
        }
        .width-63{
            width:63% !important;
        }
        .width-37{
            width:25% !important;
        }
        .number_box{
            width:5%;
            margin-left:-5px;
            color:white;
        }
        .witness_box1{
            width:55%;
            float:left;
        }
        .witness_box2{
            width:40%;
            float:right;
        }
        .wbox{
            width:100%;
            display:flex;
            flex-direction:row;
            justify-content:space-between;
            align-items:flex-start;
            margin-bottom:20px;
        }
        .will-words p{
            font-size: 14px;
            font-weight:400;
            color: #363839;
            margin: 2px 0 22px 0;
            line-height: 19px;
            text-align: justify;
            display:flex;
            justify-content:flex-start; align-items:flex-start;
        }
        .will-words p span{
            width:22px;
            text-align:left;
            font-size:14px;
            font-weight:500;
        }
      </style>
   </head>
   <body style="font-family: 'Cormorant', serif !important; ">
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

    if(@$executor->user_relation == 'D'){
        $executorRelation = 'daughter';
    }elseif(@$executor->user_relation == 'S'){
        $executorRelation = 'son';
    }elseif(@$executor->user_relation == 'W'){
        $executorRelation = 'wife';
    }elseif(@$executor->user_relation == 'H'){
        $executorRelation = 'husband';
    }else{
        $executorRelation = '-';
    }

    //user age
    $from = new DateTime($user->dob);
    $to   = new DateTime('today');
    $age = $from->diff($to)->y;

    ?>
      <div style="margin:0px 100px;"> <!-- width:640px; -->
         <div style="float: none; text-align: center; display: inline-block; width: 100%;" class="will-words">
            <h2 style="font-size: 22px;text-decoration: underline;text-decoration-color: #000000;margin: 0 0 30px 0;text-align: center; font-weight: 900;"><b>LAST WILL AND TESTAMENT</b></h2>
            {{--<h2 style="font-size: 22px;text-decoration: underline;text-decoration-color: #000000;margin: 0 0 30px 0;text-align: center; font-weight: 900;"><b>LAST WILL AND TESTAMENT OF {{strtoupper(@$user->name)}}</b></h2>--}}

            <!-- *************Personal Info******************* -->
            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">1.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;">I, {{getTitle(@$user->gender )}}. {{@$user->name}}, aged about {{$age}} years (Date of birth {{date('d/m/Y', strtotime($user->dob))}}), {{$relation}} of {{getRelation(@$user->user_relation)}} {{@$user->relationship}} residing at {{@$user->address1.', '.@$user->address2.', '.@$user->city.' - '.@$user->zip_code.', '.@$user->state.', '.@$user->getCountry->name}} @if(@$user->aadhar_number)(Aadhaar Number – {{@$user->aadhar_number}})@endif do hereby make this my last Will and testament.
            </span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>

            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">2.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;">With the execution of this Will, all previous Wills and Testaments, if any made by me and/or signed by me, hereby stand cancelled and withdrawn.</span><div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>

            <!-- *************Display Executors******************* -->
            {{-- <p style="text-align:left;margin-bottom:30px;">3. &nbsp; I hereby appoint {{(count(@$executors) > 1) ? 'Executors' : 'Executor'}} of this Will and Trustee of my estates and assets till the assets are distributed as per my desire as contained in this document:</p>

            @if(@$executors)
            @if(count(@$executors) > 1) <ol> @else <ul> @endif
            @foreach(@$executors as $val)
            <li>
            <p style="text-align:left;margin-top:-20px;">{{getTitle(@$val->user_relation)}}. {{$val->name}}, {{@$val->address1.', '.@$val->address2.', '.@$val->city.' - '.@$val->zip_code.', '.@$val->state.', '.@$val->getCountry->name}} (Aadhar No: {{$val->aadhar_number}}) <br>
            <b>Relationship of Executor & Will creator:</b> {{@$val->exe_willcreator_relation}}</p>
            </li>
            @endforeach
            @if(count(@$executors) > 1) </ol> @else </ul> @endif
            @endif --}}

            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">3.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;"> I hereby appoint
            @if(count(@$executors) > 0)
            <?php $e=1; ?>
                @foreach(@$executors as $val)
                {{getTitle(@$val->user_relation)}}. {{$val->name}}, {{$executorRelation}} of {{getRelation(@$val->user_relation)}} {{@$val->relationship}}, {{@$val->address1.', '.@$val->address2.', '.@$val->city.' - '.@$val->zip_code.', '.@$val->state.', '.@$val->getCountry->name}}, @if($val->aadhar_number)Aadhaar Number – {{$val->aadhar_number ? $val->aadhar_number.', ' : ''}}@endif my <span style="width:20px; font-size: 14px; font-weight:400; color: #363839; text-transform: lowercase;">{{@$val->exe_willcreator_relation}}</span> @if($e < count(@$executors)) and @endif
                <?php $e++; ?>
                @endforeach
            @endif
            as the {{(count(@$executors) > 1) ? 'Executors' : 'Executor'}} of this Will and as the {{(count(@$executors) > 1) ? 'Trustees' : 'Trustee'}} of all my moveable and/or immoveable assets/properties till my assets and properties are distributed as per my wishes as contained in this Will.</span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>

            <!-- *************Static******************* -->
            {{-- <p style="text-align:left;">4. &nbsp; I have severed all relationships with my living family members from many years hence I am bequeathing all my assets to my friends and well-wishers and certain individuals who have been very helpful and kind to me during my difficult times having attended to my welfare and well- being during my life time, as well as certain  organisations in which I have personal interest as these organisations also take care of the welfare of its members and the members of the public.</p> --}}

            <!-- *************Display Assets******************* -->
            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">4.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;"> I hereby bequeath all my moveable and/or immoveable assets/properties to the following beneficiaries in the manner set out in the table below, subject to Clause 6 below and these beneficiaries will have absolute right to the said moveable and/or immoveable assets/properties without recourse to or approval of or consent or permission of anyone including the Executors and/or Trustees.:</span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>


            <table  style="width:100% ;">
                <tr>
                    <th><b style="white-space: nowrap; font-size:14px">S No</b></th>
                    <th><b>Description of asset</b></th>
                    <th><b>Beneficiaries</b></th>
                </tr>
                <?php $i=1; ?>

                <!-- *************Property Assets******************* -->
                @if(@$property)
                <?php
                $res = 1;
                $com = 1;
                $lan = 1;
                ?>
                @foreach(@$property as $val)

                @if((@$val->type == 'R' && @$res == 1) || (@$val->type == 'C' && @$com == 1) || (@$val->type == 'L' && @$lan == 1) )
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">@if(@$val->type == 'R')
                            Residential Property
                            <?php $res++; ?>
                            @elseif(@$val->type == 'C')
                            Commercial Property
                            <?php $com++; ?>
                            @elseif(@$val->type == 'L')
                            Residential Plot
                            <?php $lan++; ?>
                            @endif </b></td>
                    <td></td>
                </tr>
                @endif
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>@if(@$val->type == 'R')
                            Residential Plot
                            @elseif(@$val->type == 'C')
                            Commercial Plot
                            @elseif(@$val->type == 'L')
                            Land property
                            @endif
                            </b><br>--}}
                            <b>@if(@$val->type == 'L')Name: @else Name of the property: @endif</b> {{@$val->name}} <br>
                            {{--@if(@$val->carpet_area)<b>Carpet Area(sq. ft.):</b> {{@$val->carpet_area}} <br>@endif--}}
                            <b>Address:</b> {{@$val->address}} <br>
                            @if(@$val->residential_type)<b>Property Type:</b> {{@$val->residential_type}} <br>@endif
                            @if(@$val->commercial_type)<b>Property Type:</b> {{@$val->commercial_type}} <br>@endif
                            @if(@$val->land_type)<b>Land Type:</b> {{@$val->land_type}} <br>@endif
                            @if(@$val->plot_size)<b>Land Area:</b> {{@$val->plot_size}} {{@$val->land_area_unit}}<br>@endif
                            <b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                            @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif
                            @if(@$val->litigation)<b>Encumbrance :</b> {{@$val->litigation}} <br>@endif
                            @if(@$val->jurisdiction)<b>Jurisdiction:</b> {{@$val->jurisdiction}} <br>@endif
                            @if(@$val->survey_number)<b>Survey Number:</b> {{@$val->survey_number}}@endif
                        </p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}}. {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif
                        Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail)({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Cash Assets******************* -->
                @if(count(@$cash) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Cash</b></td>
                    <td></td>
                </tr>
                @foreach(@$cash as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>Cash</b><br>--}}
                        <b>Amount:</b> Rs. {{@$val->amount}} <br>
                        <b>Amount in words:</b> {{@$val->amount_in_words}} <br>
                        <b>Location:</b> {{@$val->location_of_cash}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif
                        Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% (equals to an amount of Rs.{{number_format((@$val->amount/100) * @$data->percentage,2,'.','')}}@if(@$data->share_detail) {{@$data->share_detail}} @endif).</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Bank Assets******************* -->
                @if(count(@$bank) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Bank</b></td>
                    <td></td>
                </tr>
                @foreach(@$bank as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>Bank</b><br>--}}
                        <b>Account No:</b> {{@$val->account_number}}<br>
                        <b>Account Type:</b> {{@$val->account_type}}<br>
                        <b>Bank Name:</b> {{@$val->bank_name}}<br>
                        <b>Branch address:</b> {{@$val->branch_address}}<br>
                        <b>IFSC:</b> {{@$val->ifsc_code}}<br>
                        <b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                        @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif
                        <b>Account holder name:</b> {{@$val->account_holder_name}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Jwellery Assets******************* -->
                @if(count(@$jewelry) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Jewellery</b></td>
                    <td></td>
                </tr>
                @foreach(@$jewelry as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>Jewellery</b><br>--}}
                        {{--@if(@$val->gold_weight)<b>Gold:</b> {{@$val->gold_weight." gm,"}}<br>@endif
                        @if(@$val->silver_weight)<b>Silver:</b> {{@$val->silver_weight." gm,"}}<br>@endif--}}
                        @if(@$val->description)<b>Description:</b> {{@$val->description}}<br>@endif
                        @if(@$val->location)<b>Location:</b> {{@$val->location}}<br>@endif
                        {{--@if(@$val->address)<b>Address:</b> {{@$val->address}}@endif</p>--}}
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}}</p>
                        <p style="text-align:left;margin-top:-20px;">@if(@$data->share_detail) {{@$data->share_detail}}. @endif</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Locker Assets******************* -->
                {{-- @if(count(@$locker) > 0)
                <tr>
                    <td></td>
                    <td><b>Locker</b></td>
                    <td></td>
                </tr>
                @foreach(@$locker as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        <b>Locker No. {{@$val->locker_number}}</b><br>
                        <b>Bank Name:</b> {{@$val->bank_name}}<br>
                        <b>Branch address:</b> {{@$val->branch_address}}</p>
                    </td>
                    <td class="width-3">
                    <p>
                        Key Location: {{@$val->key_location ? @$val->key_location : 'N/A'}}<br>
                        Passcode: {{@$val->passcode ? @$val->passcode : 'N/A'}}<br>
                        @if(@$val->additional_info) Additional Information: {{@$val->additional_info}} @endif</p> --}}
                    {{-- @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif --}}
                    {{-- </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif --}}

                <!-- *************Locker Assets******************* -->
                @if(count(@$demat) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Demat</b></td>
                    <td></td>
                </tr>
                @foreach(@$demat as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>Demat</b><br>--}}
                        <b>DP Name:</b> {{@$val->dp_name}}<br>
                        <b>DP ID:</b> {{@$val->account_name}}<br>
                        <b>Account No:</b> {{@$val->demat_account_number}}<br>
                        <b>Branch & Address:</b> {{@$val->address}}<br>
                        <b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                        @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif
                        {{--@if(@$val->equity)<b>Equity & Quantity:</b> {{@$val->equity}}<br>@endif
                        @if(@$val->quantity)<b>Quantity:</b> {{@$val->quantity}}<br>@endif
                        @if(@$val->custodian)<b>Custodian:</b> {{@$val->custodian}}@endif  --}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}},</p>
                        {{--<p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>--}}
                        <p style="text-align:left;margin-top:-20px;">Equity & Quantity: @if(@$data->share_detail) {{@$data->share_detail}} @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Mutual Fund Assets******************* -->
                @if(count(@$mutual_funds) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Mutual Fund</b></td>
                    <td></td>
                </tr>
                @foreach(@$mutual_funds as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>Mutual Fund</b><br>--}}
                        <b>Fund Name:</b> {{@$val->investment_banker}}</p>
                        <b>Scheme Name:</b> {{@$val->account_name}}<br>
                        <b>Account No:</b> {{@$val->account_number}}<br>
                        <b>Number of units:</b> {{@$val->number_of_units}}<br>
                        <b>Address of the Bank/Advisory:</b> {{@$val->address}}<br>
                        <b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                        @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Insurance Assets******************* -->
                @if(count(@$insurance) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Insurance</b></td>
                    <td></td>
                </tr>
                @foreach(@$insurance as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>Insurance</b><br>--}}
                        <b>Insurance Comapany Name:</b> {{@$val->insurance_company_name}}<br>
                        <b>Policy Number:</b> {{@$val->policy_number}}<br></p>
                        <b>Policy Type:</b> {{@$val->type}}<br>
                        {{-- <b>Policy Holder Name:</b> {{@$val->policy_holder_name}}<br> --}}
                        {{-- <b>Policy Type:</b> {{@$val->type}}<br> --}}
                        {{-- <b>Policy Number:</b> {{@$val->policy_number}}<br></p> --}}
                    </td>
                    <td class="width-3">
                        <p style="text-align:left;">
                        {{-- Nominee Name: {{@$val->nominee_name}}<br> --}}
                        {{-- Insurance Comapany Name: {{@$val->insurance_company_name}}<br> --}}
                        {{-- Distribution Plan: {{@$val->insurance_distribution_plan}}</p> --}}
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}}.</p>
                        {{-- <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p> --}}
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************PPF Assets******************* -->
                @if(count(@$ppf) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">PPF</b></td>
                    <td></td>
                </tr>
                @foreach(@$ppf as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>PPF</b><br>--}}
                        <b>Account No:</b> {{@$val->account_number}}<br>
                        <b>Account Name:</b> {{@$val->account_name}}<br>
                        <b>Bank Name:</b> {{@$val->bank_name}}<br>
                        <b>Branch address:</b> {{@$val->branch_address}}<br>
                        {{-- <b>Nominee Name:</b> {{@$val->nominee_name}}<br> --}}
                        {{-- <b>Start Date:</b> {{date('j M Y', strtotime(@$val->start_date))}}<br>
                        <b>End Date:</b> {{date('j M Y', strtotime(@$val->end_date))}}
                        --}}
                    </p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Vehicle Assets******************* -->
                @if(count(@$vehicles) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Vehicle</b></td>
                    <td></td>
                </tr>
                @foreach(@$vehicles as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>Vehicle</b><br>--}}
                        <b>Registration No:</b> {{@$val->registration_number}}<br>
                        <b>Make & Model:</b> {{@$val->brand_name}}<br>
                        <b>Type:</b> {{@$val->type}}<br>
                        <b>Manufacture Year:</b> {{@$val->manufacture_year}}<br>
                        {{--<b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                        @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif--}}
                        <b>Location:</b> {{@$val->location}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}}</p>
                        <p style="text-align:left;margin-top:-20px;">@if(@$data->share_detail) ({{@$data->share_detail}}). @endif</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Art Assets******************* -->
                @if(count(@$art) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Art</b></td>
                    <td></td>
                </tr>
                @foreach(@$art as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        {{--<p style="text-align:left;"><b>Art</b><br>--}}
                        <b>Art Name:</b> {{@$val->art_name}}<br>
                        <b>Type:</b> {{@$val->type}}<br>
                        <b>Location:</b> {{@$val->location}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        @if(@$data->getBeneficiar->aadhar_number) AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$data->getBeneficiar->address1.', '.@$data->getBeneficiar->address2.', '.@$data->getBeneficiar->city.' - '.@$data->getBeneficiar->zip_code.', '.@$data->getBeneficiar->state.', '.@$data->getBeneficiar->getCountry->name}}</p>
                        <p style="text-align:left;margin-top:-20px;">@if(@$data->share_detail) ({{@$data->share_detail}}). @endif</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- ************* Other Assets******************* -->
                @if(count(@$other) > 0)
                <tr>
                    <td></td>
                    <td><b style="font-size:14px">Other Assets</b></td>
                    <td></td>
                </tr>
                @foreach(@$other as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2" style="font-size:14px">
                        <b>Description:</b> {{@$val->description}}<br>
                    </td>
                    <td class="width-3">
                        <p style="text-align:left;">{{getTitle(@$val->getBeneficiar->user_relation)}} {{@$val->getBeneficiar->name}}, {{@$val->getBeneficiar->user_relation}}/o {{getRelation(@$val->getBeneficiar->user_relation)}} {{@$val->getBeneficiar->relationship}},<br>
                        @if(@$val->getBeneficiar->aadhar_number) AADHAAR {{@$val->getBeneficiar->aadhar_number}},<br> @endif Residing at {{@$val->getBeneficiar->address1.', '.@$val->getBeneficiar->address2.', '.@$val->getBeneficiar->city.' - '.@$val->getBeneficiar->zip_code.', '.@$val->getBeneficiar->state.', '.@$val->getBeneficiar->getCountry->name}}.</p>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif
            </table>
<br>
            <?php $num = 4; ?>

            @if(count(@$residual) > 0)
            <?php $res=1; ?>
            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;"> Any moveable and/or immoveable assets/properties not mentioned in this Will or which are acquired by me in future, after execution of this Will but before my death, shall devolve upon: <br>
            @foreach(@$residual as $val)

            {{getTitle(@$val->getBeneficiar->user_relation)}}. {{$val->getBeneficiar->name}}, {{@$val->getBeneficiar->address1.', '.@$val->getBeneficiar->address2.', '.@$val->getBeneficiar->city.' - '.@$val->getBeneficiar->zip_code.', '.@$val->getBeneficiar->state.', '.@$val->getBeneficiar->getCountry->name}} @if(@$val->getBeneficiar->aadhar_number), AADHAAR {{@$val->getBeneficiar->aadhar_number}}. @endif<br>

            <?php $res++; ?>
            @endforeach
            </span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>
            @endif

            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;">  I hereby direct my Executor/Trustee to meet the following expenses out of my estate:</span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>
            <ol type="a" style="margin-left:10px;">
                <li><p style="text-align:left;margin-top: -20px;">my funeral expenses</p></li>
                <li><p style="text-align:left;margin-top: -22px;">any outstanding medical bills</p></li>
                <li><p style="text-align:left;margin-top: -22px;">any liability due and payable by me including taxes at the time of my death</p></li>
                <li><p style="text-align:left;margin-top: -22px;">such reasonable amounts as are necessary for maintenance and upkeep of my moveable and/or immoveable assets/properties</p></li>
            </ol>
            <p style="text-align:left;margin-top: -22px;">&nbsp; &nbsp; until they are distributed among the beneficiaries of this Will. </p>


            <!-- *************Contingency******************* -->
            {{--
            @if(count(@$contingency) > 0)
            <p style="text-align:left;">{{++$num}}. &nbsp; Should any of the beneficiaries of the assets as listed out in this Will predecease me, the said assets will be distributed as mentioned below:</p>
            <ol>
            @foreach(@$contingency as $val)
            <li>
            <p style="text-align:left;">To {{@$val->getBeneficiar->name}}</p>
            <p style="text-align:left;margin-top: -30px;">{{@$val->details}}</p>
            </li>
            @endforeach
            </ol>
            @endif
            --}}

            <!-- *************Residual******************* -->
            {{--
            @if(count(@$residual) > 0)
            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 15px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 15px;float:right; font-weight:400; color: #363839; text-align:justify;"> Any other asset in my name individually or jointly with anyone else is hereby bequeathed to</p>
            <ol>
            @foreach(@$residual as $val)
            <li>
            <p style="text-align:left;">{{@$val->getBeneficiar->name}}</p>
            <p style="text-align:left;margin-top: -22px;">{{@$val->description}}</p>
            </li>
            @endforeach
            </ol>
            @endif
            --}}

            <!-- *************Liability******************* -->
            @if(count(@$liability) > 0)
            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;"> I have the following liabilities</span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>
            <ol style="margin-left:10px;">
            @foreach(@$liability as $val)
            <li>
            <p style="text-align:left;"><b>Type:</b> {{@$val->type}}</p>
            <p style="text-align:left;margin-top: -22px;"><b>Amount's outstanding:</b>  Rs. {{@$val->amount}}</p>
            <p style="text-align:left;margin-top: -22px;"><b>Payment Schedule:</b>  {{@$val->payment_schedule}}</p>
            <p style="text-align:left;margin-top: -22px;"><b>Payment amount:</b>  {{@$val->payment_amount}}</p>
            <p style="text-align:left;margin-top: -22px;"><b>Lender Name:</b>  {{@$val->lender_name}}</p>
            <p style="text-align:left;margin-top: -22px;"><b>Lender Branch & Address:</b>  {{@$val->lender_address}}</p>
            <p style="text-align:left;margin-top: -22px;"><b> Libility to be paid by:</b>  {{@$val->description}}</p>
            </li>
            @endforeach
            </ol>
            @endif

            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;"> I state that all my moveable and/or immoveable assets/properties as listed in this Will belong to me have been acquired by me absolutely and that I have every right to make a Will in respect of the same</span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>

            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;"> I have made this Will with the intention that after my death there should not be any dispute or uncertainty regarding my moveable and/or immoveable assets/properties.</span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>

            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;"> I have made this Will and declared the same to be my last Will and Testament of my own accord, without pressure from anyone and while I am in good state of health.</span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p>

            {{--<p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 15px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 15px;float:right; font-weight:400; color: #363839; text-align:justify;"> I have made this WILL with the good intention that after my death, there should
not be any dispute or uncertainty with regard to the assets and properties that may be
left by me.</p>

            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 15px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 15px;float:right; font-weight:400; color: #363839; text-align:justify;"> I have made this WILL and declared the same as my LAST WILL (until any other
            WILL which may be prepared/ executed by me in future) of my own accord without any
            pressure from anyone, in quite good state of health. The will is also being registered by
            me and any other will if I may prepare in future should be considered only if it is duly,
            registered.</p>


            <p style="text-align:left;">{{++$num}}. &nbsp; Disposal of my dead body: SHALL BE WITH NO RELIGIOUS RITUALS: ONLY
                ELECTRIC CREMATORIUM &amp; ASHES BE DISPOSED OFF IN THE SEA
                AFTER MY DEMISE NO DISPLAY OF MY ANY EXISTING PHOTOGRAPH FOR ANY OBITUARY
                PLEASE WHETHER PUBLIC OR PRIVATE
                AFTER MY DEMISE ALL MY PHOTOGRAPHS BE BURNT &amp; DISPOSED OFF [WITH THE
                EXCEPTION OF ANY NECESSARY REQUIRED LEGAL PROCESS ONLY]</p>
                --}}

            <p style="text-align:left; display:block; width:100%; float:none;"><span style="width:20px; float:left;font-size: 14px; font-weight:400; color: #363839;">{{++$num}}.</span><span style="width:472px;display:inline-block;font-size: 14px;float:right; font-weight:400; color: #363839; text-align:justify;"> Having made this Last Will and Last Testament out of my free will and while I am in sound health and in good understanding, I have hereby put my signature hereunder in the presence of two witnesses on the date and at the place mentioned below.</span> <div class="clear" style="padding: 0px;margin: 0px 0px 15px 0px;clear: both;"></div></p><br>


            {{--
            <p style="text-align:left;">Signature of Testator</p>
            <p style="text-align:left;margin-top: -20px;"><b>{{@$user->name}}</b></p>
            <p style="text-align:left;margin-top: -20px;"><b>Dated:</b> </p>
            <p style="text-align:left;margin-top: -20px;"><b>Place:</b> </p>--}}

            <table class="witnesstable" style="width:500px; margin-left:28px;">
                <tr>
                    <td class="width-63">
                    <p style="text-align:left;margin-top: -20px;"><b>{{@$user->name}}</b></p>
                    <p style="text-align:left;margin-top: -20px;"><b>Dated:</b> </p>
                    <p style="text-align:left;margin-top: -20px;"><b>Place:</b> </p>
                    </td>
                    <td class="width-37">
                    <p style="text-align:left;margin-top: -20px;">Signature of Testator</p>
                    </td>
                </tr>
            </table>

            {{--<p style="text-align:left;margin-top: 12px;">In the presence of witnesses, who in his presence and at his request of each other have placed their signatures as witnesses hereunder:</p>--}}



            <table class="witnesstable" style="width:100%; margin-left:10px;">
                <p style="text-align:left;margin: -10px 0px 0px 20px;"><b>Witnesses</b></p><br>
            @if(@$witness)
                <?php $i = 1; ?>
            @foreach(@$witness as $val)
                <tr>
                    <td class="width-11"><p style="text-align:left;margin-top: -20px;">{{$i}}</p></td>
                    <td class="width-22">
                    <p style="text-align:left;margin-top: -20px;margin-left: -60px;"><b>Name:</b> {{@$val->salutation}} {{@$val->name}}</p>
                    @if(@$val->aadhar_number)<p style="text-align:left;margin-top: -20px;margin-left: -60px"><b>Aadhaar Card No:</b> {{@$val->aadhar_number}}</p>@endif
                    <p style="text-align:left;margin-top: -20px;margin-left: -60px"><b>Address:</b> {{@$val->address1}}, {{@$val->address2}}, {{@$val->city}} - {{@$val->zip_code}}, {{@$val->state}}, {{@$val->getCountry->name}}</p>
                    {{--<p style="text-align:left;margin-top: -20px;margin-left: -60px"><b>Place of Signature:</b> </p>--}}
                    </td>
                    <td class="width-33">
                    <p style="text-align:left;margin-top: -20px;">Signature</p>
                    <p style="text-align:left;margin-top: 24px;">Date</p>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            @endif
            </table>


         </div>





      </div>
   </body>
</html>
