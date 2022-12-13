<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Mailbox;
use App\Mailsent;
use App\Maildraft;
use App\Mailtrash;
use App\User;
use App\Media;
use App\Leaves;
use App\Shifts;
use App\Attendances;
use App\Mail_Send;
use Auth;
use File;
use DB;

class MailboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchTerm = request()->get('s');
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $mailboxes = Mailbox::where('to', $userEmail)->orderBy('id','DESC')->get();
        $mailsents = Mailbox::where('user_id', $userId)->where('from', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailtrashes = Mailbox::where('user_id', $userId)->where('trash', 'TRUE')->orderBy('id','DESC')->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('to',$userEmail)->count();
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();
        $totaltrashsend = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->get();
        $totalsend = Mail_send::where('from',$userEmail)->where('trash', 'FALSE')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        $trashes = Mailbox::where('to', $userEmail)->where('trash', 'TRUE')->orderBy('id', 'DESC')->get();
        $sents = Mail_send::where('user_id', $userId)->where('trash', 'FALSE')->get();
        $mails = Mailbox::where('to', $userEmail)->where('trash','FALSE')->orderBy('id', 'DESC')->get();
        $users = User::get();
        return view('admin/mailbox/mailbox')
        ->with(compact('mails', 'mailsents', 'mailtrashes', 'mailboxes','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','trashes','sents','totalsend','totaltrash','totalinbox','totaltrashsend','totaltrashsendcount','users'));
    }


    public function index_detail($id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;

        $mailboxes = Mailbox::where('to', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailsents = Mailbox::where('user_id', $userId)->where('from', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailtrashes = Mailbox::where('user_id', $userId)->where('trash', 'TRUE')->orderBy('id','DESC')->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        $mails = Mailbox::where('to', $userEmail)->where('trash', 'FALSE')->orderBy('id', 'DESC')->get();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('user_id',$userId)->count();
        $reply = Mailbox::where('id',$id)->first();
        $totalsend = Mail_Send::where('user_id',$userId)->count();
        $reply_from = Mailbox::where('id',$reply['reply_id'])->first();

        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        $users = User::get();

        $attachments = Mailbox::where('id', $id)->get();
        $details = Mailbox::find($id);

        $mails = Mailbox::find($id);
        $mailss = json_decode($mails);
        $mail_view = $mailss->mail_view;
        if ($mail_view=='0') {
            $mails->update(['mail_view'=>'1']);
        }

        return view('admin/mailbox/index_detail')
        ->with(compact('details', 'attachments', 'mailtrashes', 'mailsents', 'mailboxes','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','mails','totalsend','totaltrash','totalinbox','reply_from','totaltrashsendcount','users'));
    }

    public function sent_detail($id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;

        $mailboxes = Mailbox::where('to', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailsents = Mailbox::where('user_id', $userId)->where('from', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailtrashes = Mailbox::where('user_id', $userId)->where('trash', 'TRUE')->orderBy('id','DESC')->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();
        $totaltrash = Mailbox::where('trash','TRUE')->where('user_id',$userId)->count();
        $reply = Mailbox::where('id',$id)->first();
        $totalsend = Mail_Send::where('user_id',$userId)->count();
        // $reply_from = Mailbox::where('id',$reply['reply_id'])->first();
        $reply_from = Mail_Send::where('id',$id)->first();
// echo "<pre>";
        // print_r(json_decode($reply_from));
        // exit;
        $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        $attachments = Mailbox::where('id', $id)->get();
        $details = Mail_Send::find($id);
        $users = User::get();
        return view('admin/mailbox/index_detail')
        ->with(compact('details', 'attachments', 'mailsents', 'mailtrashes', 'mailboxes','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','totalsend','totaltrash','totalinbox','reply_from','totaltrashsendcount','users'));
    }


    public function trash_detail($id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;

        $mailboxes = Mailbox::where('to', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailsents = Mailbox::where('user_id', $userId)->where('from', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailtrashes = Mailbox::where('user_id', $userId)->where('trash', 'TRUE')->orderBy('id','DESC')->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();

        $attachments = Mailbox::where('id', $id)->get();
        $details = Mailbox::find($id);
        return view('admin/mailbox/trash_detail')
        ->with(compact('details', 'attachments', 'mailsents', 'mailtrashes', 'mailboxes','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent'));
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

        $mailboxes = Mailbox::where('to', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailsents = Mailbox::where('user_id', $userId)->where('from', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailtrashes = Mailbox::where('user_id', $userId)->where('trash', 'TRUE')->orderBy('id','DESC')->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        $totalinbox = Mailbox::where('to',$userEmail)->where('mail_view','0')->count();

        $totaltrash = Mailbox::where('trash','TRUE')->where('user_id',$userId)->count();
        $totalsends = Mail_Send::where('user_id',$userId)->count();
        $totalsend = Mailbox::where('user_id',$userId)->count();
                $totaltrashsendcount = Mail_Send::where('trash','TRUE')->where('user_id',$userId)->count();

        $mails = Mailbox::where('user_id', $userId)->get();
        return view('admin.mailbox.compose')
        ->with(compact('mails', 'mailsents', 'mailtrashes', 'mailboxes','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent','totalsend','totaltrash','totalinbox','totaltrashsendcount'));
    }

    public function store(Request $request)
    {


        $countrie = request()->get('to');
$countries = json_encode($countrie);
        // print_r($countries);
        // exit;
        $user_countries = array();
        // foreach($countries as $country)
        // {

        $userId = auth()->user()->id;
        if ($request->status) {
            $fileName = null;

            if (request()->hasFile('attachment')) 
            {
                $file = request()->file('attachment');
                $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/', $fileName);
            }
                Mailbox::create([
                'to' => $countries,
                'from' => request()->get('from'),
                'user_id' => $userId,
                'subject' => request()->get('subject'),
                'message' => request()->get('compose-textarea'),
                'attachment' => $fileName,
                'draft' => 'FALSE',
                'trash' => 'FALSE',
                'admin_view' => '0',
                'mail_view' => '0',
                'status' => request()->get('status'),
                'mail_status' => '0',
                'reply_id' => request()->get('reply_id')
            ]);
            return redirect()->to('/mailbox');

        }
        else{
            $fileName = null;

            if (request()->hasFile('attachment')) 
            {
                $file = request()->file('attachment');
                $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/', $fileName);
            }
            $currentEmail = auth()->user()->email;
            
            Mailbox::create([
                'to' => $countries,
                'from' => $currentEmail,
                'user_id' => $userId,
                'subject' => request()->get('subject'),
                'message' => request()->get('compose-textarea'),
                'attachment' => $fileName,
                'draft' => 'FALSE',
                'mail_status' => '0',
                'mail_view' => '0',
                'admin_view' => '0',
                'trash' => 'FALSE',
                'status' => 'ACTIVATE'
            ]);

            $last_row = DB::table('mailbox')->latest()->first();
            Mail_Send::create([
                'to' => $countries,
                'from' => $currentEmail,
                'user_id' => $userId,
                'mail_id' => $last_row->id,
                'subject' => request()->get('subject'),
                'message' => request()->get('compose-textarea'),
                'attachment' => $fileName,
                'draft' => 'FALSE',
                'trash' => 'FALSE',
                'admin_view' => '0',
                'mail_status' => '0',
                'status' => 'ACTIVATE'
            ]);

        }
// }
            return redirect()->to('/mailbox');
    

    }

    public function reply(Request $request)
    {
        $countries = request()->get('to');
        $user_countries = array();
        foreach($countries as $country)
        {
        $userId = auth()->user()->id;
        if ($request->status) {
            $fileName = null;

            if (request()->hasFile('attachment')) 
            {
                $file = request()->file('attachment');
                $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/', $fileName);
            }
                Mailbox::create([
                'to' => $country,
                'from' => request()->get('from'),
                'user_id' => $userId,
                'subject' => request()->get('subject'),
                'message' => request()->get('compose-textarea'),
                'attachment' => $fileName,
                'draft' => 'FALSE',
                'trash' => 'FALSE',
                'admin_view' => '1',
                'mail_view' => '0',
                'status' => request()->get('status'),
                'mail_status' => '0',
                'reply_id' => request()->get('reply_id')
            ]);
            return redirect()->to('/mailbox');

        }
        else{
            $fileName = null;

            if (request()->hasFile('attachment')) 
            {
                $file = request()->file('attachment');
                $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/', $fileName);
            }

            $currentEmail = auth()->user()->email;
            
            Mailbox::create([
                'to' => $country,
                'from' => $currentEmail,
                'user_id' => $userId,
                'subject' => request()->get('subject'),
                'message' => request()->get('compose-textarea'),
                'attachment' => $fileName,
                'draft' => 'FALSE',
                'mail_status' => '0',
                'mail_view' => '0',
                'admin_view' => '1',
                'trash' => 'FALSE',
                'status' => 'ACTIVATE'
            ]);

            Mail_Send::create([
                'to' => $country,
                'from' => $currentEmail,
                'user_id' => $userId,
                'subject' => request()->get('subject'),
                'message' => request()->get('compose-textarea'),
                'attachment' => $fileName,
                'draft' => 'FALSE',
                'trash' => 'FALSE',
                'admin_view' => '1',
                'mail_status' => '0',
                'status' => 'ACTIVATE'
            ]);

        }
    }

        return redirect()->to('/admin/mailbox');

    }

    public function farward(Request $request)
    {
        $userId = auth()->user()->id;
        $countries = request()->get('to');
        $user_countries = array();
        foreach($countries as $country)
        {   
            $currentEmail = auth()->user()->email;
            
            Mailbox::create([
                'to' => $country,
                'from' => $currentEmail,
                'user_id' => $userId,
                'subject' => request()->get('subject'),
                'message' => request()->get('compose-textarea'),
                'attachment' => request()->get('attachment'),
                'draft' => 'FALSE',
                'mail_view' => '0',
                'mail_status' => '0',
                'trash' => 'FALSE',
                'status' => 'ACTIVATE'
            ]);

            Mail_Send::create([
                'to' => $country,
                'from' => $currentEmail,
                'user_id' => $userId,
                'subject' => request()->get('subject'),
                'message' => request()->get('compose-textarea'),
                'attachment' => request()->get('attachment'),
                'draft' => 'FALSE',
                'trash' => 'FALSE',
                'mail_status' => '0',
                'status' => 'ACTIVATE'
            ]);
            return redirect()->to('/mailbox');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dl = Mailbox::find($id);
        return  response()->download(public_path('uploads/'.$dl->attachment));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $trash = Mailbox::find($id);
        // return view('admin/')
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
        // dd(request()->all());
        $mailbox = Mailbox::find($id);
        $trash = ($mailbox->trash == 'FALSE') ? 'TRUE' : 'FALSE';

        $mailbox->update([
                'trash' => $trash
            ]);

        return redirect()->to('admin/mailbox');
    }

    public function mailupdate_status(Request $Request)
    {
        $data = $Request->get('id');
        $task = Mailbox::find($data);
        $task->update(['admin_view'=>'1']);
        return redirect('/admin/mailbox');

    }

    public function replyupdate_status(Request $Request)
    {
        $data = $Request->get('id');
        $task = Mailbox::find($data);
        $task->update(['mail_status'=>'1']);
        return redirect('/admin/mailbox');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // FOR DELETE SINGLE EMAILS 

    public function destroy($id)
    {
        $mailbox = Mailbox::find($id);
        $currentImage = $mailbox->attachment;
        $mailbox->delete();
        File::delete('./uploads/' . $currentImage);

        return redirect()->to('admin/mailbox/trash');
    }

    public function mail_delete($id)
    {
        // $id = request()->all();
        DB::table('mailbox')->where('id', $id)->delete();
        return response()->json(['success'=>"Mails Delete successfully."]);

    }

    public function deletsentemail($id)
    {
        // $id = request()->all();
        // $updateProduct = Mail_Send::whereIn('id',$id)
                  // ->update(['trash' => 'TRUE']);
        // DB::table('mail_send')->where('id', $id)->update(['trash' => 'TRUE']);
        DB::table('mail_send')->where('id', $id)->delete();
        return response()->json(['success'=>"Mails Delete successfully."]);

    }






    public function forward($id)
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;

        $mailboxes = Mailbox::where('to', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailsents = Mailbox::where('user_id', $userId)->where('from', $userEmail)->where('trash', 'FALSE')->orderBy('id','DESC')->get();
        $mailtrashes = Mailbox::where('user_id', $userId)->where('trash', 'TRUE')->orderBy('id','DESC')->get();
        $pending_leaves = Leaves::where('status','PENDING')->count();
        $approve_leaves = Leaves::where('status','APPROVE')->count();
        $reject_leaves = Leaves::where('status','REJECTED')->count();
        $shifts = Shifts::get()->count();
        $total_present = Attendances::where('attendance','PRESENT')->count();
        $total_absent = Attendances::where('attendance', 'ABSENT')->count();
        
        $forward = Mailbox::find($id);
        return view('admin/mailbox/forward')
        ->with(compact('forward', 'mailsents', 'mailtrashes', 'mailboxes','pending_leaves','approve_leaves','reject_leaves','shifts','total_present','total_absent'));
    }

    public function forward_store(Request $request, $id)
    {
        $userId = auth()->user()->id;
        $forward = Mailbox::find($id);

        $currentAttachment = $forward->attachment; 
        $fileName = null;

        if($request->hasFile('attachment'))
        {
            $file = $request->file('attachment');

            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $currentEmail = auth()->user()->email;
        
        Mailbox::create([
            'to' => request()->get('to'),
            'from' => $currentEmail,
            'user_id' => $userId,
            'subject' => request()->get('subject'),
            'message' => request()->get('compose-textarea'),
            'attachment' => ($fileName) ? $fileName : $currentAttachment,
            'draft' => 'FALSE',
            'mail_view' => '0',
            'trash' => 'FALSE',
            'mail_status' => '0',
            'status' => 'ACTIVATE'
        ]);

        return redirect()->to('admin/mailbox');
    }


    public function multi_file_upload(Request $request)
    {
        $_IMAGE = $request->file('file');
        $filename = time().$_IMAGE->getClientOriginalName();
        $uploadPath = 'public/uploads';
        $_IMAGE->move($uploadPath,$filename);

        echo json_encode($filename);
    }

    public function multi_file_remove(Request $request)
    {   
       
        try{

            $image = str_replace('"', '', $request->file);
            $directory = public_path() .  '/uploads' . $image;
            @unlink(public_path() .  '/uploads' . $image );

        }
        catch(Exception $e) {

            //echo 'Message: ' .$e->getMessage();

        }
        finally{

            $message = "success";

        }

        return json_encode($image); 
        
    }

}