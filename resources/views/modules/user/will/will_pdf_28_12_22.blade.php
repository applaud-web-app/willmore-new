<!DOCTYPE html>
<html>
   <head>
      <title>Will Document.</title>
      <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Overlock:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Overlock:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap');
        /* font-family: 'Overlock', cursive; */
        *{
            font-family: 'Overlock' !important;
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
            font-size: 15px;
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
            font-size:18px;
            font-weight:500;
        }
      </style>
   </head>
   <body style="font-family: 'Overlock' !important;">
    <?php
    if($user->user_relation == 'D'){
        $relation = 'daughter';
    }elseif($user->user_relation == 'S'){
        $relation = 'son';
    }elseif($user->user_relation == 'W'){
        $relation = 'wife';
    }elseif($user->user_relation == 'H'){
        $relation = 'husband';
    }else{
        $relation = '-';
    }

    if($executor->user_relation == 'D'){
        $executorRelation = 'daughter';
    }elseif($executor->user_relation == 'S'){
        $executorRelation = 'son';
    }elseif($executor->user_relation == 'W'){
        $executorRelation = 'wife';
    }elseif($executor->user_relation == 'H'){
        $executorRelation = 'husband';
    }else{
        $executorRelation = '-';
    }

    //user age
    $from = new DateTime($user->dob);
    $to   = new DateTime('today');
    $age = $from->diff($to)->y;

    ?>
      <div style="width:640px; margin:0 auto;">
         <div style="float: none; text-align: center; display: inline-block; width: 100%;" class="will-words">
            <h2 style="font-size: 22px;font-weight: 400;color: #55098C;margin: 0 0 30px 0;text-align: center;">Last Will and testament of {{@$user->name}} {{date('j M Y')}}</h2>

            <!-- *************Personal Info******************* -->
            <p style="text-align:left;">1. &nbsp; I, {{getTitle(@$user->gender )}} {{@$user->name}}, aged about {{$age}} years (Date of birth {{date('d/m/Y', strtotime($user->dob))}}), {{$relation}} of {{getRelation(@$user->user_relation)}} {{@$user->relationship}} residing at {{@$user->address1.' , '.@$user->address2.' , '.@$user->address3.' '.@$user->city.' '.@$user->state.' '.@$user->getCountry->name}} (Aadhaar Number – {{@$user->aadhar_number}}) do make this my last Will and testament dated {{date('j M Y')}}.</p>

            <p style="text-align:left;">2. &nbsp; With the execution of this new Will dated {{date('j M Y')}}, all the previous Wills or last testaments if any made by me and/or signed by me, now stand cancelled and withdrawn.</p>

            <!-- *************Display Executors******************* -->
            <p style="text-align:left;margin-bottom:30px;">3. &nbsp; I appoint {{(count(@$executors) > 1) ? 'Executors' : 'Executor'}} of this Will and Trustee of my estates and assets till the assets are distributed as per my desire as contained in this document:</p>

            @if(@$executors)
            @if(count(@$executors) > 1) <ol> @else <ul> @endif
            @foreach(@$executors as $val)
            <li>
            <p style="text-align:left;margin-top:-20px;">{{getTitle(@$val->user_relation)}}. {{$val->name}} {{@$val->address1.' , '.@$val->address2.' '.@$val->city.' '.@$val->state.' '.@$val->getCountry->name}} (Aadhar No: {{$val->aadhar_number}})</p>
            </li>
            @endforeach
            @if(count(@$executors) > 1) </ol> @else </ul> @endif
            @endif

            <!-- *************Static******************* -->
            <p style="text-align:left;">4. &nbsp; I have severed all relationships with my living family members from many years hence I am bequeathing all my assets to my friends and well-wishers and certain individuals who have been very helpful and kind to me during my difficult times having attended to my welfare and well- being during my life time, as well as certain  organisations in which I have personal interest as these organisations also take care of the welfare of its members and the members of the public.</p>

            <!-- *************Display Assets******************* -->
            <p style="text-align:left;">5. &nbsp; My properties/ assets will be distributed to the beneficiaries as following:</p>

            <table  style="width:100%">
                <tr>
                    <th><b>S No</b></th>
                    <th><b>Description of asset</b></th>
                    <th><b>Beneficiaries</b></th>
                </tr>
                <?php $i=1; ?>

                <!-- *************Property Assets******************* -->
                @if(@$property)
                @foreach(@$property as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>@if(@$val->type == 'R')
                            Residential Plot
                            @elseif(@$val->type == 'C')
                            Commercial Plot
                            @elseif(@$val->type == 'L')
                            Land property
                            @endif
                            </b><br>
                            <b>Name:</b> {{@$val->name}} <br>
                            <b>Carpet Area(sq. ft.):</b> {{@$val->carpet_area}} <br>
                            <b>Name:</b> {{@$val->address}} <br>
                            @if(@$val->residential_type)<b>Property Type:</b> {{@$val->residential_type}} <br>@endif
                            @if(@$val->commercial_type)<b>Property Type:</b> {{@$val->commercial_type}} <br>@endif
                            @if(@$val->land_type)<b>Land Type:</b> {{@$val->land_type}} <br>@endif
                            @if(@$val->plot_size)<b>Plot Size(Katha):</b> {{@$val->plot_size}} <br>@endif
                            <b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                            @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif
                            @if(@$val->litigation)<b>Litigation :</b> {{@$val->litigation}} <br>@endif
                            @if(@$val->jurisdiction)<b>Jurisdiction:</b> {{@$val->jurisdiction}} <br>@endif
                            @if(@$val->survey_number)<b>Survey Number:</b> {{@$val->survey_number}}@endif
                        </p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}}. {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br>
                        Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail)({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Cash Assets******************* -->
                @if(@$cash)
                @foreach(@$cash as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Cash</b><br>
                        <b>Amount:</b> Rs. {{@$val->amount}} <br>
                        <b>Amount in words:</b> {{@$val->amount_in_words}} <br>
                        <b>Location:</b> {{@$val->location_of_cash}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}},<br>
                        Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% (of amount Rs.{{@$val->amount}}@if(@$data->share_detail) {{@$data->share_detail}} @endif).</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Bank Assets******************* -->
                @if(@$bank)
                @foreach(@$bank as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Bank</b><br>
                        <b>Account NO:</b> {{@$val->account_number}}<br>
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
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Jwellery Assets******************* -->
                @if(@$jewelry)
                @foreach(@$jewelry as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Jewellery:</b><br>
                        @if(@$val->gold_weight)<b>Gold:</b> {{@$val->gold_weight." gm,"}}<br>@endif
                        @if(@$val->silver_weight)<b>Silver:</b> {{@$val->silver_weight." gm,"}}<br>@endif
                        @if(@$val->description)<b>Description:</b> {{@$val->description}}<br>@endif
                        @if(@$val->location)<b>Location:</b> {{@$val->location}}</p>@endif
                        @if(@$val->address)<b>Address:</b> {{@$val->address}}@endif</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">{{@$data->share_detail}}.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Locker Assets******************* -->
                @if(@$locker)
                @foreach(@$locker as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Locker</b><br>
                        <b>Locker NO:</b> {{@$val->locker_number}}<br>
                        <b>Bank Name:</b> {{@$val->bank_name}}<br>
                        <b>Branch address:</b> {{@$val->branch_address}}<br>
                        <b>Passcode:</b> {{@$val->passcode}}<br>
                        <b>Authorized Person name:</b> {{@$val->authorized_person}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Locker Assets******************* -->
                @if(@$demat)
                @foreach(@$demat as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Demat:</b><br>
                        <b>Account NO:</b> {{@$val->demat_account_number}}<br>
                        <b>Account Name:</b> {{@$val->account_name}}<br>
                        <b>Address:</b> {{@$val->address}}<br>
                        <b>DP Name:</b> {{@$val->dp_name}}<br>
                        <b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                        @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif
                        @if(@$val->equity)<b>Equity:</b> {{@$val->equity}}<br>@endif
                        @if(@$val->quantity)<b>Quantity:</b> {{@$val->quantity}}<br>@endif
                        @if(@$val->custodian)<b>Custodian:</b> {{@$val->custodian}}@endif</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Mutual Fund Assets******************* -->
                @if(@$mutual_funds)
                @foreach(@$mutual_funds as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Mutual Fund</b><br>
                        <b>Acc NO:</b> {{@$val->account_number}}<br>
                        <b>Account Name:</b> {{@$val->account_name}}<br>
                        <b>Address:</b> {{@$val->address}}<br>
                        <b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                        @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif
                        <b>Investment Banker Name:</b> {{@$val->investment_banker}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Insurance Assets******************* -->
                @if(@$insurance)
                @foreach(@$insurance as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Insurance</b><br>
                        <b>Policy Holder Name:</b> {{@$val->policy_holder_name}}<br>
                        <b>Policy Type:</b> {{@$val->type}}<br>
                        <b>Policy Number:</b> {{@$val->policy_number}}<br>
                        <b>Nominee Name:</b> {{@$val->nominee_name}}<br>
                        <b>Insurance Comapany Name:</b> {{@$val->insurance_company_name}}<br>
                        <b>Distribution Plan:</b> {{@$val->insurance_distribution_plan}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************PPF Assets******************* -->
                @if(@$ppf)
                @foreach(@$ppf as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>PPF</b><br>
                        <b>Acc NO:</b> {{@$val->account_number}}<br>
                        <b>Account Name:</b> {{@$val->account_name}}<br>
                        <b>Bank Name:</b> {{@$val->bank_name}}<br>
                        <b>Branch address:</b> {{@$val->branch_address}}<br>
                        <b>Nominee Name:</b> {{@$val->nominee_name}}<br>
                        <b>Start Date:</b> {{date('j M Y', strtotime(@$val->start_date))}}<br>
                        <b>End Date:</b> {{date('j M Y', strtotime(@$val->end_date))}}
                    </p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">Will get {{@$data->percentage}}% @if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Vehicle Assets******************* -->
                @if(@$vehicles)
                @foreach(@$vehicles as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Vehicle</b><br>
                        <b>Registration NO:</b> {{@$val->registration_number}}<br>
                        <b>Brand Name:</b> {{@$val->brand_name}}<br>
                        <b>Type:</b> {{@$val->type}}<br>
                        <b>Manufacture Year:</b> {{@$val->manufacture_year}}<br>
                        <b>Ownership Type:</b> {{@$val->ownership_type}} <br>
                        @if(@$val->percentage_holding)<b>Percentage Holding:</b> {{@$val->percentage_holding}} <br>@endif
                        <b>Location:</b> {{@$val->location}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">@if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif

                <!-- *************Art Assets******************* -->
                @if(@$art)
                @foreach(@$art as $val)
                <tr>
                    <td class="width-1"><p style="text-align:left;margin-top:-17px;">{{$i}}</p></td>
                    <td class="width-2">
                        <p style="text-align:left;"><b>Art</b><br>
                        <b>Art Name:</b> {{@$val->art_name}}<br>
                        <b>Type:</b> {{@$val->type}}<br>
                        <b>Location:</b> {{@$val->location}}</p>
                    </td>
                    <td class="width-3">
                    @if(@$val->beneficiars)
                    @foreach(@$val->beneficiars as $data)
                        <p style="text-align:left;">{{getTitle(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->name}}, {{@$data->getBeneficiar->user_relation}}/o {{getRelation(@$data->getBeneficiar->user_relation)}} {{@$data->getBeneficiar->relationship}},<br>
                        AADHAAR {{@$data->getBeneficiar->aadhar_number}}, Residing at {{@$data->getBeneficiar->address1.' , '.@$data->getBeneficiar->address2.' '.@$data->getBeneficiar->city.' '.@$data->getBeneficiar->state.' '.@$data->getBeneficiar->getCountry->name}},</p>
                        <p style="text-align:left;margin-top:-20px;">@if(@$data->share_detail) ({{@$data->share_detail}}) @endif.</p>
                    @endforeach
                    @endif
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif
            </table>

            <p style="text-align:left;margin-top:25px;">6. &nbsp; I bequeath all my funds/ assets/property as listed out/stated herein/above and any
                other property or assets that I may acquire hence forth as well as any bank deposits that I
                may create after the date of this Will including those bank term deposits/ FDs that may
                be renewed from time to time, in whatever form existing at the time of my death to the
                persons/individuals and organisations mentioned here below against each of the
                aforesaid assets, which rights include, among others, the absolute right and power to
                reinvest, alienate, withdraw before maturity, sell, dispose off, mortgage, pledge, lien, rent,
                lease, knock down the existing buildings and if required rebuild or construct new
                buildings/ structures for residential or commercial purposes, vest or bequeath to their
                spouse or children or others as they may deem it fit.</p>

            <p style="text-align:left;">7. &nbsp; I hereby direct my aforesaid Executor that after my death all my immoveable and
                moveable assets be dealt with and distributed as stated hereunder. My Executor and
                Trustee shall, after spending the necessary moneys for the management for the said
                property/assets out of the income thereof (or where there is no income out of the
                principal itself), pay the net income or effect the transfer of all the aforesaid assets
                standing in my name including all the other assets that I own and possess which are not
                listed in this Will to the persons and/or organisations as stated in the chart here below.
                My Executors and trustees will also spend out the corpus of my estate such amounts as
                may be required for my last medical expenses as well as my funeral expenses.</p>

            <?php $num = 7; ?>

            <!-- *************Contingency******************* -->
            @if(count(@$contingency) > 0)
            <p style="text-align:left;">{{++$num}}. &nbsp; Should any of the beneficiaries of the assets as listed out in this Will predecease me, the said assets will be distributed as mentioned below:</p>
            <ol>
            @foreach(@$contingency as $val)
            <li>
            <p style="text-align:left;">To {{@$val->getBeneficiar->name}}</p>
            <p style="text-align:left;margin-top: -22px;">{{@$val->details}}</p>
            </li>
            @endforeach
            </ol>
            @endif

            <!-- *************Residual******************* -->
            @if(count(@$residual) > 0)
            <p style="text-align:left;">{{++$num}}. &nbsp; Any other asset in my name individually or jointly with anyone else is hereby bequeathed to</p>
            <ol>
            @foreach(@$residual as $val)
            <li>
            <p style="text-align:left;">{{@$val->getBeneficiar->name}}</p>
            <p style="text-align:left;margin-top: -22px;">{{@$val->description}}</p>
            </li>
            @endforeach
            </ol>
            @endif

            <!-- *************Liability******************* -->
            @if(count(@$liability) > 0)
            <p style="text-align:left;">{{++$num}}. &nbsp; I have the following liabilities</p>
            <ol>
            @foreach(@$liability as $val)
            <li>
            <p style="text-align:left;"><b>Type:</b> {{@$val->type}}</p>
            <p style="text-align:left;margin-top: -22px;"><b>Amount:</b>  Rs. {{@$val->amount}}</p>
            <p style="text-align:left;margin-top: -22px;"><b>Payment Schedule:</b>  {{@$val->payment_schedule}}</p>
            <p style="text-align:left;margin-top: -22px;"><b>Lender Name:</b>  {{@$val->lender_name}}</p>
            <p style="text-align:left;margin-top: -22px;"><b> Libility to be paid by:</b>  {{@$val->description}}</p>
            </li>
            @endforeach
            </ol>
            @endif

            <p style="text-align:left;">{{++$num}}. &nbsp; Till the completion of the administration of the said property by realisation thereof
            and payment of all liabilities the Executors and trustees, shall hold the property on trust
            hereby created.</p>

            <p style="text-align:left;">{{++$num}}. &nbsp; I state that all my properties and assets as listed above belong to me only and are
            all self-earned and are acquired absolutely by me and I have every right to make a WILL in
            respect thereof and as such I am making this WILL of all my properties/ assets which I
            own at present and which I may own hereafter.</p>

            <p style="text-align:left;">{{++$num}}. &nbsp; I have made this WILL with the good intention that after my death, there should
not be any dispute or uncertainty with regard to the assets and properties that may be
left by me.</p>

            <p style="text-align:left;">{{++$num}}. &nbsp; I have made this WILL and declared the same as my LAST WILL (until any other
            WILL which may be prepared/ executed by me in future) of my own accord without any
            pressure from anyone, in quite good state of health. The will is also being registered by
            me and any other will if I may prepare in future should be considered only if it is duly,
            registered.</p>

            <p style="text-align:left;">{{++$num}}. &nbsp; I hereby direct the Executor of my Will that my assets and properties, which I may
leave behind me at the time of my death may please be dealt with in the manner
and directions given hereinabove. I hereby once again state that I have made this
Will of my own accord in quite a good state of health without any pressure from
any one and with the good intention that after my death there should not be any
dispute or uncertainty with regard to the assets and properties that may be left by
me at the time of my death.</p>

            <p style="text-align:left;">{{++$num}}. &nbsp; Disposal of my dead body: SHALL BE WITH NO RELIGIOUS RITUALS: ONLY
ELECTRIC CREMATORIUM &amp; ASHES BE DISPOSED OFF IN THE SEA
AFTER MY DEMISE NO DISPLAY OF MY ANY EXISTING PHOTOGRAPH FOR ANY OBITUARY
PLEASE WHETHER PUBLIC OR PRIVATE
AFTER MY DEMISE ALL MY PHOTOGRAPHS BE BURNT &amp; DISPOSED OFF [WITH THE
EXCEPTION OF ANY NECESSARY REQUIRED LEGAL PROCESS ONLY]</p>

            <p style="text-align:left;">{{++$num}}. &nbsp; Having made this Will and Last Testament out of my free will and while I am in
sound health and in good understanding and in witness thereof, I have put my
signature hereunder in the presence of two witnesses this 15 th day of Nov 2022</p>



            <p style="text-align:left;">Signature of Testator</p>
            <p style="text-align:left;margin-top: -20px;">Mr/Miss  <b>{{@$user->name}}</b></p>
            <p style="text-align:left;margin-top: -20px;"><b>Dated:</b> {{date('j M Y')}}</p>
            <p style="text-align:left;margin-top: -20px;"><b>Place:</b> {{@$user->city.' '.@$user->state.' '.@$user->getCountry->name}}</p>

            <p style="text-align:left;margin-top: 12px;">In the presence of witnesses, who in his presence and at his request of each other have placed their signatures as witnesses hereunder:</p>



            <table class="witnesstable" style="width:100%">
            @if(@$witness)
                <?php $i = 1; ?>
            @foreach(@$witness as $val)
                <tr>
                    <td class="width-11"><p style="text-align:left;margin-top: -20px;">{{$i}}</p></td>
                    <td class="width-22">
                    <p style="text-align:left;margin-top: -20px;"><b>Name:</b> {{@$val->name}}</p>
                    <p style="text-align:left;margin-top: -20px;"><b>Aadhaar Card No:</b> {{@$val->aadhar_number}}</p>
                    <p style="text-align:left;margin-top: -20px;"><b>Address:</b> {{@$val->address1}} {{@$val->address2}} {{@$val->city}} {{@$val->state}}</p>
                    <p style="text-align:left;margin-top: -20px;"><b>Date:</b> {{date('d/m/Y')}}</p>
                    </td>
                    <td class="width-33">
                    <p style="text-align:left;margin-top: -20px;">Signature</p>
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
