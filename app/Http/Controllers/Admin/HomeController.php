<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Attendances;
use App\Shifts;
use App\Leaves;
use App\Mail_Send;
use App\Mailbox;
use File;

class HomeController extends Controller
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
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('trash','FALSE')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();


        return view('admin.profile.index')->with(compact('total_present','total_absent','shifts','pending_leaves','approve_leaves','reject_leaves','userEmail','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $admin_profile = User::find($id);

        $currentImage = $admin_profile->employee_img;
        $fileName = null;


        if (request()->hasFile('employee_img')) 
        {
            $file = request()->file('employee_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }


        $admin_profile->update([
            'name' => $request['name'],
            'departments' => $request['departments'],
            'email' => $request['email'],
            'address' => $request['address'],
            'employee_img' => ($fileName) ? $fileName : $currentImage,
        ]);

        if($fileName)
            File::delete('./uploads/' . $currentImage);

        return redirect()->to('/admin/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
