<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest:admin', ['except' => 'logout']);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        try {
            if(Cookie::get('email') != null && Cookie::get('password') != null && Cookie::get('remember') != null) {
                $data['email'] = Cookie::get('email');
                $data['password'] = Cookie::get('password');
                $data['remember'] = Cookie::get('remember');
            }
            // dd($data);
                // Get URLs
            $urlPrevious = url()->previous();
            $urlBase = url()->to('/');
            // Set the previous url that we came from to redirect to after successful login but only if is internal
            if(($urlPrevious != $urlBase . '/admin/login') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
                session()->put('url.intended', $urlPrevious);
            }
            // echo $urlPrevious;
            return view('admin.auth.login')->with(@$data);            
        } catch (Exception $e) {
            abort(404);
        }
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password'        => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['status'] = ['A'];
        return $credentials;
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->status == "A" && @$request->remember == 'on') {
            // check remember me cookie have or not
            // set remember me cookie
            $email_cookie = Cookie::queue('email', $request->email, 10080);
            $pass_cookie = Cookie::queue('password', $request->password, 10080);
            $remember_coockie = Cookie::queue('remember', $request->remember, 10080); 
        }
        else {
            Cookie::queue(Cookie::forget('remember'));
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // dd($request->all());
        // throw ValidationException::withMessages([
        //     $this->username() => [trans('auth.failed')],
        // ]);
        $errors = [$this->username() => trans('auth.failed')];
        $user = \App\Admin::where($this->username(), $request->{$this->username()})
                            ->where('status', '!=', 'D')
                            ->first();
        // dd($user);
        if ($user && \Hash::check($request->password, $user->password) && $user->status == 'I') {
            $errors = [$this->username() => "Your Accout is not Active."];
        }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/admin/login');
    }

}

