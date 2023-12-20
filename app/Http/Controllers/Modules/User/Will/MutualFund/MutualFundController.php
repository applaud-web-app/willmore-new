<?php

namespace App\Http\Controllers\Modules\User\Will\MutualFund;

use Mail;
use App\User;
use App\Models\Country;
use App\Models\Packages;
use App\Models\WillMaster;
use App\Models\MutualFunds;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use App\Models\Demat;
use App\Models\Insurance;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;

class MutualFundController extends Controller
{

    public function manageMutualFund(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['mutualFund'] = MutualFunds::where('will_master_id',@$willID)->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['mutualFund'] = $data['mutualFund']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.mutualFund.manage_mutual_fund')->with($data);
    }

    public function viewMutualFund(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['mutualFundDetail'] = MutualFunds::where('will_master_id',@$willID)->where('id',@$id)->where('status','A')->first();

        if(!$data['mutualFundDetail']){
            abort(404);
        }

        $data['UserAssetsBeneficiaries'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','M')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','M')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['demat'] = Demat::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['insurance'] = Insurance::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.mutualFund.view_mutual_fund')->with($data);
    }

    public function addMutualFund(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['demat'] = Demat::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['insurance'] = Insurance::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.mutualFund.add_mutual_fund')->with($data);
    }

    public function saveMutualFund(Request $request)
    {
        $this->validate($request, [
            'account_name'            =>'required',
            'account_number'          =>'required',
            'investment_banker'       =>'required',
            'address'                 =>'required',
            'beneficiar_id'           =>'required',
            'percentage'              =>'required',
            'ownership_type'    =>'required',
          ]);

        if(array_sum($request->percentage) > 100){
            return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        }

        $creates['user_id']                 = Auth::id();
        $creates['will_master_id']          = $request->will_id;
        $creates['account_name']            = $request->account_name;
        $creates['account_number']          = $request->account_number;
        $creates['investment_banker']       = $request->investment_banker;
        $creates['address']                 = $request->address;
        $creates['status']                  = 'A';
        $creates['ownership_type']          = $request->ownership_type;
        $creates['percentage_holding']      = $request->percentage_holding;
        $creates['number_of_units']         = $request->number_of_units;

        //dd($creates);
        $demat = MutualFunds::create($creates);

        if (!empty($request->beneficiar_id) && !empty($request->percentage))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']      = $demat->id;
                $inputs['beneficiar_id'] = $row;
                $inputs['percentage']    = $request->percentage[$key];
                $inputs['share_detail']    = $request->share_detail[$key];
                $inputs['type'] = 'M';
            }

            $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $Insurance = Insurance::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$Insurance >0){
                return redirect()->route('user.manage.insurance',[@$request->will_id])->with('success', 'Mutual Fund added successfully');
            }
            return redirect()->route('user.add.insurance',[@$request->will_id])->with('success', 'Mutual Fund added successfully');
        }

        return redirect()->route('user.manage.mutualFund',[@$request->will_id])->with('success', 'Mutual Fund added successfully');
    }

    public function updateMutualFund(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            'account_name'            =>'required',
            'account_number'          =>'required',
            'investment_banker'       =>'required',
            'address'                 =>'required',
            'beneficiar_id'           =>'required',
            'percentage'              =>'required',
            'ownership_type'    =>'required',
          ]);

          if(array_sum($request->percentage) > 100){
              return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
          }

          $creates['user_id']                 = Auth::id();
          $creates['will_master_id']          = $request->will_id;
          $creates['account_name']            = $request->account_name;
          $creates['account_number']          = $request->account_number;
          $creates['investment_banker']       = $request->investment_banker;
          $creates['address']                 = $request->address;
          $creates['status']                  = 'A';
          $creates['ownership_type']          = $request->ownership_type;
          $creates['percentage_holding']      = $request->percentage_holding;
          $creates['number_of_units']         = $request->number_of_units;

          MutualFunds::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty($request->beneficiar_id) && !empty($request->percentage))
          {
            UserAssetsBeneficiaries::where('asset_id',$request->id)->where('type','M')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']      = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['percentage']    = $request->percentage[$key];
                  $inputs['share_detail']    = $request->share_detail[$key];
                  $inputs['type'] = 'M';
              }

              $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $Insurance = Insurance::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$Insurance >0){
                return redirect()->route('user.manage.insurance',[@$request->will_id])->with('success', 'Mutual Fund updated successfully');
            }
            return redirect()->route('user.add.insurance',[@$request->will_id])->with('success', 'Mutual Fund updated successfully');
        }

        return redirect()->route('user.manage.mutualFund',[@$request->will_id])->with('success', 'Mutual Fund updated successfully');

    }

    public function deleteMutualFund(Request $request , $id)
    {

        $delLand = MutualFunds::where('id',$id)->where('status','=',"A")->first();

        if($delLand)
        {
            MutualFunds::where('id',$id)->delete();
            UserAssetsBeneficiaries::where('asset_id',$id)->where('type','M')->delete();

            return redirect()->back()->with('success','Mutual Fund deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
