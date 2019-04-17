<?php

namespace App\Repositories\Backend\User;

interface UserContract
{
    /**
     * Get All users
     * @param array $filter
     * @return mixed
     */
    public function getAll(array $filter=[]);

    /**
     * Find single user
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Edit user
     * @param $id
     * @return mixed
     */
    public function edit($id);

    /**
     * Delete user
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Create new user
     * @param array $input
     * @return mixed
     */
    public function store(array $input);

    /**
     * Update user
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input);
}
