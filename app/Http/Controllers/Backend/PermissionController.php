<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Permission\PermissionContract;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    /**
     * @var $repository
     */
    protected $repository;

    public function __construct(PermissionContract $permissionRepository)
    {
        $this->repository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => [
                'permissions' => $this->repository->getAll($request->all())
            ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'code' => 200,
            'data' => []
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            'code' => 200,
            'message' => 'stored',
            'data' => [
                'permission' => $this->repository->store($request->only(['name', 'module_name']))
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
            'data' =>[
                'permission' => $this->repository->find($id)
            ]
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'code' => 200,
            'data' =>[
                'permission' => $this->repository->find($id)
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
                'permission' => $this->repository->update($id, $request->only(['name', 'module_name']))
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
                'permission' => $this->repository->delete($id)
            ]
        ], 200);
    }
}
