<?php

namespace App\Http\Controllers\Admin;

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
        $userId = auth()->user()->id;
        $department = auth()->user()->departments;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();


        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
    	$tasksDetail = TaskDetail::get();
    	$role = Auth::user()->role;
		if ($role == 'Admin') {
			$users = User::where('role','Project Manager')->orwhere('role','Team Lead')->get();
			$userss = User::get();
            $tasks = Task::get();
    		return view('admin.task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
		}
		if ($role == 'Project Manager') {
			$users = User::where('role','Team Lead')->where('role','Employee')->get();
    		$tasks = Task::get();
			$userss = User::get();
            return view('admin.task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
		}
		if ($role == 'Internal Project Manager') {
			$userss = User::get();
// 			print_r($userss);die;
    		$tasks = Task::get();
			$users = User::get();
            return view('admin.task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
		}
		if ($role == 'Team Lead') {
			$userss = User::where('role','Employee')->where('departments',$department)->get();
            // echo "<pre>";
            // print_r(json_decode($users));
            // exit;
    		$tasks = Task::get();
			$users = User::get();
            return view('admin.task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
		}
		if ($role == 'Employee') {
			$users = User::where('role','Employee')->get();
    		$tasks = Task::get();
			$userss = User::get();
            return view('admin.task')->with(compact('userss','users','tasks','role','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
		}
    }
    
    public function edit($id)
    {
        $userId = auth()->user()->id;
        $department = auth()->user()->departments;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();


        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
    	$tasksDetail = TaskDetail::get();
        $role = Auth::user()->role;
        $task = Task::find($id);
        if ($role == 'Admin') {
			$users = User::where('role','Project Manager')->orwhere('role','Team Lead')->get();
			$userss = User::get();
            $tasks = Task::get();
    		return view('admin.task_edit')->with(compact('users','task','role','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox'));
		}
		if ($role == 'Project Manager') {
			$users = User::where('role','Team Lead')->where('role','Employee')->get();
    		$tasks = Task::get();
			$userss = User::get();
            return view('admin.task_edit')->with(compact('users','task','role','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox'));
		}
		if ($role == 'Internal Project Manager') {
			$users = User::get();
    		$tasks = Task::get();
			$userss = User::get();
            return view('admin.task_edit')->with(compact('users','task','role','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox'));
		}
		if ($role == 'Team Lead') {
			$users = User::where('role','Employee')->where('departments',$department)->get();
            // echo "<pre>";
            // print_r(json_decode($users));
            // exit;
    		$tasks = Task::get();
			$userss = User::get();
            return view('admin.task_edit')->with(compact('users','task','role','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox'));
		}
		if ($role == 'Employee') {
			$users = User::where('role','Employee')->get();
    		$tasks = Task::get();
			$userss = User::get();
            return view('admin.task_edit')->with(compact('users','task','role','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox'));
		}
    }
    

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'photos'=>'required',
        // ]);
        // print_r(request()->all());
        // exit;
        if($request->hasFile('photos'))
        {
            $allowedfileExtension=['pdf','jpg','png','docx'];
            $files = $request->file('photos');
            foreach($files as $file)
            {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                //dd($check);
                if($check)
                {
                    $data = $request->all();
                    // echo "<pre>";
                    // print_r($data);
                    // exit;
                    $user = User::find(request()->get('employee_id'));

                        if ($user['admin']=='0') {
                            $items= Task::create([
                                'task_name'=>request()->get('task_name'),
                                'employee_id'=>request()->get('employee_id'),
                                'assign_by'=>request()->get('assign_by'),
                                'due_date'=>request()->get('due_date'),
                                'priority'=>request()->get('priority'),
                                'start_date'=>request()->get('start_date'),
                                'status'=>request()->get('status'),
                                'description'=>request()->get('description'),
                                'task_status'=>'0',
                                'admin_view'=>'0',
                            ]);
                                }
                        else{
                            $items= Task::create([
                        'task_name'=>request()->get('task_name'),
                        'employee_id'=>request()->get('employee_id'),
                        'assign_by'=>request()->get('assign_by'),
                        'due_date'=>request()->get('due_date'),
                        'priority'=>request()->get('priority'),
                        'start_date'=>request()->get('start_date'),
                        'description'=>request()->get('description'),
                        'status'=>request()->get('status'),
                        'task_status'=>'0',
                        'admin_view'=>'0',
                    ]);
                        }
                    foreach ($request->photos as $photo) 
                    {
                        $fileName = md5($photo->getClientOriginalName()) . time() . "." . $photo->getClientOriginalExtension();
                        $filename = $photo->move('./uploads/task_documents',$fileName);
                        $jdata = json_decode($items);
                        TaskDetail::create([
                            'task_id' => $jdata->id,
                            'filename' => $filename
                        ]);
                    }
                    return redirect('/admin/task');
                }
            else
            {
            echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
            }
        }}


    	$data = request()->all();
    	Task::create([
            'task_name'=>request()->get('task_name'),
            'employee_id'=>request()->get('employee_id'),
            'assign_by'=>request()->get('assign_by'),
            'due_date'=>request()->get('due_date'),
            'priority'=>request()->get('priority'),
            'start_date'=>request()->get('start_date'),
            'status'=>request()->get('status'),
            'description'=>request()->get('description'),
            'task_status'=>'0',
            'admin_view'=>'0',
        ]);
    	return redirect('admin/task');
    }
    
    public function taskupdate(Request $request ,$id)
    {
        // $request = request()->all();
        $task = Task::find($id);
        if($request->hasFile('photos'))
        {
            $allowedfileExtension=['pdf','jpg','png','docx'];
            $files = $request->file('photos');
            foreach($files as $file)
            {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                //dd($check);
                if($check)
                {
                    $data = $request->all();
                    // echo "<pre>";
                    // print_r($data);
                    // exit;
                    $user = User::find(request()->get('employee_id'));

                        // if ($user['admin']=='0') {
                            $items= $task->update([
                                'task_name'=>request()->get('task_name'),
                                'employee_id'=>request()->get('employee_id'),
                                'assign_by'=>request()->get('assign_by'),
                                'due_date'=>request()->get('due_date'),
                                'priority'=>request()->get('priority'),
                                'start_date'=>request()->get('start_date'),
                                'status'=>request()->get('status'),
                                'description'=>request()->get('description'),
                                'task_status'=>'0',
                                'admin_view'=>'0',
                            ]);
                                // }
                    foreach ($request->photos as $photo) 
                    {
                        $fileName = md5($photo->getClientOriginalName()) . time() . "." . $photo->getClientOriginalExtension();
                        $filename = $photo->move('./uploads/task_documents',$fileName);
                        $jdata = json_decode($items);
                        // print_r($items);
                        // exit;
                        TaskDetail::create([
                            // 'task_id' => $jdata->id,
                            'task_id' => $id,
                            'filename' => $filename
                        ]);
                    }
                    return redirect('/admin/task');
                }
            else
            {
            echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
            }
        }}

    	$data = request()->all();
    	$task::update([
            'task_name'=>request()->get('task_name'),
            'employee_id'=>request()->get('employee_id'),
            'assign_by'=>request()->get('assign_by'),
            'due_date'=>request()->get('due_date'),
            'priority'=>request()->get('priority'),
            'start_date'=>request()->get('start_date'),
            'status'=>request()->get('status'),
            'description'=>request()->get('description'),
            'task_status'=>'0',
            'admin_view'=>'0',
        ]);
    	return redirect('admin/task');
    }
    
    public function taskdelete($id){
         $task = Task::find($id);
        $task->delete();
        return redirect()->back();
    }

    public function update(Request $request)
    {
    	$data = $request->all();
    	$id = $data['id'];
        $status = $data['status'];
    	// $role = $data['role'];
        $role = Auth::user()->role;
    	$task = Task::find($id);
        if ($role=='Admin') {
            // print_r('admin');
            // exit;
        $task->update(['status'=>$status,'admin_task_update'=>'0']);
        }
        else{
            // print_r('user');
            // exit;
    	$task->update(['status'=>$status,'employee_task_update'=>'0']);
        }
    	return redirect('/admin/task');

    }

    public function statusupdate(Request $Request)
    {
        $data = $Request->get('id');
        $task = Task::find($data);
        $task->update(['employee_task_update'=>'1','admin_view'=>'1','admin_task_update'=>'1']);
        return redirect('/admin/task');

    }

    public function detail($id)
    {
        $tasksDetail = TaskDetail::get();
        $task = Task::find($id);

        $userId = auth()->user()->id;
        $department = auth()->user()->departments;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();


        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        return view('/admin/taskdetail')->with(compact('tasksDetail','task','pending_leaves','approve_leaves','reject_leaves','shifts','tasksDetail','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));

    }
}
