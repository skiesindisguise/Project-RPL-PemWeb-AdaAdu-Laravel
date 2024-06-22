<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if($request->user() === null) {
            return redirect()->route('login');
        }
        else if ($request->user()->role !== 'user') {
            return redirect(route('admin.dashboard'));
        }
        return $next($request);
    }
}