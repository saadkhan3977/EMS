<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Leaves;
use App\Employees;
use App\Mailbox;
use App\Mail_Send;
use App\Task;
use App\User;

use File;

class UserLeaveController extends Controller
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
    public function index($employee_id)
    {
        $searchTerm = request()->get('s');
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();

        $leaves = Leaves::where('leave_type', 'LIKE', "$searchTerm%")->where('employee_id', $employee_id)->orderBy('id', 'DESC')->paginate(10);

        return view('user_leave/index')
        ->with(compact('leaves','totaltrash','userId','userEmail','totalsend','totalinbox'));
    }

    public function create($employee_id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        return view('user_leave/create')->with(compact('totaltrash','userId','userEmail','totalsend','totalinbox'));
        
    }

    public function store(Request $request, $employee_id)
    {
        $this->validate(request(), [
                // 'document_img' => 'required',
                'leave_type' => 'required',
                'duration' => 'required',
                'reason' => 'required',
        ]);

        $fileName = null;
        if (request()->hasFile('document_img')) 
        {
            $file = request()->file('document_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        Leaves::create([
            'employee_id' => request()->get('employee_id'),
            'name' => request()->get('name'),
            'admin_view' => '0',
            'department' => request()->get('department'),
            'leave_type' => request()->get('leave_type'),
            'duration' => request()->get('duration'),
            'reason' => request()->get('reason'),
            'leave_status' => '0',
            'admin_view' => '0',
            'user_view' => '1',
            'document_img' => $fileName,
            'status' => 'PENDING'

        ]);

        // $data = Leaves::where('view', 0)->get()->count();


        return redirect()->to('/user_dashboard');
    }

    public function edit($id)
    {
        $leave = Leaves::find($id);
        return view('/user_leave/edit')
        ->with(compact('leave'));
    }

    public function update(Request $request, $id)
    {
        $leave = Leaves::find($id);

        $editStatus = $leave->status;

        $currentImage = $leave->document_img;

        $fileName = null;

        if (request()->hasFile('document_img')) 
        {
            $file = request()->file('document_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }



        $leave->update([
            'employee_id' => request()->get('employee_id'),
            'name' => request()->get('name'),
            'department' => request()->get('department'),
            'leave_type' => request()->get('leave_type'),
            'duration' => request()->get('duration'),
            'reason' => request()->get('reason'),
            'leave_status' => '0',
            'document_img' => ($fileName) ? $fileName : $currentImage,
            'status' => $editStatus

        ]);

        if($fileName)
            File::delete('./uploads/', $currentImage);

        return redirect()->to('user_dashboard');
    }

    public function destroy($id)
    {
        $leave = Leaves::find($id);
        $currentImage = $leave->document_img;
        $leave->delete();
        File::delete('./uploads/' . $currentImage);

        return redirect()->back();
    }

    public function detail($employee_id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
                $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $leave = Leaves::find($employee_id);

        return view('user_leave/detail')
        ->with(compact('leave','totaltrash','userId','userEmail','totalsend','totalinbox'));    
    }

    public function view($id)
    {
        $id = request()->get('id');
        $userid = Auth::user()->id;
        $data = Leaves::find($id);
        $data->update(['user_view' => 1]);
        return redirect('/user_leave/'.$userid);
    }

    

    public function leavefetch()
    {
        $name = Auth::user()->name;
        $to =Auth::user()->email;

        $con = mysqli_connect("localhost", "propofkx_ems_user", "ems321@!", "propofkx_ems_db");
        $result = Leaves::where('user_view',0)->where('employee_id',Auth::user()->id)->get();
        $result1 = Task::where('task_status',0)->where('employee_id',Auth::user()->id)->get();
        $result2 = Mailbox::where('mail_status',0)->where('to',$to)->get();
        // $query3 = Task::where('employee_task_update','0')->where('assign_by',$name)->get();

        $output = '';
        $output1 = '';
        $output2 = '';
        if(!empty($result))
        {
            foreach ($result as $row) 
            {
                $output .= '
                <li>
                <a href="/leavesupdate_status?id='.$row['id'].'">
                <h5><b>Your Leave: '.$row["status"].'</b></h5>
                <small><b>Leave Name: <em>'.$row["leave_type"].'</em></b></small>
                </a>
                </li>
                ';
            }
        }
        if(!empty($result1))
        {
            foreach ($result1 as $row1) 
            {
                $user = User::find($row1['employee_id']);
                $output1 .= '
                <li>
                <a href="/taskupdate_status?id='.$row1['id'].'">
                <h5><b>Task Assign: '.$row1["assign_by"].'</b></h5>
                <img src="/uploads/'.$user['employee_img'].'" width="30" height="30" alt="User Image" style="float:right;">
                <small><b>Task Name: <em>'.$row1["task_name"].'</em></b></small>
                </a>
                </li>';
            }
        }
        if(!empty($result2))
        {
            foreach ($result2 as $row2) 
            {
                $output2 .= '
                <li>
                <a href="/mailupdate_status?id='.$row2->id.'">
                <h5><b>Mail From: '.$row2->from.'</b></h5>
                <small><b>Subject: <em>'.$row2->subject.'</em></b></small>
                </a>
                </li>
                ';
            }
        }
        if(!empty($query3))
        {
            foreach($query3 as $row3)
            {
                  $user = User::find($row3['employee_id']);
                  $output3 .= '
                  <li>
                  <a href="/taskupdate_status?id='.$row3['id'].'">
                <img src="/uploads/'.$user['employee_img'].'" width="30" height="30" alt="User Image" style="float:right;">
                  <h5><b>Task update: '.$user['name'].'</b></h5>
                  <small><b>Task Name: <em>'.$row3["task_name"].'</em></b></small>
                  </a>
                  </li>
                  ';
            }
        }
        if(empty($result1) AND empty($result) AND empty($result2)){
            $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
        }
        
        $count0 = Leaves::where('user_view',0)->where('employee_id',Auth::user()->id)->count();
        $count1 = Task::where('task_status',0)->where('employee_id',Auth::user()->id)->count();
        $count2 = Mailbox::where('mail_status',0)->where('to',$to)->count();

        $count = $count0+$count1+$count2;
        $data = array(
           'notification' => $output,
           'notification1' => $output1,
           'notification2' => $output2,
           'unseen_notification'  => $count
        );
        if (!empty($data)) {
            echo json_encode($data);
        }
    }
    public function leavesupdate_status(Request $Request)
    {
        $data = $Request->get('id');
        $userid  = Auth::user()->id;
        $task = Leaves::find($data);
        $task->update(['user_view'=>1]);
        return redirect('/user_leave/'.$userid);
    }
}
