<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use App\Models\Blog;
use App\Models\Packages;
use Illuminate\Http\Request;
use App\Mail\BirthdayWisheMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ConsultContactRequest;
use App\Mail\WelcomeMail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::check()){
        //     return redirect()->route('user.dashboard');
        // }

    //    // Account details
    //     $apiKey = urlencode("NTI2YzU0NDU1ODYyNmI1OTQzNDI0YjMyNmEzNTczNzE=");
    //     $numbers = array(918057601819);
    //     $sender = urlencode("BRMSGS");
    //     $message = rawurlencode("Your OTP to login at willandmore.com is : 123456
    //     This OTP will expire within the next 3 minutes.");
        
    //     $numbers = implode(",", $numbers);
        
    //     // Prepare data for POST request
    //     $data = array('apikey' => $apiKey, "numbers" => $numbers, "sender" => $sender, "message" => $message);
    //     // Send the POST request with cURL
    //     $ch = curl_init("https://api.textlocal.in/send/");
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     // Process your response here
    //     echo $response;die;

        $data['packages'] = Packages::get();
        $data['blog'] = Blog::orderBy('created_at','desc')->first();
        $data['letestblog'] = Blog::where('id', '!=', @$data['blog']->id)->orderBy('created_at','desc')->take(2)->get();
        // dd( $data['blog']);
        return view('modules.home.index')->with(@$data);
    }

    public function saveContact(Request $request)
    {
        // dd($request->all());
        $ins = [];
        $ins['name'] = $request->name;
        $ins['form_type'] = $request->form_type;
        $ins['phone'] = $request->phone;
        $ins['phonecode'] = $request->phonecode;
        $ins['message'] = $request->message;
        $ins['email'] = $request->email;

        $save = ConsultContactRequest::create($ins);

        if(@$save){
            // session()->flash('success','Request Send Successfully');
            // return redirect()->back();

        return response()->json(['success'=>'Request Send Successfully']);
        }else{
            // session()->flash('error','Something went wrong');
            // return redirect()->back();
        return response()->json(['error'=>'Something went wrong']);
        }

    }

    /**
    *   Method      : sendBirthDayMail
    *   Description : Cron Job Birth Day WIse Mail
    *   Author      : Sourav
    *   Date        : 31-DEC-2022
    **/
    public function sendBirthDayMail(){

        $allUsers = User::whereMonth('dob', '=', date('m'))->whereDay('dob', '=', date('d'))->get();

        // dd($allUsers);

        foreach($allUsers as $users){
        // dd($users->email);
            Mail::send(new BirthdayWisheMail($users));

        }

    }

    public function success(){
        return view('auth.success');
    }

    public function verifyEmail(Request $request, $vcode = null, $id = null)
    {
        $user = User::where('vcode', $vcode)->where(\DB::raw('MD5(id)'), $id)->first();

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
                    return redirect()->route('user.success.verified')->with('success', 'Your email is verified successfully.');
                }else{
                    return redirect()->route('user.success.msg')->with('success', 'Your email is verified successfully. Now you can Sign in with your email and password.');
                }
            }
            else
            {
                return redirect()->route('login')->with('error', 'Your verification link has been expired.');
            }
    }

    public function verifyDashEmail(Request $request, $vcode = null, $id = null)
    {
        $user = User::where('vcode', $vcode)->where(\DB::raw('MD5(id)'), $id)->first();

            if (@$user->vcode != null && (@$user->is_email_verify == 'N' || $request->type=='true'))
            {
                $update = [];
                $update['vcode'] = null;
                $update['status'] = 'A';
                $update['is_email_verify'] = 'Y';
                User::where('id', $user->id)->update($update);

                $mailData['user_type'] = $user->user_type;
                $mailData['email'] = $user->email;
                $mailData['name'] = $user->name;
                $mailData['btn_link'] = route('login');;
                Mail::send(new WelcomeMail($mailData));


                if(auth()->check()){
                    return redirect()->route('user.success.verified')->with('success', 'Your email is verified successfully.');
                }else{
                    return redirect()->route('user.success.msg')->with('success', 'Your email is verified successfully. Now you can Sign in with your email and password.');
                }
            }
            else
            {
                return redirect()->route('login')->with('error', 'Your verification link has been expired.');
            }
    }

}
