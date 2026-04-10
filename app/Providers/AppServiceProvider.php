<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Domain\Settings\Services\SettingsService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SettingsService::class, function ($app) {
            return new SettingsService();
        });
    }

    public function boot(): void
    {
        // Share global settings with all views
        View::composer('*', function ($view) {
            try {
                $settings = app(SettingsService::class)->all();
                $view->with('globalSettings', $settings);
            } catch (\Exception $e) {
                $view->with('globalSettings', []);
            }
        });
    }
}
