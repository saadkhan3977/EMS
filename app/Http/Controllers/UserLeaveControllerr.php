<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Leaves;
use App\Employees;

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
    public function index()
    {
        /*$employee = Employees::get();
        $leaves = Leaves::where('employee_id', $employee->employee_id)->get();*/
        $leaves = Leaves::orderBy('id', 'DESC')->get();

        return view('user_leave/index')
        ->with(compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_leave/create');
        
    }

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
            'status' => 'PENDING'

        ]);

        return redirect()->to('/user_leave');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$userLeaves = Leaves::find($id);

        return view('user_leave/index');*/
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
        return view('/user_leave/edit')
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
            'status' => $editStatus

        ]);

        if($fileName)
            File::delete('./uploads/', $currentImage);

        return redirect()->to('/user_leave');
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

    public function leave_index($employee_id)
    {
        $leaves = Leaves::get();
        return view('user_leave/leave_index')
        ->with(compact('leaves'));
    }
}
