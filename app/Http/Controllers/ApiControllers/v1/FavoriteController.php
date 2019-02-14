<?php

namespace App\Http\Controllers\ApiControllers\v1;

use App\User;
use App\Timing;
use App\Favorite;
use Carbon\Carbon;
use Carbon\toTimeString;
use Carbon\diffInMinutes;
use Carbon\diffInSeconds;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\FavoriteCollection;

class FavoriteController extends Controller
{
   
    public function index($id)
    {           
        $get_time = array();
        $favorites = Favorite::join('drop_points', 'favorites.drop_point_id', '=', 'drop_points.id')
                            ->where('favorites.user_id', '=', $id)
                            ->where('favorites.status', '=', 1)
                            ->get(['favorites.id',
                                   'favorites.user_id',
                                   'favorites.drop_point_id',
                                   'drop_points.status',
                                   'drop_points.name',
                                   'drop_points.phone_number',
                                   'drop_points.address',
                                   'drop_points.image',
                                   'drop_points.state',
                                   'drop_points.show_in_app',
                                   'drop_points.longitude',
                                   'drop_points.latitude',
                                   'drop_points.rampe',
                                   'drop_points.crane',
                                   'drop_points.special_requirement',
                                   ]);    
                    
        foreach ($favorites as $favorite) {

            $get_timings = $this->getTimings($favorite->drop_point_id);
            $get_drop_point = $get_timings->getData();
            
            if($favorite->drop_point_id = $get_drop_point->drop_point_id) {
                 
                 $myArray1 = $favorite->setAttribute('closes_at', $get_drop_point->closes_at);  
                 $myArray2 = $favorite->setAttribute('opens_at', $get_drop_point->opens_at); 
                 $myArray3 = $favorite->setAttribute('isStatus', $get_drop_point->isStatus); 
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

    public function faveDropPoint(Request $request)
    {
        $user_id = $request->user_id;
        $drop_point_id  = $request->drop_point_id;

        $drop_point = Favorite::where('user_id', $user_id)
                              ->where('drop_point_id', $drop_point_id)
                              ->first();

        if($drop_point) {

           $drop_point->status = 1;
           $drop_point->save();

            return response()->json([
                'success' => true,
                'message' => 'query eas successfull'
            ], 200);
        }

        $favorite = new Favorite;
        $favorite->user_id = $user_id;
        $favorite->drop_point_id = $drop_point_id;
        $favorite->status = 1;
        $favorite->save();

        return response()->json([
            'success' => true,
            'message' => 'query eas successfull'
        ], 200);
    }
   
    public function unfavDropPoint(Request $request) 
    {
    
        $user_id = $request->user_id;
        $drop_point_id  = $request->drop_point_id;

        $drop_point = Favorite::where('user_id', $user_id)
                              ->where('drop_point_id', $drop_point_id)
                              ->first();

        if($drop_point) {

           $drop_point->status = 0;
           $drop_point->save();

            return response()->json([
                'success' => true,
                'message' => 'query is successfull'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'no found'
        ], 200);

    }

    public function destroy($id, $favorite)
    {
        $Favorite = Favorite::findOrFail($favorite)->delete();
        
        return response()->json([
           'success' => true,
           'message' => 'query is deleted',
        ], 200);
    }
}
