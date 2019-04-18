<?php

namespace App\Repositories\Backend\Role;

use App\Models\Role;

class RoleRepository implements RoleContract
{

    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Get All roles
     * @param array $filter
     * @return mixed
     */
    public function getAll(array $filter = [])
    {
        $perPage = isset($filter['perPage']) ? $filter['perPage'] : 20;
        return $this->model->select('id', 'name')->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Find single role
     * @param $id
     * @return Role
     */
    public function find($id)
    {
        return $this->model->select('id', 'name', 'guard_name')->with('permissions')->findOrFail($id);
    }

    /**
     * Edit role
     * @param $id
     * @return Role
     */
    public function edit($id)
    {
        return $this->model->find($id);
    }

    /**
     * Delete role
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Create new role
     * @param array $input
     * @return Role
     */
    public function store(array $input)
    {
        // Store role
        $model = $this->model->create([
            'name' => $input['name']
        ]);

        // Assign permission to role
        $model->assignPermissions(!empty($input['permissions']) ? $input['permissions'] : []);

        return $model;
    }

    /**
     * Update role
     * @param $id
     * @param array $input
     * @return Role
     */
    public function update($id, array $input)
    {
        $model = $this->model->find($id);
        // Assign permission to role
        $model->assignPermissions(!empty($input['permissions']) ? $input['permissions'] : []);

        $model->update([
            'name' => $input['name']
        ]);

        return $model;
    }

}
