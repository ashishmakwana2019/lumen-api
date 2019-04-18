<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Role\RoleContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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
            'data' => [
                'roles' => $this->repository->getAll($request->all())
            ]
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
            'message' => 'stored',
            'data' => [
                'role' => $this->repository->store($request->only('name','permissions'))
            ]
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
        return response()->json([
            'code' => 200,
            'data' => [
                'role' => $this->repository->find($id)
            ]
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
            'message' => 'updated',
           'data' => [
               'role' => $this->repository->update($id, $request->only(['name', 'permissions']))
           ]
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
            'message' => 'deleted',
            'data' => [
                'role' => $this->repository->delete($id)
            ]
        ], 200);
    }
}
