<?php

namespace Modules\Role;
use Laravel\Lumen\Application;

class RouteRegistrar
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @var array
     */
    private $options;

    /**
     * Create a new route registrar instance.
     *
     * @param  $app
     * @param  array $options
     */
    public function __construct($router, array $options = [])
    {
        $this->app = $router;
        $this->options = $options;
    }

    /**
     * Register routes for transient tokens, clients, and personal access tokens.
     *
     * @return void
     */
    public function all()
    {
        $this->protectedRoutes();
    }

    /**
     * Role management routes
     */
    public function protectedRoutes()
    {
        $this->app->get('/', [
            'as' => 'roles.index', 'uses' => 'RoleController@index'
        ]);
        $this->app->post('/', [
            'as' => 'roles.store', 'uses' => 'RoleController@store'
        ]);
        $this->app->get('/{id}', [
            'as' => 'roles.show', 'uses' => 'RoleController@show'
        ]);
        $this->app->put('/{id}', [
            'as' => 'roles.update', 'uses' => 'RoleController@update'
        ]);
        $this->app->delete('/{id}', [
            'as' => 'roles.destroy', 'uses' => 'RoleController@destroy'
        ]);
    }
}
