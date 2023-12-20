<?php

namespace App\Http\Controllers\Modules\User\Will\Bank;

use Mail;
use App\User;
use App\Models\Bank;
use App\Models\Cash;
use App\Models\Country;
use App\Models\Jewelry;
use App\Models\Packages;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\CashBeneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{

    public function manageBank(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['bank'] = Bank::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['bank'] = $data['bank']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.bank.manage_bank')->with($data);
    }

    public function viewBank(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['bankDetail'] = Bank::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['bankDetail']){
            abort(404);
        }

        $data['cashBeneficiaries'] = CashBeneficiaries::where('asset_id',@$id)->where('type','B')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = CashBeneficiaries::where('asset_id',@$id)->where('type','B')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['jewelry'] = Jewelry::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['cash'] = Cash::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.bank.view_bank')->with($data);
    }

    public function addBank(Request $request, $willID=null)
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
        $data['cash'] = Cash::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.bank.add_bank')->with($data);
    }

    public function saveBank(Request $request)
    {
        $this->validate($request, [
          'account_type'         =>'required',
          'account_number'       =>['required', 'max:30'],
          'account_holder_name'  =>['required', 'max:100'],
          'ifsc_code'            =>['required', 'max:50'],
          'branch_address'       =>['required', 'max:200'],
          'bank_name'            =>['required', 'max:100'],
          'beneficiar_id'        =>'required',
          'percentage'           =>'required',
          'ownership_type'    =>'required',

        ]);

        if(array_sum($request->percentage) > 100){
            return redirect()->back()->withInput()->with('error', 'Total percentage should be less than or equal to 100');
        }

        $creates['user_id']                 = Auth::id();
        $creates['will_master_id']          = $request->will_id;
        $creates['account_type']            = $request->account_type;
        $creates['account_number']          = $request->account_number;
        $creates['account_holder_name']     = $request->account_holder_name;
        $creates['ifsc_code']               = $request->ifsc_code;
        $creates['branch_address']          = $request->branch_address;
        $creates['bank_name']               = $request->bank_name;
        $creates['status']                  = 'A';
        $creates['ownership_type']          = $request->ownership_type;
        $creates['percentage_holding']      = $request->percentage_holding;

        //dd($creates);
        $cash = Bank::create($creates);

        if (!empty($request->beneficiar_id) && !empty($request->percentage))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']       = $cash->id;
                $inputs['beneficiar_id'] = $row;
                $inputs['percentage']    = $request->percentage[$key];
                $inputs['share_detail']    = $request->share_detail[$key];
                $inputs['type'] = 'B';
            }

            $CashBeneficiaries = CashBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $Jewelry = Jewelry::where('will_master_id', @$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$Jewelry >0){
                return redirect()->route('user.manage.jewelry',[@$request->will_id])->with('success', 'Bank account added successfully');
            }
            return redirect()->route('user.add.jewelry',[@$request->will_id])->with('success', 'Bank account added successfully');
        }

        return redirect()->route('user.manage.bank',[@$request->will_id])->with('success', 'Bank account added successfully');
    }

    public function updateBank(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }

        $this->validate($request, [
            'account_type'         =>'required',
            'account_number'       =>['required', 'max:30'],
            'account_holder_name'  =>['required', 'max:100'],
            'ifsc_code'            =>['required', 'max:50'],
            'branch_address'       =>['required', 'max:200'],
            'bank_name'            =>['required', 'max:100'],
            'beneficiar_id'        =>'required',
            'percentage'           =>'required',
            'ownership_type'    =>'required',

          ]);

          if(array_sum($request->percentage) > 100){
              return redirect()->back()->withInput()->with('error', 'Total percentage should be less than or equal to 100');
          }

          $creates['user_id']                 = Auth::id();
          $creates['will_master_id']          = $request->will_id;
          $creates['account_type']            = $request->account_type;
          $creates['account_number']          = $request->account_number;
          $creates['account_holder_name']     = $request->account_holder_name;
          $creates['ifsc_code']               = $request->ifsc_code;
          $creates['branch_address']          = $request->branch_address;
          $creates['bank_name']               = $request->bank_name;
          $creates['status']                  = 'A';
          $creates['ownership_type']          = $request->ownership_type;
          $creates['percentage_holding']      = $request->percentage_holding;

          Bank::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty($request->beneficiar_id) && !empty($request->percentage))
          {
            CashBeneficiaries::where('asset_id',$request->id)->where('type','B')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']      = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['percentage']    = $request->percentage[$key];
                  $inputs['share_detail']    = $request->share_detail[$key];
                  $inputs['type'] = 'B';
              }

              $CashBeneficiaries = CashBeneficiaries::create($inputs);
            }
          }

          if(@$request->SaveConti == 'SQ'){

            $Jewelry = Jewelry::where('will_master_id', @$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$Jewelry >0){
                return redirect()->route('user.manage.jewelry',[@$request->will_id])->with('success', 'Bank updated successfully');
            }
            return redirect()->route('user.add.jewelry',[@$request->will_id])->with('success', 'Bank updated successfully');
        }

        return redirect()->route('user.manage.bank',[@$request->will_id])->with('success', 'Bank updated successfully');

    }

    public function deleteBank(Request $request , $id)
    {

        $delCash = Bank::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delCash)
        {
            Bank::where('id',$id)->where('user_id',Auth::id())->delete();
            CashBeneficiaries::where('asset_id',$id)->where('type','B')->delete();

            return redirect()->back()->with('success','Bank deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
