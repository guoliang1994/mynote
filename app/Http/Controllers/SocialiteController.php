<?php

namespace App\Http\Controllers;

use App\Models\Socialite as SocialiteModel;
use App\Models\User;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialiteController extends Controller
{
    /**
     * @param $type
     * @param SocialiteModel $socialite
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function callback($type, SocialiteModel $socialite, User $user)
    {
        try{
            $oauthBack = Socialite::driver($type)->stateless()->user();
            $socialite->createOrUpdate($type, $oauthBack);
            $user = User::where('account', $oauthBack->getEmail())->firstOrFail();
            $user->login();
            return view("oauth/success", ['token' =>  \auth()->user()->getRememberToken()]);
        } catch (\Exception $exception) {
            return view("oauth/error", ['token' => '', 'exception' => $exception]);
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
}
