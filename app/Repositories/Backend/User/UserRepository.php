<?php

namespace App\Repositories\Backend\User;

use App\Models\User;

class UserRepository implements UserContract
{

    protected $model;

    protected $select = [
        'id', 'name', 'email', 'created_at', 'updated_at'
    ];

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get All users
     * @param array $filter
     * @return mixed
     */
    public function getAll(array $filter = [])
    {
        $perPage = isset($filter['perPage']) ? $filter['perPage'] : 20;
        return $this->model->select($this->select)->with('roles:id,name')->orderBy('id', 'desc')->paginate($perPage);

    }

    /**
     * Find single user
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->select($this->select)->with('roles:id,name')->findOrFail($id);
    }

    /**
     * Edit user
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->model->select($this->select)->find($id);
    }

    /**
     * Delete user
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Create new user
     * @param array $input
     * @return mixed
     */
    public function store(array $input)
    {
        // Encrypt password
        if (isset($input['password'])) {
            $input['password'] = encryptPassword($input['password']);
        }
        $user = $this->model->create($input);
        $role = !empty($input['role']) ? $input['role'] : 'user';
        $user->assignRole($role);
        return $user;
    }

    /**
     * Update user
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input)
    {
        $user = $this->model->find($id);
        // Ignore email update
        if (isset($input['email']) && $user->email == $input['email']) {
            unset($input['email']);
        }
        if (isset($input['password'])) {
            $input['password'] = encryptPassword($input['password']);
        }
        return $this->model->find($id)->update($input);
    }

}
