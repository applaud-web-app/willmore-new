<?php

namespace App\Http\Controllers\Modules\User\Executor;

use App\User;
use App\Models\Country;
use App\Models\Witness;
use App\Models\Executor;
use App\Models\Packages;
use App\Models\WillMaster;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\WillMasterPackage;
use App\Models\WillDownloadAccess;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ExecutorController extends Controller
{

    public function manageExecutor(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $existWill = WillMaster::whereHas('getPackage.packageDetail', function($q){
            $q->where('id',1);})->where('id',@$willID)->where('user_id', Auth::id())->first();

        // $currentWill = WillMaster::whereHas('getPackage.packageDetail', function($q){
        //     $q->whereIn('id', [2,3]);})->where('user_id', Auth::id())->where('id', @$willID)->first();

        if(@$existWill){

            $data['executors'] = Executor::where('will_master_id',@$existWill->id)->where('status','A');
            // $data['exe_will_id'] = @$existWill->id;
        }
        else {

        //     $data['executors'] = Executor::where('will_master_id',@$willID)->where('status','A');
        // }

            $data['executors'] = Executor::where('user_id', Auth::id())->where('status','A');
        }
        $data['will_id'] = $willID;
        $data['user'] = User::where('id',Auth::id())->first();
        $data['executors'] = $data['executors']->orderBy('id','desc')->paginate(10);

        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();
        $data['currentWill'] = WillMaster::where('id',@$willID)->first();

        $data['existAccessW'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','W')->pluck('exe_id')->toArray();
        $data['existAccessL'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','L')->pluck('exe_id')->toArray();
        $data['existAccessLI'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','LI')->pluck('exe_id')->toArray();
        $data['countExecutor'] = Executor::where('user_id', Auth::id())->where('will_master_id', $willID)->where('status','=',"A")->count();

        // dd($data['existAccess']);
    	return view('modules.user.executor.manage_executor')->with($data);
    }

    public function viewExecutor(Request $request, $willID=null, $slug=null)
    {
        if($willID==null || empty($willID) || $slug==null || empty($slug)){
            abort(404);
        }

        $data['executorDetail'] = Executor::where('will_master_id',@$willID)->where('slug',@$slug)->where('status','A')->first();

        $data['countrys'] = Country::get();
        $data['nationality'] = Nationality::get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['will_id'] = $willID;

    	return view('modules.user.executor.view_executor')->with($data);
    }

    public function addExecutor(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $checkExecutor = Executor::where('user_id', Auth::id())->where('will_master_id', $willID)->where('status','=',"A")->count();
        if($checkExecutor >= 2){
            return redirect()->route('user.manage.executor',[@$willID])->with('error', 'Only 2 Executors are allowed to add');
        }

        $data['will_id'] = $willID;
        $data['countrys'] = Country::get();
        $data['nationality'] = Nationality::get();
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();

        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        // $data['witness'] = Witness::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.executor.add_executor')->with($data);
    }

    public function saveExecutor(Request $request)
    {
        $this->validate($request, [
          'first_name' =>'required',
          'middle_name' =>'max:100',
          'last_name' =>'required',
          'email' => ['required','email', 'max:255'],
          'mobile' => ['required','max:255'],
          'country_id' =>'required',
          'phonecode' =>'required',
          //'aadhar_number' =>'required',
          'nationality' =>'required',
          'user_relation' =>'required',
          'relationship' =>'required',
          'exe_willcreator_relation' =>'required',
          'address1' =>'required',
          'address2' =>'required',
          'city' =>'required',
          'state' =>'required',
          'zip_code' =>'required',
        ]);

        $creates['name'] = $request->middle_name ? $request->first_name.' '.$request->middle_name.' '.$request->last_name : $request->first_name.' '.$request->last_name;

        if(strlen($creates['name']) > 255){
            return redirect()->back()->withInput()->with('error','Please enter not more than 255 characters for First Name, Middle Name and Last Name');
        }


        $creates['user_id']         = Auth::id();
        $creates['will_master_id']  = $request->will_id;
        $creates['email']           = $request->email;
        $creates['first_name']      = $request->first_name;
        $creates['last_name']       = $request->last_name;
        $creates['middle_name']     = $request->middle_name;
        $creates['country']         = $request->country_id;
        $creates['mobile']          = @$request->mobile;
        $creates['phonecode']          = @$request->phonecode;
        $creates['aadhar_number']   = @$request->aadhar_number;
        $creates['nationality']     = $request->nationality;
        $creates['user_relation']   = $request->user_relation;
        $creates['relationship']    = $request->relationship;
        $creates['exe_willcreator_relation']    = $request->exe_willcreator_relation;
        $creates['address1']        = $request->address1;
        $creates['address2']        = $request->address2;
        $creates['address3']        = $request->address3;
        $creates['city']            = $request->city;
        $creates['state']           = $request->state;
        $creates['zip_code']        = $request->zip_code;
        $creates['status']          = 'A';

        //dd($creates);
        $executor = Executor::create($creates);

        //update slug and username
        $updateDat['username'] = $this->checkDuplicateRecursive($request->first_name,$request->last_name,$executor->id);
        $updateDat['slug'] = str_slug($creates['name']).'-'.$executor->id;
        Executor::where('id',$executor->id)->update($updateDat);

        if(@$executor){

            $locPack = WillMasterPackage::where('will_master_id', @$executor->will_master_id)->first();
            if($locPack->package_id ==1){
                $type = 'W';
            }else if($locPack->package_id ==2){
                $type = 'L';
            }else if($locPack->package_id ==3){
                $type = 'LI';
            }

            $ins['will_id']      = $executor->will_master_id;
            $ins['exe_id']       = $executor->id;
            $ins['access_type']  = $type;
            $ins['user_type']    = 'E';

            if($locPack->package_id !=1){
            WillDownloadAccess::create($ins);
            }
        }
        if(@$request->SaveConti == 'SQ'){

            $beneficiaries = Beneficiaries::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$beneficiaries >0){
                return redirect()->route('user.manage.beneficiaries',[@$request->will_id])->with('success', 'Executor added successfully');
            }
            return redirect()->route('user.add.beneficiaries',[@$request->will_id])->with('success', 'Executor added successfully');
        }

        return redirect()->route('user.manage.executor',[@$request->will_id])->with('success', 'Executor added successfully');
    }

    public function updateExecutor(Request $request, $willID=null, $slug=null)
    {
        if($request->id && $request->will_id){

            if($request->id==null || empty($request->id)){
                abort(404);
            }

            $this->validate($request, [
                'first_name' =>'required',
                'middle_name' =>'max:100',
                'last_name' =>'required',
                'email' => ['required','email', 'max:255'],
                'mobile' => ['required','max:255'],
                'country_id' =>'required',
                'phonecode' =>'required',
                //'aadhar_number' =>'required',
                'nationality' =>'required',
                'user_relation' =>'required',
                'relationship' =>'required',
                'exe_willcreator_relation' =>'required',
                'address1' =>'required',
                'address2' =>'required',
                'city' =>'required',
                'state' =>'required',
                'zip_code' =>'required',
              ]);

              $executor = Executor::where('id',$request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->where('status','=',"A")->first();

              $creates['name'] = $request->middle_name ? $request->first_name.' '.$request->middle_name.' '.$request->last_name : $request->first_name.' '.$request->last_name;

              if(strlen($creates['name']) > 255){
                return redirect()->back()->withInput()->with('error','Please enter not more than 255 characters for First Name, Middle Name and Last Name');
            }

              $creates['user_id']         = Auth::id();
              $creates['will_master_id']  = $request->will_id;
              $creates['email']           = $request->email;
              $creates['first_name']      = $request->first_name;
              $creates['last_name']       = $request->last_name;
              $creates['middle_name']     = $request->middle_name;
              $creates['country']         = $request->country_id;
              $creates['mobile']          = $request->mobile;
              $creates['phonecode']          = $request->phonecode;
              $creates['aadhar_number']   = @$request->aadhar_number;
              $creates['nationality']     = $request->nationality;
              $creates['user_relation']   = $request->user_relation;
              $creates['relationship']    = $request->relationship;
              $creates['exe_willcreator_relation']    = $request->exe_willcreator_relation;
              $creates['address1']        = $request->address1;
              $creates['address2']        = $request->address2;
              $creates['address3']        = $request->address3;
              $creates['city']            = $request->city;
              $creates['state']           = $request->state;
              $creates['zip_code']        = $request->zip_code;
              $creates['status']          = 'A';

              Executor::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);


              if(@$request->SaveConti == 'SQ'){

                $beneficiaries = Beneficiaries::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
                if(@$beneficiaries >0){
                    return redirect()->route('user.manage.beneficiaries',[@$request->will_id])->with('success', 'Executor updated successfully');
                }
                return redirect()->route('user.add.beneficiaries',[@$request->will_id])->with('success', 'Executor updated successfully');
            }

              return redirect()->route('user.manage.executor',[@$request->will_id])->with('success', 'Executor updated successfully');
        }

        if($willID==null || empty($willID) || $slug==null || empty($slug)){
            abort(404);
        }

        $data['executorDetail'] = Executor::where('will_master_id',@$willID)->where('slug',@$slug)->where('status','A')->first();

        $data['countrys'] = Country::get();
        $data['nationality'] = Nationality::get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['will_id'] = $willID;
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();

        $data['beneficiaries'] = Beneficiaries::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['countExecutor'] = Executor::where('user_id', Auth::id())->where('will_master_id', $willID)->where('status','=',"A")->count();
        // $data['witness'] = Witness::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.executor.edit_executor')->with($data);

    }

    public function deleteExecutor(Request $request , $id)
    {

        $existWillAccess = WillDownloadAccess::where('exe_id', $id)->first();
        if(@$existWillAccess != null){
            return redirect()->back()->with('error','Executor cannot be deleted, will access are associated with this executor.');
        }

        $delExecutor = Executor::where('id',$id)->where('status','=',"A")->first();

        if($delExecutor)
        {
            Executor::where('id',$id)->delete();
            WillDownloadAccess::where('exe_id',@$delExecutor->id)->delete();

            return redirect()->back()->with('success','Executor deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function executorEmailCheck(Request $request)
    {

     $executor = Executor::where('email', trim($request->email))->where('status', '!=', 'D')->first();
      if(@$executor) {
          return response('false');
      } else {
          return response('true');
      }
    }

    public function executorMobileCheck(Request $request)
    {

     $executor = Executor::where([
                  'mobile' => trim($request->mobile)
                ])
                  ->where('status', '!=', 'D')
                  ->first();

      if(@$executor) {
          return response('false');
      } else {
          return response('true');
      }

    }

    public function checkDuplicateRecursive($fname,$lname,$userId)
    {
        $fname = strtolower(substr($fname,0,1));
        $lname = strtolower(substr($lname,0,1));

        $userlength = strlen($userId);

        $totalNum = $userlength+2;

        $num = 12 - $totalNum;

        $randNum = substr(str_shuffle("0123456789"), 0, $num);

        $username  = $fname.$lname.$userId.$randNum;

        // $username = 'SB1220619584';

        $find = Executor::where('username',$username)->where('status', '!=', 'D')->count();

        if($find>0)
        {

            $this->checkDuplicateRecursive($fname,$lname,$userId);
        }

        else
        {

            return $username;

        }

    }

    /**
     *   Method      : approveLocationExecutor
     *   Description : Approve Executor for Will Location Storage
     *   Author      : Sourav
     *   Date        : 2022-DEC-16
    **/
    public function approveLocationExecutor($id=null, $will_id=null)
    {

        $existAccess = WillDownloadAccess::where('exe_id',$id)->where('will_id',@$will_id)->where('access_type','L')->first();

        if(@$existAccess)
        {
            WillDownloadAccess::where('id',@$existAccess->id)->delete();

            // Mail::send(new LocationStorageCodeMail($creates));

            return redirect()->back()->with('success','Executor storage location access revoked successfully.');
        }
        else {

            $ins['will_id']      = @$will_id;
            $ins['exe_id']       = $id;
            $ins['access_type']  = 'L';
            $ins['user_type']    = 'E';

            WillDownloadAccess::create($ins);

            return redirect()->back()->with('success','Executor storage location access approved successfully.');
        }

        return redirect()->back()->with('error','Somthing went be wrong.');
    }

    /**
     *   Method      : approveLoiExecutor
     *   Description : Approve Executor for Will Location Storage
     *   Author      : Sourav
     *   Date        : 2022-DEC-16
    **/
    public function approveLoiExecutor($id=null, $will_id=null)
    {

        $existAccess = WillDownloadAccess::where('exe_id',$id)->where('will_id',@$will_id)->where('access_type','LI')->first();

        if(@$existAccess)
        {
            WillDownloadAccess::where('id',@$existAccess->id)->delete();

            // Mail::send(new LocationStorageCodeMail($creates));

            return redirect()->back()->with('success','Executor LOI access revoked successfully.');
        }
        else {

            $ins['will_id']      = @$will_id;
            $ins['exe_id']       = $id;
            $ins['access_type']  = 'LI';
            $ins['user_type']    = 'E';

            WillDownloadAccess::create($ins);

            return redirect()->back()->with('success','Executor LOI access approved successfully.');
        }

        return redirect()->back()->with('error','Somthing went be wrong.');
    }

    /**
     *   Method      : approveWillExecutor
     *   Description : Approve Executor for Final Will
     *   Author      : Sourav
     *   Date        : 2022-DEC-21
    **/
    public function approveWillExecutor($id=null, $will_id=null)
    {

        $existAccess = WillDownloadAccess::where('exe_id',$id)->where('will_id',@$will_id)->where('access_type','W')->first();

        if(@$existAccess)
        {
            WillDownloadAccess::where('id',@$existAccess->id)->delete();

            // Mail::send(new LocationStorageCodeMail($creates));

            return redirect()->back()->with('success','Executor Final Will access revoked successfully.');
        }
        else {

            $ins['will_id']      = @$will_id;
            $ins['exe_id']       = $id;
            $ins['access_type']  = 'W';
            $ins['user_type']    = 'E';

            WillDownloadAccess::create($ins);

            return redirect()->back()->with('success','Executor Final Will access approved successfully.');
        }

        return redirect()->back()->with('error','Somthing went be wrong.');
    }

    /**
     *   Method      : checkMobile
     *   Description : Duplicate Executor Mobile Check on insert & Update
     *   Author      : Sourav
     *   Date        : 2022-DEC-26
    **/
    public function checkMobile1(Request $request)
    {

        $user = Executor::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->where('id','!=', @$request->id)->first();
        $beneficiary = Beneficiaries::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->first();

        if(@$user || @$beneficiary) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function checkMobile(Request $request)
    {
        $packeg = WillMasterPackage::where('will_master_id',@$request->will_id)->first();

        if(@$packeg->package_id ==1){
            $user = Executor::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->id)->first();

            // $beneficiary = Beneficiaries::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->first();
        }else{
            $user = Executor::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->where('id','!=', @$request->id)->first();

            // $beneficiary = Beneficiaries::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->first();
        }

        if(@$user) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function checkEmail(Request $request)
    {

        $user = Executor::where(['email' => trim($request->email)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->id)->first();
        // $beneficiary = Beneficiaries::where(['email' => trim($request->email)])->where('user_id', Auth::id())->first();

        if(@$user) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function checkAadharNumber(Request $request)
    {

        $user = Executor::where(['aadhar_number' => trim($request->aadhar_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->id)->first();

        // $beneficiary = Beneficiaries::where(['aadhar_number' => trim($request->aadhar_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->first();

        $witness = Witness::where(['aadhar_number' => trim($request->aadhar_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->first();

        if(@$user || @$witness) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function checkPanNumber(Request $request)
    {

        $user = Executor::where(['pan_number' => trim($request->pan_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->id)->first();
        //$beneficiary = Beneficiaries::where(['pan_number' => trim($request->pan_number)])->where('user_id', Auth::id())->first();

        if(@$user) {
            return response('false');
        } else {
            return response('true');
        }
    }

}
