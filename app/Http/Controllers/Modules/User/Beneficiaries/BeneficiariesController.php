<?php

namespace App\Http\Controllers\Modules\User\Beneficiaries;

use Mail;
use App\User;
use App\Models\Cash;
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

class BeneficiariesController extends Controller
{

    public function manageBeneficiaries(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        $existWill = WillMaster::whereHas('getPackage.packageDetail', function($q){
            $q->where('id',1);})->where('id',@$willID)->where('user_id', Auth::id())->first();

        // $currentWill = WillMaster::whereHas('getPackage.packageDetail', function($q){
        //     $q->whereIn('id', [2,3]);})->where('user_id', Auth::id())->where('id', @$willID)->first();

        if(@$existWill){

            $data['beneficiaries'] = Beneficiaries::where('will_master_id', @$existWill->id)->where('status','A');
            // $data['exe_will_id'] = @$existWill->id;
        }
        else {

        //     // $data['beneficiaries'] = Beneficiaries::with('downAccess')->where('will_master_id',@$willID)->where('status','A');

        // }

            $data['beneficiaries'] = Beneficiaries::where('user_id', Auth::id())->where('status','A');
        }
        $data['user'] = User::where('id',Auth::id())->first();
        $data['beneficiaries'] = $data['beneficiaries']->orderBy('id','desc')->paginate(10);
        $data['will_id'] = $willID;

        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();
        $data['currentWill'] = WillMaster::where('id',@$willID)->first();

        $data['existAccessW'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','W')->pluck('ben_id')->toArray();
        $data['existAccessL'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','L')->pluck('ben_id')->toArray();
        $data['existAccessLI'] = WillDownloadAccess::where('will_id',@$willID)->where('access_type','LI')->pluck('ben_id')->toArray();

        // dd($data['beneficiaries']);
    	return view('modules.user.beneficiaries.manage_beneficiaries')->with($data);
    }

    public function addBeneficiaries(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }
        $data['will_id'] = $willID;
        $data['countrys'] = Country::get();
        $data['nationality'] = Nationality::get();
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();

        $data['executor'] = Executor::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['cash'] = Cash::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.beneficiaries.add_beneficiaries')->with($data);
    }

    public function viewBeneficiar(Request $request, $willID=null, $slug=null)
    {
        if($willID==null || empty($willID) || $slug==null || empty($slug)){
            abort(404);
        }

        $data['beneficiarDetail'] = Beneficiaries::where('will_master_id',@$willID)->where('slug',@$slug)->where('status','A')->first();

        $data['countrys'] = Country::get();
        $data['nationality'] = Nationality::get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['will_id'] = $willID;
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();

    	return view('modules.user.beneficiaries.view_beneficiaries')->with($data);
    }

    public function saveBeneficiaries(Request $request)
    {
        $this->validate($request, [
          'first_name' =>'required',
          'middle_name' =>'max:100',
          'last_name' =>'required',
          'email' => ['required', 'string', 'email', 'max:255'],
          'mobile' => ['required', 'string', 'max:255'],
          'country_id' =>'required',
          'phonecode' =>'required',
          //'aadhar_number' =>'required',
          'nationality' =>'required',
          'user_relation' =>'required',
          'relationship' =>'required',
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
        $creates['phonecode']        = @$request->phonecode;
        if($request->doc_type==1){
            $creates['aadhar_number']   = @$request->card_number;
        }elseif($request->doc_type==3){
            $creates['passport_number']   = @$request->card_number;
        }
        else{
            $creates['pan_number']   = @$request->card_number;
        }
        $creates['nationality']     = $request->nationality;
        $creates['user_relation']   = $request->user_relation;
        $creates['relationship']    = $request->relationship;
        $creates['address1']        = $request->address1;
        $creates['address2']        = $request->address2;
        $creates['address3']        = $request->address3;
        $creates['city']            = $request->city;
        $creates['state']           = $request->state;
        $creates['zip_code']        = $request->zip_code;
        $creates['status']          = 'A';
        $creates['is_new_person']   = @$request->is_new_person ? @$request->is_new_person : 'N';

        //dd($creates);
        $beneficiaries = Beneficiaries::create($creates);

        //update slug and username
        $updateDat['username'] = $this->checkDuplicateRecursive($request->first_name,$request->last_name,$beneficiaries->id);
        $updateDat['slug'] = str_slug($creates['name']).'-'.$beneficiaries->id;
        Beneficiaries::where('id',$beneficiaries->id)->update($updateDat);

        if(@$beneficiaries){

            $locPack = WillMasterPackage::where('will_master_id', @$beneficiaries->will_master_id)->first();
            if($locPack->package_id ==1){
                $type = 'W';
            }else if($locPack->package_id ==2){
                $type = 'L';
            }else if($locPack->package_id ==3){
                $type = 'LI';
            }else if($locPack->package_id ==5){
                $type = 'AMD';
            }

            $ins['will_id']      = $beneficiaries->will_master_id;
            $ins['ben_id']       = $beneficiaries->id;
            $ins['access_type']  = $type;
            $ins['user_type']    = 'B';

            if($locPack->package_id !=1){
            WillDownloadAccess::create($ins);
            }
        }

        if(@$request->SaveConti == 'SQ'){

            $witness = Cash::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$witness >0){
                return redirect()->route('user.manage.cash',[@$request->will_id])->with('success', 'Beneficiary added successfully');
            }
            return redirect()->route('user.add.cash',[@$request->will_id])->with('success', 'Beneficiary added successfully');
        }

        if(@$request->newperson == 'Y'){
            if($locPack->package_id == 5){
                return redirect()->route('user.service.authorized',[@$request->will_id])->with('success', 'Trusted Added successfully');
            }
            return redirect()->route('user.service.authorized',[@$request->will_id])->with('success', 'Nominee Added successfully');
        }

        return redirect()->route('user.manage.beneficiaries',[@$request->will_id])->with('success', 'Beneficiary added successfully');
    }

    public function updateBeneficiaries(Request $request, $willID=null, $slug=null)
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
            'address1' =>'required',
            'address2' =>'required',
            'city' =>'required',
            'state' =>'required',
            'zip_code' =>'required',
            ]);

            $beneficiaries = Beneficiaries::where('id',$request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->where('status','=',"A")->first();

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
            
            if($request->doc_type==1){
                $creates['aadhar_number']   = @$request->card_number;
                $creates['pan_number']   = null;
                $creates['passport_number']   = null;
            }elseif($request->doc_type==3){
                $creates['aadhar_number']   = null;
                $creates['pan_number']   = null;
                $creates['passport_number']   = @$request->card_number;
            }else{
                $creates['pan_number']   = @$request->card_number;
                $creates['aadhar_number']   = null;
                $creates['passport_number']   = null;
            }

            $creates['nationality']     = $request->nationality;
            $creates['user_relation']   = $request->user_relation;
            $creates['relationship']    = $request->relationship;
            $creates['address1']        = $request->address1;
            $creates['address2']        = $request->address2;
            $creates['address3']        = $request->address3;
            $creates['city']            = $request->city;
            $creates['state']           = $request->state;
            $creates['zip_code']        = $request->zip_code;
            $creates['status']          = 'A';
            $creates['is_new_person']   = @$request->is_new_person ? @$request->is_new_person : 'N';

            Beneficiaries::where('id', $request->id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);


            if(@$request->SaveConti == 'SQ'){

                $witness = Cash::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
                if(@$witness >0){
                    return redirect()->route('user.manage.cash',[@$request->will_id])->with('success', 'Beneficiary updated successfully');
                }
                return redirect()->route('user.add.cash',[@$request->will_id])->with('success', 'Beneficiary updated successfully');
            }

            if(@$request->newperson == 'Y'){
                return redirect()->route('user.service.authorized',[@$request->will_id])->with('success', 'Nominee updated successfully');
            }

            if(@$request->newperson == 'T'){
                return redirect()->route('user.service.authorized',[@$request->will_id])->with('success', 'Trusted updated successfully');
            }

            return redirect()->route('user.manage.beneficiaries',[@$request->will_id])->with('success', 'Beneficiary updated successfully');
        }

        if($willID==null || empty($willID) || $slug==null || empty($slug)){
            abort(404);
        }

        $data['beneficiarDetail'] = Beneficiaries::where('will_master_id',@$willID)->where('slug',@$slug)->where('status','A')->first();

        $data['countrys'] = Country::get();
        $data['nationality'] = Nationality::get();
        $data['user'] = User::where('id',Auth::id())->first();
        $data['will_id'] = $willID;
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();

        $data['executor'] = Executor::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['cash'] = Cash::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.beneficiaries.edit_beneficiaries')->with($data);

    }

    public function deleteBeneficiar(Request $request , $id)
    {
        $checkWillAssets = checkWillAssetsExist($id);

        if($checkWillAssets == true){
            return redirect()->back()->with('error','Beneficiary cannot be deleted, will assets are associated with this beneficiary.');
        }

        // $existWillAccess = WillDownloadAccess::where('ben_id', $id)->first();
        // if(@$existWillAccess != null){
        //     return redirect()->back()->with('error','Beneficiary cannot be deleted, will access are associated with this beneficiary.');
        // }

        $delBeneficiar = Beneficiaries::where('id',$id)->where('status','=',"A")->first();

        if($delBeneficiar)
        {
            Beneficiaries::where('id',$id)->delete();
            WillDownloadAccess::where('ben_id',@$delBeneficiar->id)->delete();

            return redirect()->back()->with('success','Beneficiary deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function deleteNominee(Request $request , $id)
    {

        $existWillAccess = WillDownloadAccess::where('ben_id', $id)->first();
        if(@$existWillAccess != null){
            return redirect()->back()->with('error','Nominee cannot be deleted, will access are associated with this Nominee.');
        }

        $delBeneficiar = Beneficiaries::where('id',$id)->where('status','=',"A")->first();

        if($delBeneficiar)
        {
            Beneficiaries::where('id',$id)->delete();
            WillDownloadAccess::where('ben_id',@$delBeneficiar->id)->delete();

            return redirect()->back()->with('success','Nominee deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function beneficiariesEmailCheck(Request $request)
    {

     $beneficiaries = Beneficiaries::where('email', trim($request->email))->where('status', '!=', 'D')->first();
      if(@$beneficiaries) {
          return response('false');
      } else {
          return response('true');
      }
    }

    public function beneficiariesMobileCheck(Request $request)
    {

     $beneficiaries = Beneficiaries::where([
                  'mobile' => trim($request->mobile)
                ])
                  ->where('status', '!=', 'D')
                  ->first();

      if(@$beneficiaries) {
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

        $find = Beneficiaries::where('username',$username)->where('status', '!=', 'D')->count();

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
     *   Method      : approveLocationBeneficiaries
     *   Description : Approve Beneficiaries for Will Location Storage
     *   Author      : Sourav
     *   Date        : 2022-DEC-20
    **/
    public function approveLocationBeneficiaries($id=null, $will_id=null)
    {

        $existAccess = WillDownloadAccess::where('ben_id',$id)->where('will_id',@$will_id)->where('access_type','L')->first();

        if(@$existAccess)
        {
            WillDownloadAccess::where('id',@$existAccess->id)->delete();

            // Mail::send(new LocationStorageCodeMail($creates));

            return redirect()->back()->with('success','Beneficiaries storage location access revoked successfully.');
        }
        else {

            $ins['will_id']      = @$will_id;
            $ins['ben_id']       = $id;
            $ins['access_type']  = 'L';
            $ins['user_type']    = 'B';

            WillDownloadAccess::create($ins);

            return redirect()->back()->with('success','Beneficiaries storage location access approved successfully.');
        }

        return redirect()->back()->with('error','Somthing went be wrong.');
    }

    /**
     *   Method      : approveLoiBeneficiaries
     *   Description : Approve Beneficiaries for Will Location Storage
     *   Author      : Sourav
     *   Date        : 2022-DEC-20
    **/
    public function approveLoiBeneficiaries($id=null, $will_id=null)
    {

        $existAccess = WillDownloadAccess::where('ben_id',$id)->where('will_id',@$will_id)->where('access_type','LI')->first();

        if(@$existAccess)
        {
            WillDownloadAccess::where('id',@$existAccess->id)->delete();

            // Mail::send(new LocationStorageCodeMail($creates));

            return redirect()->back()->with('success','Beneficiaries LOI access revoked successfully.');
        }
        else {

            $ins['will_id']      = @$will_id;
            $ins['ben_id']       = $id;
            $ins['access_type']  = 'LI';
            $ins['user_type']    = 'B';

            WillDownloadAccess::create($ins);

            return redirect()->back()->with('success','Beneficiaries LOI access approved successfully.');
        }

        return redirect()->back()->with('error','Somthing went be wrong.');
    }

    /**
     *   Method      : approveWillBeneficiaries
     *   Description : Approve Beneficiaries for Final Will
     *   Date        : 2022-DEC-20
    **/
    public function approveWillBeneficiaries($id=null, $will_id=null)
    {

        $existAccess = WillDownloadAccess::where('ben_id',$id)->where('will_id',@$will_id)->where('access_type','W')->first();

        if(@$existAccess)
        {
            WillDownloadAccess::where('id',@$existAccess->id)->delete();

            // Mail::send(new LocationStorageCodeMail($creates));

            return redirect()->back()->with('success','Beneficiaries Final Will access revoked successfully.');
        }
        else {

            $ins['will_id']      = @$will_id;
            $ins['ben_id']       = $id;
            $ins['access_type']  = 'W';
            $ins['user_type']    = 'B';

            WillDownloadAccess::create($ins);

            return redirect()->back()->with('success','Beneficiaries Final Will access approved successfully.');
        }

        return redirect()->back()->with('error','Somthing went be wrong.');
    }

    /**
     *   Method      : checkMobile
     *   Description : Duplicate Beneficiaries Mobile Check on insert & Update
     *   Author      : Sourav
     *   Date        : 2022-DEC-26
    **/
    public function checkMobile1(Request $request)
    {

        $user = Beneficiaries::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->where('id','!=', @$request->id)->first();
        $executor = Executor::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->first();

        if(@$user || @$executor) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function checkMobile(Request $request)
    {
        $packeg = WillMasterPackage::where('will_master_id',@$request->will_id)->first();

        if(@$packeg->package_id ==1){
            $user = Beneficiaries::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->id)->first();

            // $executor = Executor::where(['mobile' => trim($request->mobile)])->where('will_master_id',$request->will_id)->where('user_id', Auth::id())->first();

        }else{
            $user = Beneficiaries::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->where('id','!=', @$request->id)->first();

            // $executor = Executor::where(['mobile' => trim($request->mobile)])->where('user_id', Auth::id())->first();
        }

        // if(@$packeg->package_id == 2){

        //     $exe = Executor::where('mobile', $request->mobile)->where('user_id', Auth::id())->first();
        //     $executor = WillDownloadAccess::where('exe_id',@$exe->id)->where('will_id',$request->will_id)->where('access_type', 'L')->first();


        //     $ben = Beneficiaries::where('mobile', $request->mobile)->where('user_id', Auth::id())->first();
        //     $user = WillDownloadAccess::where('ben_id',@$ben->id)->where('will_id',$request->will_id)->where('access_type', 'L')->first();
        // }

        // if(@$packeg->package_id == 3){

        //     $exe = Executor::where('mobile', $request->mobile)->where('user_id', Auth::id())->first();
        //     $executor = WillDownloadAccess::where('exe_id',@$exe->id)->where('will_id',$request->will_id)->where('access_type', 'LI')->first();

        //     $ben = Beneficiaries::where('mobile', $request->mobile)->where('user_id', Auth::id())->first();
        //     $user = WillDownloadAccess::where('ben_id',@$ben->id)->where('will_id',$request->will_id)->where('access_type', 'LI')->first();
        // }

        if(@$user) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function checkEmail(Request $request)
    {
        $user = Beneficiaries::where(['email' => trim($request->email)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->id)->first();

        // $executor = Executor::where(['email' => trim($request->email)])->where('will_master_id',$request->will_id)->where('user_id', Auth::id())->first();

        if(@$user) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function checkAadharNumber(Request $request)
    {
        $user = Beneficiaries::where(['aadhar_number' => trim($request->aadhar_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->id)->first();

        // $executor = Executor::where(['aadhar_number' => trim($request->aadhar_number)])->where('will_master_id',$request->will_id)->where('user_id', Auth::id())->first();

        $witness = Witness::where(['aadhar_number' => trim($request->aadhar_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->first();

        if(@$user || @$witness) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function checkPanNumber(Request $request)
    {
        $user = Beneficiaries::where(['pan_number' => trim($request->pan_number)])->where('user_id', Auth::id())->where('will_master_id',$request->will_id)->where('id','!=', @$request->id)->first();

        //$executor = Executor::where(['pan_number' => trim($request->pan_number)])->where('will_master_id',$request->will_id)->where('user_id', Auth::id())->first();

        if(@$user) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function yourDetails(Request $request,$willID){
        if($willID==null || empty($willID)){
            abort(404);
        }
        $data['will_id'] = $willID;
        $data['countrys'] = getCountryFromApi();
        $data['nationality'] = Nationality::get();
        $data['locPack'] = WillMasterPackage::where('will_master_id',@$willID)->first();

        $data['executor'] = Executor::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
        $data['cash'] = Cash::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();
    	return view('modules.user.beneficiaries.your-details')->with($data);
    }

    public function saveYourDetails(Request $request){
        User::where('id',Auth::id())->update([
            'aadhar_number'=>$request->aadhar_number,
            'pan_number'=>$request->pan_number,
            'passport_number'=>$request->passport_number,
            'place_of_issue'=>$request->place_of_issue,
            'passport_expiry_date'=>date("Y-m-d",strtotime($request->passport_expiry_date)),
            'nationality'=>$request->nationality,
            'user_relation'=>$request->user_relation,
            'relationship'=>$request->relationship,
        ]);
        return redirect('manage-executor/'.$request->will_id)->with('success','Your Details Updated Successfully...');
    }


}
