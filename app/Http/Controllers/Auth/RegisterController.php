<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Employees;
use App\Country;
use App\TimeSchedules;
use App\Shifts;
use App\Genders;
use App\Meritals;
use App\Departments;
use App\BreakTimes;
use File;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $countries = Country::get();
        $timeSchedules = TimeSchedules::where(['status' => 'ACTIVE'])->get();
        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $shifts = Shifts::where(['status' => 'ACTIVE'])->get();
        $genders = Genders::get();
        $meritals = Meritals::get();
        $breakTimes = BreakTimes::where(['status' => 'ACTIVE'])->get();
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            'admin'=>0,
            'employee_id' => $data['employee_id'],
            'slug' => $data['slug'],
            'dob' => $data['dob'],
            'country' => $data['country'],
            'phone' => $data['phone'],
            'salary' => $data['salary'],
            'departments' => $data['departments'],
            'gender' => $data['gender'],
            'shift' => $data['shift'],
            'merital' => $data['merital'],
            'joining_date' => $data['joining_date'],
            'time_schedule' => $data['time_schedule'],
            'facebook_id' => $data['facebook_id'],
            'linkedin_id' => $data['linkedin_id'],
            'address' => $data['address'],
            'employee_img' => 'No image found',
            'status' => 'ACTIVE'
        ]);

        return view('auth.register')
        ->with(compact('countries', 'timeSchedules', 'departments', 'shifts', 'genders', 'meritals', 'breakTimes'));

    }
}
