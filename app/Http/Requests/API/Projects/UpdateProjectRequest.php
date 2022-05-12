<?php

namespace App\Http\Requests\API\Projects;

use App\Http\Requests\API\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends BaseRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'nullable|string',
      'description' => 'nullable|string',
      'private' => 'nullable|boolean',
    ];
  }
}
