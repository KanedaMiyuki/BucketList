<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user->admin == 1){
            return view('admin.home')->with('message', 'You successfully logged in!');
        } elseif($user->status == 1){
            return view('Users.ban');
        } else{
            return view('home')->with('message', 'You successfully logged in!');
        }
    }
}
