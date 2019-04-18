<?php

namespace Modules\Role;

//use Illuminate\Support\Facades\Route;

use Laravel\Lumen\Application;

class Role
{
    public static $namespace = 'Modules\Role\Http\Controllers\Backend';
    public static $middleware = ['module:Roles', 'auth:api'];
    public static $prefix = 'api/roles';

    /**
     * Get a Passport route registrar.
     *
     * @param  callable|Router|Application  $callback
     * @param  array  $options
     * @return RouteRegistrar
     */
    public static function routes($callback = null, array $options = [])
    {
        if ($callback instanceof Application) $callback = $callback->router;

        $callback = $callback ?: function ($router) {
            $router->all();
        };

        $defaultOptions = [
            'middleware' => self::$middleware,
            'prefix' => self::$prefix,
            'namespace' => self::$namespace,
        ];

        $options = array_merge($defaultOptions, $options);

        $callback->group($options, function ($router) use ($callback, $options) {
            $routes = new RouteRegistrar($router, $options);
            $routes->all();
        });
    }
}
