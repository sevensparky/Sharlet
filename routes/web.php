<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class,'index']);

Route::group(['middleware' => ['auth','verified']], function(){
    Route::get('statuses/@{user}' ,[StatusController::class,'index'])->name('statuses.index');
    Route::get('latest/statuses' ,[StatusController::class,'latest'])->name('statuses.latest');
    Route::get('statuses' ,[StatusController::class,'all'])->name('statuses.all');
    Route::post('statuses/new' ,[StatusController::class,'store'])->name('statuses.store');
    Route::get('/user/@{user}',[UserController::class,'show'])->name('user.profile');
    Route::post('follow/{id}/{userId}/', [UserController::class, 'followUser'])->name('follow');   
    Route::post('unfollow/{id}/{userId}/', [UserController::class, 'unfollowUser'])->name('unfollow');   
    Route::get('users', [UserController::class, 'index'])->name('users.all'); 
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