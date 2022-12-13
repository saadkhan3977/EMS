<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Task;
use App\TaskDetail;
use App\Shifts;
use App\Leaves;
use App\Attendances;
use App\Mailbox;
use App\Mail_Send;


class TaskController extends Controller
{
    public function index()
    {
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
    	$tasksDetail = TaskDetail::get();


        $userId = auth()->user()->id;
        $departments = auth()->user()->departments;
        $userEmail = auth()->user()->email;
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('from',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

    	$role = Auth::user()->role;
		if ($role == 'Admin') {
			$users = User::where('role','Project Manager')->get();
			$userss = User::get();
            $tasks = Task::get();
    		return view('task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userId','userEmail','totalinbox','totalsend','totaltrash','totaltrashsendcount'));
		}
		if ($role == 'Project Manager') {
			$users = User::where('role','Team Lead')->get();
    		$tasks = Task::get();
			$userss = User::get();
            return view('task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userId','userEmail','totalinbox','totalsend','totaltrash','totaltrashsendcount'));
		}
		
		if ($role == 'Team Lead') {
			$users = User::where('role','Employee')->where('departments', $departments)->get();
			$userss = User::where('role','Team Lead')->get();
    		$tasks = Task::get();
			$teamlead = User::get();
            return view('task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userId','userEmail','totalinbox','totalsend','totaltrash','totaltrashsendcount','teamlead'));
		}
		if ($role == 'Employee') {
            $users = User::where('role','Employee')->get();
    		$tasks = Task::get();
			$userss = User::get();
            return view('task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userId','userEmail','totalinbox','totalsend','totaltrash','totaltrashsendcount'));
		}
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'photos'=>'required',
        ]);
        if($request->hasFile('photos'))
        {
            $allowedfileExtension=['pdf','jpg','png','docx'];
            $files = $request->file('photos');
            foreach($files as $file)
            {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if($check)
                {
                    $data = $request->all();

                    $items= Task::create([
                        'task_name'=>request()->get('task_name'),
                        'employee_id'=>request()->get('employee_id'),
                        'assign_by'=>request()->get('assign_by'),
                        'due_date'=>request()->get('due_date'),
                        'priority'=>request()->get('priority'),
                        'start_date'=>request()->get('start_date'),
                        'status'=>request()->get('status'),
                        'task_status'=>'0',
                    ]);
                    foreach ($request->photos as $photo) 
                    {
                        // $file = request()->file('employee_img');
                        $fileName = md5($photo->getClientOriginalName()) . time() . "." . $photo->getClientOriginalExtension();
                        $filename = $photo->move('./uploads/task_documents',$fileName);
                        // echo "<pre>";
                        $jdata = json_decode($items);
                        // exit;
                        TaskDetail::create([
                            'task_id' => $jdata->id,
                            'filename' => $filename
                        ]);
                    }
                    return redirect('/admin/task');
                // echo "Upload Successfully";
                }
            else
            {
            echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
            }
        }}


    	$data = request()->all();
    	Task::create($data);
    	return redirect('admin/task');
    }
     public function statusupdate(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $task = Task::find($id);
        $task->update(['task_status'=>'1']);
        return redirect('/task');

    }

    public function update(Request $request)
    {

    	$data = $request->all();
    	$id = $data['id'];
    	$status = $data['status'];
    	$task = Task::find($id);
        // $task->update(['employee_task_update'=>'1','admin_view'=>'1']);
    	$task->update(['status'=>$status,'employee_task_update'=>'0']);
    	return redirect('/task');

    }
}
