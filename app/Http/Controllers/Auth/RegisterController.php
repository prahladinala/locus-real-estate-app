<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\SystemSetting;

use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    function register(Request $request) {

        $is_exist = User::where('email', $request->email)->first();
        if($is_exist){
            return redirect()->back()->with('error','Email already exist!.');
        }else{
        config([
            'mail.mailers.smtp.transport' => get_settings('smtp_protocol'),
            'mail.mailers.smtp.host' => get_settings('smtp_host'),
            'mail.mailers.smtp.port' => get_settings('smtp_port'),
            'mail.mailers.smtp.username' => get_settings('smtp_user'),
            'mail.mailers.smtp.password' => get_settings('smtp_pass'),
            'mail.mailers.smtp.encryption' => get_settings('smtp_crypto'),
            'mail.from.address' => get_settings('smtp_from_email'),
            'mail.from.name' => get_settings('system_title'),
        ]);

        $data = $request->all();

        Validator::make($data,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $emailVerifiedAt = get_settings('signup_email_verification') == 1 ? null : now();
        $verificationCode = get_settings('signup_email_verification') == 1 ? Str::random(6) : null;
       
                $user =  User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role' => 'user',
                    'archive' => 1,
                    'verification_code' => $verificationCode,
                    'email_verified_at' => $emailVerifiedAt,
                ]);
                if(get_settings('signup_email_verification') == 1){
                    // Send verification email
                  Mail::to($user->email)->send(new WelcomeEmail($user));
                  return redirect()->route('verification')->with('message', 'We send a code to your Email');
                }else{
                // Directly redirect to login
                return redirect()->route('login')->with('message', 'Registration Successfully!');  
                }
            
            
      
    }
  }
}
