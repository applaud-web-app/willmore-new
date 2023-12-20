

<?php
use App\Models\WillMasterPackage;
$package = WillMasterPackage::where('will_master_id', @$will_id)->first();
?>

<div class="cusdashb-left">
    <div class="mobile_menu2"> <i class="fa fa-bars" aria-hidden="true"></i>
        <span>Show Menu</span>
    </div>

    @if(@$package->package_id == 1)
    <div class="user_dash_lf_inr" id="mobile_menu_dv2">
        <a href="{{route('user.dashboard')}}" class="back text-dark my-2 d-block" style="font-size:18px;"><i class="fas fa-long-arrow-alt-left"></i> Return To Dashboard</a>
        <br/>
        <h1>Online Will Creation <img src="{{asset('public/images/arro22.png')}}" alt="">: #{{ @$will_id }}</h1>
        <div class="nav_Pannel for_will_create_leftt">

            <div class="abbtex2">

                <a href="{{route('introduction',[@$will_id])}}" class="{{Route::is('introduction') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/inss.png')}}" alt="icon"> </span> Introduction</a>

                <a href="{{route('user.your-details',[@$will_id])}}" class="{{Route::is('user.your-details') ? 'active_ln':''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp011.png')}}" alt="icon"> </span> Your Details</a>
                
                <a href="{{route('user.manage.executor',[@$will_id])}}" class="{{Route::is('user.manage.executor','user.add.executor','view.executor','detail.executor') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/pp_me.png')}}" alt="icon"> </span> Executor</a>

              

                <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="{{Route::is('user.manage.beneficiaries','user.add.beneficiaries','view.beneficiar','detail.beneficiaries') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp011.png')}}" alt="icon"> </span> Beneficiaries</a>
                {{-- <a href="{{route('user.add.loi',[@$will_id])}}" class="{{Route::is('user.add.loi') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/nl01.png')}}" alt="icon"> </span> Letter of Instruction</a> --}}


                <div class="accordion_container">
                    <div class="accordion_head {{Route::is('user.manage.cash','user.add.cash','user.view.cash','user.manage.bank','user.add.bank','user.view.bank','user.manage.jewelry','user.add.jewelry','user.view.jewelry','user.manage.locker','user.add.locker','user.view.locker') ? 'active_ln' : ''}}" data-id="1"> <span class="pp_icnn"><img src="{{asset('public/images/iconn04.png')}}" alt="icon"> </span> Cash & Equivalent<span class="plusminus plusminus1">+</span></div>
                    <div class="accordion_body under_mm aa1" style="display: none;">
                        <a href="{{route('user.manage.cash',[@$will_id])}}" class="{{Route::is('user.manage.cash','user.add.cash','user.view.cash') ? 'actv' : ''}}">Cash</a>
                        <a href="{{route('user.manage.bank',[@$will_id])}}" class="{{Route::is('user.manage.bank','user.add.bank','user.view.bank') ? 'actv' : ''}}">Bank Account</a>
                        <a href="{{route('user.manage.jewelry',[@$will_id])}}" class="{{Route::is('user.manage.jewelry','user.add.jewelry','user.view.jewelry') ? 'actv' : ''}}">Jewellery</a>
                        {{-- <a href="{{route('user.manage.locker',[@$will_id])}}" class="{{Route::is('user.manage.locker','user.add.locker','user.view.locker') ? 'actv' : ''}}">Locker</a> --}}
                    </div>
                </div>

                <div class="accordion_container">
                    <div class="accordion_head {{Route::is('user.manage.residentials','user.add.residentials','user.view.residentials','user.manage.commercial','user.add.commercial','user.view.commercial','user.manage.land','user.add.land','user.view.land') ? 'active_ln' : ''}}" data-id="2"> <span class="pp_icnn"><img src="{{asset('public/images/p1.png')}}" alt="icon">
                        </span>Property<span class="plusminus plusminus2">+</span></div>
                    <div class="accordion_body under_mm aa2" style="display: none;">
                        <a href="{{route('user.manage.residentials',[@$will_id])}}" class="{{Route::is('user.manage.residentials','user.add.residentials','user.view.residentials') ? 'actv' : ''}}">Residential Property</a>
                        <a href="{{route('user.manage.commercial',[@$will_id])}}" class="{{Route::is('user.manage.commercial','user.add.commercial','user.view.commercial') ? 'actv' : ''}}">Commercial Property</a>
                        <a href="{{route('user.manage.land',[@$will_id])}}" class="{{Route::is('user.manage.land','user.add.land','user.view.land') ? 'actv' : ''}}">Land</a>
                    </div>
                </div>

                <a href="{{route('user.manage.demat',[@$will_id])}}" class="{{Route::is('user.manage.demat','user.add.demat','user.view.demat') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/p2.png')}}" alt="icon"> </span> Demat Account</a>

                <a href="{{route('user.manage.mutualFund',[@$will_id])}}" class="{{Route::is('user.manage.mutualFund','user.add.mutualFund','user.view.mutualFund') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/pp1.png')}}" alt="icon"> </span> Mutual Funds & Bonds</a>

                <a href="{{route('user.manage.insurance',[@$will_id])}}" class="{{Route::is('user.manage.insurance','user.add.insurance','user.view.insurance') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/pp2.png')}}" alt="icon"> </span> Insurance</a>

                <a href="{{route('user.manage.ppf',[@$will_id])}}" class="{{Route::is('user.manage.ppf','user.add.ppf','user.view.ppf') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/pp3.png')}}" alt="icon"> </span> PPF</a>

                <a href="{{route('user.manage.vehicles',[@$will_id])}}" class="{{Route::is('user.manage.vehicles','user.add.vehicles','user.view.vehicles') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/pp4.png')}}" alt="icon"> </span> Vehicles</a>

                <a href="{{route('user.manage.art',[@$will_id])}}" class="{{Route::is('user.manage.art','user.add.art','user.view.art') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/pp5.png')}}" alt="icon"> </span> Art</a>

                <a href="{{route('user.manage.otherAssets',[@$will_id])}}" class="{{Route::is('user.manage.otherAssets','user.add.otherAssets','user.edit.otherAssets') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/nl02.png')}}" alt="icon"> </span>Any Other Assets</a>

                <a href="{{route('user.manage.residualAssets',[@$will_id])}}" class="{{Route::is('user.manage.residualAssets','user.add.residualAssets','user.edit.residualAssets') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/nl02.png')}}" alt="icon"> </span> Residual Assets</a>

                <a href="{{route('user.manage.liability',[@$will_id])}}" class="{{Route::is('user.manage.liability','user.add.liability','user.view.liability') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/p3.png')}}" alt="icon"> </span> Liability</a>
                {{--
                <a href="{{route('user.manage.contingency',[@$will_id])}}" class="{{Route::is('user.manage.contingency','user.add.contingency','user.view.contingency') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/p4.png')}}" alt="icon"> </span> Contingency</a> --}}
                <a href="{{route('user.manage.witness',[@$will_id])}}" class="{{Route::is('user.manage.witness','user.add.witness','view.witness','user.edit.witness') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/nl03.png')}}" alt="icon"> </span> Witness</a>

            </div>

        </div>
    </div>
    @endif

    @if(@$package->package_id == 2)
    <div class="user_dash_lf_inr" id="mobile_menu_dv2">
        <h1>Will Location Registry <img src="{{asset('public/images/arro22.png')}}" alt="">: #{{ @$will_id }}</h1>
        <div class="nav_Pannel for_will_create_leftt">

            <div class="abbtex2">
                {{-- <a href="{{route('user.manage.executor',[@$will_id])}}" class="{{Route::is('user.manage.executor','user.add.executor','view.executor','detail.executor') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/pp_me.png')}}" alt="icon"> </span> Executor</a>
                <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="{{Route::is('user.manage.beneficiaries','user.add.beneficiaries','view.beneficiaries','detail.beneficiaries') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp011.png')}}" alt="icon"> </span> Beneficiaries</a> --}}

                <a href="{{route('introduction',[@$will_id])}}" class="{{Route::is('introduction') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/inss.png')}}" alt="icon"> </span> Introduction</a>

                <a href="{{route('user.add.will.location',[@$will_id])}}" class="{{Route::is('user.add.will.location') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp03.png')}}" alt="icon"> </span> Location Information</a>
                <a href="{{route('user.service.authorized',[@$will_id])}}" class="{{Route::is('user.service.authorized','user.add.beneficiaries','view.beneficiar','detail.beneficiaries') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp03.png')}}" alt="icon"> </span> Nominee</a>
            </div>

        </div>
    </div>
    @endif

    @if(@$package->package_id == 3)
    <div class="user_dash_lf_inr" id="mobile_menu_dv2">
        <h1> Letter of instruction <img src="{{asset('public/images/arro22.png')}}" alt="">: #{{ @$will_id }}</h1>
        <div class="nav_Pannel for_will_create_leftt">

            <div class="abbtex2">
                {{-- <a href="{{route('user.manage.executor',[@$will_id])}}" class="{{Route::is('user.manage.executor','user.add.executor','view.executor','detail.executor') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/pp_me.png')}}" alt="icon"> </span> Executor</a>
                <a href="{{route('user.manage.beneficiaries',[@$will_id])}}" class="{{Route::is('user.manage.beneficiaries','user.add.beneficiaries','view.beneficiaries','detail.beneficiaries') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp011.png')}}" alt="icon"> </span> Beneficiaries</a> --}}


                <a href="{{route('introduction',[@$will_id])}}" class="{{Route::is('introduction') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/inss.png')}}" alt="icon"> </span> Introduction</a>

                <a href="{{route('user.add.will.location',[@$will_id])}}" class="{{Route::is('user.add.will.location') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp03.png')}}" alt="icon"> </span> Letter of instruction</a>
                <a href="{{route('user.service.authorized',[@$will_id])}}" class="{{Route::is('user.service.authorized','user.add.beneficiaries','view.beneficiar','detail.beneficiaries') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp03.png')}}" alt="icon"> </span> Nominee</a>
            </div>

        </div>
    </div>
    @endif

    @if(@$package->package_id == 5)
    <div class="user_dash_lf_inr" id="mobile_menu_dv2">
        <h1> Advance Medical Directive <img src="{{asset('public/images/arro22.png')}}" alt="">: #{{ @$will_id }}</h1>
        <div class="nav_Pannel for_will_create_leftt">

            <div class="abbtex2">
                <a href="{{route('introduction',[@$will_id])}}" class="{{Route::is('introduction') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/inss.png')}}" alt="icon"> </span> Introduction</a>

                <a href="{{route('user.add.amd',[@$will_id])}}" class="{{Route::is('user.add.amd') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp03.png')}}" alt="icon"> </span> Advance Medical Directive</a>
                <a href="{{route('user.service.authorized',[@$will_id])}}" class="{{Route::is('user.service.authorized','user.add.beneficiaries','view.beneficiar','detail.beneficiaries') ? 'active_ln' : ''}} accordion_head"><span class="pp_icnn"><img src="{{asset('public/images/dp03.png')}}" alt="icon"> </span> Trusted Person</a>
            </div>

        </div>
    </div>
    @endif

</div>
