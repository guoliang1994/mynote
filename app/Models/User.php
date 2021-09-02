<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function socialite() {
        $this->hasMany(Socialite::class);
    }

    /**
     * 通过账号密码登录
     * @param array $credentials
     * @return JsonResponse
     */
    public function loginByCredentials(array $credentials): JsonResponse
    {
        $ok = auth()->attempt($credentials);
        if (!$ok ) {
            return response()->json(['error' => 'login by credentials error'], 401);
        }
        return $this->respondWithToken(auth()->user()->createToken('vue_admin')->plainTextToken);
    }

    /**
     * 查询出用户快速登录
     */
    public function login() {
       auth()->login($this, true);
    }
    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(['code' => 20000, 'data' => [auth()->user()]]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        $user = auth();
        $expire = 7200;
        return response()->json(['code' => 20000, 'message'=> '登录成功', 'data' =>[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expire
        ]]);
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
