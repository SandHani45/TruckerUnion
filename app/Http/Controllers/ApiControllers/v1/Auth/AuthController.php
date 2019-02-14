<?php

namespace App\Http\Controllers\ApiControllers\v1\Auth;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','verifyOtp','reSendOtp']]);
    }

    public function login(Request $request)
    {   
        $otp = 1234;
        $phone_number = $request->phone_number;
        $device_token = $request->device_token;

        $user = User::where('phone_number', $phone_number)
                    ->where('device_token', $device_token)
                    ->first();

        if(!$user) {
            $new_user = new User;
            $new_user->phone_number = $phone_number;
            $new_user->otp = $otp;
            $new_user->device_token = $device_token;
            $new_user->save();

           return $this->sendOtp($phone_number);
        }
        else {

            return $this->sendOtp($phone_number);
        }
    }

    public function sendOtp($phone_number)
    {
        $otp = 1234;
        return response()->json([
            'success'=> true,
            'message'=>'Message Sent Successfully',
            'otp' => $otp
        ], 200);
    }


    public function verifyOtp(Request $request)
    {
        $otp = $request->otp;
        // status => 0 = online , 1 = offline
        $status = 0; 
        $phone_number = $request->phone_number;
        $onesignal_token = $request->onesignal_token; 

        $user = User::where('otp', $otp)
                    ->where('phone_number', $phone_number)
                    ->first();          
        $user->onesignal_token = $onesignal_token;
        $user->status = $status;
        $user->update();

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid otp'
            ], 401);
        }

        try {

            if (!$token = JWTAuth::fromUser($user)) { 
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        }
        catch (JWTException $e) {

            return response()->json(['error' => 'could_not_create_token'], 500); 
        } 

        return $this->respondWithToken($token);
    }
    
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout(Request $request)
    {
        // status => 0 = online , 1 = offline
        $status = 1;
        $user = User::where('id', $request->id)
                    ->first();
        $user->status = $status;
        $user->update();
        auth()->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

    public function reSendOtp(Request $request)
    {
        $otp = 1234;
        $phone_number = $request->phone_number;

        $user = User::where('phone_number', $phone_number)->first();

        if(!$user) {

            $new_user = new User;
            $new_user->phone_number = $phone_number;
            $new_user->otp = $otp;
            $new_user->save();

           return $this->sendOtp($phone_number);
        }
        else {

            return $this->sendOtp($phone_number);
        }
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'success' => true,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 * 60
        ]);
    }
}
