<?php

namespace App\Providers;

use App\Repositories\Backend\Permission\PermissionContract;
use App\Repositories\Backend\Permission\PermissionRepository;
use App\Repositories\Backend\Role\RoleContract;
use App\Repositories\Backend\Role\RoleRepository;
use App\Repositories\Backend\User\UserContract;
use App\Repositories\Backend\User\UserRepository;
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
        $this->registerBackendRepository();
    }

    /**
     * Backend repository binding.
     *
     * @return void
     */
    private function registerBackendRepository(){
        $this->app->bind(
            UserContract::class,
            UserRepository::class
        );

        $this->app->bind(
            RoleContract::class,
            RoleRepository::class
        );

        $this->app->bind(
            PermissionContract::class,
            PermissionRepository::class
        );
    }
}
