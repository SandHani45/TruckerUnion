<?php

namespace App\Http\Controllers\Admin;

use App\DropPoint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

 	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	$drop_poins = DropPoint::all();
        return view('admin.home', compact('drop_poins'));
    }
}
