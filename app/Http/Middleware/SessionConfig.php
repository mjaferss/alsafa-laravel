<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionConfig
{
    public function handle(Request $request, Closure $next)
    {
        config([
            'session.same_site' => 'lax',
            'session.secure' => env('SESSION_SECURE_COOKIE', false),
            'session.domain' => env('SESSION_DOMAIN', null),
            'session.http_only' => true,
        ]);

        return $next($request);
    }
}
