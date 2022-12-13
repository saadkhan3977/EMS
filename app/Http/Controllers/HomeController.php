<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Attendances;
use App\Employees;
use App\User;
use App\Country;
use App\TimeSchedules;
use App\Shifts;
use App\Genders;
use App\Meritals;
use App\Departments;
use App\BreakTimes;
use App\Leaves;
use App\Mail_Send;
use App\Mailbox;
use App\Task;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('from',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        $date = date('Y-m-d');
        $todotask = Task::where('employee_id',$userId)->where('status','To Do')->where('start_date',$date)->count();
        return view('user_dashboard')->with(compact('totaltrashsendcount','userId','totaltrash','userEmail','totalsend','totalinbox','todotask'));
    }
    public function pagenotfound(){
        return("<span style='font-size:100px;margin-left:600px;'>&#128513;</span><p style='text-align:center;'>Page Not Found</p>");
    }

    public function error()
    {
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        return view('errors.404')->with(compact('pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent'));
    }

    // public function UserIndex($employee_id)
    // {
    //     $attendances = Attendances::where('employee_id', $employee_id)->first();


    //     return view('user_attendance/index')
    //     ->with(compact('attendances'));
    // }

    public function profile()
    {
        $userId = Auth::user()->id;
        $userEmail = auth()->user()->email;
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('from',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        $date = date('Y-m-d');
        $attendance = Attendances::where('date',$date)->where('employee_id',$userId)->get();
        $jsondata = json_decode($attendance);
        // print_r($jsondata);
        // exit;

        // if (empty($jsondata)) {
        //     Attendances::create([
        //         'employee_id' => $userId,
        //         'employee_name' => Auth::user()->name,
        //         'shift' => Auth::user()->shift,
        //         'department_name' => Auth::user()->departments,
        //         'time_schedule' => Auth::user()->time_schedule,
        //         'date' => $date,
        //         'attendance' => 'PRESENT',
        //         'time_in' => date('H:i:s'),
        //         'status' => 'PRESENT'
        //     ]);
        //     return redirect('user_attendance/'.$userId);
        // }
        return view('user_profile.index')->with(compact('userId','totaltrash','userEmail','totalsend','totalinbox'));
    }


    public function edit($id)
    {
        $countries = Country::get();
        $timeSchedules = TimeSchedules::where(['status' => 'ACTIVE'])->get();
        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $shifts = Shifts::where(['status' => 'ACTIVE'])->get();
        $genders = Genders::get();
        $meritals = Meritals::get();
        $breakTimes = BreakTimes::where(['status' => 'ACTIVE'])->get();

        $userId = Auth::user()->id;
        $userEmail = auth()->user()->email;
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('from',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        $user = User::find($id);
        $countries = Country::get();
        return view('user_profile.edit')
        ->with(compact('user','countries', 'timeSchedules', 'departments', 'shifts', 'genders', 'meritals', 'breakTimes','userId','totaltrash','userEmail','totalsend','totalinbox'));
    }

    
    public function update(Request $request, $id)
    {  
        $user = User::find($id);


        $currentImage = $user->employee_img;
        $fileName = null;


        if (request()->hasFile('employee_img')) 
        {
            $file = request()->file('employee_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $user->update([
            'name' => $request['name'],
            'employee_id' => $request['employee_id'],
            'email' => $request['email'],
            'slug' => $request['slug'],
            'dob' => $request['dob'],
            'country' => $request['country'],
            'phone' => $request['phone'],
            'salary' => $request['salary'],
            'departments' => $request['departments'],
            'gender' => $request['gender'],
            'shift' => $request['shift'],
            'merital' => $request['merital'],
            'joining_date' => $request['joining_date'],
            'facebook_id' => $request['facebook_id'],
            'linkedin_id' => $request['linkedin_id'],
            'employee_img' => ($fileName) ? $fileName : $currentImage,
            'time_schedule' => $request['time_schedule'],
            'admin' => $request['admin'],
            'address' => $request['address'],
            'status' => 'ACTIVE',
            'password' => $request['password'],
        ]);

        if($fileName)
            File::delete('./uploads/' . $currentImage);

        return redirect()->to('user_profile');    
    }

    













    // public function employee_update(Request $request, $id)
    // {
    //     $employee_profile = User::find($id);

    //     $currentImage = $employee_profile->employee_img;
    //     $fileName = null;


    //     if (request()->hasFile('employee_img')) 
    //     {
    //         $file = request()->file('employee_img');
    //         $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
    //         $file->move('./uploads/', $fileName);
    //     }


    //     $employee_profile->update([
    //         'name' => $request['name'],
    //         'departments' => $request['departments'],
    //         'email' => $request['email'],
    //         'address' => $request['address'],
    //         'employee_img' => ($fileName) ? $fileName : $currentImage,
    //     ]);

    //     if($fileName)
    //         File::delete('./uploads/' . $currentImage);

    //     return redirect()->to('/user_profile');
    // }



}
