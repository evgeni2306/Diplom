<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->routeIs('admin.*')) {
            if (!Auth::guard('admin')->check()) {
                return route('admin.login');
            }
        }
        if (!Auth::guard('web')->check()) {
            return route('login');
        }
    }
}
