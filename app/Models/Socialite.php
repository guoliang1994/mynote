<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;


class Socialite extends Base implements UniqueCheck
{
    use HasFactory;
    protected $fillable = [
        'avatar_url', 'name', 'nickname',
        'access_token','socialite_id', 'refresh_token','oauth_back_data'
    ];
    protected $hidden = [
        'access_token',
        'refresh_token',
        'oauth_back_data'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exists() {
        $query = $this->newQuery();
        if ($this->id) {
            $query->where('id', '<>', $this->id);
        }
        $data = $query->where("type", $this->type)->where('email', $this->email)->first();
        if (is_object($data)) {
            return $data;
        } {
            return false;
        }
    }
    /**
     * @param string $type
     * @param $oauthBack
     * @return $this
     */
    public function createOrUpdate(string $type, $oauthBack): Socialite
    {
        DB::transaction(function () use ($type, $oauthBack){
            $this->type = $type;
            $this->email = $oauthBack->getEmail();
            $fill = [
                'avatar_url' => $oauthBack->getAvatar(),
                'nickname' => $oauthBack->getNickname(),
                'name' => $oauthBack->getName(),
                'access_token' => $oauthBack->token,
                'socialite_id' => $oauthBack->getId(),
                'refresh_token' => @$oauthBack->refreshToken,
                'oauth_back_data' => json_encode($oauthBack),
            ];

            switch ($type) {
                case 'github':

                    break;
            }
            // 判断当前第三方账号是否存在
            $model = $this->exists();
            if ($model === false) {
                $userInfo = [
                    'account' => $fill['email'],
                    'password' => $type,
                    'name' => $fill['name'],
                    'email' => $fill['email']
                ];
                $user = User::firstOrCreate($userInfo);
                $this->user_id = $user->id;
                $this->fill($fill)->save();
            } else {
                // 存在则更新数据
                $model->type = $type;
                $model->email = $oauthBack->getEmail();
                $model->fill($fill)->save();
            }
        });

        return $this;
    }
}
