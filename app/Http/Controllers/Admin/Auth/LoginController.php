<?php

namespace App\Http\Controllers\Admin\Auth;

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
    protected $redirectTo = 'admin/home';


     public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);


        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        
        return $this->sendFailedLoginResponse($request);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Create a new controller instance. 
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    // public function logout(Request $request)
    // {
    //     Auth::guard('admin')->logout();
    //     return redirect()->guest(route('admin.login'));
    // }

    public function logout(Request $request)
        {
            $this->guard('admin')->logout();

            $request->session()->invalidate();
            toast('Logout Successfully, Gud Bye ','success','top-right');
            return redirect('admin-login');
        }
    protected function authenticated(Request $request, $user)
    {
        if ( $user->status == 0 ) {
        auth()->logout();
            alert()->error('ErrorAlert','You are blocked or not activated.');
            return back()->withErrors(['email' => 'You are blocked or not activated.']);
        }
        toast('Login Successfully, Hello Super Admin ','success','top-right');
        return redirect()->intended($this->redirectPath());
    }
}
