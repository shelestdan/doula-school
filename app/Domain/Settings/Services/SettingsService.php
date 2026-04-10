<?php

namespace App\Domain\Settings\Services;

use App\Domain\Settings\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    private const CACHE_KEY = 'global_settings';
    private const CACHE_TTL = 3600;

    public function get(string $key, mixed $default = null): mixed
    {
        $settings = $this->all();
        return $settings[$key] ?? $default;
    }

    public function all(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            $settings = [];
            Setting::all()->each(function (Setting $setting) use (&$settings) {
                $settings[$setting->key] = match ($setting->type) {
                    'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
                    'integer' => (int) $setting->value,
                    'json'    => json_decode($setting->value, true),
                    default   => $setting->value,
                };
            });
            return $settings;
        });
    }

    public function set(string $key, mixed $value, string $type = 'string'): void
    {
        Setting::set($key, $value, $type);
        Cache::forget(self::CACHE_KEY);
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
