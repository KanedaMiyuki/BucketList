<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        $user = Auth::user();
        // dd($user);
        return view('user.profile')
            ->with('user', $user);
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
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        $user = Auth::user();
        return view('user.edit_profile')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        if($user->status == 1){
            return view('Users.ban');
        }

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:255', Rule::unique('users')->ignore(Auth::id()),
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('users.index')
            ->with('message', 'Your profile Updated Successfully.');
    }

    public function changePrivacy(){
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        return view('user.privacy')
            ->with('user', $user);
    }

    public function updatePrivacy(Request $request, User $user){
        $user = Auth::user();
        if($user->status == 1){
            return view('Users.ban');
        }

        $request->validate([
            'privacy' => 'required',
        ]);

        $user->privacy = $request->privacy;

        $user->save();

        return redirect()->route('users.index')
            ->with('message', 'Your privacy changed Successfully.');
    }

    public function changePassword(){
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        return view('user.change_password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        if($user->status == 1){
            return view('Users.ban');
        }
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect()->route('users.index')
            ->with('message', 'Your Password Changed Successfully.');
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

    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/')->with('message', 'See You Later!');
    }
}
