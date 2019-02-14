<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Mail\verifyEmail;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Session;
Use Alert;

class RegisterController extends Controller
{

    use RedirectsUsers;

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        toast('Registered Successfully! Please Active Yor Email','success','top-right');
        return redirect(route('login'));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function guard()
    {
        return Auth::guard();
    }


    protected $redirectTo = '/home';


    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    protected function create(array $data)
    {
        Session::flash('status', 'Registered! Please Verify Your Email ');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verifyToken' => Str::random(40),
        ]);

        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }

    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function sendEmailDone($email, $verifyToken)
    {
        Session::flash('status', 'Activation Successfully Completed! Please Login ');

        $user = User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->first();
        if($user){
             user::where(['email'=>$email,'verifyToken'=>$verifyToken])->update(['status'=>'1','verifyToken'=> NUll]);

             toast('Registered Successfully! Please Login','success','top-right');
             return redirect(route('login'));
        }else{

            return redirect(route('register'));
        }
    }

    public function verifyEmailFirst()
    {
        return view('email.verifyEmailFirst');
    }

}
