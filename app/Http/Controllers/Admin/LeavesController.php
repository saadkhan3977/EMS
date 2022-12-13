<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Attendances;
use App\Leaves;
use App\Shifts;
use File;
use App\Mailbox;
use App\Mail_Send;
use App\User;
use App\Task;

class LeavesController extends Controller
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
        
        $searchTerm = request()->get('s');

        if(Auth::user()->role =='Internal Project Manager'){
            $leaves = Leaves::where('leave_type', 'LIKE', "$searchTerm%")->where('employee_id', $userId)->orderBy('id', 'DESC')->paginate(10);
        }
        else{
            
        
    	$leaves = Leaves::where('employee_id', 'LIKE', "$searchTerm%")->orWhere('leave_type', 'LIKE', "$searchTerm%")->orWhere('duration', 'LIKE', "$searchTerm%")->orWhere('name', 'LIKE', "$searchTerm%")->orWhere('department', 'LIKE', "$searchTerm%")->orWhere('status', 'LIKE', "$searchTerm%")->get();
        }
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        return view('admin.leaves.index')
        ->with(compact('leaves','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));    
    }
    public function create($employee_id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        return view('/admin/leaves/create')->with(compact('totaltrash','userId','userEmail','totalsend','totalinbox','total_present','total_absent'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin/leaves/create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$fileName = null;

    	if (request()->hasFile('document_img')) 
        {
            $file = request()->file('document_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        Leaves::create([
            'employee_id' => request()->get('employee_id'),
            'leave_type' => request()->get('leave_type'),
            'duration' => request()->get('duration'),
            'reason' => request()->get('reason'),
            'document_img' => $fileName,
            'leave_status' => '0',
            'status' => 'ACTIVE'

        ]);

        return redirect()->to('/admin/leaves');
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
    public function edit($id)
    {
        $leave = Leaves::find($id);
        return view('admin/leaves/edit')
        ->with(compact('leave'));
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
            'leave_type' => request()->get('leave_type'),
            'duration' => request()->get('duration'),
            'reason' => request()->get('reason'),
            'document_img' => ($fileName) ? $fileName : $currentImage,
            'leave_status' => '0',
            'status' => $editStatus

        ]);

        if($fileName)
        	File::delete('./uploads/', $currentImage);

        return redirect()->to('/admin/leaves');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave = Leaves::find($id);
        $currentImage = $leave->document_img;
        $leave->delete();
        File::delete('./uploads/' . $currentImage);

        return redirect()->back();
    }

    public function status($id)
    {
        $leave = Leaves::find($id);
        /*$newStatus = ($leave->status == 'PENDING') ?  'APPROVE': 'REJECTED';*/
        $newStatus = $leave->status == 'PENDING' ? 'APPROVE' : ($leave->status == 'APPROVE' ? 'REJECTED' : 'PENDING');

        $leave->update([
            'status' => $newStatus,
            'user_view'=>0
        ]);
        return redirect()->back();
    }

    public function detail($employee_id)
    {

        $leave = Leaves::find($employee_id);
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        return view('admin/leaves/detail')
        ->with(compact('leave','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));    
    }
    public function leavesupdate_status(Request $Request)
    {
        $data = $Request->get('id');
        $task = Leaves::find($data);
        $task->update(['admin_view'=>'1','user_view'=>0]);
        return redirect('/admin/leaves');

    }

    public function leavefetch()
    {
        // $con = mysqli_connect("localhost", "root", "ems12345678", "fishgfxf_ems");
        // $con = mysqli_connect("localhost", "propofkx_ems_user", "ems321@!", "propofkx_ems_db");
        $con = mysqli_connect("localhost", env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $id = Auth::user()->id;
        if($_POST["view"] != '')
        {
           $update_query = "UPDATE leaves SET leave_status = 1 WHERE leave_status=0";
           mysqli_query($con, $update_query);
        }
        $query = "SELECT * FROM leaves WHERE admin_view=0 ORDER BY id DESC LIMIT 5";
        $query1 = "SELECT * FROM task WHERE admin_view=0 ORDER BY id DESC LIMIT 5";
        $query2 = Mailbox::where('admin_view','0')->where('to',$email)->get();
        if (Auth::user()->role!='Employee') {
        $query3 = Task::where('employee_task_update','0')->where('assign_by',$name)->get();
        $query5 = Task::where('admin_task_update','0')->where('employee_id',$id)->get();
        }
        $query4 = Mailbox::where('mail_status','0')->where('to',$email)->get();

        $result = mysqli_query($con, $query);
        $result1 = mysqli_query($con, $query1);
        $result2 = mysqli_query($con, $query2);
        $output = '';
        $output1 = '';
        $output2 = '';
        $output3 = '';
        $output4 = '';
        $output5 = '';
        if(!empty($result))
        {
            while($row = mysqli_fetch_array($result))
            {
                  $output .= '
                  <li>
                  <a href="/admin/leavesupdate_status?id='.$row['id'].'">
                  <h5><b>Leave Create: '.$row["name"].'</b></h5>
                  <small><b>leave_type: <em>'.$row["leave_type"].'</em></b></small>
                  </a>
                  </li>
                  ';
            }
        }
        if(!empty($result1))
        {
            while($row1 = mysqli_fetch_array($result1))
            {
                if ($row1['assign_by'] != Auth::user()->name) {
                  # code...
                  $user = User::where('id',$row1['employee_id'])->get()->first();
                  $output1 .= '
                  <li>
                  <a href="/admin/taskupdate_status?id='.$row1['id'].'">
                <img src="/uploads/'.$user['employee_img'].'" width="30" height="30" alt="User Image" style="float:right;">
                  <h5><b>Task create: '.$row1['assign_by'].'</b></h5>
                  <small><b>Task Name: <em>'.$row1["task_name"].'</em></b></small>
                  </a>
                  </li>
                  ';
                }

            }
        }
        if(!empty($result2))
        {
            while($row2 = mysqli_fetch_array($result2))
            {
                  $output2 .= '
                  <li>
                  <a href="/admin/mailupdate_status?id='.$row2['id'].'">
                  <h5><b>Mail From: '.$row2["from"].'</b></h5>
                  <small><b>Subject: <em>'.$row2["subject"].'</em></b></small>
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
                  <a href="/admin/taskupdate_status?id='.$row3['id'].'">
                <img src="/uploads/'.$user['employee_img'].'" width="30" height="30" alt="User Image" style="float:right;">
                  <h5><b>Task update: '.$user['name'].'</b></h5>
                  <small><b>Task Name: <em>'.$row3["task_name"].'</em></b></small>
                  </a>
                  </li>
                  ';
            }
        }
        if(!empty($query4))
        {
            foreach($query4 as $row4)
            {
                  $output4 .= '
                  <li>
                  <a href="/admin/replyupdate_status?id='.$row4['id'].'">
                  <h5><b>Mail From: '.$row4["from"].'</b></h5>
                  <small><b>Subject: <em>'.$row4["subject"].'</em></b></small>
                  </a>
                  </li>
                  ';

            }
        }

        if(!empty($query5))
        {
            foreach($query5 as $row5)
            {
                  $user = User::find($row5['employee_id']);
                  $output5 .= '
                  <li>
                  <a href="/admin/taskupdate_status?id='.$row5['id'].'">
                <img src="/uploads/'.$user['employee_img'].'" width="30" height="30" alt="User Image" style="float:right;">
                  <h5><b>Task update: '.$user['name'].'</b></h5>
                  <small><b>Task Name: <em>'.$row5["task_name"].'</em></b></small>
                  </a>
                  </li>
                  ';
            }
        }
        if(empty($result1) AND empty($result) AND empty($result2)){
            $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
        }
        $status_query = "SELECT * FROM leaves WHERE admin_view=0";
        $result_query = mysqli_query($con, $status_query);
        $count0 = mysqli_num_rows($result_query);
        
        $status_query1 = "SELECT * FROM task WHERE admin_view=0";
        $result_query1 = mysqli_query($con, $status_query1);
        $count1 = "";
            while($row1 = mysqli_fetch_array($result_query1))
            {
                if ($row1['assign_by'] != Auth::user()->name) {
                  $count1 = mysqli_num_rows($result_query1);
                }
                else{
                  $count1='0';
                }
            }
        if (Auth::user()->role!='Employee') {
        $count3 = Task::where('employee_task_update','0')->where('assign_by',$name)->count();
        $count5 = Task::where('admin_task_update','0')->where('employee_id',$id)->count();
        }
        else{
          $count3 = '0';
          $count5 = '0';
        }
        // $count2 = Mailbox::where('admin_view','0')->where('to',$email)->count();
        // $count2 = '1';

        // $status_query2 = "SELECT * FROM mailbox WHERE admin_view=0";
        // $result_query2 = mysqli_query($con, $status_query2);
        // $count2 = mysqli_num_rows($result_query2);

        $count4 = Mailbox::where('mail_status','0')->where('to',$email)->count();
//        $status_query4 = "SELECT * FROM mailbox WHERE mail_status=0";
  //      $result_query4 = mysqli_query($con, $status_query4);
//        $count4 = mysqli_num_rows($result_query4);

        if($count1==''){
          $count1='0';
        } 

        $count = $count0+ $count1 +$count3+$count4+$count5;
        $data = array(
           'notification' => $output,
           'notification1' => $output1,
           // 'notification2' => $output2,
           'notification3' => $output3,
           'notification4' => $output4,
           'notification5' => $output5,
           'unseen_notification'  => $count
        );
        if (!empty($data)) {
            echo json_encode($data);
        }
    }
}
