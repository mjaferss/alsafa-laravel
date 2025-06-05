<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|array  $roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login')->with('error', __('auth.please_login'));
        }

        // If 'any' is in roles array, allow access
        if (in_array('any', $roles)) {
            return $next($request);
        }

        // Check if user has any of the required roles
        if (!in_array($request->user()->role, $roles)) {
            return redirect()->route('admin.dashboard')->with('error', __('auth.unauthorized'));
        }

        return $next($request);
    }
}
