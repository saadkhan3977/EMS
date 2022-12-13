<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Users;

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


    protected function authenticated(Request $request, $user)
    {
        if($user->admin(1))
        {
            return redirect('/admin/dashboard');
        }
        else
        {
            return redirect('/user_profile');
        }

        // if($user->admin(1) && $user->status == 1){
        //     return redirect('/admin/dashboard');
        // }else if($user->admin(0) && $user->status == 0){
        //     return redirect('/user_profile');
        // }else{
        //     return redirect::back()->withErrors(['msg', 'You don/t have access to login']);
        // }
    }

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
