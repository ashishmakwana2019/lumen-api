<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
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
     * Send reset password link
     */
    public function forgotPassword()
    {
        return response()->json(
            [
                'code' => 200,
                'message' => 'Reset password link sent to your email address',
                'data' => null
            ]
        );
    }
}
