<?php

namespace App\Http\Controllers\Modules\User\Will\Contingency;

use Mail;
use App\User;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Liability;
use App\Models\WillMaster;
use App\Models\Contingency;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use App\Models\Executor;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;
use App\Models\Witness;

class ContingencyController extends Controller
{

    public function manageContingency(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['contingency'] = Contingency::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['contingency'] = $data['contingency']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.contingency.manage_contingency')->with($data);
    }

    public function viewContingency(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['contingencyDetail'] = Contingency::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['contingencyDetail']){
            abort(404);
        }
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['beneficiar_ids'] = Contingency::where('will_master_id',@$willID)->where('user_id',Auth::id())->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['liability'] = Liability::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['witness'] = Witness::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.contingency.view_contingency')->with($data);
    }

    public function addContingency(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['beneficiar_ids'] = Contingency::where('will_master_id',@$willID)->where('user_id',Auth::id())->pluck('beneficiar_id')->toArray();

        $data['liability'] = Liability::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['witness'] = Witness::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.contingency.add_contingency')->with($data);
    }

    public function saveContingency(Request $request)
    {
        $this->validate($request, [
          'beneficiar_id'   =>'required',
          'details'         =>'required'
        ]);

        $creates['user_id']             = Auth::id();
        $creates['will_master_id']      = $request->will_id;
        $creates['beneficiar_id']       = $request->beneficiar_id;
        $creates['details']             = $request->details;
        $creates['status']              = 'A';

        //dd($creates);
        $contingency = Contingency::create($creates);

        if(@$request->SaveConti == 'SQ'){

            $executor = Witness::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$executor >0){
                return redirect()->route('user.manage.witness',[@$request->will_id])->with('success', 'Contingency created successfully');
            }
            return redirect()->route('user.add.witness',[@$request->will_id])->with('success', 'Contingency created successfully');
        }

        return redirect()->route('user.manage.contingency',[@$request->will_id])->with('success', 'Contingency created successfully');
    }

    public function updateContingency(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }

        $this->validate($request, [
            'beneficiar_id'   =>'required',
            'details'         =>'required'
          ]);

          $creates['user_id']             = Auth::id();
          $creates['will_master_id']      = $request->will_id;
          $creates['beneficiar_id']       = $request->beneficiar_id;
          $creates['details']             = $request->details;
          $creates['status']              = 'A';

          Contingency::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if(@$request->SaveConti == 'SQ'){

            $executor = Witness::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$executor >0){
                return redirect()->route('user.manage.witness',[@$request->will_id])->with('success', 'Contingency updated successfully');
            }
            return redirect()->route('user.add.witness',[@$request->will_id])->with('success', 'Contingency updated successfully');
        }

        return redirect()->route('user.manage.contingency',[@$request->will_id])->with('success', 'Contingency updated successfully');

    }

    public function deleteContingency(Request $request , $id)
    {

        $delContingency = Contingency::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delContingency)
        {
            Contingency::where('id',$id)->where('user_id',Auth::id())->delete();

            return redirect()->back()->with('success','Contingency deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
