<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;

class LikeController extends Controller
{
    
    public function like(User $user, Status $status)
    {
        $user->like($status);
        return back();
    }

    public function unlike(User $user, Status $status)
    {
        $user->unlike($status);
        return back();
    }

}
