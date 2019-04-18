<?php

/**
 * Role management routes
 */
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
