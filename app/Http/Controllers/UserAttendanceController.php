<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendances;
use App\Shifts;
use App\TimeSchedules;
use App\Departments;
use App\Months;

use Carbon\Carbon;

class UserAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function abc($employee_id)
    {
        # code...
    }
    public function index($employee_id)
    {
        $searchTerm = request()->get('s');
        
        $attendances = Attendances::where('employee_id', $employee_id)->where('date', 'LIKE', "$searchTerm%")->orderBy('id', 'DESC')->paginate(10);
        // $attendances = Attendances::where('employee_id', $employee_id);
        $attendance = Attendances::where('employee_id', $employee_id)->first();
        $last = Attendances::where('employee_id', $employee_id)->orderBy('id', 'DESC')->first();
         $date = date("Y-m-d", strtotime("-1 day"));
        echo "<pre>";
        echo $tomorrow;
        echo "<pre>";
        exit;
        if($last['date'] != $date){
            Attendances::create([
                'employee_id'=>$employee_id,
                'employee_name'=>$attendance->employee_name,
                'department_name'=>$attendance->department_name,
                'month'=>$attendance->month,
                'shift'=>$attendance->shift,
                'time_schedule'=>$attendance->time_schedule,
                'date'=>$date,
                'attendance'=>'Absent',
                'time_in'=>'00:00:00',
                'time_out'=>'00:00:00',
            ]);
        }
        // print_r($key->date);
        // exit;
            # code...

        // exit; 
        return view('user_attendance/index')
        ->with(compact('attendances','attendance'));
    }

    public function create($employee_id)
    {
        $attendance = Attendances::where('employee_id', $employee_id)->first();
        $date = date("Y-m-d", strtotime("0 day"));
        if($attendance != NULL) {
            if ($attendance->date == $date) {
                return redirect('user_dashboard');
            }
            else{
                $timeSchedules = TimeSchedules::get();
                $departments = Departments::get();
                $shifts = Shifts::get();
                $months = Months::get();
                return view('user_attendance/create')
                ->with(compact('timeSchedules', 'departments', 'shifts', 'months'));
            }
        }
        else
        {
            

        $timeSchedules = TimeSchedules::get();
        $departments = Departments::get();
        $shifts = Shifts::get();
        $months = Months::get();
        return view('user_attendance/create')
        ->with(compact('timeSchedules', 'departments', 'shifts', 'months'));
        }
    }

    
    public function store(Request $request, $employee_id)
    {
        print_r('hello');die;
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

        return redirect()->to('user_attendance/'.$employee_id);
    }

    public function edit($id)
    {
        $timeSchedules = TimeSchedules::get();
        $departments = Departments::get();
        $shifts = Shifts::get();
        $attendance = Attendances::find($id);
        return view('/user_attendance/edit')
        ->with(compact('attendance', 'timeSchedules', 'departments', 'shifts'));
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
            'attendance' => $request['attendance'],
            'time_in' => $request['time_in'],
            'time_out' => Carbon::now()->format('h:i:s')

        ]);

        return redirect()->to('user_attendance/'.$employee_id);
    }






    public function destroy($employee_id)
    {
        $attendance = Attendances::find($employee_id);
        $attendance->delete();

        return redirect()->back();
    }

}












