<?php

namespace App\Http\Controllers\Modules\User\Will\Property;

use Mail;
use App\User;
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

class CommercialController extends Controller
{

    public function manageCommercial(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','C')->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['properties'] = $data['properties']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.property.manage_commercial_property')->with($data);
    }

    public function viewCommercial(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['commercialDetail'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('type','C')->where('status','A')->first();

        if(!$data['commercialDetail']){
            abort(404);
        }

        $data['PropertyBeneficiaries'] = PropertyBeneficiaries::where('asset_id',@$id)->where('type','C')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = PropertyBeneficiaries::where('asset_id',@$id)->where('type','C')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','R')->where('status','A')->count();
        $data['propertiesl'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','L')->where('status','A')->count();

    	return view('modules.user.will.property.view_commercial_property')->with($data);
    }

    public function addCommercial(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['properties'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','R')->where('status','A')->count();
        $data['propertiesl'] = Property::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('type','L')->where('status','A')->count();

    	return view('modules.user.will.property.add_commercial_property')->with($data);
    }

    public function saveCommercial(Request $request)
    {
        $this->validate($request, [
          'pname'             =>'required',
          'address'           =>'required',
          //'carpet_area'       =>'required',
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
        //$creates['carpet_area']         = $request->carpet_area;
        $creates['plot_size']           = $request->plot_size;
        $creates['commercial_type']     = $request->commercial_type;
        $creates['ownership_type']      = $request->ownership_type;
        $creates['percentage_holding']  = $request->percentage_holding;
        $creates['litigation']          = $request->litigation;
        $creates['jurisdiction']        = $request->jurisdiction;
        $creates['survey_number']       = $request->survey_number;
        $creates['type']                = 'C';
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
                $inputs['type'] = 'C';
            }

            $PropertyBeneficiaries = PropertyBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $properties = Property::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('type','L')->where('status','A')->count();
            if(@$properties >0){
                return redirect()->route('user.manage.land',[@$request->will_id])->with('success', 'Commercial Property added successfully');
            }
            return redirect()->route('user.add.land',[@$request->will_id])->with('success', 'Commercial Property added successfully');
        }

        return redirect()->route('user.manage.commercial',[@$request->will_id])->with('success', 'Commercial Property added successfully');
    }

    public function updateCommercial(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            'pname'             =>'required',
            'address'           =>'required',
            //'carpet_area'       =>'required',
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
          //$creates['carpet_area']         = $request->carpet_area;
          $creates['plot_size']           = $request->plot_size;
          $creates['commercial_type']     = $request->commercial_type;
          $creates['ownership_type']      = $request->ownership_type;
          $creates['percentage_holding']  = $request->percentage_holding;
          $creates['litigation']          = $request->litigation;
          $creates['jurisdiction']        = $request->jurisdiction;
          $creates['survey_number']       = $request->survey_number;
          $creates['type']                = 'C';
          $creates['status']              = 'A';

          Property::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->where('type','C')->update($creates);

          if (!empty($request->beneficiar_id) && !empty($request->percentage))
          {
            PropertyBeneficiaries::where('asset_id',$request->id)->where('type','C')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['percentage']    = $request->percentage[$key];
                  $inputs['share_detail']    = $request->share_detail[$key];
                  $inputs['type'] = 'C';
              }

              $PropertyBeneficiaries = PropertyBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $properties = Property::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('type','L')->where('status','A')->count();
            if(@$properties >0){
                return redirect()->route('user.manage.land',[@$request->will_id])->with('success', 'Commercial Property updated successfully');
            }
            return redirect()->route('user.add.land',[@$request->will_id])->with('success', 'Commercial Property updated successfully');
        }

        return redirect()->route('user.manage.commercial',[@$request->will_id])->with('success', 'Commercial Property updated successfully');

    }

    public function deleteCommercial(Request $request , $id)
    {

        $delCommercial = Property::where('id',$id)->where('type','C')->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delCommercial)
        {
            Property::where('id',$id)->where('user_id',Auth::id())->delete();
            PropertyBeneficiaries::where('asset_id',$id)->where('type','C')->delete();

            return redirect()->back()->with('success','Commercial Property deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
