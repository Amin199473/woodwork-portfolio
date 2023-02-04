<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function AdminRegister(Request $request)
    {
        // dd($request);
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($admin) {
            return response()->json([$admin, 'status' => 'success'], 200);
        }

        return response()->json([$admin, 'status' => 'faild'], 500);
    }

    public function AdminLogin()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard('admin-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function AdminMe()
    {
        return response()->json(auth()->guard('admin-api')->user());
    }

    public function AdminLogout()
    {
        auth()->guard('admin-api')->logout();

        return response()->json(['message' => 'خروج با موفقیت انجام شد.']);
    }

    public function AdminRefresh()
    {
        return $this->respondWithToken(auth()->guard('admin-api')->refresh());
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
            'expires_in' => auth()->guard('admin-api')->factory()->getTTL()  * 60 * 24 * 365 * 5,
            'admin' => auth()->guard('admin-api')->user()
        ]);
    }
}
