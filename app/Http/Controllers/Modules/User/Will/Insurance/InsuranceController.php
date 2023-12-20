<?php

namespace App\Http\Controllers\Modules\User\Will\Insurance;

use Mail;
use App\User;
use App\Models\PPF;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Insurance;
use App\Models\WillMaster;
use App\Models\MutualFunds;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;

class InsuranceController extends Controller
{

    public function manageInsurance(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['insurance'] = Insurance::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['insurance'] = $data['insurance']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.insurance.manage_insurance')->with($data);
    }

    public function viewInsurance(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['insuranceDetail'] = Insurance::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['insuranceDetail']){
            abort(404);
        }

        $data['UserAssetsBeneficiaries'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','I')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','I')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['ppf'] = PPF::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['mutualFund'] = MutualFunds::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.insurance.view_insurance')->with($data);
    }

    public function addInsurance(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['ppf'] = PPF::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['mutualFund'] = MutualFunds::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.insurance.add_insurance')->with($data);
    }

    public function saveInsurance(Request $request)
    {
        $this->validate($request, [
        //   'policy_holder_name'          =>'required',
          'type'                        =>'required',
        //   'nominee_name'                =>'required',
          'policy_number'               =>'required',
          'insurance_company_name'      =>'required',
        //   'insurance_distribution_plan' =>'required',
          //'beneficiar_id'               =>'required',
          //'percentage'                  =>'required'
        ]);

        // if(array_sum($request->percentage) > 100){
        //     return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        // }

        $creates['user_id']                     = Auth::id();
        $creates['will_master_id']              = $request->will_id;
        // $creates['policy_holder_name']          = $request->policy_holder_name;
        $creates['type']                        = $request->type;
        // $creates['nominee_name']                = $request->nominee_name;
        $creates['policy_number']               = $request->policy_number;
        $creates['insurance_company_name']      = $request->insurance_company_name;
        // $creates['insurance_distribution_plan'] = $request->insurance_distribution_plan;
        $creates['status']                      = 'A';

        //dd($creates);
        $demat = Insurance::create($creates);

        if (!empty(@$request->beneficiar_id))
        {
            $inputs['asset_id']      = $demat->id;
            $inputs['beneficiar_id'] = $request->beneficiar_id;
            $inputs['type'] = 'I';

            $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);

        }

        if(@$request->SaveConti == 'SQ'){

            $PPF = PPF::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$PPF >0){
                return redirect()->route('user.manage.ppf',[@$request->will_id])->with('success', 'Insurance policy added successfully');
            }
            return redirect()->route('user.add.ppf',[@$request->will_id])->with('success', 'Insurance policy added successfully');
        }

        return redirect()->route('user.manage.insurance',[@$request->will_id])->with('success', 'Insurance policy added successfully');
    }

    public function updateInsurance(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            // 'policy_holder_name'          =>'required',
            'type'                        =>'required',
            // 'nominee_name'                =>'required',
            'policy_number'               =>'required',
            'insurance_company_name'      =>'required',
            // 'insurance_distribution_plan' =>'required',
            //'beneficiar_id'               =>'required',
            //'percentage'                  =>'required'
          ]);

        //   if(array_sum($request->percentage) > 100){
        //       return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        //   }

          $creates['user_id']                     = Auth::id();
          $creates['will_master_id']              = $request->will_id;
        //   $creates['policy_holder_name']          = $request->policy_holder_name;
          $creates['type']                        = $request->type;
        //   $creates['nominee_name']                = $request->nominee_name;
          $creates['policy_number']               = $request->policy_number;
          $creates['insurance_company_name']      = $request->insurance_company_name;
        //   $creates['insurance_distribution_plan'] = $request->insurance_distribution_plan;
          $creates['status']                      = 'A';

          Insurance::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty(@$request->beneficiar_id))
          {
            UserAssetsBeneficiaries::where('asset_id',$request->id)->where('type','I')->delete();

                $inputs['asset_id']       = $request->id;
                $inputs['beneficiar_id'] = $request->beneficiar_id;
                $inputs['type'] = 'I';


              $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
            //   dd(@$UserAssetsBeneficiaries);

          }

          if(@$request->SaveConti == 'SQ'){

            $PPF = PPF::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$PPF >0){
                return redirect()->route('user.manage.ppf',[@$request->will_id])->with('success', 'Insurance policy updated successfully');
            }
            return redirect()->route('user.add.ppf',[@$request->will_id])->with('success', 'Insurance policy updated successfully');
        }

        return redirect()->route('user.manage.insurance',[@$request->will_id])->with('success', 'Insurance policy updated successfully');

    }

    public function deleteInsurance(Request $request , $id)
    {

        $delInsurance = Insurance::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delInsurance)
        {
            Insurance::where('id',$id)->where('user_id',Auth::id())->delete();
            UserAssetsBeneficiaries::where('asset_id',$id)->where('type','I')->delete();

            return redirect()->back()->with('success','Insurance policy deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
