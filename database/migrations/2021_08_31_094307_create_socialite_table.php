<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialite', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment("类型");
            $table->string('socialite_id')->comment("第三方id");
            $table->string('nickname')->comment("昵称");
            $table->string('name')->comment("真实姓名");
            $table->string('email')->comment("邮件");
            $table->string('mobile')->nullable()->comment("手机号");
            $table->string('avatar_url')->comment("头像");
            $table->string('sex')->nullable()->comment("性别");
            $table->string('access_token')->nullable()->comment("认证token");
            $table->string('refresh_token')->nullable()->comment("刷新用");
            $table->json('oauth_back_data')->comment("认证返回的数据");
            $table->string('user_id');
            $table->unique(["type", "email"]);
            $table->unique(["type", "mobile"]);
            $table->unique(["type", "nickname"]);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socialite');
    }
}
