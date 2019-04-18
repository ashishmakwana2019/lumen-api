<?php
/**
 * Role module configuration
 * TODO : Future structure
 */
return [
    'moduleName' => 'Role',
    'title' => 'Role Management',
    'namespace' => 'Modules\Role',
    'routeMiddleware' => ['module:Roles', 'auth:api'],
    'routePrefix' => 'api/roles',
    'security' => [
        // This is for when api call third party provider or user
        'middlewareStrategy' => 'UserStrategy', // ClientStrategy
        'checkPermission' => false,
        'permissions' => [
            'roles.index',
            'roles.create',
            'roles.store',
            'roles.update',
            'roles.destroy'
        ]
    ]
];
