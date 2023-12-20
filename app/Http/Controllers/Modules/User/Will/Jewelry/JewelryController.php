<?php

namespace App\Http\Controllers\Modules\User\Will\Jewelry;

use Mail;
use App\User;
use App\Models\Bank;
use App\Models\Locker;
use App\Models\Country;
use App\Models\Jewelry;
use App\Models\Packages;
use App\Models\Property;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\CashBeneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JewelryController extends Controller
{

    public function manageJewelry(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['jewelry'] = Jewelry::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['jewelry'] = $data['jewelry']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.jewelry.manage_jewelry')->with($data);
    }

    public function viewJewelry(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['jewelryDetail'] = Jewelry::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['jewelryDetail']){
            abort(404);
        }

        $data['cashBeneficiaries'] = CashBeneficiaries::where('asset_id',@$id)->where('type','J')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = CashBeneficiaries::where('asset_id',@$id)->where('type','J')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['properties'] = Property::where('will_master_id',@$willID)->where('type','R')->where('status','A')->count();
        $data['bank'] = Bank::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.jewelry.view_jewelry')->with($data);
    }

    public function addJewelry(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['properties'] = Property::where('will_master_id',@$willID)->where('type','R')->where('status','A')->count();
        $data['bank'] = Bank::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.jewelry.add_jewelry')->with($data);
    }

    public function saveJewelry(Request $request)
    {
        $this->validate($request, [
          //'gold_weight'         =>'max:50',
          //'silver_weight'       =>'max:50',
          'location'            =>['required', 'max:200'],
          //'address'             =>['required', 'max:200'],
          'description'         =>['required'],
          'beneficiar_id'       =>'required',
          //'percentage'          =>'required'
        ]);

        if (empty($request->gold_weight) && empty($request->silver_weight) && empty($request->description))
        {
            return redirect()->back()->withInput()->with('error', 'Please fill atleast one of these fields - Gold Weight or Silver Weight, Description');
        }

        // if(array_sum($request->percentage) > 100){
        //     return redirect()->back()->withInput()->with('error', 'Total percentage should be less than or equal to 100');
        // }

        $creates['user_id']             = Auth::id();
        $creates['will_master_id']      = $request->will_id;
        // $creates['gold_weight']         = $request->gold_weight;
        // $creates['silver_weight']       = $request->silver_weight;
        $creates['location']            = $request->location;
        //$creates['address']             = $request->address;
        $creates['description']         = $request->description;
        $creates['status']              = 'A';

        //dd($creates);
        $cash = Jewelry::create($creates);

        if (!empty($request->beneficiar_id))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']      = $cash->id;
                $inputs['beneficiar_id'] = $row;
                $inputs['share_detail']  = $request->share_detail[$key];
                $inputs['type'] = 'J';
            }

            $CashBeneficiaries = CashBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $properties = Property::where('will_master_id',@$request->will_id)->where('type','R')->where('status','A')->count();
            if(@$properties >0){
                return redirect()->route('user.manage.residentials',[@$request->will_id])->with('success', 'Jewellery Assets added successfully');
            }
            return redirect()->route('user.add.residentials',[@$request->will_id])->with('success', 'Jewellery Assets added successfully');
        }

        return redirect()->route('user.manage.jewelry',[@$request->will_id])->with('success', 'Jewellery Assets added successfully');
    }

    public function updateJewelry(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }

        $this->validate($request, [
            //'gold_weight'         =>'max:50',
            //'silver_weight'       =>'max:50',
            'location'            =>['required', 'max:200'],
            //'address'             =>['required', 'max:200'],
            'description'         =>['required'],
            'beneficiar_id'       =>'required',
            //'percentage'          =>'required'
          ]);

          if (empty($request->gold_weight) && empty($request->silver_weight) && empty($request->description))
          {
              return redirect()->back()->withInput()->with('error', 'Please fill atleast one of these fields - Gold Weight or Silver Weight, Description');
          }

        //   if(array_sum($request->percentage) > 100){
        //       return redirect()->back()->withInput()->with('error', 'Total percentage should be less than or equal to 100');
        //   }

          $creates['user_id']             = Auth::id();
          $creates['will_master_id']      = $request->will_id;
          //$creates['gold_weight']         = $request->gold_weight;
          //$creates['silver_weight']       = $request->silver_weight;
          $creates['location']            = $request->location;
          //$creates['address']             = $request->address;
          $creates['description']         = $request->description;
          $creates['status']              = 'A';

          Jewelry::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty($request->beneficiar_id))
          {
            CashBeneficiaries::where('asset_id',$request->id)->where('type','J')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['share_detail']    = $request->share_detail[$key];
                  $inputs['type'] = 'J';
              }

              $CashBeneficiaries = CashBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $properties = Property::where('will_master_id',@$request->will_id)->where('type','R')->where('status','A')->count();
            if(@$properties >0){
                return redirect()->route('user.manage.residentials',[@$request->will_id])->with('success', 'Jewellery Assets updated successfully');
            }
            return redirect()->route('user.add.residentials',[@$request->will_id])->with('success', 'Jewellery Assets updated successfully');
        }

        return redirect()->route('user.manage.jewelry',[@$request->will_id])->with('success', 'Jewellery Assets updated successfully');

    }

    public function deleteJewelry(Request $request , $id)
    {

        $delJewelry = Jewelry::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delJewelry)
        {
            Jewelry::where('id',$id)->where('user_id',Auth::id())->delete();
            CashBeneficiaries::where('asset_id',$id)->where('type','J')->delete();

            return redirect()->back()->with('success','Jewellery Assets deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function updateJewelryAlocation(Request $request){

        $data['alodata'] = CashBeneficiaries::where('id',$request->id)->first();
        $data['beneficiaries'] = Beneficiaries::where('id',@$data['alodata']->beneficiar_id)->first();

        return response()->json($data);

    }

}
