<?php

namespace App\Http\Controllers;

use App\Models\Socialite as SocialiteModel;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialiteController extends Controller implements CRUD
{
    /**
     * @param $type
     * @param SocialiteModel $socialite
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function callback($type, SocialiteModel $socialite, User $userModel)
    {
        try{
            $oauthBack = Socialite::driver($type)->user();
            $socialite->createOrUpdate($type, $oauthBack);
            $user = $userModel->newQuery()->where("account", $oauthBack->getEmail())->firstOrFail();
            $user->login();
            return view("oauth/success", ['frontUrl' => env("SANCTUM_STATEFUL_DOMAINS")]);
        } catch (\Exception $exception) {
            return view("oauth/error", ['frontUrl' => env("SANCTUM_STATEFUL_DOMAINS")]);
        }
    }

    /**
     * @param $type
     * @return RedirectResponse
     */
    public function goAuth($type): RedirectResponse
    {
        return Socialite::driver($type)->redirect();
    }

    public function create(){}

    public function retrieve()
    {
        // TODO: Implement retrieve() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
