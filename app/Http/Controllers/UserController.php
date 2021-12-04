<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = Cache::remember('users', now()->addSeconds(10), function(){
            return User::all();
        });

        $userStatuses = Cache::remember('user-statuses', now()->addSeconds(10), function(){
            return User::find(auth()->id())->latest()->paginate(2);
        });


        return view('users.index', ['users' => $users, 'userStatuses' => $userStatuses]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $status = Cache::remember('status', now()->addSeconds(10), function(){
            return Status::all();
        });

        $suggestedUsers = Cache::remember('suggestedUsers', now()->addSeconds(10), function() use ($user){
            return User::where('id', '!=', $user->id)->take(6)->latest()->get();
        });

        $userStatuses = Cache::remember('user-statuses', now()->addSeconds(10), function() use($user){
            return Status::where('user_id', '=', $user->id)->latest()->paginate(5);
        });
        
        return view('users.profile',compact('user','status', 'suggestedUsers', 'userStatuses'));
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
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = date('Ymd') . '.' . strtolower($file->getClientOriginalExtension());
            Image::make($file)->resize(250, 250)->save(storage_path('app\\public\\' . $imageName));
            $user->update(array_merge($request->all(), ['image' => $imageName]));
        }else{
            $user->update($request->all());
        }

        return redirect(route('user.profile', $user));
    }

    /**
     *  Follow the user
     *
     * @param  User $User
     * @return \Illuminate\Http\Response
     */
    public function followUser(Request $request ,$user){
        
        $findUser = User::findOrFail($request->id);
        $user = User::findOrFail($request->userId);
        $findUser->follow($user);
        return back();
    }

    /**
     *  Unfollow the user
     *
     * @param  User $User
     * @return \Illuminate\Http\Response
     */
    public function unfollowUser(Request $request ,$user){
        
        $findUser = User::findOrFail($request->id);
        $user = User::findOrFail($request->userId);
        $findUser->unfollow($user);
        return back();
    }

    
}
