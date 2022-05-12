<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
  /**
   * Handle a failed validation attempt.
   *
   * @param Validator $validator
   * @return void
   *
   * @throws ValidationException
   */
  protected function failedValidation(Validator $validator){
    $response = response()->json([
      'errors' => $validator->errors(),
    ], 403);

    throw (new ValidationException($validator, $response))
      ->errorBag($this->errorBag);
  }
}
