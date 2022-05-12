<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Auth\AuthenticationException;


class Authenticate extends Middleware
{
  public function handle($request, Closure $next, ...$guards)
  {
    try {
      return parent::handle($request, $next, ...$guards);
    } catch (AuthenticationException $exception) {
      return response()->json(['status' => 'error', 'error' => 'Unauthorized'], 401);
    }
  }
}
