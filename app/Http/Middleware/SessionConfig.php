<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionConfig
{
    public function handle(Request $request, Closure $next)
    {
        config([
            'session.same_site' => null,
            'session.secure' => false,
            'session.domain' => null,
        ]);

        return $next($request);
    }
}
