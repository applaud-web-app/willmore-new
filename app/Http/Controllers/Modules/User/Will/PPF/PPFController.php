<?php

namespace App\Http\Controllers\Modules\User\Will\PPF;

use Mail;
use App\User;
use App\Models\PPF;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Vehicles;
use App\Models\Insurance;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;

class PPFController extends Controller
{

    public function managePPF(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['ppf'] = PPF::where('will_master_id',@$willID)->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['ppf'] = $data['ppf']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.ppf.manage_ppf')->with($data);
    }

    public function viewPPF(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['ppfDetail'] = PPF::where('will_master_id',@$willID)->where('id',@$id)->where('status','A')->first();

        if(!$data['ppfDetail']){
            abort(404);
        }

        $data['UserAssetsBeneficiaries'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','P')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = UserAssetsBeneficiaries::where('asset_id',@$id)->where('type','P')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['insurance'] = Insurance::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['vehicles'] = Vehicles::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.ppf.view_ppf')->with($data);
    }

    public function addPPF(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['insurance'] = Insurance::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['vehicles'] = Vehicles::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.ppf.add_ppf')->with($data);
    }

    public function savePPF(Request $request)
    {
        $this->validate($request, [
          'account_name'    =>'required',
          'account_number'  =>'required',
          'bank_name'       =>'required',
          'branch_address'  =>'required',
        //   'nominee_name'    =>'required',
        //   'start_date'      =>'required',
        //   'end_date'        =>'required',
          'beneficiar_id'   =>'required',
          'percentage'      =>'required'
        ]);

        if(array_sum($request->percentage) > 100){
            return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
        }

        $creates['user_id']         = Auth::id();
        $creates['will_master_id']  = $request->will_id;
        $creates['account_name']    = $request->account_name;
        $creates['account_number']  = $request->account_number;
        $creates['bank_name']       = $request->bank_name;
        $creates['branch_address']  = $request->branch_address;
        // $creates['nominee_name']    = $request->nominee_name;
        // $creates['start_date']      = date('Y-m-d',strtotime($request->start_date));
        // $creates['end_date']        = date('Y-m-d',strtotime($request->end_date));
        $creates['status']          = 'A';

        //dd($creates);
        $demat = PPF::create($creates);

        if (!empty($request->beneficiar_id) && !empty($request->percentage))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']      = $demat->id;
                $inputs['beneficiar_id'] = $row;
                $inputs['percentage']    = $request->percentage[$key];
                $inputs['share_detail']    = $request->share_detail[$key];
                $inputs['type'] = 'P';
            }

            $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $vehicles = Vehicles::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$vehicles >0){
                return redirect()->route('user.manage.vehicles',[@$request->will_id])->with('success', 'PPF account added successfully');
            }
            return redirect()->route('user.add.vehicles',[@$request->will_id])->with('success', 'PPF account added successfully');
        }

        return redirect()->route('user.manage.ppf',[@$request->will_id])->with('success', 'PPF account added successfully');
    }

    public function updatePPF(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }
        $this->validate($request, [
            'account_name'    =>'required',
            'account_number'  =>'required',
            'bank_name'       =>'required',
            'branch_address'  =>'required',
            // 'nominee_name'    =>'required',
            // 'start_date'      =>'required',
            // 'end_date'        =>'required',
            'beneficiar_id'   =>'required',
            'percentage'      =>'required'
          ]);

          if(array_sum($request->percentage) > 100){
              return redirect()->back()->with('error', 'Total percentage should be less than or equal to 100');
          }

          $creates['user_id']         = Auth::id();
          $creates['will_master_id']  = $request->will_id;
          $creates['account_name']    = $request->account_name;
          $creates['account_number']  = $request->account_number;
          $creates['bank_name']       = $request->bank_name;
          $creates['branch_address']  = $request->branch_address;
        //   $creates['nominee_name']    = $request->nominee_name;
        //   $creates['start_date']      = date('Y-m-d',strtotime($request->start_date));
        //   $creates['end_date']        = date('Y-m-d',strtotime($request->end_date));
          $creates['status']          = 'A';

          PPF::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty($request->beneficiar_id) && !empty($request->percentage))
          {
            UserAssetsBeneficiaries::where('asset_id',$request->id)->where('type','P')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['percentage']    = $request->percentage[$key];
                  $inputs['share_detail']    = $request->share_detail[$key];
                  $inputs['type'] = 'P';
              }

              $UserAssetsBeneficiaries = UserAssetsBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $vehicles = Vehicles::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$vehicles >0){
                return redirect()->route('user.manage.vehicles',[@$request->will_id])->with('success', 'PPF account updated successfully');
            }
            return redirect()->route('user.add.vehicles',[@$request->will_id])->with('success', 'PPF account updated successfully');
        }

        return redirect()->route('user.manage.ppf',[@$request->will_id])->with('success', 'PPF account updated successfully');

    }

    public function deletePPF(Request $request , $id)
    {

        $delPPF = PPF::where('id',$id)->where('status','=',"A")->first();

        if($delPPF)
        {
            PPF::where('id',$id)->delete();
            UserAssetsBeneficiaries::where('asset_id',$id)->where('type','P')->delete();

            return redirect()->back()->with('success','PPF account deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
