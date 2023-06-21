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
            static $dataGestion = null;

            if (is_null($data) && is_null($dataGestion)) {
                $user = Auth::user();
                $data = [];
                $dataGestion = [];
                if ($user) {
                    $data = RolPermiso::where('idRol', $user->rol->id)
                        ->whereHas('permiso', function($query) {
                            $query->where('nombrePermiso', 'NOT LIKE', 'Gestión%');
                        })->get();
                    $dataGestion = RolPermiso::where('idRol', $user->rol->id)
                        ->whereHas('permiso', function($query) {
                            $query->where('nombrePermiso', 'LIKE', 'Gestión%');
                        })->get();
                }
            }
        
            $view->with([
                'menus' => $data,
                'menusGestiones' => $dataGestion
            ]);
        });
    }
}
