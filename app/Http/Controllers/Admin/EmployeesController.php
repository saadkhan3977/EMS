<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\RegistersUsers;

use App\Http\Controllers\Controller;

use App\Employees;
use App\User;

use App\Country;
use App\TimeSchedules;
use App\Shifts;
use App\Genders;
use App\Meritals;
use App\Leaves;
use App\Departments;
use App\BreakTimes;
use App\Mailbox;
use App\Mail_Send;
use App\Attendances;
use File;

class EmployeesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();
        
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $shifts = Shifts::where(['status' => 'ACTIVE'])->get();

        $searchTerm = request()->get('s');

        $employees = User::where('name', 'LIKE', "{$searchTerm}%")->orWhere('departments', 'LIKE', "{$searchTerm}%")->orWhere('shift', 'LIKE', "{$searchTerm}%")->orWhere('email', 'LIKE', "{$searchTerm}%")->orWhere('status', 'LIKE', "{$searchTerm}%")->orWhere('employee_id', 'LIKE', "{$searchTerm}%")->orWhere('country', 'LIKE', "{$searchTerm}%")->orWhere('gender', 'LIKE', "{$searchTerm}%")->orWhere('admin', 'LIKE', "{$searchTerm}%")->orWhere('salary', 'LIKE', "{$searchTerm}%")->orderBy('id', 'DESC')->get();
        
        $timeSchedules = TimeSchedules::get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        return view('admin.employee.index')
        ->with(compact('employees', 'timeSchedules', 'departments', 'shifts','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        $countries = Country::get();
        $timeSchedules = TimeSchedules::where(['status' => 'ACTIVE'])->get();
        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $shiftss = Shifts::where(['status' => 'ACTIVE'])->get();
        $genders = Genders::get();
        $meritals = Meritals::get();
        $breakTimes = BreakTimes::where(['status' => 'ACTIVE'])->get();
        $total_employees_data = User::latest('id')->first();
        $empployeeid = json_decode($total_employees_data['id']);
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();


        return view('admin.employee.create')
        ->with(compact('countries', 'timeSchedules', 'departments', 'shiftss', 'genders', 'meritals', 'breakTimes','empployeeid','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r(request()->all());
        // exit;
        $fileName = null;

        if (request()->hasFile('employee_img')) 
        {
            $file = request()->file('employee_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        User::create([
            'name' => $request['name'],
            'employee_id' => $request['employee_id'],
            'email' => $request['email'],
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
            'employee_img' => $fileName,
            'time_schedule' => $request['time_schedule'],
            'admin' => $request['admin'],
            'address' => $request['address'],
            'role' => request()->get('role'),
            'status' => 'ACTIVE',
            'password' => bcrypt($request['password']),

        ]);

        return redirect()->to('/admin/employees');   
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();
        
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        $countries = Country::get();
        $timeSchedules = TimeSchedules::where(['status' => 'ACTIVE'])->get();
        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $shiftss = Shifts::where(['status' => 'ACTIVE'])->get();
        $genders = Genders::get();
        $meritals = Meritals::get();
        $breakTimes = BreakTimes::where(['status' => 'ACTIVE'])->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        $user = User::find($id);
        $countries = Country::get();
        return view('admin.employee.edit')
        ->with(compact('user','countries', 'timeSchedules', 'departments', 'shiftss', 'genders', 'meritals', 'breakTimes','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->to('/admin/employees');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $currentImage = $user->employee_img;
        $user->delete();
        File::delete('./uploads/' . $currentImage);

        return redirect()->back();

    }

    public function status($id)
    {
        $user = User::find($id);
        $newStatus = ($user->status == 'ACTIVE') ?  'DEACTIVE': 'ACTIVE';
        $user->update([
            'status' => $newStatus
        ]);
        return redirect()->back();
    }

    public function detail($id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
        $employee = User::where('employee_id',$id)->first();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        return view('admin/employee/detail')
        ->with(compact('employee','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));    
    }
}
