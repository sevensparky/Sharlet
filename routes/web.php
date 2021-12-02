<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Status;

Route::get('/', [HomeController::class,'index'])->name('home');
// Route::fallback('/home', function(){
//     return redirect('/');
// });

Route::group(['middleware' => ['auth','verified']], function(){
    Route::get('statuses/@{user}' ,[StatusController::class,'index'])->name('statuses.index');
    Route::get('latest/statuses' ,[StatusController::class,'latest'])->name('statuses.latest');
    Route::get('statuses' ,[StatusController::class,'all'])->name('statuses.all');
    Route::post('statuses/new' ,[StatusController::class,'store'])->name('statuses.store');
    Route::get('/user/@{user}',[UserController::class,'show'])->name('user.profile');
    Route::post('follow/{id}/{userId}/', [UserController::class, 'followUser'])->name('follow');   
    Route::post('unfollow/{id}/{userId}/', [UserController::class, 'unfollowUser'])->name('unfollow');   
    Route::get('users', [UserController::class, 'index'])->name('users.all'); 
    Route::get('/user/@{user}/profile/update', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/user/@{user}/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('status/{status}/user/@{user}/page', [StatusController::class, 'page'])->name('status.page');
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add');
    Route::post('/reply/store', [CommentController::class ,'replyStore'])->name('reply.add');
    Route::post('like/{user}/{status}/increase', [LikeController::class, 'like'])->name('increase.like');
    Route::post('unlike/{user}/{status}/decrease', [LikeController::class, 'unlike'])->name('decrease.unlike');
});

Auth::routes();
//   Activation Email 
Route::group([], function(){
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    
    Route::get('/profile', function () {
        // This route can only be accessed by confirmed users...
    })->middleware('verified');
});


Route::get('test', function(){
    // $com = Cache::remember('test', now()->addSeconds(15), function(){
    //     return Status::latest()->first();
    // });
    
    // $com = Cache::put('test', Status::latest()->first() ,now()->addSeconds(15));

    // if (Cache::has('test')) {   
    //     dd(Cache::get('test'));
    // }else{
    //     Cache::put('test', Status::latest()->first() ,now()->addSeconds(15));
    // }

    Cache::rememberForever('test', function(){
        dd(Cache::get('test'));
    });



});