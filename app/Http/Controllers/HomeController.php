<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
   
    /**
     * Show the home page of application .
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statuses = Cache::remember('statuses', now()->addSeconds(10), function(){
            return Status::latest()->with('user')->paginate(20);
        }); 
        return view('pages.home',[
            'statuses' => $statuses
        ]);
    } 

}
