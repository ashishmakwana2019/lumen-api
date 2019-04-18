<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{

    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {

            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'code' => 422,
                    'data' => null,
                    'message' => 'Enter valid credentials!'
                ], 422);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'code' => 422,
                'data' => null,
                'message' => 'Token expired'
            ], 422);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json([
                'code' => 422,
                'data' => null,
                'message' => 'Token invalid'
            ], 422);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'code' => 422,
                'data' => null,
                'message' => 'Token absent'
            ], 422);
        }catch (\Exception $e){
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'bad request',
                    'data' => null
                ]
            );
        }
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
