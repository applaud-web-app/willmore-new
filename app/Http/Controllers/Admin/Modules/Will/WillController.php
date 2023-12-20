<?php

namespace App\Http\Controllers\Admin\Modules\Will;

use PDF;
use App\User;
use App\Models\Art;
use App\Models\PPF;
use App\Models\Bank;
use App\Models\Cash;
use App\Models\Demat;
use App\Models\Locker;
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
use App\Models\WillMessages;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\ResidualAssets;
use App\Models\WillMasterPackage;
use App\Models\WillDownloadAccess;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\WillSearchEnquiry;

class WillController extends Controller
{
    public function __construct(){

        $this->middleware('admin.auth:admin');
  }


    /**
     *   Method      : manageWill
     *   Description : Will Listing
     *   Author      : Sourav
     *   Date        : 2022-DEC-09
    **/
    public function manageWill(Request $request, $id=null){

        if($id){
            $data['wills'] = WillMaster::with('getPackage')->where('user_id',$id)->orderBy('id','desc')->paginate(50);
            $data['willuser'] = User::where('id',$id)->first();
            $data['packages'] = Packages::whereNotIn('id', [4,6])->get();
            $data['key'] = $request->all();
            return view('admin.modules.will.manage_will')->with($data);
        }
        $data['wills'] = WillMaster::with('getPackage')->orderBy('id','desc')->paginate(50);

        if ($request->all()) {

            $data['wills'] = WillMaster::with('getPackage')->orderBy('id','desc');

            if (@$request->keyword) {
                $data['wills'] = $data['wills']->whereHas('userDetails', function($q) use($request){

                    $q->where('name','like','%'.$request->keyword.'%');
               });
            }
            if (@$request->package) {

                $data['wills'] = $data['wills']->whereHas('getPackage.packageDetail', function($q) use($request){

                    $q->where('id', $request->package);
               });
            }
            if (@$request->status) {

                $data['wills'] = $data['wills']->where('status', $request->status);
            }
            if (@$request->approval_status) {

                $data['wills'] = $data['wills']->where('approval_status', $request->approval_status);
            }

            $data['wills'] = $data['wills']->paginate(50);
        }

        $data['packages'] = Packages::whereNotIn('id', [4,6])->get();
        $data['key'] = $request->all();
    	return view('admin.modules.will.manage_will')->with($data);
    }

    /**
     *   Method      : suggestChange
     *   Description : Suggest Will Change
     *   Author      : Sourav
     *   Date        : 2022-DEC-09
    **/
    public function suggestChange(Request $request, $id=null){

        $data['wills'] = WillMaster::where('id', @$id)->first();

        if(@$request->all()){

            $ins = [];
            $ins['will_id'] = $request->will_id;
            $ins['user_id'] = $request->user_id;
            $ins['admin_id'] = Auth::guard('admin')->user()->id;
            $ins['message'] = $request->message;

            if(@$request->attachments){
                $image = $request->attachments;
                $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
                Storage::putFileAs('admin/will_message', $image, $filename);

            $ins['attachments'] = $filename;
            }

            $message = WillMessages::create($ins);

            if(@$message){

                WillMaster::where('id', $request->will_id)->update(['approval_status' => 3]);

                return redirect()->back()->with('success','Will message added successfully.');
            }
            else {

                return redirect()->back()->with('error','Something went wrong !!');
            }
        }

        $data['willMessage'] = WillMessages::where('will_id', @$id)->orderBy('id', 'desc')->get();

        return view('admin.modules.will.suggest_will_change')->with(@$data);
    }


    /**
     *   Method      : approveWill
     *   Description : Approve Will
     *   Author      : Sourav
     *   Date        : 2022-DEC-10
    **/
    public function approveWill($id=null){

        $will = WillMaster::where('id',$id)->first();

        if(!$will){
            return redirect()->back()->with('error','Somthing went be wrong.');
        }

        if(@$will->status == 1 && @$will->approval_status == 1) {
            $upd['status'] = 2;
            $upd['approval_status'] = 2;
            $upd['finalized_date'] = date('Y-m-d H:i:s');
        }
        $will->update($upd);
        return redirect()->back()->with('success','Will Approved Successfully.');
    }


    public function generatePDF($id=null)
    {
        // if(checkWillExist($id)== false){
        //     abort(404);
        // }
        $user = WillMaster::where('id',$id)->first();

        $data['user'] = User::find(@$user->user_id);
        $data['will'] = WillMaster::with('getPackage')->where('id',@$id)->where('user_id', @$user->user_id);
        $data['executor'] = Executor::where('will_master_id',@$id)->where('user_id', @$user->user_id)->first();
        $data['executors'] = Executor::where('will_master_id',@$id)->where('user_id', @$user->user_id)->get();
        $data['property'] = Property::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['cash'] = Cash::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['bank'] = Bank::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['jewelry'] = Jewelry::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['locker'] = Locker::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['demat'] = Demat::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['mutual_funds'] = MutualFunds::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['insurance'] = Insurance::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['ppf'] = PPF::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['vehicles'] = Vehicles::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['art'] = Art::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['witness'] = Witness::where('user_id', @$user->user_id)->where('will_master_id',@$id)->where('status','A')->get();
        $data['art'] = Art::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$user->user_id)->where('will_master_id',@$id)->get();
        $data['contingency'] = Contingency::where('user_id', @$user->user_id)->where('will_master_id',@$id)->where('status','A')->get();
        $data['other'] = OtherAssets::where('user_id', @$user->user_id)->where('will_master_id',@$id)->where('status','A')->get();
        $data['residual'] = ResidualAssets::where('user_id', @$user->user_id)->where('will_master_id',@$id)->where('status','A')->get();
        $data['liability'] = Liability::where('user_id', @$user->user_id)->where('will_master_id',@$id)->where('status','A')->get();
        $data['beneficiaries'] = Beneficiaries::with(['cashBene','cashBene.getCash','dematBene','dematBene.getDemat','bankBene','bankBene.getBank','jewelryBene','jewelryBene.getJewelry','lockerBene','lockerBene.getLocker','commercialBene','commercialBene.getCommercial','landBene','landBene.getLand','residentialBene','residentialBene.getResidential'])->where('will_master_id',@$id)->where('user_id', @$user->user_id)->get();

        //dd($data['beneficiaries']);
        //echo "<pre>";print_r($data['beneficiaries']); die;

        $pdf = PDF::loadView('admin.modules.will.will_pdf', $data);
        return $pdf->stream('will_pdf.pdf',array('Attachment'=>0));
        //return $pdf->download('will_pdf.pdf');
    }

    public function viewWill($id=null)
    {
        // if(checkWillExist($id)== false){
        //     abort(404);
        // }
        $mainWill = WillMaster::where('id',$id)->first();
        $data['user'] = User::find(@$mainWill->user_id);
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$mainWill->id)->first();
        $data['wills'] = WillMaster::with('getPackage')->where('id',@$id)->where('user_id', @$mainWill->user_id)->first();
        $data['will_id'] = @$mainWill->id;

            $data['executors'] = Executor::where('will_master_id',@$id)->where('user_id', @$mainWill->user_id)->get();

            $data['residential'] = Property::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',@$mainWill->user_id)->where('will_master_id',@$id)->where('type', 'R')->get();
            $data['commercial'] = Property::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',@$mainWill->user_id)->where('will_master_id',@$id)->where('type', 'C')->get();
            $data['land'] = Property::with('beneficiars','beneficiars.getBeneficiar')->where('user_id',@$mainWill->user_id)->where('will_master_id',@$id)->where('type', 'L')->get();
            $data['cash'] = Cash::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['bank'] = Bank::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['jewelry'] = Jewelry::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['locker'] = Locker::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['demat'] = Demat::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['mutual_funds'] = MutualFunds::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['insurance'] = Insurance::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['ppf'] = PPF::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['vehicles'] = Vehicles::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['art'] = Art::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['witness'] = Witness::where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->where('status','A')->get();
            $data['art'] = Art::with('beneficiars','beneficiars.getBeneficiar')->where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->get();
            $data['contingency'] = Contingency::where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->where('status','A')->get();
            $data['other'] = OtherAssets::where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->where('status','A')->get();
            $data['residual'] = ResidualAssets::where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->where('status','A')->get();
            $data['liability'] = Liability::where('user_id', @$mainWill->user_id)->where('will_master_id',@$id)->where('status','A')->get();
            $data['beneficiaries'] = Beneficiaries::with(['cashBene','cashBene.getCash','dematBene','dematBene.getDemat','bankBene','bankBene.getBank','jewelryBene','jewelryBene.getJewelry','lockerBene','lockerBene.getLocker','commercialBene','commercialBene.getCommercial','landBene','landBene.getLand','residentialBene','residentialBene.getResidential'])->where('will_master_id',@$id)->where('user_id', @$mainWill->user_id)->get();

            $data['willExecutorsW'] = WillDownloadAccess::where('will_id',@$mainWill->id)->where('user_type','E')->where('access_type','W')->get();
            $data['willBeneficiariesW'] = WillDownloadAccess::where('will_id',@$mainWill->id)->where('user_type','B')->where('access_type','W')->get();

            $data['willExecutorsL'] = WillDownloadAccess::where('will_id',@$mainWill->id)->where('user_type','E')->where('access_type','L')->get();
            $data['willBeneficiariesL'] = WillDownloadAccess::where('will_id',@$mainWill->id)->where('user_type','B')->where('access_type','L')->get();

            $data['willExecutorsLI'] = WillDownloadAccess::where('will_id',@$mainWill->id)->where('user_type','E')->where('access_type','LI')->get();
            $data['willBeneficiariesLI'] = WillDownloadAccess::where('will_id',@$mainWill->id)->where('user_type','B')->where('access_type','LI')->get();

            $data['willExecutorsAMD'] = WillDownloadAccess::where('will_id',@$mainWill->id)->where('user_type','E')->where('access_type','AMD')->get();
            $data['willBeneficiariesAMD'] = WillDownloadAccess::where('will_id',@$mainWill->id)->where('user_type','B')->where('access_type','AMD')->get();

            // dd($data);
        return view('admin.modules.will.view_will')->with(@$data);
    }


    public function willLocationSearchEnquiries(Request $request){
        $data = WillSearchEnquiry::paginate(50);
        return view('admin.modules.will.will-location-search-enquiries',compact('data'));
    }

}
