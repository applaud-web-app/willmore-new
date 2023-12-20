<?php

namespace App\Http\Controllers\Modules\User\Will\Locker;

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
use App\Models\CashBeneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LockerController extends Controller
{

    public function manageLocker(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['locker'] = Locker::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['locker'] = $data['locker']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.locker.manage_locker')->with($data);
    }

    public function viewLocker(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['lockerDetail'] = Locker::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['lockerDetail']){
            abort(404);
        }

        $data['cashBeneficiaries'] = CashBeneficiaries::where('asset_id',@$id)->where('type','L')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = CashBeneficiaries::where('asset_id',@$id)->where('type','L')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['jewelry'] = Jewelry::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['properties'] = Property::where('will_master_id',@$willID)->where('type','R')->where('status','A')->count();

    	return view('modules.user.will.locker.view_locker')->with($data);
    }

    public function addLocker(Request $request, $willID=null)
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
        $data['properties'] = Property::where('will_master_id',@$willID)->where('type','R')->where('status','A')->count();

    	return view('modules.user.will.locker.add_locker')->with($data);
    }

    public function saveLocker(Request $request)
    {
        $this->validate($request, [
          'locker_number'       =>['required', 'max:100'],
          'bank_name'           =>['required', 'max:100'],
          //'authorized_person'   =>['required', 'max:100'],
          'passcode'            =>['max:200'],
          'key_location'            =>['max:200'],
          'branch_address'      =>['required', 'max:200'],
          'additional_info'      =>['max:200'],
        //   'beneficiar_id'       =>'required',
        //   'percentage'          =>'required'
        ]);

        // if(array_sum($request->percentage) > 100){
        //     return redirect()->back()->withInput()->with('error', 'Total percentage should be less than or equal to 100');
        // }

        $creates['user_id']              = Auth::id();
        $creates['will_master_id']       = $request->will_id;
        $creates['locker_number']        = $request->locker_number;
        $creates['bank_name']            = $request->bank_name;
        //$creates['authorized_person']    = $request->authorized_person;
        $creates['passcode']            = @$request->passcode;
        $creates['key_location']        = @$request->key_location;
        $creates['branch_address']      = $request->branch_address;
        $creates['additional_info']     = @$request->additional_info;
        $creates['status']              = 'A';

        //dd($creates);
        $cash = Locker::create($creates);

        // if (!empty($request->beneficiar_id) && !empty($request->percentage))
        // {
        //    foreach ($request->beneficiar_id as $key => $row)
        //    {
        //     if($row){
        //         $inputs['asset_id']      = $cash->id;
        //         $inputs['beneficiar_id'] = $row;
        //         $inputs['percentage']    = $request->percentage[$key];
        //         $inputs['share_detail']    = $request->share_detail[$key];
        //         $inputs['type'] = 'L';
        //     }

        //     $CashBeneficiaries = CashBeneficiaries::create($inputs);
        //   }
        // }

        if(@$request->SaveConti == 'SQ'){

            $properties = Property::where('will_master_id',@$request->will_id)->where('type','R')->where('status','A')->count();
            if(@$properties >0){
                return redirect()->route('user.manage.residentials',[@$request->will_id])->with('success', 'Locker added successfully');
            }
            return redirect()->route('user.add.residentials',[@$request->will_id])->with('success', 'Locker added successfully');
        }

        return redirect()->route('user.manage.locker',[@$request->will_id])->with('success', 'Locker added successfully');
    }

    public function updateLocker(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            'locker_number'       =>['required', 'max:100'],
            'bank_name'           =>['required', 'max:100'],
            //'authorized_person'   =>['required', 'max:100'],
            'passcode'            =>['max:200'],
            'key_location'        =>['max:200'],
            'branch_address'      =>['required', 'max:200'],
            'additional_info'      =>['max:200'],
            // 'beneficiar_id'       =>'required',
            // 'percentage'          =>'required'
          ]);

        //   if(array_sum($request->percentage) > 100){
        //       return redirect()->back()->withInput()->with('error', 'Total percentage should be less than or equal to 100');
        //   }

          $creates['user_id']              = Auth::id();
          $creates['will_master_id']       = $request->will_id;
          $creates['locker_number']        = $request->locker_number;
          $creates['bank_name']            = $request->bank_name;
          //$creates['authorized_person']    = $request->authorized_person;
          $creates['passcode']            = @$request->passcode;
          $creates['key_location']        = @$request->key_location;
          $creates['branch_address']      = $request->branch_address;
          $creates['additional_info']      = @$request->additional_info;
          $creates['status']              = 'A';

          Locker::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

        //   if (!empty($request->beneficiar_id) && !empty($request->percentage))
        //   {
        //     CashBeneficiaries::where('asset_id',$request->id)->where('type','L')->delete();
        //      foreach ($request->beneficiar_id as $key => $row)
        //      {
        //       if($row){
        //           $inputs['asset_id']       = $request->id;
        //           $inputs['beneficiar_id'] = $row;
        //           $inputs['percentage']    = $request->percentage[$key];
        //           $inputs['share_detail']    = $request->share_detail[$key];
        //           $inputs['type'] = 'L';
        //       }

        //       $CashBeneficiaries = CashBeneficiaries::create($inputs);
        //     }
        //   }

          if(@$request->SaveConti == 'SQ'){

            $properties = Property::where('will_master_id',@$request->will_id)->where('type','R')->where('status','A')->count();
            if(@$properties >0){
                return redirect()->route('user.manage.residentials',[@$request->will_id])->with('success', 'Locker updated successfully');
            }
            return redirect()->route('user.add.residentials',[@$request->will_id])->with('success', 'Locker updated successfully');
        }

        return redirect()->route('user.manage.locker',[@$request->will_id])->with('success', 'Locker updated successfully');

    }

    public function deleteLocker(Request $request , $id)
    {

        $delLocker = Locker::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delLocker)
        {
            Locker::where('id',$id)->where('user_id',Auth::id())->delete();
            CashBeneficiaries::where('asset_id',$id)->where('type','L')->delete();

            return redirect()->back()->with('success','Locker deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
