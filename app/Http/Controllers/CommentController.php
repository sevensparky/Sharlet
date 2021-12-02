<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Status;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {   
        $this->validate($request,[
            'comment' => 'required'
        ]);

        $comment = new Comment();

        $comment->comment = $request->comment;

        $comment->user()->associate($request->user());

        $status = Status::find($request->status_id);

        $status->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $status = Status::find($request->get('status_id'));

        $status->comments()->save($reply);

        return back();

    }
}
