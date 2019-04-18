<?php

namespace Modules\Role\Http\Controllers\Backend;

use Modules\Role\Repositories\Backend\Role\RoleContract;
use Illuminate\Http\Request;
use Modules\Role\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    /**
     * @var $repository
     */
    protected $repository;

    public function __construct(RoleContract $roleRepository)
    {
        $this->repository = $roleRepository;
    }

    /**
     * Get all roles
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json([
            'code' => 200,
            'roles' => $this->repository->getAll($request->all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            'code' => 200,
            'role' => $this->repository->store($request->only(['name']))
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->repository->find($id);
        $permissions = $role->getAllPermissions();
        return response()->json([
            'code' => 200,
            'rolePermissions' => $permissions->groupBy('module_name')->map(function ($items) {
                return $items->pluck('id')->toArray();
            }),
            'modules' => Permission::all()->groupBy('module_name'),
            'role' => $this->repository->find($id)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'code' => 200,
            'role' => $this->repository->update($id, $request->only(['name', 'permissions']))
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            'code' => 200,
            'role' => $this->repository->delete($id)
        ], 200);
    }
}
