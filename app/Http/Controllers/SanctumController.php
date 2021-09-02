<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class SanctumController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(["auth:sanctum"], ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function login(User $user): JsonResponse
    {
        $credentials = request(['account', 'password']);
        return $user->loginByCredentials($credentials);
    }

    /**
     * Get the authenticated User.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function me(User $user): JsonResponse
    {
       return $user->me();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param User $user
     * @return JsonResponse
     */
    public function logout(User $user): JsonResponse
    {
        return $user->logout();
    }

    /**
     * Refresh a token.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function refresh(User $user): JsonResponse
    {
        return $user->refresh();
    }
}
