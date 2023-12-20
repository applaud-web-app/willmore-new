<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $chkTocken = User::where('user_password_resets',@$token)->first();
 
        if(!@$chkTocken){
            return redirect()->route('user.error.msg')->with('error', 'This link has been expired.');
        }
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $chkTocken->email]
        );
    }

    public function reset(Request $request)
    {
        // dd($request->all());

        if($request->password == $request->password_confirmation && $request->password){
            $user_password_resets = $request->id;
            $update['password'] = Hash::make($request->password);
            $update['user_password_resets'] = null;
            $admin = User::Where('user_password_resets',$user_password_resets)->update($update);
            if($admin) {
                return redirect()->route('user.success.msg')->with('success','Password changed successfully !');
            } else {
                return redirect()->back()->with('error','Somthing went be wrong');
            }
        } else {
            return redirect()->back()->with('error','Password and Confirm Password not matched');
        }
    }

    public function broker()
    {
        return Password::broker('');
    }

    protected function guard()
    {
        return Auth::guard('auth');
    }
}
