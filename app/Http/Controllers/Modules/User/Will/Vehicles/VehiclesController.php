<?php

namespace App\Http\Controllers\Modules\User\Will\Vehicles;

use Mail;
use App\User;
use App\Models\Art;
use App\Models\PPF;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Vehicles;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;

class VehiclesController extends Controller
{

    public function manageVehicles(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['vehicles'] = Vehicles::where('will_master_id',@$willID)->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['vehicles'] = $data['vehicles']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.vehicles.manage_vehicles')->with($data);
    }

    public function viewVehicles(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['vehiclesDetail'] = Vehicles::where('will_master_id',@$willID)->where('id',@$id)->where('status','A')->first();

        if(!$data['vehiclesDetail']){
            abort(404);
        }

        $data['UserAssetsBeneficiaries'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','V')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','V')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['ppf'] = PPF::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['art'] = Art::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.vehicles.view_vehicles')->with($data);
    }

    public function addVehicles(Request $request, $willID=null)
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
        $data['art'] = Art::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.vehicles.add_vehicles')->with($data);
    }

    public function saveVehicles(Request $request)
    {
        $this->validate($request, [
          'brand_name'              =>'required',
          'type'                    =>'required',
          'registration_number'     =>'required',
          'manufacture_year'        =>'required',
          'location'                =>'required',
          'beneficiar_id'           =>'required',
          //'ownership_type'    =>'required',
        ]);

        // if(array_sum($request->percentage) > 100){
        //     return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        // }

        $creates['user_id']                     = Auth::id();
        $creates['will_master_id']              = $request->will_id;
        $creates['brand_name']                  = $request->brand_name;
        $creates['type']                        = $request->type;
        $creates['registration_number']         = $request->registration_number;
        $creates['manufacture_year']            = $request->manufacture_year;
        $creates['location']                    = $request->location;
        $creates['status']                      = 'A';
        //$creates['ownership_type']              = $request->ownership_type;
        //$creates['percentage_holding']          = $request->percentage_holding;

        //dd($creates);
        $vehicle = Vehicles::create($creates);

        if (!empty($request->beneficiar_id))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']      = $vehicle->id;
                $inputs['beneficiar_id'] = $row;
                $inputs['share_detail']    = $request->share_detail[$key];
                //$inputs['percentage']    = $request->percentage[$key];
                $inputs['type'] = 'V';
            }

            $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $art = Art::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$art >0){
                return redirect()->route('user.manage.art',[@$request->will_id])->with('success', 'Vehicles added successfully');
            }
            return redirect()->route('user.add.art',[@$request->will_id])->with('success', 'Vehicles added successfully');
        }

        return redirect()->route('user.manage.vehicles',[@$request->will_id])->with('success', 'Vehicles added successfully');
    }

    public function updateVehicles(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            'brand_name'              =>'required',
            'type'                    =>'required',
            'registration_number'     =>'required',
            'manufacture_year'        =>'required',
            'location'                =>'required',
            'beneficiar_id'           =>'required',
            //'ownership_type'    =>'required',
          ]);

        //   if(array_sum($request->percentage) > 100){
        //       return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        //   }

          $creates['user_id']                     = Auth::id();
          $creates['will_master_id']              = $request->will_id;
          $creates['brand_name']                  = $request->brand_name;
          $creates['type']                        = $request->type;
          $creates['registration_number']         = $request->registration_number;
          $creates['manufacture_year']            = $request->manufacture_year;
          $creates['location']                    = $request->location;
          $creates['status']                      = 'A';
          //$creates['ownership_type']              = $request->ownership_type;
          //$creates['percentage_holding']          = $request->percentage_holding;

          Vehicles::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty($request->beneficiar_id))
          {
            UserAssetsBeneficiaries::where('asset_id',$request->id)->where('type','V')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['share_detail']    = $request->share_detail[$key];
                  //$inputs['percentage']    = $request->percentage[$key];
                  $inputs['type'] = 'V';
              }

              $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $art = Art::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$art >0){
                return redirect()->route('user.manage.art',[@$request->will_id])->with('success', 'Vehicles updated successfully');
            }
            return redirect()->route('user.add.art',[@$request->will_id])->with('success', 'Vehicles updated successfully');
        }

        return redirect()->route('user.manage.vehicles',[@$request->will_id])->with('success', 'Vehicles updated successfully');

    }

    public function deleteVehicles(Request $request , $id)
    {

        $delVehicles = Vehicles::where('id',$id)->where('status','=',"A")->first();

        if($delVehicles)
        {
            Vehicles::where('id',$id)->delete();
            UserAssetsBeneficiaries::where('asset_id',$id)->where('type','V')->delete();

            return redirect()->back()->with('success','Vehicles deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
