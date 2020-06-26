<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /* public function username()
    {
        $login = request()->input('email');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);

        return $field;
    } */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        //validate the form data
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($field == 'email') {
            $email = User::where('email', $request->email)->first();
            if ($email == null) {
                return redirect()->back()
                    ->with('error', 'No Account found!');
            }
            if ($email->status !='active') {
                return redirect()->back()
                    ->with('error', 'Account is not Active yet! contact admin.');
            }
        } else {
            $username = User::where('username', $request->email)->first();
            if ($username == null) {
                return redirect()->back()
                    ->with('error', 'No Account found!');
            }
            if ($username->status !='active') {
                return redirect()->back()
                    ->with('error', 'Account is not Active yet! contact admin');
            }
        }

        // for user
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->remember)) {
            User::where('email', $request->email)->update(['last_login_at' => now()]);

            return redirect()->route('single-order');
        } elseif (Auth::guard('web')->attempt(['username' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->remember)) {
            User::where('email', $request->email)->update(['last_login_at' => now()]);

            return redirect()->route('single-order');
        }

        return redirect()->back()->with('Input', $request->only('email', 'remember'))->with('error', 'Invalid Email & Password.');
    }
}
