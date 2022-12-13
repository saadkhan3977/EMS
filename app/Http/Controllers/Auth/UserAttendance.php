<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Attendances;
use App\Shifts;
use App\TimeSchedules;
use App\Departments;
use App\Mail_Send;
use App\Mailbox;
use Carbon\Carbon;


class UserAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($employee_id)
    {
        $attendances = Attendances::orderBy('id', 'DESC')->where('employee_id', $employee_id)->paginate(10);
        $userId = Auth::user()->id;
        $userEmail = auth()->user()->email;
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totalsend = Mail_Send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('from',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        return view('user_attendance/index')
        ->with(compact('attendances','userId','totaltrash','userEmail','totalsend','totalinbox'));
    }

    public function create($employee_id)
    {
        $day = date('D');
        $time = date("H-i-s");
        if($day =='Sat')
        {
            // print_r($day);die;
            if($time >='09-45-00')
            {
                $date = date('Y-m-d');
                $userId = Auth::user()->id;
                $userEmail = auth()->user()->email;
                $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
                $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
                $totaltrash = Mailbox::where('trash','TRUE')->where('from',$userEmail)->count();
                $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
                $data = Attendances::where('date',$date)->where('employee_id',$userId)->get();
                $result = json_decode($data);
                if(empty($result))
                {
        
                    $timeSchedules = TimeSchedules::get();
                    $departments = Departments::get();
                    $shifts = Shifts::get();
                    return view('user_attendance/create')
                    ->with(compact('timeSchedules', 'departments', 'shifts','userId','totaltrash','userEmail','totalsend','totalinbox'));
                }
                else{
                return redirect()->to('user_attendance/'.$employee_id);
                }
        
            }
            else{
                echo "<script>";
                echo "alert('Saturday s day Office Starting timing 9:45 Am. Your Attendance Is not Approved at this Time..!!')";
                echo "</script>";
                echo "<a href='/user_dashboard' >Go Back</a>";
            }
        }
        else{
            if($time >='08-45-00')
            {
                $date = date('Y-m-d');
                $userId = Auth::user()->id;
                $userEmail = auth()->user()->email;
                $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
                $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
                $totaltrash = Mailbox::where('trash','TRUE')->where('from',$userEmail)->count();
                $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
                $data = Attendances::where('date',$date)->where('employee_id',$userId)->get();
                $result = json_decode($data);
                if(empty($result))
                {
                    $timeSchedules = TimeSchedules::get();
                    $departments = Departments::get();
                    $shifts = Shifts::get();
                    return view('user_attendance/create')
                    ->with(compact('timeSchedules', 'departments', 'shifts','userId','totaltrash','userEmail','totalsend','totalinbox'));
                }
                else{
                    return redirect()->to('user_attendance/'.$employee_id);
                    
                }
            }
            else{
                echo "<script>";
                echo "alert('Office Starting timing 8:45 Am. Your Attendance Is not Approved at this Time..!!')";
                echo "</script>";
                echo "<a href='/user_dashboard' >Go Back</a>";
            }
        }
    }

    
    public function store(Request $request, $employee_id)
    {
        $time = date('H:i:s');
        // print_r($time);die;
        $day = date('D');
        if($day=='Sat')
        {
            if($time >='10:30:20')
            {
                Attendances::create([
                    'employee_id' => request()->get('employee_id'),
                    'employee_name' => request()->get('employee_name'),
                    'shift' => request()->get('shift'),
                    'department_name' => request()->get('department_name'),
                    'time_schedule' => request()->get('time_schedule'),
                    'date' => request()->get('date'),
                    'time_in' => Carbon::now()->format('h:i:s'),
                    'time_out' => null,
                    'month' => request()->get('month'),
                    'attendance' => 'LATE PRESENT'
                ]);
            }
            else{
            Attendances::create([
                'employee_id' => request()->get('employee_id'),
                'employee_name' => request()->get('employee_name'),
                'shift' => request()->get('shift'),
                'department_name' => request()->get('department_name'),
                'time_schedule' => request()->get('time_schedule'),
                'date' => request()->get('date'),
                'time_in' => Carbon::now()->format('h:i:s'),
                'time_out' => null,
                'month' => request()->get('month'),
                'attendance' => 'PRESENT'
            ]);
            }
        return redirect()->to('user_attendance/'.$employee_id);    
        }
        elseif($day!='Sat')
        {
            if($time >='09:30:20')
            {
                Attendances::create([
                    'employee_id' => request()->get('employee_id'),
                    'employee_name' => request()->get('employee_name'),
                    'shift' => request()->get('shift'),
                    'department_name' => request()->get('department_name'),
                    'time_schedule' => request()->get('time_schedule'),
                    'date' => request()->get('date'),
                    'time_in' => Carbon::now()->format('h:i:s'),
                    'time_out' => null,
                    'month' => request()->get('month'),
                    'attendance' => 'LATE PRESENT'
                ]);
            }    
            else{
                Attendances::create([
                    'employee_id' => request()->get('employee_id'),
                    'employee_name' => request()->get('employee_name'),
                    'shift' => request()->get('shift'),
                    'department_name' => request()->get('department_name'),
                    'time_schedule' => request()->get('time_schedule'),
                    'date' => request()->get('date'),
                    'time_in' => Carbon::now()->format('h:i:s'),
                    'time_out' => null,
                    'month' => request()->get('month'),
                    'attendance' => 'PRESENT'
                ]);
            }
        return redirect()->to('user_attendance/'.$employee_id);
        }

    }

    public function edit($id)
    {
        $userId = Auth::user()->id;
        $userEmail = auth()->user()->email;
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('from',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
        $timeSchedules = TimeSchedules::get();
        $departments = Departments::get();
        $shifts = Shifts::get();
        $attendance = Attendances::find($id);
        return view('/user_attendance/edit')
        ->with(compact('attendance', 'timeSchedules', 'departments', 'shifts','userId','totaltrash','userEmail','totalsend','totalinbox'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendances::find($id);

        // dd($attendance);
        $employee_id = $request['employee_id'];

        $attendance->update([
            'employee_id' => $request['employee_id'],
            'employee_name' => $request['employee_name'],
            'shift' => $request['shift'],
            'department_name' => $request['department_name'],
            'time_schedule' => $request['time_schedule'],
            'date' => $request['date'],
            'month' => $request['month'],
            // 'attendance' => $request['attendance'],
            'time_in' => $request['time_in'],
            'time_out' => Carbon::now()->format('h:i:s')

        ]);

        return redirect()->to('user_attendance/'.$employee_id);
    }

    public function destroy($id)
    {
        $attendance = Attendances::find($id);
        $attendance->delete();

        return redirect()->back();
    }

}
