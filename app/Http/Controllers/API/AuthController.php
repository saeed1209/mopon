<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if($token = $this->guard()->attempt($credentials))
            return $this->respondWithToken($token);

        return response()->json(['error' => 'unauthorized'], 401);
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    public function me()
    {
        return response()->json([$this->guard()->user()]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL()*60
        ]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }
}
