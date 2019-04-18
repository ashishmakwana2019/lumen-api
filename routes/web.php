<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use \Tymon\JWTAuth\JWTAuth;

$router->get('/', function () use ($router) {
    return [
        'user' => app('config')->get('jwt.user'),
        'appVersion' => $router->app->version(),
    ];
});

$router->post('/api/t', [
    'as' => 'tlogin', 'uses' => 'Auth\LoginController@postLogin'
]);

/**
 * Auth routes
 */
$router->group(['prefix' => 'api/auth', 'namespace' => 'Auth'], function () use ($router) {
    $router->post('/login', [
        'as' => 'login', 'uses' => 'LoginController@login'
    ]);
    $router->post('/register', [
        'as' => 'register', 'uses' => 'RegisterController@register'
    ]);
    $router->post('/forgot-password', [
        'as' => 'forgot.password', 'uses' => 'ForgotPasswordController@forgotPassword'
    ]);
});

/**
 * Testing routes
 */
$router->group(['prefix' => 'api/test', 'namespace' => 'Test'], function () use ($router) {
    $router->post('/message-broker/payload/send', [
        'as' => 'message.send', 'uses' => 'MessageBrokerController@send'
    ]);
});

/**
 * Protected routes
 */
$router->group(['prefix' => 'api/', 'middleware' => 'auth:api', 'namespace' => 'Auth'], function () use ($router) {
    $router->get('/profile', [
        'as' => 'profile.show', 'uses' => 'ProfileController@show'
    ]);
    $router->put('/profile', [
        'as' => 'profile.update', 'uses' => 'ProfileController@update'
    ]);
    $router->post('/change-password', [
        'as' => 'change.password', 'uses' => 'ChangePasswordController@changePassword'
    ]);
});

/**
 * Super admin routes
 */
$router->group(['prefix' => 'api/', 'namespace' => 'Backend', 'middleware' => 'auth:api'], function () use ($router) {
    /**
     * Permission management routes
     */
    $router->group(['middleware' => 'module:Permissions', 'prefix' => 'permissions'], function () use ($router) {
        $router->get('/', [
            'module' => 'Permissions',
            'as' => 'permissions.index', 'uses' => 'PermissionController@index'
        ]);
        $router->post('/', [
            'as' => 'permissions.store', 'uses' => 'PermissionController@store'
        ]);
        $router->get('/{id}', [
            'as' => 'permissions.show', 'uses' => 'PermissionController@show'
        ]);
        $router->put('/{id}', [
            'as' => 'permissions.update', 'uses' => 'PermissionController@update'
        ]);
        $router->delete('/{id}', [
            'as' => 'permissions.destroy', 'uses' => 'PermissionController@destroy'
        ]);
    });

    /**
     * Role management routes
     */
    $router->group(['middleware' => 'module:Roles', 'prefix' => 'roles'], function () use ($router) {
        $router->get('/', [
            'as' => 'roles.index', 'uses' => 'RoleController@index'
        ]);
        $router->post('/', [
            'as' => 'roles.store', 'uses' => 'RoleController@store'
        ]);
        $router->get('/{id}', [
            'as' => 'roles.show', 'uses' => 'RoleController@show'
        ]);
        $router->put('/{id}', [
            'as' => 'roles.update', 'uses' => 'RoleController@update'
        ]);
        $router->delete('/{id}', [
            'as' => 'roles.destroy', 'uses' => 'RoleController@destroy'
        ]);
    });
    /**
     * User management routes
     */
    $router->group(['middleware' => 'module:Users', 'prefix' => 'users'], function () use ($router) {
        $router->get('/', [
            'as' => 'users.index', 'uses' => 'UserController@index'
        ]);
        $router->post('/', [
            'as' => 'users.store', 'uses' => 'UserController@store'
        ]);
        $router->get('/{id}', [
            'as' => 'users.show', 'uses' => 'UserController@show'
        ]);
        $router->put('/{id}', [
            'as' => 'users.update', 'uses' => 'UserController@update'
        ]);
        $router->delete('/{id}', [
            'as' => 'users.destroy', 'uses' => 'UserController@destroy'
        ]);
    });
});
