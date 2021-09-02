<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Socialite extends Base
{
    use HasFactory;
    protected $fillable = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param string $type
     * @param $oauthBack
     * @return $this
     */
    public function createOrUpdate(string $type, $oauthBack): Socialite
    {
        $this->email = $oauthBack->getEmail();
        $this->avatar_url = $oauthBack->getAvatar();
        $this->nickname = $oauthBack->getNickname();
        $this->name = $oauthBack->getName();
        $this->type = $type;
        $this->access_token = $oauthBack->token;

        DB::transaction(function () use ($type, $oauthBack){
            switch ($type) {
                case 'github':
                    $this->socialite_id = $oauthBack->getId();
                    $this->refresh_token = $oauthBack->refreshToken;
                    $userInfo = [
                        'account' => $this->email,
                        'password' => $this->type,
                        'name' => $this->name,
                        'email' => $this->email
                    ];
                    break;
            }

            $this->oauth_back_data = json_encode($oauthBack);
            $user = User::firstOrCreate($userInfo);
            $this->user_id = $user->id;
            $this->save();
        });

        return $this;
    }
}
