<?php

use App\Http\Controllers\APIs\AuthController;
use App\Http\Controllers\APIs\BlogController;
use App\Http\Controllers\APIs\CategoryController;
use App\Http\Controllers\APIs\CityController;
use App\Http\Controllers\APIs\CourseController;
use App\Http\Controllers\APIs\TimingController;
use App\Http\Controllers\APIs\ImportController;
use App\Http\Controllers\APIs\MetaController;
use App\Http\Controllers\APIs\RoleController;
use App\Http\Controllers\APIs\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('getUser', function () {});

Route::middleware('api')->group(function () {
    // Auth routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');



    Route::middleware('jwt.auth')->group(function () {


        // User routes
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::patch('/{id}/toggle-status', [UserController::class, 'toggleStatus']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });

        // Role routes
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index']);
            Route::post('/', [RoleController::class, 'store']);
            Route::get('/{id}', [RoleController::class, 'show']);
            Route::put('/{id}', [RoleController::class, 'update']);
            Route::post('/{id}/add-user', [RoleController::class, 'addUsersToRole']);
            Route::delete('/{id}', [RoleController::class, 'destroy']);
        });

        // Categories routes
        Route::prefix('categories')->group(function () {
            Route::post('/toggle-hide', [CategoryController::class, 'bulkHide']);
            Route::get('/', [CategoryController::class, 'index']);
            Route::post('/', [CategoryController::class, 'store']);
            Route::get('{slug}', [CategoryController::class, 'show']);
            Route::put('{slug}', [CategoryController::class, 'update']);
            Route::put('{slug}/seo', [CategoryController::class, 'updateSEO']);
            Route::get('{slug}/multi-images', [CategoryController::class, 'getMultiImages']);
            Route::delete('{slug}/multi-images/{mediaId}', [CategoryController::class, 'deleteMultiImage']);
        });

        // Courses routes
        Route::prefix('courses')->group(function () {
            Route::post('/toggle-hide', [CourseController::class, 'bulkHide']);
            Route::get('/', [CourseController::class, 'index']);
            Route::post('/', [CourseController::class, 'store']);
            Route::get('{slug}', [CourseController::class, 'show']);
            Route::put('{slug}', [CourseController::class, 'update']);
            Route::put('{slug}/seo', [CourseController::class, 'updateSEO']);

            // Timings for one course
            Route::get('{slug}/timings', [TimingController::class, 'indexCourseTimings']);
            Route::post('{slug}/timings', [TimingController::class, 'store']);
        });

        // Timings routes
        Route::patch('timings/{id}/toggle-banner', [TimingController::class, 'toggleBanner']);
        Route::patch('timings/{id}/toggle-upcoming', [TimingController::class, 'toggleUpcoming']);
        Route::post('timings/toggle-hide', [TimingController::class, 'bulkHide']);
        Route::put('timings/batch-update', [TimingController::class, 'timingBatchUpdate']);
        Route::get('timings/search', [TimingController::class, 'index']);

        // Venus routes
        Route::prefix('venus')->group(function () {
            Route::post('/toggle-hide', [CityController::class, 'bulkHide']);
            Route::get('/', [CityController::class, 'index']);
            Route::post('/', [CityController::class, 'store']);
            Route::get('{slug}', [CityController::class, 'show']);
            Route::put('{slug}', [CityController::class, 'update']);
            Route::put('{slug}/seo', [CityController::class, 'updateSEO']);
        });

        // Blog routes
        Route::prefix('blog')->group(function () {
            Route::post('/toggle-hide', [BlogController::class, 'bulkHide']);
            Route::get('/', [BlogController::class, 'index']);
            Route::post('/', [BlogController::class, 'store']);
            Route::get('{slug}', [BlogController::class, 'show']);
            Route::put('{slug}', [BlogController::class, 'update']);
            Route::put('{slug}/seo', [BlogController::class, 'updateSEO']);
        });

        // Meta routes
        Route::prefix('meta')->group(function () {
            Route::get('{id}', [MetaController::class, 'show']);
            Route::put('{id}', [MetaController::class, 'update']);
        });

        // Import
        Route::prefix('imports')->group(function () {
            Route::post('process', [ImportController::class, 'process']);
            Route::get('progress', [ImportController::class, 'progress']);
            Route::post('clear-status', [ImportController::class, 'clearStatus']);
            Route::get('download', [ImportController::class, 'download']);
        });
        Route::post('truncate-tables', [ImportController::class, 'truncateTables']);
    });
});
