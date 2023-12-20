<!DOCTYPE html>
<html>
   <head>
      <title>Will Document.</title>
      <style>

      </style>
   </head>
   <body>
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
         <div style="float: none; text-align: center; display: inline-block; width: 100%;">
            <h2 style="font-family: Arial; font-size: 22px;font-weight: 400;color: #55098C;margin: 0 0 30px 0;text-align: center;">SIMPLE WILL (INDIVIDUAL)</h2>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">I, Mr/Miss {{@$user->name}}, aged {{$age}}, {{@$user->getNationality->name}}, 
            {{$relation}} of Mr/Mrs {{@$user->relationship}}, resident of {{@$user->address1.' , '.@$user->address2.' , '.@$user->address3.' '.@$user->city.' '.@$user->state.' '.@$user->getCountry->name}} holding Aadhaar Card
            No.{{@$user->aadhar_number}} do hereby revoke all my previous Wills (or) Codicils and declare
            that this is my last Will, which I make on this, the [1st] day of
            [JANUARY], [2021].</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">I declare that I was born on {{date('d.m.Y',strtotime($user->dob))}} and that I am in good
            health and I possess a sound mind.</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">This Will is made by me without any persuasion or coercion and out of
            my own independent decision and shall be effective after my death.</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">I hereby appoint my [WIFE/HUSBAND] Mrs {{$executor->name}}, adult, aged [.],
            {{@$executor->getNationality->name}} {{$executorRelation}} of {{@$executor->relationship}}, resident of {{@$executor->address1.' , '.@$executor->address2.' '.@$executor->city.' '.@$executor->state.' '.@$executor->getCountry->name}} holding
            Aadhaar Card No.{{$executor->aadhar_number}} to be the Executor of this Will.</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">In the event that Mrs [Name] were to predecease me, then, my
            [brother] Mr. [Name] adult, aged [.], [INDIAN] son/daughter of Mr.
            [Name] resident of [Address] holding Aadhaar Card No.[.]will be the
            Executor of this Will.</p>
            
            @if(@$beneficiaries)
            @foreach(@$beneficiaries as $val)
               
                <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #5b5b5b;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">I bequeath the following assets to my [WIFE/HUSBAND] Mrs {{$val->name}}, adult, aged [.], {{$val->getNationality->name}} daughter of [Name], resident of {{@$val->address1.' , '.@$val->address2.' '.@$val->city.' '.@$val->state.' '.@$val->getCountry->name}} holding
                Aadhaar Card No.{{$val->aadhar_number}}</p>
                <ol>

                {{-- display cash assests --}}
                @if(@$val->cashBene)
                @foreach(@$val->cashBene as $cash)
                <li style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 8px 0; line-height: 19px;text-align: justify;">{{$cash->percentage}} % cash of amount Rs.{{@$cash->getCash->amount}}, at location - {{@$cash->getCash->location_of_cash}}</li>
                @endforeach              
                @endif

                {{-- display bank assests --}}
                @if(@$val->bankBene)
                @foreach(@$val->bankBene as $bank)
                <li style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 8px 0; line-height: 19px;text-align: justify;">{{$bank->percentage}}% of Bank balance in my {{@$bank->getBank->account_type}} Bank A/c No. {{@$bank->getBank->account_number}} with {{@$bank->getBank->branch_address}}</li>
                @endforeach                
                @endif

                {{-- display jewelry assests --}}
                @if(@$val->jewelryBene)
                @foreach(@$val->jewelryBene as $jewelry)
                <li style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 8px 0; line-height: 19px;text-align: justify;">{{@$jewelry->percentage}}% of Jewellery in {{@$jewelry->getJewelry->gold_weight ? @$jewelry->getJewelry->gold_weight." gm,":""}} {{@$jewelry->getJewelry->silver_weight ? @$jewelry->getJewelry->silver_weight." gm, ":""}} at location {{@$jewelry->getJewelry->location}}, {{@$jewelry->getJewelry->description}}</li>
                @endforeach                
                @endif

                {{-- display locker assests --}}
                @if(@$val->lockerBene)
                @foreach(@$val->lockerBene as $locker)
                <li style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 8px 0; line-height: 19px;text-align: justify;">{{@$locker->percentage}}% of bank locker no. {{@$locker->getLocker->locker_number}}  with {{@$locker->getLocker->branch_address}}</li>
                @endforeach                
                @endif

                {{-- display commercial property assests --}}
                @if(@$val->commercialBene)
                @foreach(@$val->commercialBene as $commercial)
                <li style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 8px 0; line-height: 19px;text-align: justify;">{{@$commercial->percentage}}% in Commercial Plot name. {{@$commercial->getCommercial->name}}  located at {{@$commercial->getCommercial->address}}</li>
                @endforeach                
                @endif

                {{-- display residential property assests --}}
                @if(@$val->residentialBene)
                @foreach(@$val->residentialBene as $residential)
                <li style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 8px 0; line-height: 19px;text-align: justify;">{{@$residential->percentage}}% in Residential Plot name. {{@$residential->getResidential->name}}  located at {{@$residential->getResidential->address}}</li>
                @endforeach                
                @endif

                {{-- display land property assests --}}
                @if(@$val->landBene)
                @foreach(@$val->landBene as $land)
                <li style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 8px 0; line-height: 19px;text-align: justify;">{{@$land->percentage}}% in Land property name. {{@$land->getLand->name}}  located at {{@$land->getLand->address}}</li>
                @endforeach                
                @endif

                {{-- display demat property assests --}}
                @if(@$val->dematBene)
                @foreach(@$val->dematBene as $demat)
                <li style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 8px 0; line-height: 19px;text-align: justify;">{{@$demat->percentage}}% of Demat account no. {{@$demat->getDemat->demat_account_number}}  with {{@$demat->getDemat->address}}</li>
                @endforeach                
                @endif
            </ol>
            @endforeach
            @endif

            {{--<p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">All the aforesaid assets and properties are owned solely by me.
            My [WIFE/HUSBAND], Mr./Ms./Mrs.[Name] will have the absolute
            right to sell or pledge or mortgage or bequeath or transfer any of the
            said moveable and/or immoveable assets/properties bequeathed to
            her/him in my Will at any time during her/his life at her/his own will,
            and without recourse to approval or consent or permission from
            anyone.</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 15px 0; line-height: 19px;text-align: justify;">If my [WIFE/HUSBAND], Mrs.[Name] were to predecease me, I
            bequeath my assets in the following manner:</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 15px 0; line-height: 19px;text-align: justify;">A. To my [DAUGHTER] Miss [Name], aged [22], [INDIAN], Resident of [Address], holding Aadhar Card No. [3599 1280 9875 6754]:</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">1. The contents of bank locker no [L-213], with [Bank Address]</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">2. Residential Plot no [A-901] located at [Address]</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">3. 25,340 shares of [Name of the company] held by me in Beneficiary
            Account No. [3420670] with [ICICI SECURITIES LIMITED]</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 15px 0; line-height: 19px;text-align: justify;">B. To my [SON] Mr [Name], aged [.], [INDIAN] Resident of [Address], holding Aadhar Card No. [.]</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">1. 50% rights held by me in Flat Address</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">2. Bank balance in my Savings Bank A/c No. [.] with [Bank Name]</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">3. My [TOYOTA COROLLA] Car with registration no [NUMBER]</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">4. 7. Any other asset not mentioned in this Will but of which I am the owner.</p>--}}

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">All the above assets and properties are owned solely by me.
            If your daughter or son is a minor, you can use the following words
            after the above:</p>
            <p style="font-family: Arial;font-style: italic; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">“I appoint my Wife/Husband Mrs/Mr [NAME], Resident of
            [ADDRESS], holding [AADHAR CARD NO./PASSPORT NO] as the
            Guardian of my daughter/son [NAME] All the above assets and
            properties are owned solely by me”.</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Signature of Testator</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">[Name]</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Address</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Aadhaar Card No [.]</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">[Place]</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">[Date]</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">(Please affix your initials on all pages if the WILL has many pages)</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">We hereby attest that this Will has been signed by Mr {{@$user->name}}, aged {{$age}},
            {{@$user->getNationality->name}}, {{$relation}} of Mr {{@$user->relationship}}, resident of {{@$user->address1.' , '.@$user->address2.' , '.@$user->address3.' '.@$user->city.' '.@$user->state.' '.@$user->getCountry->name}}
            holding Aadhaar Card No.{{@$user->aadhar_number}} as his last Will at {{@$user->city}} {{@$user->state}} on [Date] in the
            joint presence of himself/herself and us.</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">The testator is in sound mind and made this Will without any coercion.</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Name of the Witness(1)</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Signature</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Address:</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Aadhaar Card No:</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Place :</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">Date:</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Name of the Witness(2)</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Signature</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Address:</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Aadhaar Card No:</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 10px 0; line-height: 19px;text-align: justify;">Place :</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">Date:</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:500;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">Notes:</p>

            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">1. The above format is suitable for all Indian religions except Islam; for
            Muslims, Sharia applies and there are restrictions on bequeathing property
            under that law.</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">2. The above does not constitute a legal advice and Will &amp; More does not take
            responsibility for the contents of the will made by you.</p>
            <p style="font-family: Arial; font-size: 15px;font-weight:400;color: #363839;margin: 2px 0 22px 0; line-height: 19px;text-align: justify;">3. If you need the assistance of a lawyer in preparing your Will, please write to
            us at assistance@willandmore.com</p>

         </div>   
            
            
            
         
         
      </div>
   </body>
</html>