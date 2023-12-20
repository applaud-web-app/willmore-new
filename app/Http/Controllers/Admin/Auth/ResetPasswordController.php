<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

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
     * Where to redirect admins after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest:admin');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $chkTocken = Admin::where('admin_password_resets',@$token)->first();
        if(!@$chkTocken){
            return redirect()->route('admin.error.msg')->with('error', 'This link has been expired.');
        }
        return view('admin.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $chkTocken->email]
        );
    }

    public function reset(Request $request)
    {
        if($request->password == $request->confirm_password && $request->password){
            $admin_password_resets = $request->id;
            $update['password'] = Hash::make($request->password);
            $update['admin_password_resets'] = null;
            $admin = Admin::Where('admin_password_resets',$admin_password_resets)->update($update);
            if($admin) {
                return redirect()->route('admin.success.msg')->with('success','Password changed successfully !!');
            } else {
                return redirect()->back()->with('error','Somthing went be wrong');
            }
        } else {
            return redirect()->back()->with('error','Password and Confirm Password not matched');
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
