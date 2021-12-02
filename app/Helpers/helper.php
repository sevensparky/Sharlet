<?php

use App\Models\Status;
use Illuminate\Support\Facades\Cache;

function imageProfilePath($imageName)
{
    // return public_path('storage\\' . $imageName);
    return asset('storage/'. $imageName);
}

function likeNumbers(Status $status)
{   
    $statusLikes = Cache::remember('statusLikes', now()->addSeconds(10), function() use($status){
        return $status->likers()->count();
    });

    return $statusLikes;
}