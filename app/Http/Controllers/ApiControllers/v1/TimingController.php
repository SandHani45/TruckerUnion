<?php

namespace App\Http\Controllers\ApiControllers\v1;

use App\Timing;
use Carbon\Carbon;
use App\Http\Requests;
use Carbon\toTimeString;
use Carbon\diffInMinutes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TimingCollection;

class TimingController extends Controller
{
    public function index()
   {
    $Timing = Timing::all();
   	return new TimingCollection($Timing);
   }
}
