<?php

namespace App\Http\Controllers\Modules\User\Will\OtherAssets;

use App\User;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\OtherAssets;
use App\Http\Controllers\Controller;
use App\Models\Art;
use App\Models\ResidualAssets;
use Illuminate\Support\Facades\Auth;

class OtherAssetsController extends Controller
{

    public function manageOtherAssets(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['other'] = OtherAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['other'] = $data['other']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.other_assets.manage_other_assets')->with($data);
    }

    public function editOtherAssets(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['otherDetail'] = OtherAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['otherDetail']){
            abort(404);
        }
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['beneficiar_ids'] = OtherAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['art'] = Art::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['residualAssets'] = ResidualAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.other_assets.edit_other_assets')->with($data);
    }

    public function addOtherAssets(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['beneficiar_ids'] = OtherAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->pluck('beneficiar_id')->toArray();

        $data['art'] = Art::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['residualAssets'] = ResidualAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.other_assets.add_other_assets')->with($data);
    }

    public function saveOtherAssets(Request $request)
    {
        $this->validate($request, [
          'beneficiar_id'   =>'required',
          'description'         =>'required'
        ]);

        $creates['user_id']             = Auth::id();
        $creates['will_master_id']      = $request->will_id;
        $creates['beneficiar_id']       = $request->beneficiar_id;
        $creates['description']             = $request->description;
        $creates['status']              = 'A';

        //dd($creates);
        $OtherAssets = OtherAssets::create($creates);

        if(@$request->SaveConti == 'SQ'){

            $residualAssets = ResidualAssets::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$residualAssets >0){
                return redirect()->route('user.manage.residualAssets',[@$request->will_id])->with('success', 'Any Other Assets added successfully');
            }
            return redirect()->route('user.add.residualAssets',[@$request->will_id])->with('success', 'Any Other Assets added successfully');
        }


        return redirect()->route('user.manage.otherAssets',[@$request->will_id])->with('success', 'Any Other Assets added successfully');
    }

    public function updateOtherAssets(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }

        $this->validate($request, [
            'beneficiar_id'   =>'required',
            'description'         =>'required'
          ]);

          $creates['user_id']             = Auth::id();
          $creates['will_master_id']      = $request->will_id;
          $creates['beneficiar_id']       = $request->beneficiar_id;
          $creates['description']             = $request->description;
          $creates['status']              = 'A';

          OtherAssets::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);


        if(@$request->SaveConti == 'SQ'){

            $residualAssets = ResidualAssets::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$residualAssets >0){
                return redirect()->route('user.manage.residualAssets',[@$request->will_id])->with('success', 'Any Other Assets updated successfully');
            }
            return redirect()->route('user.add.residualAssets',[@$request->will_id])->with('success', 'Any Other Assets updated successfully');
        }


        return redirect()->route('user.manage.otherAssets',[@$request->will_id])->with('success', 'Any Other Assets updated successfully');

    }

    public function deleteOtherAssets(Request $request , $id)
    {

        $delOtherAssets = OtherAssets::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delOtherAssets)
        {
            OtherAssets::where('id',$id)->where('user_id',Auth::id())->delete();

            return redirect()->back()->with('success','Any Other Assets deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
