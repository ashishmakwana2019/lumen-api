<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function register(Request $request)
    {
        $input = $request->only('name', 'email', 'password', 'password_confirmation');

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        DB::beginTransaction();
        try {
            $input['password'] = encryptPassword($input['password']);
            // Create basic user
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);
            // assign user role
            $user->assignRole('user');

            // TODO : Send success mail

            DB::commit();
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'Registered successful',
                    'data' => null
                ]
            );
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'Register failed',
                    'data' => null
                ], 400);
        }
    }
}
