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
        $suggestedUsers = User::latest()->take(6)->get();
        return view('users.profile',compact('user','status', 'suggestedUsers'));
    }

    /**
     * Display the specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit-profile',compact('user'));
    }

    /**
     * Update the specified user info.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        // dd($request->all());
        $user->update($request->all());
        return redirect(route('user.profile', $user));
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
