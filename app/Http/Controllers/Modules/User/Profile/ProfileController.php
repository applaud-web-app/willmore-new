<?php

namespace App\Http\Controllers\Modules\User\Profile;

use App\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Mail\UserEmailVerifyMail;
use App\Mail\ChangeEmailToPrevMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function profile()
    {
        // $data['countrys'] = Country::get();
        $countries = getCountryFromApi();
        $data['countrys'] = $countries;
        $data['user'] = User::where('id',Auth::id())->first();
        $data['states'] = getStateFromApi($data['user']->country);
    	return view('modules.user.profile.edit_profile')->with($data);
    }

    public function update(Request $request)
    {
       
        $this->validate($request, [
            'address1'     =>['required','max:200'],
            'address2'     =>['required','max:200'],
            'city'        =>['required','max:100'],
            'state'       =>['required','max:100'],
            'country_id'  =>'required',
            'zip_code'    => ['required','max:10'],
            'first_name' =>['required','max:100'],
            'middle_name' =>'max:100',
            'last_name' =>['required','max:100'],
            'dob' =>'required',
          'gender' =>'required',
        ]);

        $user = Auth::user();

        $input['name'] = $request->middle_name ? $request->first_name.' '.$request->middle_name.' '.$request->last_name : $request->first_name.' '.$request->last_name;

        if(strlen($input['name']) > 255){
            return redirect()->back()->withInput()->with('error','Please enter not more than 255 characters for First Name, Middle Name and Last Name');
        }

        if(@$request->aadhar_number == '' && @$request->passport_number == ''){
            return redirect()->back()->withInput()->with('error','Please fill atleast one of these fields - Aadhar Number or Passport Number');
        }

        $input['first_name']      = $request->first_name;
        $input['last_name']       = $request->last_name;
        $input['middle_name']     = $request->middle_name;
        $input['dob']             = date('Y-m-d',strtotime($request->dob));
        $input['gender']          = $request->gender;
        $input['aadhar_number']   = $request->aadhar_number;
        $input['pan_number']      = @$request->pan_number ? strtoupper(@$request->pan_number) : @$request->pan_number;
        $input['passport_number'] = @$request->passport_number ? strtoupper(@$request->passport_number) : @$request->passport_number;

        $input['address1']    = $request->address1;
        $input['address2']    = $request->address2;
        $input['city']        = $request->city;
        $input['zip_code']    = $request->zip_code;
        $input['country']     = $request->country_id;
        $input['state']       = $request->state;

        if(@$request->profile_picture){

            $unlnk=User::where('id', @$user->id)->first();
            @$prev_pdf = $unlnk->profile_picture;

            if($prev_pdf){
               @unlink('storage/app/public/profile_picture/'.$prev_pdf);
            }

            $image = $request->profile_picture;
            $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/profile_picture', $image, $filename);

        $input['profile_picture'] = $filename;
        }

        User::where('id', $user->id)->update($input);

        return redirect()->back()->with('success', 'Profile updated successfully.');

    }

    public function updateEmail(Request $request)
    {
        if(@$request->email){

            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:200'
                  ],
              ]);

            $input['temp_email']    = $request->email;
            $input['vcode']         = rand(10000,99999);
            User::where('id', Auth::User()->id)->update($input);
            $user = User::where('id', Auth::User()->id)->where('status', '!=', 'D')->first();

            $creates['link']        = route('verify', [@$user->vcode,md5(@$user->id), 'type'=>'true']);
            $creates['name']        = $user->name;
            $creates['email']       = $user->temp_email;
            $prevemail['name']      =$user->name;
            $prevemail['email']     =$user->email;
            $prevemail['prevemail'] =$user->email;
            $prevemail['newemail']  =$user->temp_email;
            Mail::send(new ChangeEmailToPrevMail($prevemail));
            Mail::send(new UserEmailVerifyMail($creates));

            return redirect()->back()->with('success', 'A verification link has been sent to your mail '.@$request->email.', Please verify email.');
        }

        if(@$request->mobile){
            $this->validate($request, [
                'mobile' => ['required', 'max:10'],
                'phonecode' => ['required'],
              ]);

            $input['temp_mobile']    = $request->mobile;
            $input['temp_phonecode']    = $request->phonecode;
            $input['ph_vcode']       = rand(10000,99999);
            User::where('id', Auth::User()->id)->update($input);
            $user = User::where('id', Auth::User()->id)->where('status', '!=', 'D')->first();

            return redirect()->route('verify.otp', [md5(@$user->id), 'type'=>'true']);
        }

        return redirect()->back()->with('error', 'Something went wrong');

    }

    public function userEmailCheck(Request $request)
    {

     $user = User::where('email', trim($request->email))->where('status', '!=', 'D')->first();
      if(@$user) {
          return response('false');
      } else {
          return response('true');
      }
    }

    public function userMobileCheck(Request $request)
    {

     $user = User::where([
                  'mobile' => trim($request->mobile)
                ])
                  ->where('status', '!=', 'D')
                  ->first();

      if(@$user) {
          return response('false');
      } else {
          return response('true');
      }

    }

    public function verifyOTP(Request $request, $uid = null)
    {

        if($request->otp && $request->user_id){

            $user = User::where('ph_vcode', $request->otp)->where('id', $request->user_id)->first();
            if (@$user->ph_vcode != null) {
                //dd($request->otp,$user->vcode,$user);
                $update = [];
                $update['ph_vcode'] = null;
                $update['status'] = 'A';
                $update['mobile'] = $user->temp_mobile;
                $update['phonecode'] = $user->temp_phonecode;
                $update['temp_mobile'] = null;
                $update['temp_phonecode'] = null;
                $update['is_mobile_verified'] = 'Y';
                User::where('id', $request->user_id)->update($update);

                if(@$user->is_email_verify == 'N'){
                    return redirect()->route('user.profile')->with('success', 'Thanks for signing up! Your mobile number is verified successfully. Now you can Sign in with your mobile number and password. Please verify your email. A verification link has been sent to your email. If not found, check your spam folder too.');
                }else{
                    return redirect()->route('user.profile')->with('success', 'Your mobile number is verified successfully. Now you can Sign in with your mobile number and password.');
                }


            }else{
                return redirect()->back()->with('error', 'Please Enter correct OTP');
            }

        }

            $user = User::where(\DB::raw('MD5(id)'), $uid)->first();
            if (@$uid != null && @$user->ph_vcode != null)
            {
                $data['vcode']  = @$user->ph_vcode;
                $data['userid'] = @$user->id;
                return view('auth.verifyOtp')->with(@$data);
            }
            else
            {
                return redirect()->route('login')->with('error', 'Your verification link has been expired.');
            }
    }

    public function changePassword()
    {
    	return view('modules.user.profile.change_password');
    }

    public function passwordUpdate(Request $request)
    {
        $user = Auth::user();
        if (!empty($request->old_password) && !empty($user)) {
            if (\Hash::check($request->old_password, $user->password)) {
                $password = \Hash::make($request->password);
                User::where('id', $user->id)->update(['password' => $password]);
            }else {
                return redirect()->back()->with('error', 'Current  password does not match please try again!');
            }
        }else{
            if((auth()->user()->password==NULL) && @$request->password){
                $password = \Hash::make($request->password);
                User::where('id', auth()->user()->id)->update(['password' => $password]);
            }
        }

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    /**
     *   Method      : verifyEmail
     *   Description : Dashboard Email verify
     *   Author      : sourav
     *   Date        : 2023-APR-18
    **/
    public function verifyEmail(Request $request)
    {
        if(@$request->id){

            $input['vcode']         = rand(10000,99999);
            User::where('id', Auth::User()->id)->update($input);
            $user = User::where('id', Auth::User()->id)->where('status', '!=', 'D')->first();

            $creates['link']        = route('verify.email', [@$user->vcode,md5(@$user->id), 'type'=>'true']);
            $creates['name']        = $user->name;
            $creates['email']       = $user->email;
            Mail::send(new UserEmailVerifyMail($creates));

            return response()->json(['success'=>'Varification link send successfully']);
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }


    /**
     *   Method      : verifyMobile
     *   Description : Dashboard Mobile verify
     *   Author      : sourav
     *   Date        : 2023-APR-18
     **/
    public function verifyMobile(Request $request)
    {
        $user = User::where('id', Auth::User()->id)->where('status', '!=', 'D')->first();

        if(@$user){

            $input['ph_vcode']       = rand(10000,99999);
            User::where('id', Auth::User()->id)->update($input);

            return redirect()->route('verify.mobile.otp', [md5(@$user->id), 'type'=>'true']);
        }

        return redirect()->back()->with('error', 'Something went wrong');

    }


    /**
     *   Method      : verifyMobile
     *   Description : Dashboard Mobile OTP verify
     *   Author      : sourav
     *   Date        : 2023-APR-18
     **/
    public function verifyMobileOTP(Request $request, $uid = null)
    {

        if($request->otp && $request->user_id){

            // $user = User::where('ph_vcode', $request->otp)->where('id', $request->user_id)->first();
            $user = User::where('id', $request->user_id)->first();
            if (@$user->ph_vcode != null) {
                //dd($request->otp,$user->vcode,$user);
                $update = [];
                $update['ph_vcode'] = null;
                $update['status'] = 'A';
                $update['is_mobile_verified'] = 'Y';
                User::where('id', $request->user_id)->update($update);


                return redirect()->route('user.dashboard')->with('success', 'Your mobile number is verified successfully. Now you can Sign in with your mobile number and password.');
            }else{
                return redirect()->back()->with('error', 'Please Enter correct OTP');
            }

        }

            $user = User::where(\DB::raw('MD5(id)'), $uid)->first();
            if (@$uid != null && @$user->ph_vcode != null)
            {
                $data['vcode']  = @$user->ph_vcode;
                $data['userid'] = @$user->id;
                $data['phone_number'] = "+".@$user->phonecode.@$user->mobile;
                $data['page'] = 'Dash';
                return view('auth.verifyOtp')->with(@$data);
            }
            else
            {
                return redirect()->route('login')->with('error', 'Your verification link has been expired.');
            }
    }
}
