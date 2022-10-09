<?php

namespace App\Http\Controllers;

use App\Mail\InquiryForm;
use App\Mail\RespondInquiry;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class InquiryController extends Controller
{
    private $inquiry;

    public function __construct(Inquiry $inquiry){
        $this->inquiry = $inquiry;
    }

    public function store(Request $request)
    {
        // $inquiry = new Inquiry();
        $request->validate([
            'user_id' => ['integer', 'max:500'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50'],
            'about' => ['required'],
            'details' => ['required', 'max:1050']
        ]);
        if(Auth::hasUser()){
            $this->inquiry->user_id = Auth::user()->id;
        } else{
            $this->inquiry->user_id = '0';
        }
        $this->inquiry->name = $request->name;
        $this->inquiry->email = $request->email;
        $this->inquiry->about = $request->about;
        $this->inquiry->details = $request->details;

        $this->inquiry->save();
        // dd($this->inquiry);
        $admin = config('mail.admin');
        Mail::to(config('mail.admin'))->send(new InquiryForm($this->inquiry));
        $email = $this->inquiry['email'];
        Mail::to($email)->send(new InquiryForm($this->inquiry));

        return redirect()->route('contact')
            ->with('message', 'Your inquiry has been sent successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'details' => 'required|max:1080'
        ]);
        $this->inquiry = Inquiry::findOrFail($id);
        $this->inquiry->details = $request->details;
        $this->inquiry->status = $request->status;
        $this->inquiry->responder = Auth::user()->name;

        $this->inquiry->save();
        // dd($this->inquiry);
        $admin = config('mail.admin');
        Mail::to(config('mail.admin'))->send(new RespondInquiry($this->inquiry));
        $email = $this->inquiry['email'];
        Mail::to($email)->send(new RespondInquiry($this->inquiry));

        return redirect()->route('check')
            ->with('message', 'Message Has Been Sent Successfully');
    }
}
