<?php

namespace App\Http\Controllers\Auth;

use App\AuditTrail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

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


    public function getLogin() {
        return view('auth.login');
    }

    public function auth_check(Request $request)
    {
            $request->validate(
                [
                    'custom' =>'required',
                    'password'=>'required',
                ]
            );

            $custom = $request->input('custom');

            $param_type = filter_var($custom,FILTER_VALIDATE_EMAIL) ?
                'email' : 'username';

             $request->merge([$param_type => $custom]);

            $cred = $request->only($param_type,'password');


            if(Auth::attempt($cred))
                return redirect()->route('home.index');



           return  redirect()->back()->withInput(Input::all())->withErrors("$param_type $custom does not exist ");

    }


    public function postLogin(Request $request) {
        //validate request
        try {
            $this->validate($request, [
                'login' => 'required',
                'password' => 'required'
            ]);
        } catch (ValidationException $e) {
        }

        // get our login input
        $login = $request->input('login');

        // check login field
        $login_type = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';

        // merge our login field into the request with either email or username as key
        $request->merge([ $login_type => $login ]);

        $credentials = $request->only($login_type, 'password');

        //check the user trying to login
        if (isset($credentials['username']) && !empty($credentials['username']))
            $user = User::query()->where([
                ['username', '=', $credentials['username']]
            ])->first();
        else
            $user = User::query()->where([
                ['email', '=', $credentials['email']]
            ])->first();

        if (!empty($user) && $user->is_locked) {
            //process locked user
            $request->session()->put('locked_user_id', $user->id);
            return view('locked');
        }

        if (Auth::attempt($credentials))
        {

                    Auth::user()->log("LOGGED IN");  // capture login time of user.
                    //redirect user after successful login
                return redirect()->intended('/');


        } else {


            return redirect()->back()
                ->withInput($request->only('login', 'remember'))
                ->withErrors(['login' => Lang::get('auth.failed')]);
        }
    }

    public function loggedOut(Request $request)
    {
        Auth::user()->log("Logged Out");
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }


}

