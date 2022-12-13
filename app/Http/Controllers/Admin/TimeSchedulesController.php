<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendances;
use App\TimeSchedules;
use App\Leaves;
use App\Shifts;
use App\Mailbox;
use App\Mail_Send;

class TimeSchedulesController extends Controller
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

    	$timeSchedules = TimeSchedules::where('time_schedule', 'LIKE', "$searchTerm%")->orWhere('status', 'LIKE', "$searchTerm%")->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        return view('admin/time_schedule/index')
        ->with(compact('timeSchedules','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
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

        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        return view('admin/time_schedule/create')->with(compact('pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
                'time_schedule' => 'required',
        ]);

        TimeSchedules::create([
            'time_schedule' => request()->get('time_schedule'),
            'status' => 'ACTIVE'
        ]);

        return redirect()->to('/admin/timeschedules');
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
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        
        $timeSchedule = TimeSchedules::find($id);
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        return view('admin/time_schedule/edit')
        ->with(compact('timeSchedule','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
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
        $this->validate(request(), [
                'time_schedule' => 'required',
        ]);
        
    	$timeSchedule = TimeSchedules::find($id);
        $timeSchedule->update([
            'time_schedule' => request()->get('time_schedule'),
        ]);

        return redirect()->to('/admin/timeschedules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timeSchedule = TimeSchedules::find($id);
        $timeSchedule->delete();

        return redirect()->to('admin/timeschedules');
    }

    public function status($id)
    {
        $timeSchedule = TimeSchedules::find($id);
        $newStatus = ($timeSchedule->status == 'ACTIVE') ?  'DEACTIVE': 'ACTIVE';
        $timeSchedule->update([
            'status' => $newStatus
        ]);
        return redirect()->back();
    }
}
