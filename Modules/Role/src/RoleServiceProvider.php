<?php

namespace Modules\Role;

use Illuminate\Support\ServiceProvider;
use Modules\Role\Repositories\Backend\Role\RoleContract;
use Modules\Role\Repositories\Backend\Role\RoleRepository;

class RoleServiceProvider extends ServiceProvider
{
    protected $namespace = 'Modules\Role\Http\Controllers\Backend';
    protected $middleware = ['module:Roles','auth:api'];
    protected $prefix = 'api/roles';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RoleContract::class,
            RoleRepository::class
        );

        Role::routes($this->app);
    }
}
