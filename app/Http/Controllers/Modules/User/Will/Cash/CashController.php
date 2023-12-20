<?php

namespace App\Http\Controllers\Modules\User\Will\Cash;

use Mail;
use App\User;
use App\Models\LOI;
use App\Models\Bank;
use App\Models\Cash;
use App\Models\Country;
use App\Models\Packages;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\CashBeneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CashController extends Controller
{

    public function manageCash(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['cash'] = Cash::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['cash'] = $data['cash']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

    	return view('modules.user.will.cash.manage_cash')->with($data);
    }

    public function viewCash(Request $request, $willID=null, $id=null)
    {
        if($willID==null || empty($willID) || $id==null || empty($id)){
            abort(404);
        }

        $data['cashDetail'] = Cash::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('id',@$id)->where('status','A')->first();

        if(!$data['cashDetail']){
            abort(404);
        }

        $data['cashBeneficiaries'] = CashBeneficiaries::where('asset_id',@$id)->where('type','C')->get();
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiar_ids'] = CashBeneficiaries::where('asset_id',@$id)->where('type','C')->pluck('beneficiar_id')->toArray();
        $data['will_id'] = $willID;

        $data['bank'] = Bank::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['benefici'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.cash.view_cash')->with($data);
    }

    public function addCash(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false){
            return redirect()->back()->with('error','Please add one executor and at least one beneficiary to proceed');
        }

        $data['will_id'] = $willID;
        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->get();

        $data['bank'] = Bank::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['benefici'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.cash.add_cash')->with($data);
    }

    public function saveCash(Request $request)
    {
        $this->validate($request, [
          'amount'              =>['required', 'max:30'],
          'amount_in_words'     =>['required', 'max:200'],
          'location_of_cash'    =>['required', 'max:200'],
          'beneficiar_id'       =>'required',
          'percentage'          =>'required'
        ]);

        if(array_sum($request->percentage) > 100){
            return redirect()->back()->withInput()->with('error', 'Total percentage should be less than or equal to 100');
        }

        $creates['user_id']             = Auth::id();
        $creates['will_master_id']      = $request->will_id;
        $creates['amount']              = $request->amount;
        $creates['amount_in_words']     = $request->amount_in_words;
        $creates['location_of_cash']    = $request->location_of_cash;
        $creates['status']              = 'A';

        //dd($creates);
        $cash = Cash::create($creates);

        if (!empty($request->beneficiar_id) && !empty($request->percentage))
        {
           foreach ($request->beneficiar_id as $key => $row)
           {
            if($row){
                $inputs['asset_id']      = $cash->id;
                $inputs['beneficiar_id'] = $row;
                $inputs['percentage']    = $request->percentage[$key];
                $inputs['type'] = 'C';
            }

            $CashBeneficiaries = CashBeneficiaries::create($inputs);
          }
        }

        if(@$request->SaveConti == 'SQ'){

            $bank = Bank::where('will_master_id', @$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$bank >0){
                return redirect()->route('user.manage.bank',[@$request->will_id])->with('success', 'Cash asset added successfully');
            }
            return redirect()->route('user.add.bank',[@$request->will_id])->with('success', 'Cash asset added successfully');
        }

        return redirect()->route('user.manage.cash',[@$request->will_id])->with('success', 'Cash asset added successfully');
    }

    public function updateCash(Request $request)
    {
        if($request->id==null || empty($request->id)){
            abort(404);
        }

        $this->validate($request, [
            'amount'              =>['required', 'max:30'],
            'amount_in_words'     =>['required', 'max:200'],
            'location_of_cash'    =>['required', 'max:200'],
            'beneficiar_id'       =>'required',
            'percentage'          =>'required'
          ]);

          if(array_sum($request->percentage) > 100){
              return redirect()->back()->withInput()->with('error', 'Total percentage should be less than or equal to 100');
          }

          $creates['user_id']             = Auth::id();
          $creates['will_master_id']      = $request->will_id;
          $creates['amount']              = $request->amount;
          $creates['amount_in_words']     = $request->amount_in_words;
          $creates['location_of_cash']    = $request->location_of_cash;
          $creates['status']              = 'A';

          Cash::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if (!empty($request->beneficiar_id) && !empty($request->percentage))
          {
            CashBeneficiaries::where('asset_id',$request->id)->where('type','C')->delete();
             foreach ($request->beneficiar_id as $key => $row)
             {
              if($row){
                  $inputs['asset_id']       = $request->id;
                  $inputs['beneficiar_id'] = $row;
                  $inputs['percentage']    = $request->percentage[$key];
                  $inputs['type'] = 'C';
              }

              $CashBeneficiaries = CashBeneficiaries::create($inputs);
            }
          }

        if(@$request->SaveConti == 'SQ'){

            $bank = Bank::where('will_master_id', @$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$bank >0){
                return redirect()->route('user.manage.bank',[@$request->will_id])->with('success', 'Cash asset updated successfully');
            }
            return redirect()->route('user.add.bank',[@$request->will_id])->with('success', 'Cash asset updated successfully');
        }

        return redirect()->route('user.manage.cash',[@$request->will_id])->with('success', 'Cash asset updated successfully');

    }

    public function deleteCash(Request $request , $id)
    {

        $delCash = Cash::where('id',$id)->where('user_id',Auth::id())->where('status','=',"A")->first();

        if($delCash)
        {
            Cash::where('id',$id)->where('user_id',Auth::id())->delete();
            CashBeneficiaries::where('asset_id',$id)->where('type','C')->delete();

            return redirect()->back()->with('success','Cash asset deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
