<?php

namespace App\Http\Controllers\Modules\User\Will\Property;

use Mail;
use App\User;
use App\Models\Demat;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Property;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyBeneficiaries;

class LandController extends Controller
{

    public function manageLand(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','L')->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['properties'] = $data['properties']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.property.manage_land_property')->with($data);
    }

    public function viewLand(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['landDetail'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('type','L')->where('status','A')->first();

        if(!$data['landDetail']){
            abort(404);
        }

        $data['PropertyBeneficiaries'] = PropertyBeneficiaries::where('asset_id',@$id)->where('type','L')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = PropertyBeneficiaries::where('asset_id',@$id)->where('type','L')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','C')->where('status','A')->count();
        $data['demat'] = Demat::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.property.view_land_property')->with($data);
    }

    public function addLand(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','C')->where('status','A')->count();
        $data['demat'] = Demat::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.property.add_land_property')->with($data);
    }

    public function saveLand(Request $request)
    {
        $this->validate($request, [
          'pname'             =>'required',
          'address'           =>'required',
          'land_type'         =>'required',
          'plot_size'         =>'required',
          'ownership_type'    =>'required',
        //   'survey_number'     =>'required',
          'beneficiar_id'     =>'required',
          'percentage'        =>'required'
        ]);

        if(array_sum($request->percentage) > 100){
            return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        }

        $creates['user_id']             = Auth::id();
        $creates['will_master_id']      = $request->will_id;
        $creates['name']                = $request->pname;
        $creates['address']             = $request->address;
        $creates['land_type']           = $request->land_type;
        $creates['plot_size']           = $request->plot_size;
        $creates['land_area_unit']      = $request->land_area_unit;
        $creates['ownership_type']      = $request->ownership_type;
        $creates['percentage_holding']  = $request->percentage_holding;
        $creates['litigation']          = $request->litigation;
        $creates['jurisdiction']        = $request->jurisdiction;
        $creates['survey_number']       = $request->survey_number;
        $creates['type']                = 'L';
        $creates['status']              = 'A';

        //dd($creates);
        $property = Property::create($creates);

        if (!empty($request->beneficiar_id) && !empty($request->percentage))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']      = $property->id;
                $inputs['beneficiar_id'] = $row;
                $inputs['percentage']    = $request->percentage[$key];
                $inputs['share_detail']    = $request->share_detail[$key];
                $inputs['type'] = 'L';
            }

            $PropertyBeneficiaries = PropertyBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $demat = Demat::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$demat >0){
                return redirect()->route('user.manage.demat',[@$request->will_id])->with('success', 'Land Property added successfully');
            }
            return redirect()->route('user.add.demat',[@$request->will_id])->with('success', 'Land Property added successfully');
        }

        return redirect()->route('user.manage.land',[@$request->will_id])->with('success', 'Land information added successfully');
    }

    public function updateLand(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            'pname'             =>'required',
            'address'           =>'required',
            'land_type'         =>'required',
            'plot_size'         =>'required',
            'ownership_type'    =>'required',
            // 'survey_number'     =>'required',
            'beneficiar_id'     =>'required',
            'percentage'        =>'required'
          ]);

          if(array_sum($request->percentage) > 100){
              return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
          }

          $creates['user_id']             = Auth::id();
          $creates['will_master_id']      = $request->will_id;
          $creates['name']                = $request->pname;
          $creates['address']             = $request->address;
          $creates['land_type']           = $request->land_type;
          $creates['plot_size']           = $request->plot_size;
          $creates['land_area_unit']      = $request->land_area_unit;
          $creates['ownership_type']      = $request->ownership_type;
          $creates['percentage_holding']  = $request->percentage_holding;
          $creates['litigation']          = $request->litigation;
          $creates['jurisdiction']        = $request->jurisdiction;
          $creates['survey_number']       = $request->survey_number;
          $creates['type']                = 'L';
          $creates['status']              = 'A';

          Property::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->where('type','L')->update($creates);

          if (!empty($request->beneficiar_id) && !empty($request->percentage))
          {
            PropertyBeneficiaries::where('asset_id',$request->id)->where('type','L')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['percentage']    = $request->percentage[$key];
                  $inputs['share_detail']    = $request->share_detail[$key];
                  $inputs['type'] = 'L';
              }

              $PropertyBeneficiaries = PropertyBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $demat = Demat::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$demat >0){
                return redirect()->route('user.manage.demat',[@$request->will_id])->with('success', 'Land Property updated successfully');
            }
            return redirect()->route('user.add.demat',[@$request->will_id])->with('success', 'Land Property updated successfully');
        }

        return redirect()->route('user.manage.land',[@$request->will_id])->with('success', 'Land information updated successfully');

    }

    public function deleteLand(Request $request , $id)
    {

        $delLand = Property::where('id',$id)->where('user_id',Auth::id())->where('type','L')->where('status','=',"A")->first();

        if($delLand)
        {
            Property::where('id',$id)->where('user_id',Auth::id())->delete();
            PropertyBeneficiaries::where('asset_id',$id)->where('type','L')->delete();

            return redirect()->back()->with('success','Land information deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
