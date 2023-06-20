<?php

namespace App\Providers;

use App\Models\RolPermiso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    static $composed;

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
        view()->composer(['*'], function ($view) {
            static $data = null;

            if (is_null($data)) {
                $user = Auth::user();
                $data = [];
                if ($user) {
                    $data = RolPermiso::where('idRol', $user->rol->id)->get();
                }
            }
        
            $view->with('menus', $data);
        });
    }
}
