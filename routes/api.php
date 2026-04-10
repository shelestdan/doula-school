<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CoursesController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\PagesController;
use App\Http\Controllers\Api\V1\LeadsController;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\Me\CoursesController as MeCoursesController;
use App\Http\Controllers\Api\V1\Me\LessonsController as MeLessonsController;

Route::prefix('v1')->name('api.v1.')->group(function () {

    /*
    |----------------------------------------------------------------------
    | Public endpoints
    |----------------------------------------------------------------------
    */
    Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
    Route::get('/courses/{slug}', [CoursesController::class, 'show'])->name('courses.show');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

    Route::get('/pages/{slug}', [PagesController::class, 'show'])->name('pages.show');

    Route::post('/leads', [LeadsController::class, 'store'])->name('leads.store');

    /*
    |----------------------------------------------------------------------
    | Auth
    |----------------------------------------------------------------------
    */
    Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/auth/me', [AuthController::class, 'me'])->name('auth.me');

        /*
        |------------------------------------------------------------------
        | Orders
        |------------------------------------------------------------------
        */
        Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
        Route::get('/orders/{uuid}', [OrdersController::class, 'show'])->name('orders.show');

        /*
        |------------------------------------------------------------------
        | Student "me" endpoints
        |------------------------------------------------------------------
        */
        Route::prefix('me')->name('me.')->group(function () {
            Route::get('/courses', [MeCoursesController::class, 'index'])->name('courses.index');
            Route::get('/courses/{slug}', [MeCoursesController::class, 'show'])->name('courses.show');
            Route::get('/courses/{slug}/lessons/{lesson}', [MeLessonsController::class, 'show'])->name('lessons.show');
            Route::post('/courses/{slug}/lessons/{lesson}/complete', [MeLessonsController::class, 'complete'])->name('lessons.complete');
        });
    });
});
