<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ChangePasswordController extends Controller
{
    public function index()
    {
    	return view('admin.profile.index');
    }

    public function ChangePassword(Request $request)
    {

    	/*$this->validate($request,  [
    		'old_password' => 'required',
    		'password' => 'required|confirmed'
    	]);*/

    	$hashedPassword = Auth::user()->password;


    	if(Hash::check($request->old_password,$hashedPassword))
    	{
    		$user = User::find(Auth::id());

    		$user->password = Hash::make($request->password);

    		$user->save();

    		Auth::logout();

    		return redirect()->route('login')->with('alert-success', 'Your Password has been changed successfully.');
    	}
    	else
    	{
    		return redirect()->back()->with('alert-danger', "Your Current Password is invalid.");
    	}

    }
}
