<?php

namespace App\Http\Controllers\ApiControllers\v1;

use App\User;
use App\Timing;
use Carbon\Carbon;
use App\DropPoint;
use App\ActiveRoot;
use App\Http\Requests;
use Carbon\diffInMinutes;
use Carbon\diffInSeconds;
use Carbon\toTimeString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActiveRootCollection;

class ActiveRootController extends Controller
{
    public function index($id)
	{
        $get_time = array();
        $active_roots = ActiveRoot::join('drop_points', 'active_roots.drop_point_id', '=', 'drop_points.id')
            ->where('active_roots.user_id', '=', $id)
            ->get([
                'active_roots.id',
                'active_roots.user_id',
                'active_roots.drop_point_id',
                'drop_points.status',
                'drop_points.name',
                'drop_points.phone_number',
                'drop_points.address',
                'drop_points.image',
                'drop_points.show_in_app',
                'drop_points.longitude',
                'drop_points.latitude',
                'drop_points.rampe',
                'drop_points.crane',
                'drop_points.special_requirement',
                
            ]);

        foreach ($active_roots as $active_root) {

            $get_timings = $this->getTimings($active_root->drop_point_id);
            $get_drop_point = $get_timings->getData();
         
            if($active_root->drop_point_id = $get_drop_point->drop_point_id) {

                $myArray1 = $active_root->setAttribute('closes_at', $get_drop_point->closes_at); 
                $myArray2 = $active_root->setAttribute('opens_at', $get_drop_point->opens_at); 
                $myArray3 = $active_root->setAttribute('isStatus', $get_drop_point->isStatus); 
                $get_time[] =$myArray1;
            }    
        }
       
        return response()->json([
            'success' => true,
            'message' => 'query is successfull',
            'data' => $get_time
        ], 200);
	}
/**********************************************************************************/
/********************** closing and stating timings*****************************/
/**********************************************************************************/
    public function getTimings($drop_point_id)
    {
        $current = Carbon::now();
        $day = $current->format('l');
        $time = $current->toTimeString();
        $isStatus = 'offline';
        $timings = Timing::where('drop_point_id', $drop_point_id)
                         ->where('day', $day)
                         ->first();

        $opens = $current->diffInMinutes($timings->start_time);

         if($time >= $timings->start_time)
         {
            $opens = 'null';
         }

        $closes = $current->diffInMinutes($timings->end_time);

         if($time >= $timings->end_time)
         {
            $closes = 'null';
            $isStatus = 'offline';
         }

        if($timings->start_time <= $time && $timings->end_time >= $time )
        {
             $isStatus = 'online';
        }

        $opens_at = $this->convertToHoursMins($opens, '%02d hours %02d minutes');
        $closes_at = $this->convertToHoursMins($closes, '%02d hours %02d minutes');
       
        return response()->json([
            'drop_point_id' => $timings->drop_point_id,
            'opens_at' => $opens_at,
            'closes_at' => $closes_at,
            'isStatus'=>$isStatus
        ]);
    }

    public function convertToHoursMins($time, $format = '%02d:%02d') 
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

/**********************************************************************************/
/**********************end closing and stating timings*****************************/
/**********************************************************************************/

	public function store(Request $request)
	{
        $user_id = $request->user_id;
        $drop_point_id  = $request->drop_point_id;
        $drop_point = ActiveRoot::where('drop_point_id', $drop_point_id)
                               ->where('user_id', $user_id)
                              ->first();
        if($drop_point) {

            return response()->json([
                'success' => true,
                'message' => 'Route is already added'
            ], 200);
        }

        $add_root = new  ActiveRoot();
        $add_root->user_id = $user_id;
        $add_root->drop_point_id = $drop_point_id;
        $add_root->status = 1;
        $add_root->save();

        return response()->json([
            'success' => true,
            'message' => 'Route added successfully'
        ], 200);                     

	}
	public function destroy($id, $active_root)
	{
        $ActiveRoot = ActiveRoot::findOrFail($active_root)->delete();                    
        return response()->json([
           'success' => true,
           'message' => 'Route is deleted',
        ], 200);                  
	}
}
