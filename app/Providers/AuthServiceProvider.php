<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

            
            $this->registerPolicies();

            /*dd($user->roles->first()->slug);
            if (($user->roles->first()->slug!='externo' || $user->roles->first()->slug!='admin' ||
            $user->roles->first()->slug!='magistrado' || $user->roles->first()->slug!='sga' || $user->roles->first()->slug!='actuario'
            || $user->roles->first()->slug!='consulta' || $user->roles->first()->slug!='op' || $user->roles->first()->slug!='seceyc'))
                {
                    return view('login');
                }*/
            
                Gate::define('admin', function($user)
                {
                 
                    return $user->roles->first()->slug=='admin';
                });
                Gate::define('sga', function($user)
                {
                    return $user->roles->first()->slug=='sga';
                });

                Gate::define('magistrado', function($user)
                {
                    return $user->roles->first()->slug=='magistrado';
                });

                Gate::define('op', function($user)
                {
                    return $user->roles->first()->slug=='op';
                });

                Gate::define('actuario', function($user)
                {
                    return $user->roles->first()->slug=='actuario';
                });

                Gate::define('seceyc', function($user)
                {
                    return $user->roles->first()->slug=='seceyc';
                });

                Gate::define('externo', function($user)
                {
                    return $user->roles->first()->slug=='externo';
                });

                Gate::define('consulta', function($user)
                {
                    return $user->roles->first()->slug=='consulta';
                });
    }
}
