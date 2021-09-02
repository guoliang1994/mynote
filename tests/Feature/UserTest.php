<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser() {
//        $data = ['account' => '761297884@qq.com', 'password' => 'github'];
//        User::firstOrCreate($data);
//        $this->assertDatabaseHas('users', $data);
    }

    public function testLogin() {
        $user = User::where(['account' => "761297884@qq.com"])->firstOrFail();
        Auth::login($user, true);
        $userInfo = \auth()->user()->getRememberToken();
    }

    public function testUiLogin() {
        $response = $this
            ->json(
                'POST',
                'api/vue-element-admin/user/login',
                [
                    'account' => '761297884@qq.com',
                    'password' => 'github',
                ]
            );
        $response->assertJson(['code' => 20000, 'message' => 'Successfully login']);

    }

}
