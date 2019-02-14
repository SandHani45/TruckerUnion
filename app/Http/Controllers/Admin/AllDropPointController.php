<?php

namespace App\Http\Controllers\Admin;

use App\ActiveRoot;
use App\DropPoint;
use App\Http\Controllers\Controller;
use App\Timing;
use Illuminate\Http\Request;

class AllDropPointController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $drop_poins = DropPoint::all();
        return view('admin.pages.all-drop-point', compact('drop_poins'));
    }

  public function show($id)
    {
        return redirect(route('all-drop-points.index'));
    }

    public function edit($id)
    {   
        $drop_point = DropPoint::where('id', $id)->first();
        $timings = Timing::where('drop_point_id', $id)->get();
        return view('admin.pages.edit-drop-point', compact('drop_point','timings'));
    }

    public function update(Request $request, $id)
    {
        $imageName = '';
        $user = '';
        $timings = [
            [
                'day' => 'monday',
                'start_time'=> $request->monday_start_time, 
                'end_time' => $request->monday_end_time
            ],
            [
                'day' => 'tuesday',
                'start_time'=> $request->tuesday_start_time, 
                'end_time' => $request->tuesday_end_time
            ],
            [
                'day' => 'wednesday',
                'start_time'=> $request->wednesday_start_time, 
                'end_time' => $request->wednesday_end_time
            ],
            [
                'day' => 'thursday ',
                'start_time'=> $request->thursday__start_time, 
                'end_time' => $request->thursday__end_time
            ],
            [
                'day' => 'friday',
                'start_time'=> $request->friday_start_time, 
                'end_time' => $request->friday_end_time
            ],
            [
                'day' => 'saturday',
                'start_time'=> $request->saturday_start_time, 
                'end_time' => $request->saturday_end_time
            ],
            [
                'day' => 'sunday',
                'start_time'=> $request->sunday_start_time, 
                'end_time' => $request->sunday_end_time
            ],

        ];

        if ($request->hasFile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $image = $request->file('image');
            $t = Storage::disk('s3')->put($imageName, file_get_contents($image), 'public');
            $imageName = Storage::disk('s3')->url($imageName);
        }

        $drop_point = DropPoint::find($id);
        $drop_point->user_id = $drop_point->user_id;
        $drop_point->name = $request->name;
        $drop_point->image = $imageName ? $imageName : $drop_point->image;
        $drop_point->address = $request->address;
        $drop_point->driver_message = $request->driver_message;
        $drop_point->longitude = $request->longitude;
        $drop_point->latitude = $request->latitude;
        $drop_point->phone_number = $request->phone_number;
        $drop_point->show_in_app = $request->has('show_in_app')? true : false;
        $drop_point->phone_number = $request->phone_number;
        $drop_point->address = $request->address;
        $drop_point->rampe = $request->has('rampe')? true : false;
        $drop_point->crane = $request->has('crane')? true : false;
        $drop_point->rampe_small = $request->has('rampe_small') ? true : false;
        $drop_point->rampe_medium = $request->has('rampe_medium') ? true : false; 
        $drop_point->rampe_big = $request->has('rampe_big') ? true : false;
        $drop_point->craner_type = $request->craner_type;
        $drop_point->special_requirement = $request->has('special_requirement')? true : false;

        if($drop_point->update()) {
            foreach ($timings as $timing) {
                $updateTiming = Timing::where('drop_point_id',$drop_point->id)
                                        ->where('day', $timing['day'])
                                        ->first();
                $updateTiming->day = $timing['day'];
                $updateTiming->start_time = $timing['start_time'];
                $updateTiming->end_time = $timing['end_time'];
                $updateTiming->update();
            }

            $active_user_id = ActiveRoot::where('drop_point_id',$id)->get();
            
            if( $active_user_id == true){
                $device_tokens = array();
                foreach ($active_user_id as $active_user){
                    $device_tokens[] = User::where('id',$active_user['user_id'])->first();
                }   
            }

            /*PUSH NOTIFICATION*/  
            foreach ($device_tokens as $device_token) {

                $token = $device_token['device_token'];
                $push = new PushNotification('apn');
                $push->setConfig([
                    'priority' => 'high',
                    'dry_run' => true
                ]);
                $push->setMessage([
                    'aps' => [
                        'alert' => [
                            'title' => 'Hi!',
                            'body' => $drop_point->name .' '. 'DropPoint has Updated'. ' ' . $drop_point->driver_message
                        ],
                        'sound' => 'default',
                        'badge' => 3

                    ],
                    'extraPayLoad' => [
                        'drop_point_id' => $id,
                    ]
                ])
                ->setApiKey('AAAArZuGLv0:APA91bHiJaSi0BFtup53TMdU5VC28GPYoBDN5-f1J2b151oSHDzNNl0vxbgCHIN3eibqrO6Ymu537RsnfagvNENd5PFMVCo_W4cBNXUVoGmZlMbB9T6U2v8WvwwAERN_eXtV6J8fQGZ1')
                ->setDevicesToken($token)
                ->send();
                
                $push = new PushNotification('fcm');
                    $token = $device_token['device_token'];
                    $push->setConfig([
                        'priority' => 'high',
                        'dry_run' => false
                    ]);
                    $push->setMessage([
                       'notification' => [
                               'title'=>'Hi,'. ' ' . $drop_point->name,
                               'body'=>'DropPoint has Updated'. ' ' . $drop_point->driver_message,
                               'sound' => 'default'
                               ],
                       'data' => [
                               'drop_point_id' => $id,
                               ],
                               
                        'extraPayLoad' => [
                            'drop_point_id' => $id,
                        ]
                       ])
                    ->setApiKey('AAAArZuGLv0:APA91bHiJaSi0BFtup53TMdU5VC28GPYoBDN5-f1J2b151oSHDzNNl0vxbgCHIN3eibqrO6Ymu537RsnfagvNENd5PFMVCo_W4cBNXUVoGmZlMbB9T6U2v8WvwwAERN_eXtV6J8fQGZ1')
                    ->setDevicesToken($token)
                    ->send();
            }


        }   
        /*PUSH NOTIFICATION END*/
        // $pushNotifications = new PushNotifications(array(
        //           "instanceId" => "d8869f52-cf93-419a-be07-0441e1909153",
        //           "secretKey" => "80A79F38E1A69B693F0859187F25354",
        //         ));

        //         $publishResponse = $pushNotifications->publish(
        //           array("hello", "donuts"),
        //           array(
        //             "fcm" => array(
        //               "notification" => array(
        //                 "title" => "Hi!",
        //                 "body" => "This is my first Push Notification!"
        //               )
        //             ),
        //             "apns" => array("aps" => array(
        //               "alert" => array(
        //                 "title" => "Hi!",
        //                 "body" => "This is my first Push Notification!"
        //               )
        //             ))
        //         ));




        alert()->success('SuccessAlert','DropPoint edited ');
        return redirect(route('all-drop-points.index'));
    }

    public function destroy($id)
    {
        DropPoint::where('id', $id)->delete();
        Timing::where('drop_point_id',$id)->delete();
        Favorite::where('drop_point_id',$id)->delete();
        ActiveRoot::where('drop_point_id',$id)->delete();
        toast('Drop Point Deleted ','success','top-right');
        return redirect()->back();
    }
}
