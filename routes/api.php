<?php

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

Route::post('/user', [\App\Http\Controllers\API\AuthenticationController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function (\Illuminate\Routing\Router $router) {
  Route::get('/user', [\App\Http\Controllers\API\AuthenticationController::class, 'me']);
});


