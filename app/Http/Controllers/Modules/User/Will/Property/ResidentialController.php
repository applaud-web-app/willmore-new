<?php

namespace App\Http\Controllers\Modules\User\Will\Property;

use Mail;
use App\User;
use App\Models\Locker;
use App\Models\Country;
use App\Models\Jewelry;
use App\Models\Packages;
use App\Models\Property;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyBeneficiaries;

class ResidentialController extends Controller
{

    public function manageResidential(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['properties'] = Property::where('will_master_id',@$willID)->where('type','R')->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['properties'] = $data['properties']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.property.manage_residential_property')->with($data);
    }

    public function viewResidential(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['residentialDetail'] = Property::where('will_master_id',@$willID)->where('id',@$id)->where('type','R')->where('status','A')->first();

        if(!$data['residentialDetail']){
            abort(404);
        }

        $data['PropertyBeneficiaries'] = PropertyBeneficiaries::where('asset_id',@$id)->where('type','R')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = PropertyBeneficiaries::where('asset_id',@$id)->where('type','R')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['jewelry'] = Jewelry::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','C')->where('status','A')->count();

    	return view('modules.user.will.property.view_residential_property')->with($data);
    }

    public function addResidential(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['jewelry'] = Jewelry::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','C')->where('status','A')->count();

    	return view('modules.user.will.property.add_residential_property')->with($data);
    }

    public function saveResidential(Request $request)
    {
        $this->validate($request, [
          //'pname'             =>'required',
          'address'           =>'required',
          //'carpet_area'       =>'required',
          //'plot_size'         =>'required',
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
        //$creates['carpet_area']         = $request->carpet_area;
        $creates['plot_size']           = $request->plot_size;
        $creates['residential_type']     = $request->residential_type;
        $creates['ownership_type']      = $request->ownership_type;
        $creates['percentage_holding']  = $request->percentage_holding;
        $creates['litigation']          = $request->litigation;
        $creates['jurisdiction']        = $request->jurisdiction;
        $creates['survey_number']       = $request->survey_number;
        $creates['type']                = 'R';
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
                $inputs['type'] = 'R';
            }

            $PropertyBeneficiaries = PropertyBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $properties = Property::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('type','C')->where('status','A')->count();
            if(@$properties >0){
                return redirect()->route('user.manage.commercial',[@$request->will_id])->with('success', 'Residential Property added successfully');
            }
            return redirect()->route('user.add.commercial',[@$request->will_id])->with('success', 'Residential Property added successfully');
        }

        return redirect()->route('user.manage.residentials',[@$request->will_id])->with('success', 'Residential Property added successfully');
    }

    public function updateResidential(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            //'pname'             =>'required',
            'address'           =>'required',
            //'carpet_area'       =>'required',
            //'plot_size'         =>'required',
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
          //$creates['carpet_area']         = $request->carpet_area;
          $creates['plot_size']           = $request->plot_size;
          $creates['residential_type']     = $request->residential_type;
          $creates['ownership_type']      = $request->ownership_type;
          $creates['percentage_holding']  = $request->percentage_holding;
          $creates['litigation']          = $request->litigation;
          $creates['jurisdiction']        = $request->jurisdiction;
          $creates['survey_number']       = $request->survey_number;
          $creates['type']                = 'R';
          $creates['status']              = 'A';

          Property::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->where('type','R')->update($creates);

          if (!empty($request->beneficiar_id) && !empty($request->percentage))
          {
            PropertyBeneficiaries::where('asset_id',$request->id)->where('type','R')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['percentage']    = $request->percentage[$key];
                  $inputs['share_detail']    = $request->share_detail[$key];
                  $inputs['type'] = 'R';
              }

              $PropertyBeneficiaries = PropertyBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $properties = Property::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('type','C')->where('status','A')->count();
            if(@$properties >0){
                return redirect()->route('user.manage.commercial',[@$request->will_id])->with('success', 'Residential Property updated successfully');
            }
            return redirect()->route('user.add.commercial',[@$request->will_id])->with('success', 'Residential Property updated successfully');
        }

        return redirect()->route('user.manage.residentials',[@$request->will_id])->with('success', 'Residential Property updated successfully');

    }

    public function deleteResidential(Request $request , $id)
    {

        $delResidential = Property::where('id',$id)->where('type','R')->where('status','=',"A")->first();

        if($delResidential)
        {
            Property::where('id',$id)->delete();
            PropertyBeneficiaries::where('asset_id',$id)->where('type','R')->delete();

            return redirect()->back()->with('success','Residential Property deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
