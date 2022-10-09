<?php

use App\Http\Controllers\AdminController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InquiryController;
use App\Models\Comment;
use App\Models\Inquiry;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $listings = Lists::orderBy('id', 'desc')->get();
    // $listing = Lists::find(1);
    // $users = User::where('privacy', 'OFF')->get();
    // dd($listing->user->name);
    return view('welcome', [
        'listings' => Listing::orderBy('id', 'desc')->filter(request(['tag', 'search']))->simplePaginate(4),
    ]);
});

//Show Single List
Route::get('/show/{id}', [ListingController::class, 'show'])->where('id', '[0-9]+')->name('show');

//Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact/store', [InquiryController::class, 'store'])->name('contact.store');

Auth::routes();


Route::group(['middleware' => 'auth'], function(){
    Route::get('/ban', function(){
        return view('Users.ban');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Listing
    Route::name('lists.')->group(function(){
        //Get My All Lists
        Route::get('/index_lists', [ListingController::class, 'index'])->name('index');
        //Create
        Route::get('/create_list', [ListingController::class, 'create'])->name('create');
        //Store
        Route::post('/store_list', [ListingController::class, 'store'])->name('store');
        //Edit
        Route::get('/edit_list/{id}', [ListingController::class, 'edit'])->where('id', '[0-9]+')->name('edit');
        //Update
        Route::patch('/update_list/{id}', [ListingController::class, 'update'])->where('id', '[0-9]+')->name('update');
        //Delete
        Route::delete('/delete_list/{id}', [ListingController::class, 'destroy'])->name('destroy');

    });
    //Users
    Route::name('users.')->group(function(){
        //Index
        Route::get('/profile', [UserController::class, 'index'])->name('index');
        //Edit
        Route::get('/edit_profile/{id}', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('edit');
        //Update
        Route::put('/update_profile', [UserController::class, 'update'])->name('update');
        //Move to Change Password Page
        Route::get('/change_password', [UserController::class, 'changePassword'])->name('changePassword');
        //Change Password
        Route::put('/update_password', [UserController::class, 'updatePassword'])->name('updatePassword');
        //logout
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    });

    //Comment
    Route::name('comments.')->group(function(){
        //Store
        Route::post('/store_comment', [CommentController::class, 'store'])->name('store');
        //Delete
        Route::delete('/delete_comment/{id}', [CommentController::class, 'destroy'])->where('id', '[0-9]+')->name('destroy');
    });

    //Admin
    Route::get('/add_admin', [AdminController::class, 'addAdmin'])->name('add_admin');
    Route::patch('/changeUsertype_Admin/{id}', [AdminController::class, 'changeUsertype_Admin']);
    Route::patch('/changeUsertype_User/{id}', [AdminController::class, 'changeUsertype_User']);
    Route::get('/check_inquiries', [AdminController::class, 'checkInquiries'])->name('check');
    Route::get('/account_administration', [AdminController::class, 'accountAdministration'])->name('account');
    Route::patch('/account_administration/suspended/{id}', [AdminController::class, 'suspended']);
    Route::patch('/account_administration/reversed/{id}', [AdminController::class, 'reversed']);
    Route::get('/show_inquiry/{id}', [AdminController::class, 'showInquiry']);
    Route::get('/respond_inquiry/{id}', [AdminController::class, 'respondInquiry']);
    Route::name('admin.')->group(function(){
        Route::patch('/update_inquiry/{id}', [InquiryController::class, 'update'])->where('id', '[0-9]+')->name('update');
    });
});
