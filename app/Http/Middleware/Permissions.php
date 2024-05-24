<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Permissions
{
  private $exceptNames = [
    'LaravelInstaller*',
    'LaravelUpdater*',
    'debugbar*',
    '*ajax-*',
  ];

  private $exceptControllers = [
    'LoginController',
    'ForgotPasswordController',
    'ResetPasswordController',
    'RegisterController',
  ];

  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    if (Auth::user()->is_suspended == true) {
      Auth::logout();

      return redirect()->route('login.view')->withDanger('Your account has been suspended. Please contact with admin.');
    }
    $permission = $request->route()->getName();
    // dd($permission ,$this->match($request->route()) , auth()->user()->canNot($permission));
    if ($this->match($request->route()) && auth()->user()->canNot($permission)) {
      // if ($permission != 'dashboard') {
        throw new UnauthorizedException(403, 'User does not have the permission to use ' . $permission);
      // }
    }

    return $next($request);
  }

  private function match(\Illuminate\Routing\Route $route)
  {
    if ($route->getName() == '' || $route->getName() === null) {
      return false;
    } else {
      if (in_array(class_basename($route->getController()), $this->exceptControllers)) {
        return false;
      }
      foreach ($this->exceptNames as $except) {
        if (Str::is($except, $route->getName())) {
          return false;
        }
      }
    }

    return true;
  }
}
