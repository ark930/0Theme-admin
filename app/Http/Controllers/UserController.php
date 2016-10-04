<?php

namespace App\Http\Controllers;

use App\Repositories\GoogleAuthenticator;
use App\Repositories\ReCaptcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return view('login');
    }

    public function login(Request $request, GoogleAuthenticator $googleAuthenticator, ReCaptcha $reCaptcha)
    {
        $this->validate($request, [
//            'pwd' => 'required|regex:/^[a-zA-Z0-9]{8,}$/',
            'code' => 'required|regex:/^\d{6}$/',
            'g-recaptcha-response' => 'required',
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
        $recaptcha = $request->input('g-recaptcha-response');

        if($reCaptcha->verify(env('RECAPTCHA_SECRET_KEY'), $recaptcha, $request->ip()) == true) {
            if($googleAuthenticator->verifyCode(env('GOOGLE_AUTHENTICATOR_SECRET'), $code, 0)
//           && $password === 'qwertyuiop'
            ) {
                $request->session()->regenerate();
                $this->clearLoginAttempts($request);

                $request->session()->set('login', true);

                return redirect('/dashboard');
            }

        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return redirect()->back()->withErrors('Login fails');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }
}
