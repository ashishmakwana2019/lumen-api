<?php

namespace App\Repositories\Auth;

use App\Models\User;

class ProfileRepository
{
    public function process($userId, array $input){
        User::find($userId);
        $user = $request->user();
        $input = $request->only('name','email','password');
        if (isset($input['password'])) {
            $input['password'] = encryptPassword($input['password']);
        }
        $user->fill($input);
        $user->save();
    }
}
