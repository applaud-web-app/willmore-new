<?php

namespace App\Http\Controllers\Modules\User\Will\Demat;

use Mail;
use App\User;
use App\Models\Demat;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Property;
use App\Models\WillMaster;
use App\Models\MutualFunds;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;

class DematController extends Controller
{

    public function manageDemat(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['demat'] = Demat::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['demat'] = $data['demat']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.demat.manage_demat')->with($data);
    }

    public function viewDemat(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['dematDetail'] = Demat::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['dematDetail']){
            abort(404);
        }

        $data['UserAssetsBeneficiaries'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','D')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','D')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','L')->where('status','A')->count();
        $data['mutul'] = MutualFunds::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.demat.view_demat')->with($data);
    }

    public function addDemat(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','L')->where('status','A')->count();
        $data['mutualFund'] = MutualFunds::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.demat.add_demat')->with($data);
    }

    public function saveDemat(Request $request)
    {
        $this->validate($request, [
          'dp_id'            =>'required',
          'demat_account_number'    =>'required',
          'dp_name'                 =>'required',
          //'custodian'               =>'required',
           //'equity'                  =>'required',
          //'quantity'                =>'required',
          'address'                 =>'required',
          'beneficiar_id'           =>'required',
          'percentage'              =>'required',
          'ownership_type'    =>'required',

        ]);

        // if(array_sum($request->percentage) > 100){
        //     return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        // }

        $creates['user_id']                 = Auth::id();
        $creates['will_master_id']          = $request->will_id;
        $creates['account_name']            = $request->dp_id;
        $creates['demat_account_number']    = $request->demat_account_number;
        $creates['dp_name']                 = $request->dp_name;
        //$creates['custodian']               = $request->custodian;
        //$creates['equity']                  = $request->equity;
        //$creates['quantity']                = $request->quantity;
        $creates['address']                 = $request->address;
        $creates['status']                  = 'A';
        $creates['ownership_type']          = $request->ownership_type;
        $creates['percentage_holding']      = $request->percentage_holding;

        //dd($creates);
        $demat = Demat::create($creates);

        if (!empty($request->beneficiar_id) && !empty($request->percentage))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']      = $demat->id;
                $inputs['beneficiar_id'] = $row;
                //$inputs['percentage']    = $request->percentage[$key];
                $inputs['share_detail']    = $request->share_detail[$key];
                $inputs['type'] = 'D';
            }

            $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $Mutu = MutualFunds::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$Mutu >0){
                return redirect()->route('user.manage.mutualFund',[@$request->will_id])->with('success', 'Demat account information added successfully');
            }
            return redirect()->route('user.add.mutualFund',[@$request->will_id])->with('success', 'Demat account information added successfully');
        }

        return redirect()->route('user.manage.demat',[@$request->will_id])->with('success', 'Demat account information added successfully');
    }

    public function updateDemat(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            'dp_id'            =>'required',
            'demat_account_number'    =>'required',
            'dp_name'                 =>'required',
            //'custodian'               =>'required',
            //'equity'                  =>'required',
            //'quantity'                =>'required',
            'address'                 =>'required',
            'beneficiar_id'           =>'required',
            // 'percentage'              =>'required',
            'ownership_type'    =>'required',

          ]);

        //   if(array_sum($request->percentage) > 100){
        //       return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        //   }

          $creates['user_id']                 = Auth::id();
          $creates['will_master_id']          = $request->will_id;
          $creates['account_name']            = $request->dp_id;
          $creates['demat_account_number']    = $request->demat_account_number;
          $creates['dp_name']                 = $request->dp_name;
          //$creates['custodian']               = $request->custodian;
          //$creates['equity']                  = $request->equity;
          //$creates['quantity']                = $request->quantity;
          $creates['address']                 = $request->address;
          $creates['status']                  = 'A';
          $creates['ownership_type']          = $request->ownership_type;
          $creates['percentage_holding']      = $request->percentage_holding;

          Demat::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty($request->beneficiar_id))
          {
            UserAssetsBeneficiaries::where('asset_id',$request->id)->where('type','D')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  //$inputs['percentage']    = $request->percentage[$key];
                  $inputs['share_detail']    = $request->share_detail[$key];
                  $inputs['type'] = 'D';
              }

              $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $Mutu = MutualFunds::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$Mutu >0){
                return redirect()->route('user.manage.mutualFund',[@$request->will_id])->with('success', 'Demat account information updated successfully');
            }
            return redirect()->route('user.add.mutualFund',[@$request->will_id])->with('success', 'Demat account information updated successfully');
        }

        return redirect()->route('user.manage.demat',[@$request->will_id])->with('success', 'Demat account information updated successfully');

    }

    public function deleteDemat(Request $request , $id)
    {

        $delLand = Demat::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delLand)
        {
            Demat::where('id',$id)->where('user_id',Auth::id())->delete();
            UserAssetsBeneficiaries::where('asset_id',$id)->where('type','D')->delete();

            return redirect()->back()->with('success','Demat account information deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function updateDematAlocation(Request $request){

        $data['alodata'] = UserAssetsBeneficiaries::where('id',$request->id)->first();
        $data['beneficiaries'] = Beneficiaries::where('id',@$data['alodata']->beneficiar_id)->first();

        return response()->json($data);

    }

}
