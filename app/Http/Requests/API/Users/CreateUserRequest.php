<?php

namespace App\Http\Requests\API\Users;

use App\Http\Requests\API\BaseRequest;
use Illuminate\Support\Facades\Gate;

class CreateUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('manage-users')->allowed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|string',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|string',
        ];
    }
}
