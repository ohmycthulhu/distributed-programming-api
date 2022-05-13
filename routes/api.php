<?php

use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\ProjectsController;
use App\Http\Controllers\API\UsersController;
use Illuminate\Routing\Router;
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

Route::post('/user', [AuthenticationController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function (Router $router) {
  Route::get('/user', [AuthenticationController::class, 'me']);

  Route::group(['prefix' => '/users'], function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/', [UsersController::class, 'create']);
    Route::get('/{user}', [UsersController::class, 'get']);
    Route::put('/{user}', [UsersController::class, 'update']);
    Route::delete('/{user}', [UsersController::class, 'delete']);
    Route::get('/{user}/projects', [UsersController::class, 'projects']);
  });

  Route::group(['prefix' => '/projects'], function () {
    Route::get('/', [ProjectsController::class, 'search']);
    Route::post('/', [ProjectsController::class, 'create']);
    Route::get('/{project}', [ProjectsController::class, 'get']);
    Route::put('/{project}', [ProjectsController::class, 'update']);
    Route::delete('/{project}', [ProjectsController::class, 'delete']);

    Route::post('/{project}/tags', [ProjectsController::class, 'addTag']);
    Route::delete('/{project}/tags/{name}', [ProjectsController::class, 'removeTag']);
  });
});


