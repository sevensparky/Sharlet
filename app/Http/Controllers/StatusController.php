<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StatusController extends Controller
{
   
    public function latest()
    {
        return view('statuses.latest', ['userFollowings' => User::find(auth()->id())]);
    }

    public function all()
    {
        $allStatuses = Cache::remember('allStatuses',now()->addSeconds(10), function(){
            return Status::latest()->paginate(5);
        });
        return view('statuses.all', [
            'statuses' =>  $allStatuses
        ]);
    }   

    public function index()
    {
        $statuses = Cache::remember('statuses', now()->addSeconds(10), function(){
            return Status::all();
        });

        return view('statuses.index',compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        Status::create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);
        return back();
    }

    public function page(Status $status, User $user)
    {
        $comments = Comment::where('commentable_id', '=', $status->id)->latest()->get();
        return view('statuses.page', compact('status', 'user', 'comments'));
    }

    public function edit(Status $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(Status $status,Request $request)
    {
        $status->update([
            'body' => $request->body
        ]);
        return redirect(route('user.profile', $status->user->name));
    }

}
