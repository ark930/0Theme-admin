<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return view('main');
    }

    public function login(Request $request, GoogleAuthenticator $googleAuthenticator)
    {
        $this->validate($request, [
            'pwd' => 'required|regex:/^[a-zA-Z0-9]{8,}$/',
            'code' => 'required|regex:/^\d{6}$/',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $password = $request->input('pwd');
        $code = $request->input('code');
        $secret = 'SY3NRGNH5XAEFNHE';
        if($googleAuthenticator->verifyCode($secret, $code, 0) && $password === 'qwertyuiop') {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            $request->session()->set('login', true);

            return redirect('/dashboard');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }
}
