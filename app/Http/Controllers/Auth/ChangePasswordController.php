<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        if (!(matchPassword($request->get('old_password'), $request->user()->password))) {
            // The passwords matches
            return response()->json([
                'code' => 422,
                'message' => "Your current password does not matches with the password you provided. Please try again."
            ], 422);
        }
        if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return response()->json([
                'code' => 422,
                'message' => "New Password cannot be same as your current password. Please choose a different password."
            ], 422);
        }
        //Update new password
        $user = Auth::user();
        $user->password = encryptPassword($request->get('new_password'));
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
}
