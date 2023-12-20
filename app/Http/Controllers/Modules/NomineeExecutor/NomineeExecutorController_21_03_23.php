<?php

namespace App\Http\Controllers\Modules\NomineeExecutor;

use App\Models\Executor;
use App\Models\WillMaster;
use App\Mail\SendNomineeOTP;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\WillMasterPackage;
use App\Models\WillDownloadAccess;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class NomineeExecutorController extends Controller
{
     /**
    *   Method      : loginForm
    *   Description : This is use to NomineeExecutor login Form.
    *   Author      : Sourav
    *   Date        : 13-DEC-2022
    **/
    public function loginForm(Request $request)
    {
    	return view('modules.nominee_executor.nominee_executor_login');
    }

    public function customLogin(Request $request)
    {
        $mainWill = WillMaster::where('will_code', $request->code)->first();
        if(@$mainWill){

            $checkBeneMobile = Beneficiaries::where('mobile', $request->mobile)->first();
            if(@$checkBeneMobile && @$checkBeneMobile->phonecode != 101){
                return redirect()->route('nominee.executor.login')->with('error', 'Mobile number is not available in India, please enter your email address to receive an OTP.');
            }
            $checkExeMobile = Executor::where('mobile', $request->mobile)->first();
            if(@$checkExeMobile && @$checkExeMobile->phonecode != 101){
                return redirect()->route('nominee.executor.login')->with('error', 'Mobile number is not available in India, please enter your email address to receive an OTP.');
            }

            $checkBenEmail = Beneficiaries::where('email', @$request->mobile)->first();
            $checkExeEmail = Executor::where('email', @$request->mobile)->first();

            $isEmail = false;
            if(@$checkBenEmail || @$checkExeEmail){
                $isEmail = true;
            }

            $packeg = WillMasterPackage::where('will_master_id',@$mainWill->id)->first();
            // dd($packeg);
            if($packeg->package_id ==1){

                $executor = Executor::where('will_master_id', $mainWill->id)->where('mobile', $request->mobile)->orWhere('email', @$request->mobile)->first();
                $beneficiaries = Beneficiaries::where('will_master_id', $mainWill->id)->where('mobile', $request->mobile)->orWhere('email', @$request->mobile)->first();

                if(@$executor){
                    $existExeAccess = WillDownloadAccess::where('will_id', $mainWill->id)->where('exe_id', @$executor->id)->where('access_type', 'W')->first();
                }
                if(@$beneficiaries){
                    $existBenAccess = WillDownloadAccess::where('will_id', $mainWill->id)->where('ben_id', @$beneficiaries->id)->where('access_type', 'W')->first();
                }
                // dd($beneficiaries);
            }

            if($packeg->package_id == 2){

                $executor = Executor::where('user_id', $mainWill->user_id)->where('mobile', $request->mobile)->orWhere('email', @$request->mobile)->whereHas('downAccessL', function($q){
                        $q->where('access_type', 'L');})->first();
                $beneficiaries = Beneficiaries::where('user_id', $mainWill->user_id)->where('mobile', $request->mobile)->orWhere('email', @$request->mobile)->whereHas('downAccessL', function($q){
                    $q->where('access_type', 'L');})->first();

                if(@$executor){
                    $existExeAccess = WillDownloadAccess::where('will_id', $mainWill->id)->where('exe_id', @$executor->id)->where('access_type', 'L')->first();
                }
                if(@$beneficiaries){
                    $existBenAccess = WillDownloadAccess::where('will_id', $mainWill->id)->where('ben_id', @$beneficiaries->id)->where('access_type', 'L')->first();
                }

            }

            if($packeg->package_id == 3){

                $executor = Executor::where('user_id', $mainWill->user_id)->where('mobile', $request->mobile)->orWhere('email', @$request->mobile)->whereHas('downAccessLI', function($q){
                    $q->where('access_type', 'LI');})->first();
                $beneficiaries = Beneficiaries::where('user_id', $mainWill->user_id)->where('mobile', $request->mobile)->orWhere('email', @$request->mobile)->whereHas('downAccessLI', function($q){
                    $q->where('access_type', 'LI');})->first();
                if(@$executor){
                    $existExeAccess = WillDownloadAccess::where('will_id', $mainWill->id)->where('exe_id', @$executor->id)->where('access_type', 'LI')->first();
                }
                if(@$beneficiaries){
                    $existBenAccess = WillDownloadAccess::where('will_id', $mainWill->id)->where('ben_id', @$beneficiaries->id)->where('access_type', 'LI')->first();
                }
                // dd(@$beneficiaries);
            }

            if(@$existExeAccess){

                if(@$isEmail && @$executor->phonecode != 101){
                    $upd['pnonecode']= mt_rand(100000,999999);
                    $data['email'] = @$executor->email;
                    $data['name'] = @$executor->name;
                    $data['otp'] = $upd['pnonecode'];
                    Executor::where('id',$executor->id)->update($upd);
                    Mail::send(new SendNomineeOTP($data));
                    Session::put('will_code', $request->code);
                    return redirect()->route('executor.otp.verification',['exe_id'=> @$executor->id,'isEmail'=>true]);
                }

                $upd['pnonecode']= mt_rand(100000,999999);

                Executor::where('id',$executor->id)->update($upd);
                // // dd($executor->id);
                // Session::put('mobile_otp', $upd['pnonecode']);
                Session::put('will_code', $request->code);
                return redirect()->route('executor.otp.verification',['exe_id'=> @$executor->id]);
            }
            if(@$existBenAccess){
                // dd(@$existBenAccess);
                if(@$isEmail && @$beneficiaries->phonecode != 101){

                    $upd['pnonecode']= mt_rand(100000,999999);
                    $data['email'] = @$beneficiaries->email;
                    $data['name'] = @$beneficiaries->name;
                    $data['otp'] = $upd['pnonecode'];
                    Beneficiaries::where('id',$beneficiaries->id)->update($upd);
                    Mail::send(new SendNomineeOTP($data));
                    Session::put('will_code', $request->code);
                    return redirect()->route('nominee.otp.verification',['ben_id'=> @$beneficiaries->id,'isEmail'=>true]);
                }
                $upd['pnonecode']= mt_rand(100000,999999);

                Beneficiaries::where('id',$existBenAccess->ben_id)->update($upd);
                // // dd($beneficiaries->id);
                // Session::put('mobile_otp', $upd['pnonecode']);
                Session::put('will_code', $request->code);
                return redirect()->route('nominee.otp.verification',['ben_id'=> @$beneficiaries->id]);
            }
        }
        return redirect()->route('nominee.executor.login')->with('error', 'These credentials do not match our records');
    }

    public function otpPageN($ben_id=null)
    {
        $data['beneficiaries'] = Beneficiaries::where('id', @$ben_id)->first();
        $data['isEmail'] = @$_GET['isEmail'] ? true : false;

    	return view('modules.nominee_executor.nominee_executor_otp_verification')->with(@$data);
    }

    public function otpPageE(Request $request, $exe_id=null)
    {
        $data['executor'] = Executor::where('id', @$exe_id)->first();
        $data['isEmail'] = @$_GET['isEmail'] ? true : false;

    	return view('modules.nominee_executor.nominee_executor_otp_verification')->with(@$data);
    }

    public function otpVerify(Request $request)
    {
        // dd($request->all());
        $beneficiaries = Beneficiaries::where('id', @$request->ben_id)->first();
        $executor = Executor::where('id', @$request->exe_id)->first();

        if(@$beneficiaries){
            if (@$request->otp == @$beneficiaries->pnonecode ) {

                $update['pnonecode'] = null;

                Beneficiaries::where('id', @$request->ben_id)->update($update);

                // $data['beneficiaries'] = $beneficiaries;

                return redirect()->route('nominee.upload.file',['ben_id'=> @$beneficiaries->id])->with('success', 'OTP verified successfully');
            }
            return redirect()->back()->with('error', 'OTP dose not match');
        }
        if(@$executor){
            if (@$request->otp == @$executor->pnonecode ) {

                $update['pnonecode'] = null;

                Executor::where('id', @$request->exe_id)->update($update);

                // $data['executor'] = $executor;

                return redirect()->route('executor.upload.file',['exe_id'=> @$executor->id])->with('success', 'OTP verified successfully');
            }
            return redirect()->back()->with('error', 'OTP dose not match');
        }

    	return redirect()->route('nominee.executor.login')->with('error', 'OTP verification failed');
    }

    public function uploadFileN($ben_id=null){

        $data['beneficiaries'] = Beneficiaries::where('id', @$ben_id)->first();

        return view('modules.nominee_executor.nominee_executor_upload_file')->with(@$data);
    }


    public function uploadFileE($exe_id=null){

        $data['executor'] = Executor::where('id', @$exe_id)->first();

        return view('modules.nominee_executor.nominee_executor_upload_file')->with(@$data);
    }

    public function saveFile(Request $request)
    {
        // dd($request->all());

        $data['will_code'] = Session::get('will_code');
        $will_code = $data['will_code'];


        $mainWill = WillMaster::where('will_code', $will_code)->first();
        $packeg = WillMasterPackage::where('will_master_id',@$mainWill->id)->first();
        if($packeg->package_id ==1){
            $type = 'W';
        }else if($packeg->package_id ==2){
            $type = 'L';
        }else if($packeg->package_id ==3){
            $type = 'LI';
        }
        $beneficiaries = WillDownloadAccess::where('will_id', @$mainWill->id)->where('user_type', 'B')->where('ben_id', @$request->ben_id)->where('access_type', @$type)->first();
        $executor = WillDownloadAccess::where('will_id', @$mainWill->id)->where('user_type', 'E')->where('exe_id', @$request->exe_id)->where('access_type', @$type)->first();

        if(@$beneficiaries){
            $update['upload_file_type'] = $request->type;
            $update['download_file_date'] = date('Y-m-d H:i:s');
            if(@$request->file){

                $unlnk=WillDownloadAccess::where('id', @$beneficiaries->id)->first();
                @$prev_pdf = $unlnk->file;

                if($prev_pdf){
                   @unlink('storage/app/public/will_download_prof/'.$prev_pdf);
                }

                $image = $request->file;
                $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
                Storage::putFileAs('public/will_download_prof', $image, $filename);

            $update['upload_file_name'] = $filename;
            }
            WillDownloadAccess::where('id', @$beneficiaries->id)->update($update);

            // $will = WillMaster::where('will_code', @$will_code)->first();
            return redirect()->route('nominee.executor',@$will_code)->with('success', 'OTP verified successfully');
        }
        if(@$executor){

            $update['upload_file_type'] = $request->type;
            $update['download_file_date'] = date('Y-m-d H:i:s');
            if(@$request->file){

                $unlnk=WillDownloadAccess::where('id', @$executor->id)->first();
                @$prev_pdf = $unlnk->file;

                if($prev_pdf){
                    @unlink('storage/app/public/will_download_prof/'.$prev_pdf);
                }

                $image = $request->file;
                $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
                Storage::putFileAs('public/will_download_prof', $image, $filename);

            $update['upload_file_name'] = $filename;
            }
            WillDownloadAccess::where('id', @$executor->id)->update($update);

            // $data['will_code'] = Session::get('will_code');
            // $will_code = $data['will_code'];
            // $will = WillMaster::where('will_code', @$will_code)->first();
            return redirect()->route('nominee.executor',@$will_code)->with('success', 'OTP verified successfully');
        }

    	return redirect()->back()->with('error', 'Somthing Went Wrong !!');
    }


    public function downloadFile($will_code=null){

        if($will_code==null || empty($will_code)){
            abort(404);
        }

        if(checkCodeExist($will_code)== false){
            abort(404);
        }

        $data['will'] = WillMaster::where('will_code', $will_code)->first();

        // $executor = Executor::where('id', @$exe_id)->first();

        return view('modules.nominee_executor.nominee_executor')->with(@$data);
    }

    public function resendOTP($otp=null)
    {
        // dd($request->all());
        $beneficiaries = Beneficiaries::where('pnonecode', @$otp)->first();
        $executor = Executor::where('pnonecode', @$otp)->first();

        if(@$beneficiaries){
            if(@$beneficiaries->phonecode != 101){
                $data['mobile'] =  $beneficiaries->email;
                $data['isEmail'] = true;


                    $upd['pnonecode']= mt_rand(100000,999999);
                    $data['email'] = @$beneficiaries->email;
                    $data['name'] = @$beneficiaries->name;
                    $data['otp'] = $upd['pnonecode'];
                    Beneficiaries::where('id',$beneficiaries->id)->update($upd);
                    Mail::send(new SendNomineeOTP($data));
                    //Session::put('will_code', $request->code);
                    return redirect()->route('nominee.otp.verification',['ben_id'=> @$beneficiaries->id,'isEmail'=>true])->with('success', 'OTP Resend Successfully On ' .@$beneficiaries->email);

            }else{

                $data['mobile'] =  $beneficiaries->mobile;
                $data['isEmail'] = false;
                return redirect()->route('nominee.otp.verification',['ben_id'=> @$beneficiaries->id,'isEmail'=>false])->with('success', 'OTP Resend Successfully On ' .@$beneficiaries->mobile);
            }
        }

        if(@$executor){
            if(@$executor->phonecode != 101){
                $data['mobile'] =  $executor->email;
                $data['isEmail'] = true;

                $upd['pnonecode']= mt_rand(100000,999999);
                $data['email'] = @$executor->email;
                $data['name'] = @$executor->name;
                $data['otp'] = $upd['pnonecode'];
                Executor::where('id',$executor->id)->update($upd);
                Mail::send(new SendNomineeOTP($data));
                //Session::put('will_code', $request->code);
                return redirect()->route('nominee.otp.verification',['exe_id'=> @$executor->id,'isEmail'=>true])->with('success', 'OTP Resend Successfully On ' .@$executor->email);

            }else{

                $data['mobile'] =  $executor->mobile;
                $data['isEmail'] = false;
                return redirect()->route('nominee.otp.verification',['exe_id'=> @$executor->id,'isEmail'=>false])->with('success', 'OTP Resend Successfully On ' .@$beneficiaries->mobile);
            }
        }

        return redirect()->back()->with('error', 'Something went wrong! Please try again.');
    }

}
