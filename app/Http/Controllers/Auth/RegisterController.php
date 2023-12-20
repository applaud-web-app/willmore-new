<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Rules\Captcha;
use App\Models\Country;
use App\Mail\WelcomeMail;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\UserEmailVerifyMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
      * Show Register Form
      *
      * @return void
      */

    protected function register()
    {
        // $data['countrys'] = Country::get();
        $data['nationality'] = Nationality::get();
        $countries = getCountryFromApi();
        $data['countrys'] = $countries;
        return view('auth.register')->with($data);
    }

   

    public function success(){
        return view('auth.success');
    }

    public function error(){
        return view('auth.error');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorUser(array $data)
    {
        return Validator::make($data, [
            // 'g-recaptcha-response' => new Captcha(),
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        return $validator;
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

    public function saveRegisterUser(Request $request)
    {
        $this->validate($request, [
          'first_name' =>['required','max:100'],
          'middle_name' =>'max:100',
          'last_name' =>['required','max:100'],
          'email' => ['required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore('D', 'status')
            ],
            'mobile' => ['required', 'string', 'max:10',
                Rule::unique('users')->ignore('D', 'status')
            ],
          'password' =>'required|min:8|confirmed',
          'country_id' =>'required',
          'phonecode' =>'required',
          'dob' =>'required',
          'gender' =>'required',
          //'aadhar_number' =>'required',
          //'pan_number' =>'required',
        //   'nationality' =>'required',
        //   'user_relation' =>['required','max:100'],
        //   'relationship' =>['required','max:100'],
          'address1' =>['required','max:200'],
          'address2' =>['required','max:200'],
          'zip_code' =>'required',
          'city' =>['required','max:100'],
          'state' =>['required','max:100'],
        ]);

        $creates['name'] = $request->middle_name ? $request->first_name.' '.$request->middle_name.' '.$request->last_name : $request->first_name.' '.$request->last_name;

        if(strlen($creates['name']) > 255){
            return redirect()->back()->withInput()->with('error','Please enter not more than 255 characters for First Name, Middle Name and Last Name');
        }

        if(@$request->aadhar_number == '' && @$request->passport_number == ''){
            return redirect()->back()->withInput()->with('error','Please fill atleast one of these fields - Aadhar Number or Passport Number');
        }

        if(@$request->passport_number && @$request->passport_issued_date && @$request->passport_expiry_date){

            if(strtotime(@$request->passport_issued_date) > strtotime(@$request->passport_expiry_date))
            return redirect()->back()->withInput()->with('error','Passport Expiry date must be greater than issued date.');
        }

        $creates['email']           = $request->email;
        $creates['first_name']      = $request->first_name;
        $creates['last_name']       = $request->last_name;
        $creates['middle_name']     = $request->middle_name;
        $creates['password']        = Hash::make($request->password);
        $creates['country']         = $request->country_id;
        $creates['mobile']          = @$request->mobile;
        $creates['phonecode']          = @$request->phonecode;
        $creates['dob']             = date('Y-m-d',strtotime($request->dob));
        $creates['gender']          = $request->gender;
        $creates['aadhar_number']   = $request->aadhar_number;
        $creates['pan_number']      = @$request->pan_number ? strtoupper(@$request->pan_number) : @$request->pan_number;
        $creates['passport_number'] = @$request->passport_number ? strtoupper(@$request->passport_number) : @$request->passport_number;

        $creates['passport_issued_date']             = @$request->passport_issued_date ? date('Y-m-d',strtotime(@$request->passport_issued_date)) : Null;
        $creates['passport_expiry_date']             = @$request->passport_expiry_date ? date('Y-m-d',strtotime(@$request->passport_expiry_date)) : Null;
        $creates['nationality']     = $request->nationality;
        $creates['user_relation']   = $request->user_relation;
        $creates['relationship']    = $request->relationship;
        $creates['address1']        = $request->address1;
        $creates['address2']        = $request->address2;
        $creates['zip_code']        = $request->zip_code;
        $creates['city']            = $request->city;
        $creates['state']           = $request->state;
        $creates['status']          = 'U';
        $creates['vcode']           = rand(10000,99999);
        $creates['ph_vcode']        = rand(10000,99999);

        // dd($creates);
        $user = User::create($creates);


        //update slug and username
        // $updateDat['username'] = $this->checkDuplicateRecursive($request->first_name,$request->last_name,$user->id);
        $updateDat['username'] = $request->email;
        $updateDat['slug'] = str_slug($creates['name']).'-'.$user->id;
        $updateDat['client_id'] = $this->generateRandomClientId($user->id);
        User::where('id',$user->id)->update($updateDat);

        $userId = $user->id;
        $creates['id'] = $user->id;
        $creates['link'] = route('verify', [@$user->vcode,md5(@$user->id)]);

        try{
            Mail::send(new UserEmailVerifyMail($creates));
        }catch(\Exception $e){
            
        }
        
        $send_otp = $this->sendOtp($user->mobile,@$user->ph_vcode);

        //return redirect()->route('user.success.msg')->with('success', 'Thanks for signing up! Please verify your email to activate your account. A verification link has been sent to your email. If not found, check your spam folder too.');


        return redirect()->route('user.verify.otp', [md5(@$user->id)])->with('success', 'Thanks for signing up! Please verify your email to activate your account. A verification link has been sent to your email. If not found, check your spam folder too.');
        //return redirect()->route('user.verify.otp', [$creates['vcode'] ,1]);
    }

    public function generateRandomClientId($userId){
        $clientId = str_pad($userId,10,0,STR_PAD_LEFT);
        // check alrleady exists
        $cnt = User::where("client_id",$clientId)->count();
        if($cnt){
            $clientId = $clientId.rand(10,999);
        }
        return "CL".$clientId;
    }


    public function verifyOTP(Request $request, $uid = null)
    {


        if($request->otp && $request->user_id){
            // $user = User::where('ph_vcode', $request->otp)->where('id', $request->user_id)->first();
            $user = User::where('id', $request->user_id)->first();
            if (@$user->ph_vcode != null && (@$user->is_mobile_verified == 'N')) {
                //dd($request->otp,$user->vcode,$user);
                $update = [];
                $update['ph_vcode'] = null;
                $update['status'] = 'A';
                if(@$request->type=="true"){
                    $update['mobile'] = $user->temp_mobile;
                    $update['temp_mobile'] = null;
                }
                $update['is_mobile_verified'] = 'Y';
                User::where('id', $request->user_id)->update($update);

                if(@$user->is_email_verify == 'N'){
                    return redirect()->route('user.success.msg')->with('success', 'Thanks for signing up! Your mobile number is verified successfully. Now you can Sign in with your mobile number and password. Please verify your email. A verification link has been sent to your email. If not found, check your spam folder too.');
                }else{
                    return redirect()->route('user.success.msg')->with('success', 'Your mobile number is verified successfully. Now you can Sign in with your mobile number and password.');
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
            $data['phone_number'] = "+".@$user->phonecode.@$user->mobile;
            return view('auth.verifyOtp')->with(@$data);
        }
        else
        {
            return redirect()->route('login')->with('error', 'Your verification link has been expired.');
        }
    }

    public function verifyEmail(Request $request, $vcode = null, $id = null)
    {
        $user = User::where('vcode', $vcode)->where(\DB::raw('MD5(id)'), $id)->first();
        // dd($user);
            if (@$user->vcode != null && (@$user->is_email_verify == 'N' || $request->type=='true'))
            {
                $update = [];
                $update['vcode'] = null;
                $update['status'] = 'A';
                if(@$request->type=="true"){
                    $update['email'] = $user->temp_email;
                    $update['temp_email'] = null;
                }
                $update['is_email_verify'] = 'Y';
                User::where('id', $user->id)->update($update);

                $mailData['user_type'] = $user->user_type;
                $mailData['email'] = $user->email;
                $mailData['name'] = $user->name;
                $mailData['btn_link'] = route('login');;
                Mail::send(new WelcomeMail($mailData));


                if(auth()->check()){
                    return redirect()->back()->with('success', 'Your email is verified successfully.');
                }else{
                    return redirect()->route('user.success.msg')->with('success', 'Your email is verified successfully. Now you can Sign in with your email and password.');
                }
            }
            else
            {
                return redirect()->route('login')->with('error', 'Your verification link has been expired.');
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

        $find = User::where('username',$username)->where('status', '!=', 'D')->count();

        if($find>0)
        {

            $this->checkDuplicateRecursive($fname,$lname,$userId);
        }

        else
        {

            return $username;

        }

    }

//Mobile OTP Send
public function sendOtp($number,$otp){

$message = rawurlencode('Your OTP to login at willandmore.com is : '.$otp.'
This OTP will expire within the next 3 minutes.');

sendmsg($number,$message);

}

}
