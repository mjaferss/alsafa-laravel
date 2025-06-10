<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        // Validate locale
        if (!in_array($locale, ['ar', 'en'])) {
            $locale = config('app.fallback_locale', 'ar');
        }

        // Set locale in session
        session()->put('locale', $locale);
        
        // Set RTL/LTR direction
        $isRtl = in_array($locale, config('app.rtl_locales', ['ar']));
        session()->put('dir', $isRtl ? 'rtl' : 'ltr');

        // Set app locale
        app()->setLocale($locale);

        return redirect()->back();
    }
}
