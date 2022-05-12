<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Users\CreateUserRequest;
use App\Http\Requests\API\Users\UpdateUserRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UsersController extends BaseController
{
  protected $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function create(CreateUserRequest $request) {
      $params = array_merge($request->all(), ['password' => Hash::make($request->input('password'))]);
      $user = User::create($params);

      return $this->returnSuccess(compact('user'));
    }

    public function update(User $user, UpdateUserRequest $request) {
      if ($user->isAdmin && $user->id != auth()->id()) {
        return $this->returnError("You cann't update admin's information.", 403);
      }

      $params = array_merge($request->all(), $request->input('password') ? ['password' => Hash::make($request->input('password'))] : []);
      $user->update($params);

      return $user;
    }

    public function delete(User $user) {
      if (!Gate::check('manage-users')) {
        return $this->returnError("You are not allowed.", 403);
      }

      $status = $user->delete();

      return $this->returnSuccess($status);
    }

    public function get(User $user) {
      if (!Gate::check('manage-users')) {
        return $this->returnError("You are not allowed.", 403);
      }

      return $this->returnSuccess(compact('user'));
    }

    public function index() {
      if (!Gate::check('manage-users')) {
        return $this->returnError("You are not allowed.", 403);
      }

      return $this->returnSuccess(['users' => $this->user::query()->paginate(10)]);
    }

    public function projects(User $user) {
      if (!Gate::check('manage-users')) {
        return $this->returnError("You are not allowed.", 403);
      }

      return $this->returnSuccess(['projects' => $user->projects()]);
  }
}
