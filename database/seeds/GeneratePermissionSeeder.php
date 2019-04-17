<?php

use Illuminate\Database\Seeder;

class GeneratePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routeCollection = collect(app('router')->getRoutes())->map(function ($route) {
            return [
                'module' => $this->getModuleName($route['action']),
                'permissionName' => $this->getNamedRoute($route['action']),
            ];
        })->groupBy('module');

        foreach ($routeCollection as $moduleName => $permissions) {
            if (!$moduleName) {
                continue;
            }
            foreach ($permissions as $permission) {
                if (!$permission['permissionName']) {
                    continue;
                }
                $count = \Illuminate\Support\Facades\DB::table('permissions')->where('name', $permission['permissionName'])->count();
                if ($count === 0) {
                    \Spatie\Permission\Models\Permission::create([
                        'name' => $permission['permissionName'],
                        'guard_name' => 'api'
                    ]);
                }

            }
        }
    }

    /**
     * @param array $action
     * @return string
     */
    protected function getNamedRoute(array $action)
    {
        return (!isset($action['as'])) ? "" : $action['as'];
    }

    /**
     * @param array $action
     * @return string
     */
    protected function getModuleName(array $action)
    {
        if (!isset($action['middleware'])) {
            return;
        }
        if (is_array($action['middleware'])) {
            foreach ($action['middleware'] as $middleware) {
                $arr = explode(':', $middleware);
                if ($arr[0] === 'module') {
                    return $arr[1];
                }
            }
        }

        if (is_string($action['middleware'])) {
            $arr = explode(':', $action['middleware']);
            if ($arr[0] === 'module') {
                return $arr[1];
            }
        }
    }
}
