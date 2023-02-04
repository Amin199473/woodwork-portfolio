<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterRequest;

class UserAuthController extends Controller
{
    public function UserRegister(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $credentials = request(['email', 'password']);
        $token = auth()->guard('user-api')->attempt($credentials);

        if ($user && $token) {
            $resToken = $this->respondWithToken($token);
            return response()->json(["user" => $user, "token" => $resToken, 'status' => 'success'], 200);
        }
        return response()->json([$user, 'status' => 'faild'], 500);
    }

    public function UserLogin()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('user-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function UserMe()
    {
        return response()->json(auth()->guard('user-api')->user());
    }

    public function UserLogout()
    {
        auth()->guard('user-api')->logout();

        return response()->json(['message' => 'خروج با موفقیت انجام شد.']);
    }

    public function Userefresh()
    {
        return $this->respondWithToken(auth()->guard('user-api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('user-api')->factory()->getTTL() * 60 * 24 * 365 * 5,
            'user' => auth()->guard('user-api')->user(),
        ]);
    }
}
