<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment){
        $this->comment = $comment;
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        $request->validate([
            'comment' => 'required|min:1|max:250',
        ]);
        $this->comment->user_id = Auth::user()->id;
        $this->comment->comment = $request->comment;
        $this->comment->listing_id = $request->listing_id;

        $this->comment->save();

        return redirect()->back()->with('message', 'Comment Added Successfully');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        $comment = $this->comment->findOrFail($id);
        $this->comment->destroy($comment->id);
        return redirect()->back()->with('message', 'Comment Deleted Successfully');
    }
}
