<?php

namespace App\Http\Controllers\Modules\User\Will\Liability;

use Mail;
use App\User;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Liability;
use App\Models\Witness;
use App\Models\WillMaster;
use App\Models\Contingency;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\ResidualAssets;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;

class LiabilityController extends Controller
{

    public function manageLiability(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['liability'] = Liability::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['liability'] = $data['liability']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.liability.manage_liability')->with($data);
    }

    public function viewLiability(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['liabilityDetail'] = Liability::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['liabilityDetail']){
            abort(404);
        }

        $data['user'] = User::where('id',Auth::id())->first();
        $data['will_id'] = $willID;

        $data['residualAssets'] = ResidualAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['contingency'] = Witness::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.liability.view_liability')->with($data);
    }

    public function addLiability(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['residualAssets'] = ResidualAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['contingency'] = Witness::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.liability.add_liability')->with($data);
    }

    public function saveLiability(Request $request)
    {
        $this->validate($request, [
          'type'                =>'required',
          'lender_name'         =>'required',
          'amount'              =>'required',
          'payment_schedule'    =>'required',
          'description'         =>'required',
          'payment_amount'      =>'required',
          'lender_address'      =>'required'
        ]);

        $creates['user_id']             = Auth::id();
        $creates['will_master_id']      = $request->will_id;
        $creates['type']                = $request->type;
        $creates['lender_name']         = $request->lender_name;
        $creates['lender_address']      = $request->lender_address;
        $creates['amount']              = $request->amount;
        $creates['payment_schedule']    = $request->payment_schedule;
        $creates['payment_amount']    = $request->payment_amount;
        $creates['description']         = $request->description;
        $creates['status']              = 'A';

        //dd($creates);
        $liability = Liability::create($creates);

        if(@$request->SaveConti == 'SQ'){

            $contingency = Witness::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$contingency >0){
                return redirect()->route('user.manage.witness',[@$request->will_id])->with('success', 'Liability added successfully');
            }
            return redirect()->route('user.add.witness',[@$request->will_id])->with('success', 'Liability added successfully');
        }

        return redirect()->route('user.manage.liability',[@$request->will_id])->with('success', 'Liability added successfully');
    }

    public function updateLiability(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }

        $this->validate($request, [
            'type'                =>'required',
            'lender_name'         =>'required',
            'amount'              =>'required',
            'payment_schedule'    =>'required',
            'description'         =>'required',
            'payment_amount'      =>'required',
            'lender_address'      =>'required'
          ]);

          $creates['user_id']             = Auth::id();
          $creates['will_master_id']      = $request->will_id;
          $creates['type']                = $request->type;
          $creates['lender_name']         = $request->lender_name;
          $creates['lender_address']      = $request->lender_address;
          $creates['amount']              = $request->amount;
          $creates['payment_schedule']    = $request->payment_schedule;
          $creates['payment_amount']    = $request->payment_amount;
          $creates['description']         = $request->description;
          $creates['status']              = 'A';

          Liability::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if(@$request->SaveConti == 'SQ'){

            $contingency = Witness::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$contingency >0){
                return redirect()->route('user.manage.witness',[@$request->will_id])->with('success', 'Liability added successfully');
            }
            return redirect()->route('user.add.witness',[@$request->will_id])->with('success', 'Liability added successfully');
        }

        return redirect()->route('user.manage.liability',[@$request->will_id])->with('success', 'Liability updated successfully');

    }

    public function deleteLiability(Request $request , $id)
    {

        $delLiability = Liability::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delLiability)
        {
            Liability::where('id',$id)->where('user_id',Auth::id())->delete();

            return redirect()->back()->with('success','Liability deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
