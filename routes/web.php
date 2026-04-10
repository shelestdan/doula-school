<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentWebhookController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\CoursePlayerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| SEO & System
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/doula', [AboutController::class, 'doula'])->name('doula');
Route::get('/birth-prep', [AboutController::class, 'birthPrep'])->name('birth-prep');
Route::get('/partner-birth', [AboutController::class, 'partnerBirth'])->name('partner-birth');
Route::get('/school', [AboutController::class, 'school'])->name('school');
Route::get('/prices', [AboutController::class, 'prices'])->name('prices');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::get('/partners', [PartnersController::class, 'index'])->name('partners');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Courses
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');

// News / Blog
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

/*
|--------------------------------------------------------------------------
| City landing pages (SEO)
|--------------------------------------------------------------------------
*/
Route::get('/doula-balashikha', fn () => view('city.doula', ['city' => 'Балашиха', 'cityEn' => 'balashikha']))->name('city.balashikha');
Route::get('/doula-moskva', fn () => view('city.doula', ['city' => 'Москва', 'cityEn' => 'moskva']))->name('city.moskva');
Route::get('/doula-zheleznodorozhny', fn () => view('city.doula', ['city' => 'Железнодорожный', 'cityEn' => 'zheleznodorozhny']))->name('city.zheleznodorozhny');
Route::get('/doula-reutov', fn () => view('city.doula', ['city' => 'Реутов', 'cityEn' => 'reutov']))->name('city.reutov');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Checkout & Payments
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/checkout/{course:slug}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{course:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::get('/checkout/success/{order:uuid}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failed/{order:uuid}', [CheckoutController::class, 'failed'])->name('checkout.failed');
});

Route::post('/webhooks/yookassa', [PaymentWebhookController::class, 'handle'])
    ->name('webhooks.yookassa')
    ->withoutMiddleware(['web'])
    ->middleware('throttle:60,1');

/*
|--------------------------------------------------------------------------
| Student Account
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/courses', [DashboardController::class, 'courses'])->name('courses');
    Route::get('/courses/{course:slug}', [CoursePlayerController::class, 'show'])
        ->middleware('course.access')
        ->name('course.show');
    Route::get('/courses/{course:slug}/lesson/{lesson}', [CoursePlayerController::class, 'lesson'])
        ->middleware('course.access')
        ->name('lesson.show');
    Route::post('/courses/{course:slug}/lesson/{lesson}/complete', [CoursePlayerController::class, 'complete'])
        ->middleware('course.access')
        ->name('lesson.complete');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/orders', [DashboardController::class, 'orders'])->name('orders');
});

/*
|--------------------------------------------------------------------------
| CMS Dynamic Pages (catch-all — must be last)
|--------------------------------------------------------------------------
*/
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show')
    ->where('slug', '[a-z0-9-]+');
