<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
     * Get current user profile
     */
    public function show(Request $request)
    {
        return response()->json(
            [
                'code' => 200,
                'message' => null,
                'data' => [
                    'user' => Auth::user()
                ]
            ]
        );
    }
    /**
     * Update user profile
     */
    public function update()
    {
        return response()->json(
            [
                'code' => 200,
                'message' => 'updated',
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
