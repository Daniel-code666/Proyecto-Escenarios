<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function Login()
    {
        $credentials = $this->validate(request(),[
            'email'=>'email|required|string',
            'password'=>'required|string'
        ]);

        try
        {
            if(Auth::attempt($credentials))
            {
                $roleStdClass = DB::table('users')->where('email', $credentials['email'])->select('role_idrole')->first();

                $role = current((array) $roleStdClass);

                session(['rol'=> $role]);

                $id = DB::table('users')->where('email', $credentials['email'])->select('id')->first();
                $imgRoute = DB::table('users')->where('email', $credentials['email'])->select('photo')->first(); 
                $idConvert = current((array) $id);
                $userPhoto = current((array) $imgRoute);
                session(['id'=> $idConvert]);
                session(['userEmail' => $credentials['email']]);
                session(['userPhoto' => $userPhoto]);

                if($role == 3)
                {
                    return redirect()->route('main');
                }

                return redirect()->route('home');
            }
            else
            {
                return back()->withErrors(['email' => trans('Correo o contraseña incorrectos')]);
            }   

        }catch(Exception $ex)
        {
            return back()->withErrors(['email' => trans('Correo o contraseña incorrectos')]);
        }
    }
}
