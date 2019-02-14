<?php

namespace App\Http\Controllers\Auth;

Use Alert;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        if ( $user->status == 0 ) {
        auth()->logout();
            alert()->error('ErrorAlert','You are blocked or not activated.');
            return back()->withErrors(['email' => 'You are blocked or not activated.']);
        }
        toast('Login Successfully, Hello  ','success','top-right');
        return redirect()->intended($this->redirectPath());
    }
}
