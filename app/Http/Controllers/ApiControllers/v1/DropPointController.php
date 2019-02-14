<?php

namespace App\Http\Controllers\ApiControllers\v1;

use App\Timing;
use Carbon\Carbon;
use App\DropPoint;
use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DropPointResource;
use App\Http\Resources\DropPointCollection;
use Symfony\Component\HttpFoundation\Response;

class DropPointController extends Controller
{
    public function index()
    {
        $get_time = array();
        $drop_points = DropPoint::all();

        foreach ($drop_points as $drop_point) {

            $get_timings = $this->getTimings($drop_point->id);
            $get_drop_point = $get_timings->getData();
         
            if($drop_point->id = $get_drop_point->drop_point_id) {

                $myArray1 = $drop_point->setAttribute('closes_at', $get_drop_point->closes_at); 
                $myArray2 = $drop_point->setAttribute('opens_at', $get_drop_point->opens_at); 
                $myArray3 = $drop_point->setAttribute('isStatus', $get_drop_point->isStatus); 
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
/********************** end closing and stating timings*****************************/
/**********************************************************************************/
    public function store(Request $request)
    {
       $drop_point = new DropPoint;
       $drop_point->user_id = $request->$id;
       $drop_point->name = $request->name;
       $drop_point->phone_number = $request->phone_number;
       $drop_point->address = $request->address;
       $drop_point->city = $request->city;
       $drop_point->state = $request->state;
       $drop_point->country = $request->country;
       $drop_point->pincode = $request->pincode;
       $drop_point->show_in_app = $request->show_in_app;
       $drop_point->longitude = $request->longitude;
       $drop_point->latitude = $request->latitude;
       $drop_point->rampe = $request->rampe;
       $drop_point->crane = $request->crane;
       $drop_point->special_requirement = $request->crane;
       $drop_point->others = $request->others;
       $drop_point->status = $request->status;
       $drop_point->save();
        
        return response()->json([
            'success' => true,
            'message' => 'query is successfull',
            'data' => new DropPointResource($drop_point)
        ], 201);
    }

    public function show($id, $drop_point)
    {   
      $is_favorite = 0;
      $get_time = array();
      
      $drop_points = DropPoint::with('timings')
                      ->where('id',$drop_point)
                      ->get();
      $favorite = Favorite::where('user_id',$id)
                        ->where('drop_point_id',$drop_point)
                        ->where('status',1)
                        ->first();

      if($favorite) {
        $is_favorite = 1;
      }

       foreach ($drop_points as $drop_point) {

            $get_timings = $this->getTimings($drop_point->id);
            $get_drop_point = $get_timings->getData();
         
            if($drop_point->id = $get_drop_point->drop_point_id) {

                $myArray1 = $drop_point->setAttribute('closes_at', $get_drop_point->closes_at); 
                $myArray2 = $drop_point->setAttribute('opens_at', $get_drop_point->opens_at); 
                $myArray3 = $drop_point->setAttribute('isStatus', $get_drop_point->isStatus); 
                $get_time[] =$myArray1;
            }    
        }

       return response()->json([
            'success' => true,
            'message' => 'query is successfull',
            'isFavorite' => $is_favorite,
            'data' => $get_time
        ], 200);

    }

    public function update(Request $request, DropPoint $drop_point)
    {
        $drop_point->upadte($request->all());

        return response()->json([
        'success' => true,
        'message' => 'query is successfull',   
        'data'=> new DropPointResource($drop_point)],201);
    }

    
    public function destroy(DropPoint $drop_point)
    {
      $drop_point->delete();

      return response()->json([
          'success' => true,
          'message' => 'query is deleted'
      ],200);
    }
}
