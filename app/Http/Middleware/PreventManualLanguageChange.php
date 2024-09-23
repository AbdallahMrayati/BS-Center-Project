<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PreventManualLanguageChange
{
    public function handle($request, Closure $next)
    {
        // // Get the current locale from LaravelLocalization
        // $currentLocale = LaravelLocalization::getCurrentLocale();

        // // Get the previous locale from the cache, defaulting to the current locale
        // $previousLocale = Cache::get('previous_locale');

        // if (!$previousLocale) {
        //     // If there's no previous locale stored, set it to the current locale
        //     Cache::forever('previous_locale');
        //     Cache::put('previous_locale', $currentLocale);
        // } elseif ($currentLocale !== $previousLocale) {

        //     // Update the previous locale to the current locale before redirecting
        //     Cache::put('previous_locale', $currentLocale);
        //     // If the locales differ, it means the user changed it manually
        //     // Redirect to the localized URL of the home.index with the new locale
        //     $localizedUrl = LaravelLocalization::getLocalizedURL($currentLocale, route('home.index'));
        //     return redirect($localizedUrl);
        // }


        // Continue processing the request
        return $next($request);
    }


}
