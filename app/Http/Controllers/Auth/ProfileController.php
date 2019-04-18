<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Get current user profile
     */
    public function show()
    {
        $user = Auth::user();
        return response()->json(
            [
                'code' => 200,
                'message' => null,
                'data' => [
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => $user->getRoleNames(),
                        'permissions' => $user->getAllPermissions()->groupBy('name')->map(function () {
                            return true;
                        })
                    ]
                ]
            ]
        );
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $input = $request->only('name', 'email', 'password');
        if (isset($input['password'])) {
            $input['password'] = encryptPassword($input['password']);
        }
        $user->fill($input);
        $user->save();

        return response()->json(
            [
                'code' => 200,
                'message' => 'updated',
                'data' => [
                    'user' => $user
                ]
            ]
        );
    }


    /**
     * Logout
     */
    public function logout()
    {
        try {
            $user = Auth::user()->token();
            $user->revoke();
            return response()->json([
                'code' => 200,
                'message' => 'Logged out',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 400,
                'message' => 'Already logged out',
                'data' => null
            ], 400);
        }
    }
}
