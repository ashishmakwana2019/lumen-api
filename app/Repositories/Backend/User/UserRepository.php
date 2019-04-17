<?php

namespace App\Repositories\Backend\User;

use App\User;

class UserRepository implements UserContract
{

    protected $model;

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
        return $this->model->with('roles:id,name')->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Find single user
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Edit user
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->model->find($id);
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
        if(isset($input['password'])){
            $input['password'] = app('hash')->make($input['password']);
        }
        $user = $this->model->create($input);
        $user->assignRole('');
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
        if(isset($input['email']) && $user->email == $input['email']){
            unset($input['email']);
        }
        if(isset($input['password'])){
            $input['password'] = app('hash')->make($input['password']);
        }
        return $this->model->find($id)->update($input);
    }

}
