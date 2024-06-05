<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Auth;

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
        $permission = $request->route()->getName();

        // Ensure user is authenticated
        if (Auth::check() && $this->match($request->route()) && Auth::user()->cannot($permission)) {
            throw new UnauthorizedException(403, 'User does not have the permission to use ' . $permission);
        }

        return $next($request);
    }

    private function match(\Illuminate\Routing\Route $route)
    {
        if (empty($route->getName())) {
            return false;
        }

        if (in_array(class_basename($route->getController()), $this->exceptControllers)) {
            return false;
        }

        foreach ($this->exceptNames as $except) {
            if (Str::is($except, $route->getName())) {
                return false;
            }
        }

        return true;
    }
}
