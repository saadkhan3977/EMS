<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Mailbox;
use App\Mail_Send;
use App\Attendances;
use App\Departments;
use App\Leaves;
use App\Shifts;
use App\ImageUpload;


class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $total_employees = User::where('admin', 0)->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        // $total_employees_data = User::where('admin', 0)->get();
    	$total_employees_data = User::get();
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        $date = date('Y-m-d');
        $attendance = Attendances::where('date',$date)->where('employee_id',$userId)->get();
        $jsondata = json_decode($attendance);

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
        //     return redirect('/admin/dashboard/');
        // }


        // echo "<pre>";
        $jdata = json_decode($total_employees_data);
        // echo "<pre>";
        // print_r($jdata);
        // exit;
        foreach ($jdata as $value) 
        {
            // echo "<pre>";
                // print_r($value);
            $date = date('Y-m-d');
            $attendances = Attendances::where('employee_id', $value->employee_id)->where('date',$date)->get();    
            $jsodata =json_decode($attendances);
            if(empty($jsodata)){
                $time_schedule = $value->time_schedule;
                if ($time_schedule == '(09 a.m) to (06 p.m)') 
                {
                    $currenttime= date('H-i-s');
                    $endtime= '12-00-00';
                    // print_r($currenttime);
                    // exit;
                    if($currenttime > $endtime){
                        Attendances::create([
                            'employee_id' => $value->employee_id,
                            'employee_name' => $value->name,
                            'shift' => $value->shift,
                            'department_name' => $value->departments,
                            'time_schedule' => $value->time_schedule,
                            'time_in' => '00:00:00',
                            'time_out' => "00:00:00",
                            'attendance' => "ABSENT",
                            'date' => $date,
                            'month' =>date('M'),
                            'status' => 'ABSENT'
                        ]);
                    }
                }
                if ($time_schedule == '(03 p.m) to (11 p.m)') 
                {
                    $currenttime= date('H-i-s');
                    $endtime= '15-00-00';
                    // print_r($currenttime);
                    // exit;
                    if($currenttime > $endtime){
                        Attendances::create([
                            'employee_id' => $value->employee_id,
                            'employee_name' => $value->name,
                            'shift' => $value->shift,
                            'department_name' => $value->departments,
                            'time_schedule' => $value->time_schedule,
                            'time_in' => '00:00:00',
                            'time_out' => "00:00:00",
                            'date' => $date,
                            'status' => 'ABSENT'
                        ]);
                    }
                }
                if ($time_schedule == '(12 p.m) to (08 p.m)') 
                {
                    $currenttime= date('H-i-s');
                    $endtime= '14-00-00';
                    // print_r($currenttime);
                    // exit;
                    if($currenttime > $endtime){
                        Attendances::create([
                            'employee_id' => $value->employee_id,
                            'employee_name' => $value->name,
                            'shift' => $value->shift,
                            'department_name' => $value->departments,
                            'time_schedule' => $value->time_schedule,
                            'time_in' => '00:00:00',
                            'time_out' => "00:00:00",
                            'date' => $date,
                            'status' => 'ABSENT'
                        ]);
                    }
                }
            }
        }
        $date = date('Y-m-d');

        $total_admins = User::where('admin', 1)->count();
    	$total_present = Attendances::where('date',$date)->where('attendance','PRESENT')->count();
    	$total_pres = Attendances::where('date',$date)->where('attendance','PRESENT')->get();
    	$total_abs = Attendances::where('date',$date)->where('attendance','ABSENT')->get();
    	$total_presents =json_decode($total_pres);
    	$total_absents =json_decode($total_abs);
    // 	foreach($total_presents as $total_present => $key){
    // 	echo "<pre>";
    // 	print_r($key);
    // }
    // 	exit;
        // print_r($total_present);
        // exit;
        $total_departments = Departments::count();
        $total_leaves = Leaves::count();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $le = Leaves::where('status','PENDING')->get();
        $leaves = Leaves::where('status','PENDING')->get()->count();
    	return view('admin.dashboard')
    	->with(compact('total_employees','total_present','total_absent', 'total_admins','reject_leaves','pending_leaves','approve_leaves', 'total_departments', 'total_leaves','leaves','le','shifts','totaltrash','totalsend','totalinbox','totaltrashsendcount','total_presents','total_absents'));
    }

    public function view()
    {
        // Leaves::where('view', '=', 0)->update(['view' => 1]); //Update All Rows
        
        $id = request()->get('id');
        $data = Leaves::find($id);
        $data->update(['admin_view' => 1,'user_view' => 0]);
        return redirect('/admin/leaves');
    }

    public function get()
    {
        $data = Leaves::where('admin_view', 0)->get()->count();
        return $data;
    }

    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('Upload Document'),$imageName);
        
        $imageUpload = new ImageUpload();
        $imageUpload->filename = $imageName;
        $imageUpload->employee_id = '2';
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        ImageUpload::where('filename',$filename)->delete();
        $path=public_path().'/Upload Document/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }
}
