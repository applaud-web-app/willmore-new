<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Admin;
use App\Mail\EmailVerifyMail;
use Mail;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your admins. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        // dd($request->all());
        $data['email'] = $request->email;
        $user = Admin::where('email',$request->email)->first();
        if(!@$user){
            return redirect()->back()->with('error','No record found.');
        }
        $vcode = rand();
        Admin::where('email',$request->email)->update(['admin_password_resets'=>$vcode]);
        $data['link'] = route('admin.password.reset',[$vcode]);
        $data['name'] = $user->name;
        $data['mailBody'] = 'forgotpassword';
        Mail::send(new EmailVerifyMail($data));
        return redirect()->route('admin.success.msg')->with('success','Password reset link send your email.');
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
}
