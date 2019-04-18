<?php

namespace App\Repositories\Backend\Permission;

use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionContract
{

    protected $model;
    protected $select = [
        'id', 'name', 'guard_name'
    ];

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Get all permissions
     * @param array $filter
     * @return Permission
     */
    public function getAll(array $filter = [])
    {
        return $this->model->select($this->select)->orderBy('id', 'desc')->paginate(isset($filter['perPage']) ? $filter['perPage'] : 20);
    }

    /**
     * Find single permission
     * @param $id
     * @return Permission
     */
    public function find($id)
    {
        return $this->model->select($this->select)->findOrFail($id);
    }

    /**
     * Edit permission
     * @param $id
     * @return Permission
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
     * @return Permission
     */
    public function store(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update permission
     * @param $id
     * @param array $input
     * @return Permission
     */
    public function update($id, array $input)
    {
        $model = $this->find($id);
        $model->fill($input);
        $model->save();
        return $model;
    }

}
