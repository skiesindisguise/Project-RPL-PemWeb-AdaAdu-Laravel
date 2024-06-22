<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if($request->user() === null) {
            return redirect()->route('login');
        }
        else if ($request->user()->role !== 'admin') {
            return redirect(route('user.dashboard'));
        }
        return $next($request);
    }
}