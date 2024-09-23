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
        // Get the current locale from LaravelLocalization
        $currentLocale = LaravelLocalization::getCurrentLocale();

        // Get the previous locale from the cache, defaulting to the current locale
        $previousLocale = Cache::get('previous_locale');

        if (!$previousLocale) {
            // If there's no previous locale stored, set it to the current locale
            Cache::forever('previous_locale');
            Cache::put('previous_locale', $currentLocale);
        } elseif ($currentLocale !== $previousLocale) {

            // Update the previous locale to the current locale before redirecting
            Cache::put('previous_locale', $currentLocale);
            // If the locales differ, it means the user changed it manually
            // Redirect to the localized URL of the home.index with the new locale
            $localizedUrl = LaravelLocalization::getLocalizedURL($currentLocale, route('home.index'));
            return redirect($localizedUrl);
        }

        // Log current and previous locales
        Log::info('**********************************************************');
        Log::info('previousLocale  ' . $previousLocale);
        Log::info('currentLocale  ' . $currentLocale);

        // Continue processing the request
        return $next($request);
    }
}


    // public function handle(Request $request, Closure $next)
    // {
    //     // Check if the locale is being changed
    //     if ($request->has('locale')) {
    //         $locale = $request->input('locale');

    //         // Validate the locale
    //         $availableLocales = ['en', 'ar']; // Add your supported locales here

    //         if (in_array($locale, $availableLocales)) {
    //             // Set the new locale
    //             App::setLocale($locale);
    //             Session::put('locale', $locale);

    //             // Redirect to the home page after changing the locale
    //             return redirect()->route('home.index');
    //         }
    //     } else {
    //         // Set locale from session if not changing it
    //         if (Session::has('locale')) {
    //             App::setLocale(Session::get('locale'));
    //         }
    //     }

    //     return $next($request); // Call the next middleware or controller
    // }
