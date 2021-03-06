<?php

use App\Http\Controllers\SanctumController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("vue-admin-template/user")->group(function(){
    Route::any('login', [SanctumController::class, 'login']);
    Route::get('info', [SanctumController::class, 'me']);
    Route::post('logout', [SanctumController::class, 'logout']);
    Route::get("send-check-code-email/{email}",[SanctumController::class, 'sendCheckCodeEmail'])->middleware('throttle:60');
});




Route::prefix("upload")->middleware(["auth:sanctum"])->group(function() {
    Route::any("attachment", [UploadController::class, 'attachment']);
    Route::any("avatar", [UploadController::class, 'avatar']);
});
