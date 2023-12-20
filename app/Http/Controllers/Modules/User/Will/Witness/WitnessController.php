<?php

namespace App\Http\Controllers\Modules\User\Will\Witness;

use App\User;
use App\Models\LOI;
use App\Models\Country;
use App\Models\Witness;
use App\Models\Executor;
use App\Models\Liability;
use App\Models\Contingency;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WitnessController extends Controller
{

    public function manageWitness($willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $data['witness'] = Witness::where('will_master_id',@$willID)->where('status','A');

        $data['user'] = User::where('id',Auth::id())->first();
        $data['witness'] = $data['witness']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

        if(checkWitnessCount($willID) == 0){
            return redirect()->route('user.add.witness',[@$willID]);
        }

    	return view('modules.user.will.witness.manage_witness')->with($data);
    }

    public function addWitness($willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }
        $data['will_id'] = $willID;
        $data['countrys'] = Country::get();

        $data['contingency'] = Liability::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['executor'] = Executor::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.witness.add_witness')->with($data);
    }

    public function viewWitness($willID=null, $slug=null)
    {
        if($willID==null || empty($willID) || $slug==null || empty($slug)){
            abort(404);
        }

        $data['witnessDetail'] = Witness::where('will_master_id',@$willID)->where('slug',@$slug)->where('status','A')->first();

        $data['countrys'] = Country::get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['will_id'] = $willID;

        $data['contingency'] = Liability::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['executor'] = Executor::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.witness.view_witness')->with($data);
    }

    public function saveWitness(Request $request)
    {
        $this->validate($request, [
          'first_name' =>'required',
          'middle_name' =>'max:100',
          'last_name' =>'required',
          'country_id' =>'required',
          //'aadhar_number' =>'required',
          //'sign_place' => 'required',
          //'sign_date' => 'required',
          'address1' =>'required',
          'address2' =>'required',
          'city' =>'required',
          'state' =>'required',
          'zip_code' =>'required',
          'salutation' => 'required',
        ]);

        $creates['name'] = $request->middle_name ? $request->first_name.' '.$request->middle_name.' '.$request->last_name : $request->first_name.' '.$request->last_name;

        if(strlen($creates['name']) > 255){
            return redirect()->back()->withInput()->with('error','Please enter not more than 255 characters for First Name, Middle Name and Last Name');
        }

        $creates['user_id']         = Auth::id();
        $creates['will_master_id']  = $request->will_id;
        $creates['first_name']      = $request->first_name;
        $creates['last_name']       = $request->last_name;
        $creates['middle_name']     = $request->middle_name;
        $creates['country']         = $request->country_id;
        $creates['aadhar_number']   = @$request->aadhar_number;
        //$creates['sign_place']   = @$request->sign_place;
        //$creates['sign_date']    = date('Y-m-d',strtotime($request->sign_date));
        $creates['address1']        = $request->address1;
        $creates['address2']        = $request->address2;
        $creates['city']            = $request->city;
        $creates['state']           = $request->state;
        $creates['zip_code']        = $request->zip_code;
        $creates['status']          = 'A';
        $creates['salutation']        = $request->salutation;

        //dd($creates);
        $witness = Witness::create($creates);

        //update slug and username
        // $updateDat['username'] = $this->checkDuplicateRecursive($request->first_name,$request->last_name,$Witness->id);
        $updateDat['slug'] = str_slug($creates['name']).'-'.$witness->id;
        Witness::where('id',$witness->id)->update($updateDat);


        if(@$request->SaveConti == 'SQ'){

            $loi = Executor::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->count();
            if(@$loi >0){
                return redirect()->route('user.add.witness',[@$request->will_id])->with('success', 'Witness added successfully');
            }
            return redirect()->route('user.add.witness',[@$request->will_id])->with('success', 'Witness added successfully');
        }

        return redirect()->route('user.manage.witness',[@$request->will_id])->with('success', 'Witness added successfully');
    }

    public function updateWitness(Request $request, $willID=null, $slug=null)
    {
        if($request->id && $request->will_id){

            if($request->id==null || empty($request->id)){
                abort(404);
            }

            $this->validate($request, [
                'first_name' =>'required',
                'middle_name' =>'max:100',
                'last_name' =>'required',
                'country_id' =>'required',
                //'aadhar_number' =>'required',
                //'sign_place' => 'required',
                //'sign_date' => 'required',
                'address1' =>'required',
                'address2' =>'required',
                'city' =>'required',
                'state' =>'required',
                'zip_code' =>'required',
                'salutation' => 'required',
            ]);

            $witness = Witness::where('id',$request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->where('status','A')->first();

            $creates['name'] = $request->middle_name ? $request->first_name.' '.$request->middle_name.' '.$request->last_name : $request->first_name.' '.$request->last_name;

            if(strlen($creates['name']) > 255){
                return redirect()->back()->withInput()->with('error','Please enter not more than 255 characters for First Name, Middle Name and Last Name');
            }

            $creates['user_id']         = Auth::id();
            $creates['will_master_id']  = $request->will_id;
            $creates['first_name']      = $request->first_name;
            $creates['last_name']       = $request->last_name;
            $creates['middle_name']     = $request->middle_name;
            $creates['country']         = $request->country_id;
            $creates['aadhar_number']   = @$request->aadhar_number;
            //$creates['sign_place']   = @$request->sign_place;
            //$creates['sign_date']    = date('Y-m-d',strtotime($request->sign_date));
            $creates['address1']        = $request->address1;
            $creates['address2']        = $request->address2;
            $creates['city']            = $request->city;
            $creates['state']           = $request->state;
            $creates['zip_code']        = $request->zip_code;
            $creates['status']          = 'A';
            $creates['salutation']        = $request->salutation;

            Witness::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

            if(@$request->SaveConti == 'SQ'){

                $loi = Executor::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->count();
                if(@$loi >0){
                    return redirect()->route('user.manage.executor',[@$request->will_id])->with('success', 'Witness updated successfully');
                }
                return redirect()->route('user.add.executor',[@$request->will_id])->with('success', 'Witness updated successfully');
            }

            return redirect()->route('user.manage.witness',[@$request->will_id])->with('success', 'Witness updated successfully');
        }

        if($willID==null || empty($willID) || $slug==null || empty($slug)){
            abort(404);
        }

        $data['witnessDetail'] = Witness::where('will_master_id',@$willID)->where('slug',@$slug)->where('status','A')->first();

        $data['countrys'] = Country::get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['will_id'] = $willID;

    	return view('modules.user.will.witness.edit_witness')->with($data);

    }

    public function deleteWitness($id)
    {
        $delwitness = Witness::where('id',$id)->where('status','=',"A")->first();

        if($delwitness)
        {
            Witness::where('id',$id)->delete();

            return redirect()->back()->with('success','Witness deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function witnessDateCheck(Request $request)
    {
     $sign_date = date('Y-m-d', strtotime(@$request->sign_date));
     $witness = Witness::where('will_master_id',@$request->will_id)->where('status', '!=', 'D');
     if(@$request->witness_id){
        $witness = $witness->where('id', '!=', @$request->witness_id);
     }
     $witness = $witness->first();
        //return $witness;
      if(@$witness && @$witness->sign_date != @$sign_date) {
        return response('false');
      } else {
        return response('true');
      }

    }


    public function checkAadharNumber(Request $request)
    {
        $user = Witness::where(['aadhar_number' => trim($request->aadhar_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->witness_id)->first();

        $executor = Executor::where(['aadhar_number' => trim($request->aadhar_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->first();

        $beneficiary = Beneficiaries::where(['aadhar_number' => trim($request->aadhar_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->first();

        if(@$user || @$executor || @$beneficiary) {
            return response('false');
        } else {
            return response('true');
        }
    }

}
