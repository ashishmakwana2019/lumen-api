<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Change password
     */
    public function changePassword()
    {
        return response()->json(
            [
                'code' => 200,
                'message' => null,
                'data' => [
                    'user' => [
                        'id' => 1,
                        'name' => 'Demo user',
                        'email' => 'Demouser@mail.com'
                    ]
                ]
            ]
        );
    }
}
