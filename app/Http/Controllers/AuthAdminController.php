<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MoodleUser;
use Auth;
use Illuminate\Support\Facades\Cookie;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AuthAdminController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //private $redirectTo = '/dashboard';
    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    //private $redirectToLogout = config('app.url_moodle');

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function authUser () {
        $user = [
            'username'=>Auth::user()->username,
            'firstname'=>Auth::user()->firstname,
            'lastname'=>Auth::user()->lastname,
            'email'=>Auth::user()->email,
            'isSiteAdmin'=>Auth::user()->isSiteadmin(),
            'roles'=>Auth::user()->roles(),
            'permissions'=>Auth::user()->permissions(),
        ];
        return response()->json(['user'=>$user], 200);        
    }


    // function login(Request $request) {
    //     if ( Auth::attempt( [ 'email' => $request->email, 'password' => $request->password ]) ) {
    //         return redirect($this->redirectTo);

    //         //return response()->json( [ 'success' => true, 'message' => 'Acceso satisfactorio','user'=>Auth::user() ] );

    //     } else {
    //         return response()->json( [ 'success' => false, 'message' => 'Usuario o contraseña incorrecta' ] );
    //     }
    //     //return $request;
    // }

    function logout() {
        Auth::logout();
        return redirect( config('app.url_moodle')."/login/logout.php");
    }
}
