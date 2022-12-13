<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Attendances;
use App\Shifts;
use App\Months;
use App\Leaves;

use App\TimeSchedules;
use App\Departments;
use App\User;
use App\Mailbox;
use App\Mail_Send;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AttendancesController extends Controller
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
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $months = Months::get();

        $searchTerm = request()->get('s');
        
        $date = date('Y-m-d');
        $attendances = Attendances::where('date', 'LIKE', "$searchTerm%")->orderBy('employee_name', 'ASC')->where('date',$date)->get();

        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        $users = User::get();
        return view('admin/attendances/index')
        ->with(compact('attendances', 'departments', 'months','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount','users'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = auth()->user()->id;
        $date = date("Y-m-d", strtotime("0 day"));
        $time = date("H-i-s");
        $day = date('D');
        if($day =='Sat')
        {
            if($time >='09-45-00')
            {
                $attendance = Attendances::where('employee_id', $userId)->where('date',$date)->first();
        
                if($attendance != NULL) {
                    if(auth()->user()->role =='admin')
                    {
                        if ($attendance->date == $date) {
                            return redirect('admin/attendances');
                        }
                    }
                    else{
                        if ($attendance->date == $date) {
                            return redirect('admin/attendances/my/'.$userId);
                        }
                    }
                }    
                $userEmail = auth()->user()->email;
                $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
                $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
                $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
                $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
                $timeSchedules = TimeSchedules::get();
                $departments = Departments::get();
                $shiftss = Shifts::get();
                $pending_leaves = Leaves::where('status','PENDING')->count();
                $approve_leaves = Leaves::where('status','APPROVE')->count();
                $reject_leaves = Leaves::where('status','REJECTED')->count();
                $shifts = Shifts::get()->count();
                $total_present = Attendances::where('attendance','PRESENT')->count();
                $total_absent = Attendances::where('attendance', 'ABSENT')->count();
                return view('admin/attendances/create')
                ->with(compact('timeSchedules', 'departments','pending_leaves','approve_leaves','reject_leaves','shifts', 'shiftss','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
            }
            else{
                echo "<script>";
                echo "alert('Saturday s day Office Starting timing 8:45 Am. Your Attendance Is not Approved at this Time!!')";
                echo "</script>";
                echo "<a href='/admin' >Go Back</a>";
            }
        }
        else
        {
            if($time >='08-45-00')
            {
                $attendance = Attendances::where('employee_id', $userId)->where('date',$date)->first();
        
                if($attendance != NULL) {
                    if(auth()->user()->role =='admin')
                    {
                        if ($attendance->date == $date) {
                            return redirect('admin/attendances');
                        }
                    }
                    else{
                        if ($attendance->date == $date) {
                            return redirect('admin/attendances/my/'.$userId);
                        }
                    }
                }    
                $userEmail = auth()->user()->email;
                $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
                $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
                $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
                $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
                $timeSchedules = TimeSchedules::get();
                $departments = Departments::get();
                $shiftss = Shifts::get();
                $pending_leaves = Leaves::where('status','PENDING')->count();
                $approve_leaves = Leaves::where('status','APPROVE')->count();
                $reject_leaves = Leaves::where('status','REJECTED')->count();
                $shifts = Shifts::get()->count();
                $total_present = Attendances::where('attendance','PRESENT')->count();
                $total_absent = Attendances::where('attendance', 'ABSENT')->count();
                return view('admin/attendances/create')
                ->with(compact('timeSchedules', 'departments','pending_leaves','approve_leaves','reject_leaves','shifts', 'shiftss','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
            }
            else{
                echo "<script>";
                echo "alert('Office Starting timing 8:45 Am. Your Attendance Is not Approved at this Time..!!')";
                echo "</script>";
                echo "<a href='/admin' >Go Back</a>";
            }
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $id = auth()->user()->id;
        $day = date('D');
        if($day=='Sat')
        {
            if($time >='10:30:20')
            {
                Attendances::create([
                    'employee_id' => request()->get('employee_id'),
                    'employee_name' => request()->get('employee_name'),
                    'shift' => Auth::user()->shift,
                    'department_name' => Auth::user()->departments,
                    'time_schedule' => request()->get('time_schedule'),
                    'date' => $date,
                    'time_in' => request()->get('time_in'),
                    // 'time_out' => request()->get('time_out'),
                    // 'status' => 'PRESENT',
                    'attendance' => 'LATE PRESENT'
                ]);
            }
            else{
                Attendances::create([
                    'employee_id' => request()->get('employee_id'),
                    'employee_name' => request()->get('employee_name'),
                    'shift' => Auth::user()->shift,
                    'department_name' => Auth::user()->departments,
                    'time_schedule' => request()->get('time_schedule'),
                    'date' => $date,
                    'time_in' => request()->get('time_in'),
                    // 'time_out' => request()->get('time_out'),
                    // 'status' => 'PRESENT',
                    'attendance' => 'PRESENT'
                ]);
            }
            return redirect()->to('/admin/attendances/my/'.$id);
        }
        else{
            if($time >='09:30:20')
            {
                Attendances::create([
                    'employee_id' => request()->get('employee_id'),
                    'employee_name' => request()->get('employee_name'),
                    'shift' => Auth::user()->shift,
                    'department_name' => Auth::user()->departments,
                    'time_schedule' => request()->get('time_schedule'),
                    'date' => $date,
                    'time_in' => request()->get('time_in'),
                    // 'time_out' => request()->get('time_out'),
                    // 'status' => 'PRESENT',
                    'attendance' => 'LATE PRESENT'
                ]);
            }
            else
            {
                Attendances::create([
                    'employee_id' => request()->get('employee_id'),
                    'employee_name' => request()->get('employee_name'),
                    'shift' => Auth::user()->shift,
                    'department_name' => Auth::user()->departments,
                    'time_schedule' => request()->get('time_schedule'),
                    'date' => $date,
                    'time_in' => request()->get('time_in'),
                    // 'time_out' => request()->get('time_out'),
                    // 'status' => 'PRESENT',
                    'attendance' => 'PRESENT'
                ]);
            }
        return redirect()->to('/admin/attendances/my/'.$id);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function updatetimeout($id){
        $userId = auth()->user()->id;
        $attendance = Attendances::find($id);
        // print_r($id);die;
        $date= date('H:i:s');
        $attendance->update(['time_out'=>$date]);
        
        return redirect()->to('/admin/attendances/my/'.$userId);
    }
    public function edit($id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        
        $timeSchedules = TimeSchedules::get();
        $departments = Departments::get();
        $shifts = Shifts::get();
        $attendance = Attendances::find($id);
        return view('/admin/attendances/edit')
        ->with(compact('attendance', 'timeSchedules', 'departments', 'shifts','total_present','total_absent','totalsend','totalinbox','totaltrash','totaltrashsendcount','pending_leaves','approve_leaves','reject_leaves'));
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
        // print_r('world');die;
        $attendance = Attendances::find($id);

        $attendance->update([
            'employee_id' => request()->get('employee_id'),
            'employee_name' => request()->get('employee_name'),
            'shift' => request()->get('shift'),
            'department_name' => request()->get('department_name'),
            'time_schedule' => request()->get('time_schedule'),
            'time_in' => request()->get('time_in'),
            'time_out' => request()->get('time_out'),
            // 'status' => 'PRESENT'
        ]);

        return redirect()->to('/admin/attendances');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendance = Attendances::find($id);
        $attendance->delete();

        return redirect()->back();
    }

    public function detailemployee($employee_id){
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $months = Months::get();

        $searchTerm = request()->get('s');

        $attendances = Attendances::where('employee_id', $employee_id)->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        return view('/admin/attendances/detailemployee')
        ->with(compact('attendances', 'months','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
    }
    public function detail($employee_id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $months = Months::get();

        $searchTerm = request()->get('s');

        $attendances = Attendances::where('employee_id', $employee_id)->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        return view('admin/attendances/detail')
        ->with(compact('attendances', 'months','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));    
    }
    public function mydetail($employee_id){
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
        $departments = Departments::where(['status' => 'ACTIVE'])->get();
        $months = Months::get();

        $searchTerm = request()->get('s');

        $attendances = Attendances::where('employee_id', $employee_id)->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        return view('admin/attendances/detail')
        ->with(compact('attendances', 'months','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
    }
}
