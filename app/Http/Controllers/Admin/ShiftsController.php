<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendances;
use App\Shifts;
use App\Leaves;
use App\Mailbox;
use App\Mail_Send;

class ShiftsController extends Controller
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

        $shiftss = Shifts::where('shifts', 'LIKE', "$searchTerm%")->orWhere('status', 'LIKE', "$searchTerm%")->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        return view('admin.shifts.index')
        ->with(compact('shiftss','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
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
        return view('admin/shifts/create')->with(compact('pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
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
                'shifts' => 'required',
        ]);

        Shifts::create([
            'shifts' => request()->get('shifts'),
            'status' => 'ACTIVE'
        ]);

        return redirect()->to('/admin/shifts');    
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
        
        $shift = Shifts::find($id);
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        return view('admin/shifts/edit')
        ->with(compact('shift','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
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
                'shifts' => 'required',
        ]);
        
        $shifts = Shifts::find($id);
        $shifts->update([
            'shifts' => request()->get('shifts')
        ]);

        return redirect()->to('/admin/shifts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = Shifts::find($id);
        $shift->delete();

        return redirect()->back();
    }

    public function status($id)
    {
        $shift = Shifts::find($id);
        $newStatus = ($shift->status == 'ACTIVE') ?  'DEACTIVE': 'ACTIVE';
        $shift->update([
            'status' => $newStatus
        ]);
        return redirect()->back();
    }
}
