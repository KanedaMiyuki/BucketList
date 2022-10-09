<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addAdmin(){
        $users = User::filter(request(['search']))->simplePaginate(20);
        return view('admin.add_admin')
            ->with('users', $users);
    }

    //Adminに変更
    public function changeUsertype_Admin($id){

        $user_detail = User::findOrFail($id);
        // dd($user_detail);
        $user_detail->admin = '1';

        $user_detail->save();
        return redirect()->route('add_admin')
            ->with('message', 'Usertype Changed As Admin Successfully');
    }

    //Userに変更
    public function changeUsertype_User($user_id){

        $user_detail = User::findOrFail($user_id);
        // dd($user_detail);
        $user_detail->admin = '0';

        $user_detail->save();
        return redirect()->route('add_admin')
            ->with('message', 'Usertype Changed As User Successfully');
    }

    public function checkInquiries(){
        return view('admin.check_inquiries', [
            'inquiries' => Inquiry::orderBy('id', 'desc')->filter(request(['search']))->simplePaginate(10)
        ]);
    }

    public function showInquiry($id){
        $inquiry = Inquiry::findOrFail($id);
        return view('admin.show_inquiry')
            ->with('inquiry', $inquiry);
    }

    public function respondInquiry($id){
        $inquiry = Inquiry::findOrFail($id);
        return view('admin.respond_inquiry')
            ->with('inquiry', $inquiry);
    }

       public function accountAdministration(){
        $users = User::filter(request(['search']))->simplePaginate(20);
        return view('admin.account_administration')
            ->with('users', $users);
    }
    //アカウント停止
    public function suspended($id){

        $user_detail = User::findOrFail($id);
        // dd($user_detail);
        $user_detail->status = '1';

        $user_detail->save();
        return redirect()->route('account')
            ->with('message', 'Account :'. $user_detail->name. ' has been suspended.');
    }
    //アカウント再開
    public function reversed($id){

        $user_detail = User::findOrFail($id);
        // dd($user_detail);
        $user_detail->status = '0';

        $user_detail->save();
        return redirect()->route('account')
            ->with('message', 'Account :'. $user_detail->name. ' has been reversed.');
    }
}
