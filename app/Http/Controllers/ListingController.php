<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    private $listing;

    public function __construct(Listing $listing){
        $this->listing = $listing;
    }

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
        return view('list.index', [
            'listings' => auth()->user()->listings()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        return view('list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        $request->validate([
            'title' => 'required|min:1|max:250',
            'description' => 'max:1048',
            'tags' => 'max:50',
            'address' => 'max:240',
            'image' => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);
        $this->listing->user_id = Auth::user()->id;
        $this->listing->title = $request->title;
        $this->listing->description = $request->description;
        $this->listing->tags = $request->tags;
        $this->listing->address = $request->address;

        if($request->image){
            $this->listing->image = $this->saveImage($request);
        }

        $this->listing->save();

        return redirect()->route('lists.index')->with('message', 'Listing Created Successfully');
    }

    public function saveImage($request){
        $image_name = time(). ".". $request->image->extension();
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);
        return $image_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        $comments = Comment::where('listing_id', $id)->get();
        // dd($comments);

        return view('list.show')
            ->with('listing', $listing)
            ->with('comments', $comments);
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
            return view('Users.ban');
        }
        $listing = Listing::findOrFail($id);

        return view('list.edit')
            ->with('listing', $listing);
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
        $user = Auth::user();
        if($user->status == 1){
            return view('Users.ban');
        }
        $request->validate([
            'title' => 'required|min:1|max:250',
            'description' => 'max:500',
            'tags' => 'max:50',
            'address' => 'max:240',
            'image' => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);
        $listing = Listing::findOrFail($id);
        $listing->user_id = Auth::user()->id;
        $listing->title = $request->title;
        $listing->description = $request->description;
        $listing->tags = $request->tags;
        $listing->address = $request->address;
        if($request->image){
            $this->deleteImage($listing->image);
            $listing->image = $this->saveImage($request);
        }
        $listing->save();

        return redirect()->route('lists.index')
          ->with('message', 'List Updated Successfully.');
    }

    public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user->status == 1){
            return view('user.ban');
        }
        $listing = $this->listing->findOrFail($id);
        $this->deleteImage($listing->image);
        $this->listing->destroy($id);
        return redirect()->route('lists.index')->with('message', 'Your Post Deleted Successfully');
    }
}
