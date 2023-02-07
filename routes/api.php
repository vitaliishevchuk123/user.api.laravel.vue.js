<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\V1\UserController;
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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::get('/token', [TokenController::class, 'createToken']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::apiResources(
    [
        'users' => UserController::class,
    ]
);
});



