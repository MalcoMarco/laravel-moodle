<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\MoodleUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Autenticar usuario segun la cookie de moodle
        $cokieSesion = isset($_COOKIE["MoodleSession"]) ? $_COOKIE["MoodleSession"] : null ;
        

        if (Session::has('MoodleSession')) {
            // La variable de sesión 'MoodleSession' existe
            if (Session::get('MoodleSession') != $cokieSesion) {
                Auth::logout();
                Session::forget('MoodleSession');
            }
        } 
        if (!Auth::check()) {
            // No Hay un usuario logueado
            $sesion = DB::connection('dbmoodle')->table('mdl_sessions')
                ->where('sid',$cokieSesion)
                ->where('userid','!=',0)
                ->select('id','sid','userid')->first();

            if ($sesion) {
                $user = MoodleUser::find($sesion->userid);
                if ($user) {// Autentica al usuario
                    Auth::login($user);
                    Session::put('MoodleSession', $cokieSesion);
                }
            }else{
                Auth::logout();
                Session::forget('MoodleSession');
            }
        }
    }
}
