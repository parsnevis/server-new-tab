<?php

namespace App\Http\Controllers\Reseller\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
//        $this->middleware('auth:admin');
    }

    protected function redirectTo()
    {
//        dd('dddd');
//        if (auth()->user()->role == 'admin') {
//            return '/admin';
//        }
//        return '/home';
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
//        dd('sd');
//        if ( $user->isAdmin() ) {// do your magic here
//            return redirect()->route('dashboard');
//        }

        return redirect('/');
    }


    public function username()
    {
        return 'email'; //or return the field which you want to use.
    }

    public function password()
    {
        return 'password'; //or return the field which you want to use.
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('reseller.auth.login', [
            'title' => 'Reseller Login',
            'loginRoute' => 'reseller.login',
            'forgotPasswordRoute' => 'reseller.password.request',
        ]);
    }

    /**
     * Login the reseller.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        //Validation...
        $this->validator($request);

//        return $request->all();

        //Login the reseller...
        if($this->guard()->attempt($request->only($this->username(),$this->password()),$request->filled('remember'))){
            //Authentication passed and Redirect the reseller ...

            return redirect()
                ->intended(route('reseller.dashboard'));
//                ->with('status', 'You are Logged in as Reseller!');

//            return response('You are Logged in as Reseller!', 200)
//                ->header('Content-Type', 'text/plain');
        }

        //Authentication failed...
//        return $this->loginFailed();
        return response('You are Not Logged in as Reseller!', 400)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Logout the reseller.
     *
     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\RedirectResponse
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        //logout the reseller...
        $this->guard()->logout();
//        return redirect()
//            ->route('admin.login')
//            ->with('status','Admin has been logged out!');



//        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
//            'email'    => 'required|email|exists:admins|min:5|max:191',
//            $this->username()    => 'required|email|min:5|max:191',
            $this->username()    => 'required|min:5|max:191',
            $this->password() => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        //Login failed...
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('reseller');
    }
}
