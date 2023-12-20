<?php

namespace App\Http\Controllers\Modules\User\Will\Art;

use Mail;
use App\User;
use App\Models\Art;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Vehicles;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\OtherAssets;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;

class ArtController extends Controller
{

    public function manageArt(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['art'] = Art::where('will_master_id',@$willID)->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['art'] = $data['art']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.art.manage_art')->with($data);
    }

    public function viewArt(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['artDetail'] = Art::where('will_master_id',@$willID)->where('id',@$id)->where('status','A')->first();

        if(!$data['artDetail']){
            abort(404);
        }

        $data['UserAssetsBeneficiaries'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','A')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','A')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['vehicles'] = Vehicles::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['otherAssets'] = OtherAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.art.view_art')->with($data);
    }

    public function addArt(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['vehicles'] = Vehicles::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['otherAssets'] = OtherAssets::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.art.add_art')->with($data);
    }

    public function saveArt(Request $request)
    {
        $this->validate($request, [
          'type'            =>'required',
          'art_name'        =>'required',
          'location'        =>'required',
          'beneficiar_id'   =>'required',
          //'percentage'      =>'required'
        ]);

        // if(array_sum($request->percentage) > 100){
        //     return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        // }

        $creates['user_id']         = Auth::id();
        $creates['will_master_id']  = $request->will_id;
        $creates['type']            = $request->type;
        $creates['art_name']        = $request->art_name;
        $creates['location']        = $request->location;
        $creates['status']          = 'A';

        //dd($creates);
        $art = Art::create($creates);

        if (!empty($request->beneficiar_id))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']      = $art->id;
                $inputs['beneficiar_id'] = $row;
                $inputs['share_detail']    = $request->share_detail[$key];
                //$inputs['percentage']    = $request->percentage[$key];
                $inputs['type'] = 'A';
            }

            $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $otherAssets = OtherAssets::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$otherAssets >0){
                return redirect()->route('user.manage.otherAssets',[@$request->will_id])->with('success', 'Art asset added successfully');
            }
            return redirect()->route('user.add.otherAssets',[@$request->will_id])->with('success', 'Art asset added successfully');
        }

        return redirect()->route('user.manage.art',[@$request->will_id])->with('success', 'Art asset added successfully');
    }

    public function updateArt(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            'type'            =>'required',
            'art_name'        =>'required',
            'location'        =>'required',
            'beneficiar_id'   =>'required',
            //'percentage'      =>'required'
          ]);

        //   if(array_sum($request->percentage) > 100){
        //       return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        //   }

          $creates['user_id']         = Auth::id();
          $creates['will_master_id']  = $request->will_id;
          $creates['type']            = $request->type;
          $creates['art_name']        = $request->art_name;
          $creates['location']        = $request->location;
          $creates['status']          = 'A';

          Art::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty($request->beneficiar_id))
          {
            UserAssetsBeneficiaries::where('asset_id',$request->id)->where('type','A')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['share_detail']    = $request->share_detail[$key];
                  //$inputs['percentage']    = $request->percentage[$key];
                  $inputs['type'] = 'A';
              }

              $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $otherAssets = OtherAssets::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$otherAssets >0){
                return redirect()->route('user.manage.otherAssets',[@$request->will_id])->with('success', 'Art asset updated successfully');
            }
            return redirect()->route('user.add.otherAssets',[@$request->will_id])->with('success', 'Art asset updated successfully');
        }

        return redirect()->route('user.manage.art',[@$request->will_id])->with('success', 'Art asset updated successfully');

    }

    public function deleteArt(Request $request , $id)
    {

        $delArt = Art::where('id',$id)->where('status','=',"A")->first();

        if($delArt)
        {
            Art::where('id',$id)->delete();
            UserAssetsBeneficiaries::where('asset_id',$id)->where('type','A')->delete();

            return redirect()->back()->with('success','Art asset deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
