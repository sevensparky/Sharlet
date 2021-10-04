<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $status = Status::all();
        return view('users.profile',compact('user','status'));
    }

    /**
     *  Follow the user
     *
     * @param  User $User
     * @return \Illuminate\Http\Response
     */
    public function followUser(Request $request ,$user){
        
        $findUser1 = User::findOrFail($request->id);
        $user = User::findOrFail($request->userId);
        $findUser1->follow($user);
        return back();
    }

    /**
     *  Unfollow the user
     *
     * @param  User $User
     * @return \Illuminate\Http\Response
     */
    public function unfollowUser(Request $request ,$user){
        
        $findUser1 = User::findOrFail($request->id);
        $user = User::findOrFail($request->userId);
        $findUser1->unfollow($user);
        return back();
    }

    
}
