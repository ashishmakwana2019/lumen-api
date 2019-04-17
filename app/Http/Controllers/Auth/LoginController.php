<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Login
     */
    public function login(Request $request)
    {
        // Get User by email address
        $user = User::with('roles')->whereEmail($request->email)->first();
        // Match password
        if (!app('hash')->check($request->password, $user->password)) {
            return response()->json([
                'code' => 422,
                'message' => 'Enter valid password!'
            ], 422);
        }
        // Create Access token
        $token = $user->createToken('PersonalAccessToken')->accessToken;
        return response()->json(
            [
                'code' => 200,
                'message' => 'Login successful',
                'data' => [
                    'token' => $token
                ]
            ]
        );
    }
}
