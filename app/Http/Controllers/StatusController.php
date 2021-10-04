<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
   
    public function latest()
    {
        return view('statuses.latest', ['userFollowings' => User::find(auth()->id())]);
    }

    public function all()
    {
        return view('statuses.all');
    }   

    public function index()
    {
        $statuses = Status::all();
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

}
