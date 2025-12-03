<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        // Jika guard seller, redirect ke route seller.login
        if ($request->is('seller') || $request->is('seller/*')) {
            return route('seller.login');
        }
        // Jika guard admin, redirect ke route admin.dashboard
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.dashboard');
        }
        // Default: redirect ke root
        return '/';
    }
}
