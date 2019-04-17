<?php

namespace App\Repositories\Backend\Role;

interface RoleContract
{
    /**
     * Get All roles
     * @param array $filter
     * @return mixed
     */
    public function getAll(array $filter=[]);

    /**
     * Find single role
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Edit role
     * @param $id
     * @return mixed
     */
    public function edit($id);

    /**
     * Delete role
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Create new role
     * @param array $input
     * @return mixed
     */
    public function store(array $input);

    /**
     * Update role
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input);
}
