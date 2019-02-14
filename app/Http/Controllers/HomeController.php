<?php

namespace App\Http\Controllers;


use App\DropPoint;
// use App\Timing;
// use Carbon\Carbon;
// use Carbon\diffInHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $drop_poins = DropPoint::where('user_id',$user->id)->get();
        return view('home', compact('drop_poins'));
   
    }
}