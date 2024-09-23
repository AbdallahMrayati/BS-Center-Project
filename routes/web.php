<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\CityController;
use App\Http\Controllers\Website\BlogController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\CourseController;
use App\Http\Controllers\Website\DownloadController;
use App\Http\Controllers\Website\InquiryController;
use App\Http\Controllers\Website\JoinTeamController;
use App\Http\Controllers\Website\RegisterController;
use App\Http\Controllers\Website\RequestInHouseController;
use App\Http\Controllers\Website\RequestOnlineController;
use Illuminate\Support\Facades\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['web', 'preventLanguageChange', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        // Navigation bar Screens
        Route::get('/', [HomeController::class, 'index'])->name('home.index');
        Route::get('/search-results', [HomeController::class, 'searchResults'])->name('search.results');

        
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/venus', [CityController::class, 'index'])->name('cities.index');
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('/about', function () {
            return view('screen.about');
        })->name('about');
        Route::get('/contact', [ContactUsController::class, 'index'])->name('contact.index');
        Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');

        // Other Screens
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
        Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('course.show');
        Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('courses.index');
        
        Route::get('/{venueslug}/{categoryslug}', [CategoryController::class, 'showCoursesViaCity'])->name('showCoursesViaCity.index');

        
        Route::get('/privacy-policy', function () {
            return view('screen.privacyPolicy');
        })->name('privacy-policy');
        Route::get('/sitemap', function () {
            return view('screen.sitemap');
        })->name('sitemap');
        Route::get('/terms', function () {
            return view('screen.terms');
        })->name('terms');

        // Forms
        Route::get('/enquire/{slug}', [InquiryController::class, 'index'])->name('enquire.index');
        Route::post('/enquire/create', [InquiryController::class, 'store'])->name('enquire.store');
        Route::get('/register/{id}', [RegisterController::class, 'index'])->name('register.index');
        Route::post('/register/create', [RegisterController::class, 'store'])->name('register.store');
        Route::get('/join-team', [JoinTeamController::class, 'index'])->name('join-team.index');
        Route::post('/join-team/create', [JoinTeamController::class, 'store'])->name('join-team.store');

        Route::get('/request-in-house/{slug}', [RequestInHouseController::class, 'index'])->name('request-in-house.index');
        Route::post('/request-in-house/create', [RequestInHouseController::class, 'store'])->name('request-in-house.store');

        Route::get('/request-online/{slug}', [RequestOnlineController::class, 'index'])->name('request-online.index');
        Route::post('/request-online/create', [RequestOnlineController::class, 'store'])->name('request-online.store');

        Route::post('/download/create', [DownloadController::class, 'store'])->name('download.store');

        // helper apis for getting data
        Route::get('{slug}/all-timings', [CourseController::class, 'getAllCourseTimings'])->name('course.timings');
        Route::get('{slug}/related-timings', [CourseController::class, 'getRelatedTimings'])->name('course.related');
        Route::get('categories/{category}/courses', [CategoryController::class, 'getCategoryCourses']);
        Route::get('categories/{city}', [CityController::class, 'getCategoriesByCity']);
        Route::get('/get-courses/{city}', [CityController::class, 'getCoursesByCity']);
        Route::get('/api/upcoming-courses', [HomeController::class, 'getUpcomingCourses']);
        Route::get('/api/search-courses', [HomeController::class, 'searchCourses']);
        Route::get('/blogs/get-blogs', [BlogController::class, 'getBlogs']);
        Route::get('/blogs/get-related-blogs/{tag}', [BlogController::class, 'getBlogsByTag']);

        Route::get('/{slug}', [CityController::class, 'show'])->name('city.show');
    }

);