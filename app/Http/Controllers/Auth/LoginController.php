<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $archive = User::where('email', $input['email'])->where('archive',1)->first();
        $recaptcha_status = get_settings('recaptcha_status');
        
        if($archive){
            if($recaptcha_status == 1) 
            {
                $recaptcha_secret = get_settings('recaptcha_secretkey');
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$input['g-recaptcha-response']);
                $response = json_decode($response, true);

                if($response['success'] === true)
                {
                    $this->validate($request, [
                        'email' => 'required|email',
                        'password' => 'required',
                    ]);
                    if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                        if (auth()->user()->role =='admin' ) {
                            session(['login' => 'admin']);
                            return redirect()->route('admin.dashboard')->with('message', 'Welcome back!'.' '.auth()->user()->name);

                        }
                        elseif(auth()->user()->role =='user')
                        {
                            if(auth()->user()->is_agent==0)
                            {
                                session(['login' =>'user']);
                                return redirect()->route('customerAppointmentList',1);
                            }
                            else
                            {
                                session(['login' =>'user']);
                                return redirect()->route('agentAppointmentList',1);
                            }
                        }
                    } else {
                        return redirect('/login')->with('error', 'Please provide correct credentials');
                    }

                } else {
                    return redirect('/login')->with('error', 'You have to provide captcha');
                }
            } else {

                $this->validate($request, [
                    'email' => 'required|email',
                    'password' => 'required',
                ]);

                if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                    if (auth()->user()->role =='admin') {
                        session(['login' => 'admin']);
                        return redirect()->route('admin.dashboard')->with('message', 'Welcome back!'.' '.auth()->user()->name);
                    }
                    elseif(auth()->user()->role =='user')
                    {
                        if(auth()->user()->is_agent==0 )
                        {
                            session(['login' =>'user']);
                            return redirect()->route('customerAppointmentList',1)->with('message', 'Welcome back, '.auth()->user()->name);
                        }
                        else
                        {
                            session(['login' =>'user']);
                            return redirect()->route('agentAppointmentList',1)->with('message', 'Welcome back, '.auth()->user()->name);
                        }
                    }
                } else {
                    return redirect('/login')->with('error', 'Please provide correct credentials');
                }
            }

        } else {
            return redirect('/login')->with('error', 'Please provide correct credentials');
        }

    }
}
