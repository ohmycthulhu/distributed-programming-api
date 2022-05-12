<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Authentication\LoginRequest;
use App\Models\User;

class AuthenticationController extends BaseController
{
    protected $user;

    public function __construct(User $user)
    {
      $this->user = $user;
    }

    public function login(LoginRequest $request) {
      $token = auth()->guard('api')->attempt($request->all());

      if (!$token)
        return $this->returnError('Email or password is invalid', 403);

      return $this->returnSuccess(compact('token'));
    }

    public function me() {
      return $this->returnSuccess(['user' => auth()->user()]);
    }
}
