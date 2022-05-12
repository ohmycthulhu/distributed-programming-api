<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
  protected function returnError(string $error, $status=401) {
      return response()->json(['status' => 'error', 'error' => $error], $status);
    }

    protected function returnSuccess($payload) {
      return response()->json(['status' => 'success', 'data' => $payload]);
    }
}
