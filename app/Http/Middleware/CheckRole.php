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
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user()) {
            return redirect()->route('login')->with('error', __('auth.please_login'));
        }

        if ($role !== 'any' && $request->user()->role !== $role) {
            return redirect()->route('home')->with('error', __('auth.unauthorized'));
        }

        return $next($request);
    }
}
