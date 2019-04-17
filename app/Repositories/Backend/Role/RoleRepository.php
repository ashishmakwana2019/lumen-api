<?php

namespace App\Repositories\Backend\Role;

use Spatie\Permission\Models\Role;

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
        return $this->model->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Find single role
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Edit role
     * @param $id
     * @return mixed
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
     * @return mixed
     */
    public function store(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update role
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input)
    {
        $model = $this->model->find($id);
        return $model->update([
            'name' => $input['name']
        ]);
    }

}
