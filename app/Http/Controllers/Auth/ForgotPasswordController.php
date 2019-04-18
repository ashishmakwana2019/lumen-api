<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ResetsPasswords;

class ForgotPasswordController extends Controller
{
    use ResetsPasswords;

    protected $broker = 'users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->broker = 'users';
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
