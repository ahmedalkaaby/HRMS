<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
