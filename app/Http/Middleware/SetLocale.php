<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Get locale from session or URL parameter
            $locale = $request->query('lang') ?? session()->get('locale');

            // Get available locales from config
            $availableLocales = config('app.available_locales', ['ar', 'en']);
            $defaultLocale = config('app.locale', 'ar');

            // If locale is set and valid
            if ($locale && in_array($locale, $availableLocales)) {
                app()->setLocale($locale);
                session()->put('locale', $locale);
            } 
            // If no valid locale, try browser's language
            else {
                $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE') ?? '', 0, 2);
                $locale = in_array($browserLocale, $availableLocales) ? $browserLocale : $defaultLocale;
                app()->setLocale($locale);
                session()->put('locale', $locale);
            }

            // Set RTL/LTR direction
            $isRtl = in_array($locale, config('app.rtl_locales', ['ar']));
            session()->put('dir', $isRtl ? 'rtl' : 'ltr');

        } catch (\Exception $e) {
            // Log error and fallback to default locale
            \Log::error('Error setting locale: ' . $e->getMessage());
            app()->setLocale($defaultLocale);
            session()->put('locale', $defaultLocale);
            session()->put('dir', 'rtl');
        }

        return $next($request);
    }
}
