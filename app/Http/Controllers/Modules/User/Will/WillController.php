<?php

namespace App\Http\Controllers\Modules\User\Will;

use PDF;
use App\User;
use App\Models\Art;
use App\Models\PPF;
use App\Models\Bank;
use App\Models\Cash;
use App\Models\Demat;
use App\Models\Locker;
use App\Models\Country;
use App\Models\Jewelry;
use App\Models\Witness;
use App\Models\Executor;
use App\Models\Packages;
use App\Models\Property;
use App\Models\Vehicles;
use App\Models\Insurance;
use App\Models\Liability;
use App\Models\WillMaster;
use App\Models\Contingency;
use App\Models\MutualFunds;
use App\Models\OtherAssets;
use App\Mail\UploadWillMail;
use App\Models\WillMessages;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\ResidualAssets;
use Illuminate\Support\Carbon;
use App\Models\CashBeneficiaries;
use App\Models\WillMasterPackage;
use App\Models\WillDownloadAccess;
use App\Http\Controllers\Controller;
use App\Mail\WillTemplateDownloadMail;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyBeneficiaries;
use App\Models\UserAssetsBeneficiaries;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
class WillController extends Controller
{

    public function myWill(Request $request)
    {
        $will_ids = WillMaster::where('user_id',Auth::id())->pluck('id');

        $data['totalWillPkg1'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',1)->count();
        $data['totalWillPkg2'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',2)->count();
        $data['totalWillPkg3'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',3)->count();
        $data['totalWillPkg5'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',5)->count();
        $data['totalWillPkg8'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',8)->count();

        $data['willTempDownload'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',8)->orderBy('id','DESC')->first();
        

        $data['wills'] = WillMaster::with('getPackage')->where('user_id',Auth::id());
        $data['totalWill'] = $data['wills']->count();


        if($request->from_date){
            $data['wills'] = $data['wills']->where('start_date','>=',date('Y-m-d',strtotime(@$request->from_date)));
        }

        if($request->to_date){
            $data['wills'] = $data['wills']->where('start_date','<=',date('Y-m-d',strtotime(@$request->to_date)));
        }

        if($request->status == 1 || $request->status == 2 || $request->status == 3){
            $data['wills'] = $data['wills']->where('status',@$request->status);
        }

        // if($request->all())
        // {
        //     if(@$request->status){
        //         $data['wills'] = $data['wills']->where('status',@$request->status);
        //     }

        //     if(@$request->from_date || @$request->to_date){
        //         $data['wills'] = $data['wills']->where('start_date','=',date('Y-m-d',strtotime(@$request->from_date)))->orWhere('start_date','=',date('Y-m-d',strtotime(@$request->to_date)));
        //     }

        //     if(@$request->from_date && @$request->to_date){
        //         //$data['wills'] = $data['wills']->whereBetween('start_date',[date('Y-m-d',strtotime(@$request->from_date)),date('Y-m-d',strtotime(@$request->to_date))]);
        //         $data['wills'] = $data['wills']->where('start_date','>=',date('Y-m-d',strtotime(@$request->from_date)))->Where('start_date','<=',date('Y-m-d',strtotime(@$request->to_date)));
        //     }

        // }

        $data['user'] = User::where('id',Auth::id())->first();
        $data['wills'] = $data['wills']->orderBy('id','desc')->paginate(20);
        $data['packages'] = Packages::orderBy('id','asc')->get();
        $data['key'] = $request->all();

    	return view('modules.user.will.my_will')->with($data);
    }

    public function changesSuggestedByAdmin(Request $request, $willID=null){

        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['messages'] = WillMessages::where('will_id',@$willID)->where('user_id',Auth::id())->paginate(10);
        $data['will_id'] = $willID;

        return view('modules.user.will.changes_suggested_by_admin')->with($data);
    }

    public function submitWill(Request $request, $willID=null){

        if($willID==null || empty($willID)){
            abort(404);
        }

        $update['approval_status'] = 1;
        $w = WillMaster::where('id',@$willID)->where('user_id',Auth::id())->update($update);

        if($w){
            return redirect()->back()->with('success','Will successfully submitted for finalization.');
        }else{
            return redirect()->back()->with('error','Something went wrong!');
        }

    }

    public function generatePDF($id=null)
    {
        if(checkWillExist($id)== false){
            abort(404);
        }

        if(checkWitnessExist($id)== false || checkWitnessCount($id) < 2){
            return redirect()->back()->with('error','Please add atleast two Witness to proceed');
        }

        $data['user'] = User::find(Auth::User()->id);
        $data['will'] = WillMaster::with('getPackage')->where('id',@$id)->where('user_id',Auth::id());
        $data['executor'] = Executor::where('will_master_id',@$id)->where('user_id',Auth::id())->first();
        $data['executors'] = Executor::where('will_master_id',@$id)->where('user_id',Auth::id())->get();

        $data['property'] = Property::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['cash'] = Cash::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['bank'] = Bank::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['jewelry'] = Jewelry::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['locker'] = Locker::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['demat'] = Demat::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['mutual_funds'] = MutualFunds::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['insurance'] = Insurance::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['ppf'] = PPF::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['vehicles'] = Vehicles::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['art'] = Art::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['witness'] = Witness::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();
        $data['art'] = Art::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['contingency'] = Contingency::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();

        $data['other'] = OtherAssets::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();

        $data['residual'] = ResidualAssets::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();

        $data['liability'] = Liability::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();

        $data['beneficiaries'] = Beneficiaries::with(['cashBene','cashBene.getCash','dematBene','dematBene.getDemat','bankBene','bankBene.getBank','jewelryBene','jewelryBene.getJewelry','lockerBene','lockerBene.getLocker','commercialBene','commercialBene.getCommercial','landBene','landBene.getLand','residentialBene','residentialBene.getResidential'])->where('will_master_id',@$id)->where('user_id',Auth::id())->get();

        //dd($data['beneficiaries']);
        //echo "<pre>";print_r($data['beneficiaries']); die;
        $checkWill = WillMaster::where('id',@$id)->where('user_id',Auth::id())->first();

        if(@$checkWill != null && @$checkWill->status != 3 ){
            $update['status'] = 3;
            $w = WillMaster::where('id',@$willID)->where('user_id',Auth::id())->update($update);
        }

        $pdf = PDF::loadView('modules.user.will.will_pdf', $data);
        return $pdf->stream('will_pdf.pdf',array('Attachment'=>0));
        //return $pdf->download('will_pdf.pdf');
    }


    /**
     *   Method      : viewWill
     *   Description : Preview Will
     *   Author      : Sourav
     *   Date        : 2022-DEC-10
    **/
    public function viewWill($id=null)
    {
        // if(checkWillExist($id)== false){
        //     abort(404);
        // }

        $data['user'] = User::find(Auth::User()->id);
        $data['will'] = WillMaster::with('getPackage')->where('id',@$id)->where('user_id',Auth::id());
        $data['executor'] = Executor::where('will_master_id',@$id)->where('user_id',Auth::id())->first();
        $data['executors'] = Executor::where('will_master_id',@$id)->where('user_id',Auth::id())->get();

        $data['residential'] = Property::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->where('type', 'R')->get();
        $data['commercial'] = Property::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->where('type', 'C')->get();
        $data['land'] = Property::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->where('type', 'L')->get();

        $data['cash'] = Cash::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['bank'] = Bank::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['jewelry'] = Jewelry::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['locker'] = Locker::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['demat'] = Demat::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['mutual_funds'] = MutualFunds::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['insurance'] = Insurance::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['ppf'] = PPF::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['vehicles'] = Vehicles::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['art'] = Art::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['witness'] = Witness::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();
        $data['art'] = Art::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',Auth::id())->where('will_master_id',@$id)->get();

        $data['contingency'] = Contingency::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();

        $data['other'] = OtherAssets::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();

        $data['residual'] = ResidualAssets::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();

        $data['liability'] = Liability::where('user_id',Auth::id())->where('will_master_id',@$id)->where('status','A')->get();

        $data['beneficiaries'] = Beneficiaries::with(['cashBene','cashBene.getCash','dematBene','dematBene.getDemat','bankBene','bankBene.getBank','jewelryBene','jewelryBene.getJewelry','lockerBene','lockerBene.getLocker','commercialBene','commercialBene.getCommercial','landBene','landBene.getLand','residentialBene','residentialBene.getResidential'])->where('will_master_id',@$id)->where('user_id',Auth::id())->get();

        $data['will_id'] = WillMaster::where('id',@$id)->where('user_id',Auth::id())->first();

        return view('modules.user.will.preview_will')->with(@$data);
    }

    /**
     *   Method      : addWillLocation
     *   Description : add Will Location & LOI
     *   Author      : Sourav
     *   Date        : 2022-DEC-16
    **/
    public function addWillLocation(Request $request, $willID=null){

        if($willID==null || empty($willID)){
            abort(404);
        }

        $package = WillMasterPackage::where('will_master_id',@$willID)->first();
        if(@$package->package_id == 1){
            $existWillAccess = WillDownloadAccess::where('will_id', @$willID)->first();
            if(@$existWillAccess == null){
                return redirect()->route('user.service.authorized',$willID)->with('error','Please give access at least one nominee to proceed !!');
            }
        }

        $data['locationStor'] = WillMasterPackage::where('will_master_id',@$willID)->first();
        $data['will'] = WillMaster::where('id', @$willID)->first();
        $data['will_id'] = $willID;

        return view('modules.user.will.add_will_location')->with($data);
    }

    /**
     *   Method      : saveWillLocation
     *   Description : Save physical Will Location & LOI
     *   Author      : Sourav
     *   Date        : 2022-DEC-16
    **/
    public function saveWillLocation(Request $request){

        $existWill = WillMaster::where('id', $request->will_id)->first();
        if(@$existWill == null){
            return redirect()->back()->with('error','Something went wrong !!');
        }

        // $existWillAccess = WillDownloadAccess::where('will_id', $request->will_id)->first();
        // if(@$existWillAccess == null){
        //     return redirect()->back()->with('error','Please give access at least one executor or beneficiary to proceed !!');
        // }

        $upd = [];
        $upd['will_location'] = $request->will_location;
        $upd['address'] = $request->address;
        // $upd['loi']= $request->loi;
        // $upd['amd_text']= $request->amd_text;

        if(@$request->pack == 3 && @$request->loi_file == null && @$existWill->loi_file == null){
            return redirect()->back()->with('error','Upload LOI field required');
        }
        if(@$request->pack == 5 && @$request->amd_file == null && @$existWill->amd_file == null){
            return redirect()->back()->with('error','Upload AMD field required');
        }

        // if(@$request->will_location){
        //     $upd['status']= 3;
        //     $upd['finalized_date']= date('Y-m-d');
        // }

        // for package 3
        if(@$request->loi_file){

            $unlnk=WillMaster::where('id', @$existWill->id)->first();
            @$prev_pdf = $unlnk->loi_file;

            if($prev_pdf){
               @unlink('storage/app/public/loi_file/'.$prev_pdf);
            }

            $image = $request->loi_file;
            $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/loi_file', $image, $filename);

        $upd['loi_file'] = $filename;
        // $upd['status']= 3;
        // $upd['finalized_date']= date('Y-m-d');
        }

        // for package 5
        if(@$request->amd_file){

            $unlnk=WillMaster::where('id', @$existWill->id)->first();
            @$prev_pdf = $unlnk->amd_file;

            if($prev_pdf){
               @unlink('storage/app/public/amd_file/'.$prev_pdf);
            }

            $image = $request->amd_file;
            $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/amd_file', $image, $filename);

        $upd['amd_file'] = $filename;
        }

        // for package 1
        if(@$request->final_will_file){

            $unlnk=WillMaster::where('id', @$existWill->id)->first();
            @$prev_pdf = $unlnk->final_will_file;

            if($prev_pdf){
               @unlink('storage/app/public/final_will_file/'.$prev_pdf);
            }

            $image = $request->final_will_file;
            $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/final_will_file', $image, $filename);

        $upd['final_will_file'] = $filename;
        $upd['status']= 3;
        $upd['finalized_date']= date('Y-m-d');
        }

        //Code Generate for will
        if(@$existWill->will_code == null){
            $date = date('dm');
            $dayOfTheWeek = Carbon::now()->dayOfWeek;
            $sum=str_pad($existWill->id, 3, '0', STR_PAD_LEFT);

            $upd['will_code']=$date.$dayOfTheWeek.$sum;
        }

        $update = WillMaster::where('id', $request->will_id)->update(@$upd);

        if(@$update){

            if(@$request->SaveFWill == 'Final_will'){

                $mailData['email'] = Auth::user()->email;
                $mailData['name'] = Auth::user()->name;
                $mailData['btn_link'] = route('user.add.will.location',[$request->will_id]);
                Mail::send(new UploadWillMail($mailData));

                return redirect()->route('user.mywill')->with('success','Final Will Submited Successfully.');
            }
            if(@$request->SaveLOI == 'LOI'){
                return redirect()->route('user.service.authorized',[@$existWill->id])->with('success','Will LOI Added Successfully.');
            }
            if(@$request->SaveAMD == 'AMD'){
                return redirect()->route('user.service.authorized',[@$existWill->id])->with('success','Advance Medical Directive Added Successfully.');
            }
            return redirect()->route('user.service.authorized',[@$existWill->id])->with('success','Will Location Added Successfully.');
        }
        else {

            return redirect()->back()->with('error','Something went wrong !!');
        }
    }


    /**
     *   Method      : serviceAuthorized
     *   Description :  Service view Authorized To Person
     *   Author      : Sourav
     *   Date        : 2023-JAN-27
    **/
    public function serviceAuthorized($willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['will_id'] = $willID;
        $data['currentWill'] = WillMaster::where('id',@$willID)->first();
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();

        if($data['locPack']->package_id == 2){

            $existWillCode = WillMaster::where('id', @$willID)->where('will_location', '!=', null)->first();
            if(@$existWillCode == null){
                return redirect()->back()->with('error','Please add location information to proceed !!');
            }
        } else if($data['locPack']->package_id == 3){

            $existWillCode = WillMaster::where('id', @$willID)->where('loi_file', '!=', null)->first();
            if(@$existWillCode == null){
                return redirect()->back()->with('error','Please add letter of instruction to proceed !!');
            }
        } else if($data['locPack']->package_id == 5){

            $existWillCode = WillMaster::where('id', @$willID)->where('amd_file', '!=', null)->first();
            if(@$existWillCode == null){
                return redirect()->back()->with('error','Please add Advance Medical Directive to proceed !!');
            }
        }

        $lastWill = WillMaster::whereHas('getPackage.packageDetail', function($q){
            $q->where('id', 1);})->where('user_id', Auth::id())->orderBy('id','desc')->first();

        // $data['allexistBen'] = Beneficiaries::where('user_id', Auth::id())->Where('will_master_id', '!=', @$willID)->Where('is_new_person', 'N')->orderBy('id','desc')->get();
        // $data['allexistExe'] = Executor::where('user_id', Auth::id())->Where('will_master_id', '!=', @$willID)->orderBy('id','desc')->get();

        if($data['locPack']->package_id == 1){
            $data['allexistBen'] = Beneficiaries::where('user_id', Auth::id())->Where('will_master_id', @$willID)->Where('is_new_person', 'N')->orderBy('id','desc')->get();
            $data['allexistExe'] = Executor::where('user_id', Auth::id())->Where('will_master_id', @$willID)->orderBy('id','desc')->get();
            $data['allNewPerson'] = Beneficiaries::where('user_id', Auth::id())->Where('will_master_id', @$willID)->orderBy('id','desc')->Where('is_new_person', null)->get();
        }
        else{
            $data['allexistBen'] = Beneficiaries::where('user_id', Auth::id())->Where('will_master_id', @$lastWill->id)->Where('is_new_person', 'N')->orderBy('id','desc')->get();
            $data['allexistExe'] = Executor::where('user_id', Auth::id())->Where('will_master_id', @$lastWill->id)->orderBy('id','desc')->get();
            $data['allNewPerson'] = Beneficiaries::where('user_id', Auth::id())->Where('will_master_id', @$willID)->orderBy('id','desc')->get();
        }

        if($data['locPack']->package_id == 1){
            $data['existAccessBen'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','W')->where('user_type','B')->pluck('ben_id')->toArray();
            $data['existAccessExe'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','W')->where('user_type','E')->pluck('exe_id')->toArray();
        }
        elseif($data['locPack']->package_id == 2){
            $data['existAccessBen'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','L')->where('user_type','B')->pluck('ben_id')->toArray();
            $data['existAccessExe'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','L')->where('user_type','E')->pluck('exe_id')->toArray();
            $data['existnewperson'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','L')->pluck('ben_id')->toArray();
        }
        elseif($data['locPack']->package_id == 3){
            $data['existAccessBen'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','LI')->where('user_type','B')->pluck('ben_id')->toArray();
            $data['existAccessExe'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','LI')->where('user_type','E')->pluck('exe_id')->toArray();
            $data['existnewperson'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','LI')->pluck('ben_id')->toArray();
        }
        elseif($data['locPack']->package_id == 5){
            $data['existAccessBen'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','AMD')->where('user_type','B')->pluck('ben_id')->toArray();
            $data['existAccessExe'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','AMD')->where('user_type','E')->pluck('exe_id')->toArray();
            $data['existnewperson'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','AMD')->pluck('ben_id')->toArray();
        }

        // dd($data['existnewpersonL']);
    	return view('modules.user.service_authorized_person')->with(@$data);
    }


    /**
     *   Method      : serviceAuthorizedSave
     *   Description :  Service view Authorized To Person
     *   Author      : Sourav
     *   Date        : 2023-JAN-27
    **/
    public function serviceAuthorizedSave(Request $request)
    {
        if(@$request->beneficiaries ==null && @$request->newpersons ==null && @$request->executors == null){

            return redirect()->back()->with('error','Please give access at least one person to proceed !!');
        }

        $locPack = WillMasterPackage::where('will_master_id',@$request->will_id)->first();
        $currentWill = WillMaster::where('id',@$request->will_id)->first();

        if(@$locPack){
            if($locPack->package_id ==1){
                $type = 'W';
            }else if($locPack->package_id ==2){
                $type = 'L';
                $upd['status']= 3;
                $upd['finalized_date']= date('Y-m-d');
                $update = WillMaster::where('id', $request->will_id)->update(@$upd);

            }else if($locPack->package_id ==3){
                $type = 'LI';
                $upd['status']= 3;
                $upd['finalized_date']= date('Y-m-d');
                $update = WillMaster::where('id', $request->will_id)->update(@$upd);
            }else if($locPack->package_id ==5){
                $type = 'AMD';
                $upd['status']= 3;
                $upd['finalized_date']= date('Y-m-d');
                $update = WillMaster::where('id', $request->will_id)->update(@$upd);
            }

            $beneficiaries = array_merge($request->beneficiaries ?? [], $request->newpersons ?? []);

            // dd($beneficiaries);

            if(@$beneficiaries != null){

                foreach($beneficiaries as $beneficiariy){

                    $upd=[];

                    $upd['will_id']      = @$currentWill->id;
                    $upd['access_type']  = @$type;
                    $upd['ben_id']       = @$beneficiariy;
                    $upd['user_type']    = 'B';

                    if(@$beneficiariy){
                        $checkAvailable = WillDownloadAccess::where('will_id', @$currentWill->id)->where('ben_id', @$beneficiariy)->first();

                        if ($checkAvailable == null) {

                            WillDownloadAccess::create($upd);
                        }
                    }
                    // WillDownloadAccess::where('will_id', @$currentWill->id)->whereNotIn('ben_id', @$beneficiaries)->delete();
                }
                $beneficiar = WillDownloadAccess::where('will_id', @$currentWill->id)->whereIn('ben_id', @$beneficiaries)->pluck('id')->toArray();
            }

            $executors=@$request->executors;

            if(@$executors != null){
                foreach($executors as $executor){

                    $upd=[];

                    $upd['will_id']      = @$currentWill->id;
                    $upd['access_type']  = @$type;
                    $upd['exe_id']       = @$executor;
                    $upd['user_type']    = 'E';

                    if(@$executor){
                        $checkAvailable = WillDownloadAccess::where('will_id', @$currentWill->id)->where('exe_id', @$executor)->first();

                        if ($checkAvailable == null) {

                            WillDownloadAccess::create($upd);
                        }
                    }
                    // WillDownloadAccess::where('will_id', @$currentWill->id)->whereNotIn('exe_id', @$executors)->delete();
                }
                $execute = WillDownloadAccess::where('will_id', @$currentWill->id)->whereIn('exe_id', @$executors)->pluck('id')->toArray();
            }

            $all_IDs = array_merge($beneficiar ?? [], $execute ?? []);

            // dd($all_IDs);

            WillDownloadAccess::where('will_id', @$currentWill->id)->whereNotIn('id', @$all_IDs)->delete();

            // return redirect()->route('user.add.will.location',['willid'=>@$currentWill->id])->with('success','Authorized Given Successfully.');
            if($locPack->package_id ==1){
                return redirect()->route('user.add.will.location',[@$currentWill->id])->with('success','You have successfully authorized the selected nominees to access your Final Will');
            }else if($locPack->package_id ==2){
                return redirect()->back()->with('success','You have successfully authorized the selected nominees to access your Location Registry');
            }else if($locPack->package_id ==3){
                return redirect()->back()->with('success','You have successfully authorized the selected nominees to access your LOI');
            }else if($locPack->package_id ==5){
                return redirect()->back()->with('success','You have successfully authorized the selected persons to access your AMD');
            }else {
                return redirect()->back()->with('success','Authorized Given Successfully.');
            }
        }

        return redirect()->back()->with('error','Something went wrong !!');
    }

    /**
     *   Method      : introduction
     *   Description :  online-will-creation introduction
     *   Author      : Sourav
     *   Date        : 2023-MAR-02
    **/
    public function introduction($willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['will_id'] = $willID;
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();

        if($data['locPack']->package_id == 1){

            return view('modules.user.will.introduction.create_will_intro')->with(@$data);
        }
        if($data['locPack']->package_id == 2){

            return view('modules.user.will.introduction.will_location_intro')->with(@$data);
        }
        if($data['locPack']->package_id == 3){

            return view('modules.user.will.introduction.loi_intro')->with(@$data);
        }
        if($data['locPack']->package_id == 5){

            return view('modules.user.will.introduction.amd_intro')->with(@$data);
        }
    }


    public function downloadWillTemplates(Request $request){
        $userId = Auth::id();
        $checkValid = WillMasterPackage::select('user_id')->join('will_master as wm','wm.id','will_master_id')->where(['package_id'=>8,'user_id'=>$userId])->first();
        return view('modules.user.will.download-will-templates');
    }

    public function downloadWillTemplatesIntro(Request $request){
        return view('modules.user.will.download-will-templates-intro');
    }

    public function processWillTemplateDownload(Request $request){
        $files = $request->files_str;
        $arr = explode(',',$files);
        $zip = new \ZipArchive();
        $fileName = 'will-templates.zip';
        $filesArr = [];
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE)== TRUE)
        {

            
            foreach($arr as $v){
                if(file_exists(public_path('will-templates/'.$v.'.docx'))){
                    $filesArr[] =  public_path('will-templates/'.$v.'.docx');
                }
            }
            // dd($filesArr);
            if($filesArr){
                foreach ($filesArr as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            } 
            $zip->close();
        }
        try{
            $mailData['email'] = Auth::user()->email;
            $mailData['files'] = $filesArr;
            Mail::send(new WillTemplateDownloadMail($mailData));
        }catch(\Exception $e){

        }
        return response()->download(public_path($fileName))->deleteFileAfterSend(true);


    }

}
