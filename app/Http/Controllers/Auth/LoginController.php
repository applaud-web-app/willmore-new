<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Country;
use App\User;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Validation\Rule;
// use Socialite;
use DB;
use Session;
use Mail,Hash;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

     protected $redirectTo = '/dashboard';

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // dd($this->middleware('guest')->except(['handleProviderCallback','logout']));
        $this->middleware('guest')->except(['handleProviderCallback','logout']);
    }


    protected function guard()
    {
        return Auth::guard();
    }

    public function showUserLoginForm(Request $request)
    {

        if(@$request->redirect_uri){
            Session::put('redirect_uri', @$request->redirect_uri);
        }
        if(url()->previous() != url('login')) {
            session()->put('previous_url', url()->previous());
        }
        $countries = getCountryFromApi();
        $data['countrys'] = $countries;
        return view('auth.login')->with($data);
    }

    public function userLogin(Request $request){
         //  dd($request->all());
         $checkMobile = User::where('mobile',$request->email)->first();
         if(!$checkMobile){
              return redirect()->back()->withInput()->with('error','These credentials do not match our records.');
         }else{
             if(!Hash::check($request->password, $checkMobile->password)){
                 return redirect()->back()->withInput()->with('error','These credentials do not match our records.');
             }else{
                 \Session::put('OTP_MBL_FL','+'.$checkMobile->phonecode.$request->email);
                 \Session::put('OTP_MBL',$request->email);
                 return redirect("verify-login-mobile");
             }
         }
    }

    public function verifyLoginMobile(Request $request){
        if(!\Session::has('OTP_MBL_FL')){
            return redirect('login');
        }
        if(!\Session::has('OTP_MBL')){
            return redirect('login');
        }
        if($request->ajax()){
            User::where('mobile',\Session::get('OTP_MBL'))->update([
                'ph_vcode'=>$request->code
            ]);
            return response()->json(['s'=>1]);
        }

        if($request->isMethod('post')){
            $user = User::where(['mobile'=>\Session::get('OTP_MBL'),'ph_vcode'=>$request->otp])->first();
            if(!$user){
                return redirect('login')->withInput()->with('error','OTP verification failed...');
            }
            Auth::loginUsingId($user->id);
            \Session::forget('OTP_MBL_FL');
            \Session::forget('OTP_MBL');
            return redirect('dashboard');
        }

        $data['mobile_num'] = \Session::get('OTP_MBL_FL');
        return view('auth.verify-login-mobile')->with($data);
    }

    protected function credentials(Request $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password'=>$request->get('password'), 'status'=>'A', 'is_email_verify'=>'Y'];
          }
          return ['mobile' => $request->get('email'), 'password'=>$request->get('password'), 'status'=>'A', 'is_mobile_verified'=>'Y'];
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {

        $recaptcha_resp = $request->input('g-recaptcha-response');
        if (is_null($recaptcha_resp)) {
            return redirect()->back()->withInput()->with('error','Please verify recaptcha');
        }
        $secretKey = getenv('GOOGLE_RECAPTCH_SECRET_KEY');
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=".$recaptcha_resp), true);
        if($response['success'] == false){
            return redirect()->back()->withInput()->with('error','Invalid recaptcha..verify recaptch to continue');
        }

        $isMobileLogin = User::where(['mobile' => $request->get('email'), 'is_mobile_verified'=>'N'])->first();

        if($isMobileLogin){
            $creates['ph_vcode']           = rand(10000,99999);
            User::where('mobile',$request->get('email'))->update($creates);
            return redirect()->route('user.verify.otp', [md5(@$isMobileLogin->id)]);
        }

        $errors = [$this->username() => trans('auth.failed')];
        $user = \App\User::where($this->username(), $request->{$this->username()})
                            ->where('status', '!=', 'D')
                            ->first();

        if ($user && \Hash::check($request->password, $user->password)) {
            $errors = [$this->username() => "Your email address is not verified yet. Please verify it to activate your account."];
        }


        if ($user && \Hash::check($request->password, $user->password) && $user->status == 'I') {
            $errors = [$this->username() => "Your Accout is not Active."];
        }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        // dd($errors);
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function authenticated(Request $request, $user)
    {
        $user = Auth::user();
        
        User::where('id',auth()->user()->id)->update(['is_online' => 'Y']);

        $previous_url = Session::get('previous_url');
        $lastUserID = Session::get('authID');

        if(@$previous_url && @$lastUserID == auth()->user()->id){
            Session::put('previous_url', NULL);
            // return redirect()->away($previous_url);
            //  return Redirect::to($previous_url);
            return redirect()->route('user.dashboard');

        }

        $redirect_uri = Session::get('redirect_uri');
        if(@$redirect_uri){
            Session::put('redirect_uri', NULL);
            // return redirect()->away($redirect_uri);
            return redirect()->route('user.dashboard');
        }


        return redirect()->route('user.dashboard');

    }

    public function userUsernameCheck(Request $request)
    {

     $user = User::where([
                  'username' => trim($request->username)
                ])
                  ->where('status', '!=', 'D')
                  ->first();

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


    protected function validateLogin(Request $request)
    {

        // $recaptcha_resp = $request->input('g-recaptcha-response');
        // if (is_null($recaptcha_resp)) {
        //     return redirect()->back()->withInput()->with('error','Please verify recaptcha');
        // }
        // $secretKey = getenv('GOOGLE_RECAPTCH_SECRET_KEY');
        // $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=".$recaptcha_resp), true);
        // if($response['success'] == false){
        //     return redirect()->back()->withInput()->with('error','Invalid recaptcha..veriry recaptch to continue');
        // }
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }


    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    public function username()
    {
        return 'email';
    }

    public function logout(Request $request)
    {
        $lastUserID = auth()->user()->id;
        if(@auth()->user())
        {
            $udate=User::where('id',auth()->user()->id)->first();
            User::where('id',auth()->user()->id)->update([
                'is_online' => 'N',
                'last_sign_in' => date('Y-m-d')
            ]);
        }
        $this->guard()->logout();
        $request->session()->invalidate();
        Session::put('authID', $lastUserID);
        return $this->loggedOut($request) ?: redirect('/login');
    }


}
