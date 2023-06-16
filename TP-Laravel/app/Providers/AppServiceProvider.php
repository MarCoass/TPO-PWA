<?php

namespace App\Providers;

use App\Models\RolPermiso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Menú dinamico
        view()->composer(['*'], function($view) {
            $user = Auth::user();
            $data = [];
            if($user){
                // $data = RolPermiso::where('idRol', $user->rol->id)
                // ->join('permisos', 'permisos.idPermiso', '=', 'rolpermiso.idPermiso')
                // ->orderBy('permisos.nombrePermiso') // ver el orden
                // ->get();

                $data = RolPermiso::where('idRol', $user->rol->id)->get();
            }
            $view->with('menus', $data);
        });
    }
}
