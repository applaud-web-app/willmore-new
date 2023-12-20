<?php

namespace App\Http\Controllers\Modules\User\Will\ResidualAssets;

use App\User;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\ResidualAssets;
use App\Http\Controllers\Controller;
use App\Models\OtherAssets;
use App\Models\Liability;
use Illuminate\Support\Facades\Auth;

class ResidualAssetsController extends Controller
{

    public function manageResidualAssets(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['residual'] = ResidualAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['residual'] = $data['residual']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.residual_assets.manage_residual_assets')->with($data);
    }

    public function editResidualAssets(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['residualDetail'] = ResidualAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['residualDetail']){
            abort(404);
        }
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['beneficiar_ids'] = ResidualAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['otherAssets'] = OtherAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['liability'] = Liability::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.residual_assets.edit_residual_assets')->with($data);
    }

    public function addResidualAssets(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['beneficiar_ids'] = ResidualAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->pluck('beneficiar_id')->toArray();

        $data['otherAssets'] = OtherAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['liability'] = Liability::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.residual_assets.add_residual_assets')->with($data);
    }

    public function saveResidualAssets(Request $request)
    {
        $this->validate($request, [
          'beneficiar_id'   =>'required',
        //   'description'         =>'required'
        ]);

        $creates['user_id']             = Auth::id();
        $creates['will_master_id']      = $request->will_id;
        $creates['beneficiar_id']       = $request->beneficiar_id;
        $creates['description']             = $request->description;
        $creates['status']              = 'A';

        //dd($creates);
        $ResidualAssets = ResidualAssets::create($creates);

        if(@$request->SaveConti == 'SQ'){

            $liability = Liability::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$liability >0){
                return redirect()->route('user.manage.liability',[@$request->will_id])->with('success', 'Residual Assets added successfully');
            }
            return redirect()->route('user.add.liability',[@$request->will_id])->with('success', 'Residual Assets added successfully');
        }


        return redirect()->route('user.manage.residualAssets',[@$request->will_id])->with('success', 'Residual Assets added successfully');
    }

    public function updateResidualAssets(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }

        $this->validate($request, [
            'beneficiar_id'   =>'required',
            // 'description'         =>'required'
          ]);

          $creates['user_id']             = Auth::id();
          $creates['will_master_id']      = $request->will_id;
          $creates['beneficiar_id']       = $request->beneficiar_id;
          $creates['description']             = $request->description;
          $creates['status']              = 'A';

          ResidualAssets::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);


        if(@$request->SaveConti == 'SQ'){

            $liability = Liability::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$liability >0){
                return redirect()->route('user.manage.liability',[@$request->will_id])->with('success', 'Residual Assets updated successfully');
            }
            return redirect()->route('user.add.liability',[@$request->will_id])->with('success', 'Residual Assets updated successfully');
        }


        return redirect()->route('user.manage.residualAssets',[@$request->will_id])->with('success', 'Residual Assets updated successfully');

    }

    public function deleteResidualAssets(Request $request , $id)
    {

        $delResidualAssets = ResidualAssets::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delResidualAssets)
        {
            ResidualAssets::where('id',$id)->where('user_id',Auth::id())->delete();

            return redirect()->back()->with('success','Residual Assets deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
