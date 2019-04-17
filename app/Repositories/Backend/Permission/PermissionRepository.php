<?php

namespace App\Repositories\Backend\Permission;

use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionContract
{

    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Get All permissions
     * @param array $filter
     * @return mixed
     */
    public function getAll(array $filter = [])
    {
        return $this->model->orderBy('id', 'desc')->paginate(isset($filter['perPage']) ? $filter['perPage'] : 20);
    }

    /**
     * Find single permission
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Edit permission
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->model->find($id);
    }

    /**
     * Delete permission
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Create new permission
     * @param array $input
     * @return mixed
     */
    public function store(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update permission
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input)
    {
        $model = $this->model->find($id);
        return $model->update($input);
    }

}
