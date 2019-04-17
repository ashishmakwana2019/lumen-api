<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
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
     * Register new user
     */
    public function register()
    {
        return response()->json(
            [
                'code' => 200,
                'message' => 'Registered successful',
                'data' => null
            ]
        );
    }
}
