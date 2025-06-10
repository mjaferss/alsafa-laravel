<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        try {
            $guards = empty($guards) ? [null] : $guards;

            foreach ($guards as $guard) {
                if (Auth::guard($guard)->check()) {
                    // التحقق من حالة المستخدم
                    $user = Auth::guard($guard)->user();
                    if (!$user->is_active) {
                        Auth::guard($guard)->logout();
                        return redirect()->route('login')
                            ->with('error', trans('auth.inactive'));
                    }

                    // التحقق من الصلاحيات والتوجيه للصفحة المناسبة
                    if ($user->hasRole('admin')) {
                        return redirect(RouteServiceProvider::HOME);
                    } else {
                        return redirect('/dashboard');
                    }
                }
            }

            return $next($request);
        } catch (\Exception $e) {
            \Log::error('RedirectIfAuthenticated Error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', trans('auth.error'));
        }
    }
}
