<?php

namespace App\Repositories\Backend\Permission;

interface PermissionContract
{
    /**
     * Get All permissions
     * @param array $filter
     * @return mixed
     */
    public function getAll(array $filter=[]);

    /**
     * Find single permission
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Edit permission
     * @param $id
     * @return mixed
     */
    public function edit($id);

    /**
     * Delete permission
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Create new permission
     * @param array $input
     * @return mixed
     */
    public function store(array $input);

    /**
     * Update permission
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input);
}
