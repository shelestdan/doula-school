<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Settings\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Branding
            ['key' => 'site_name',        'value' => 'Школа материнства',                 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_tagline',     'value' => 'Доула и перинатальный психолог',     'type' => 'string', 'group' => 'general'],
            ['key' => 'specialist_name',  'value' => 'Елена Тимофеева',                    'type' => 'string', 'group' => 'general'],
            ['key' => 'specialist_title', 'value' => 'Доула · Перинатальный психолог',     'type' => 'string', 'group' => 'general'],
            ['key' => 'specialist_photo', 'value' => '',                                   'type' => 'string', 'group' => 'general'],
            ['key' => 'specialist_about_photo', 'value' => '',                             'type' => 'string', 'group' => 'general'],
            ['key' => 'specialist_certificate_photo', 'value' => '',                       'type' => 'string', 'group' => 'general'],
            ['key' => 'site_logo',        'value' => '',                                   'type' => 'string', 'group' => 'general'],

            // Contacts
            ['key' => 'phone',            'value' => '',  'type' => 'string', 'group' => 'contacts'],
            ['key' => 'email',            'value' => '',  'type' => 'string', 'group' => 'contacts'],
            ['key' => 'address',          'value' => 'Балашиха, Московская область', 'type' => 'string', 'group' => 'contacts'],

            // Social
            ['key' => 'telegram_url',     'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'telegram_username','value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'vk_url',           'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'youtube_url',      'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'instagram_url',    'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'whatsapp_url',     'value' => '', 'type' => 'string', 'group' => 'social'],

            // SEO
            ['key' => 'meta_title',       'value' => 'Школа материнства — Доула в Балашихе и Москве', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Авторские онлайн-курсы и сопровождение родов от доулы и перинатального психолога.', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'og_image',         'value' => '', 'type' => 'string', 'group' => 'seo'],

            // Analytics
            ['key' => 'yandex_metrika_id','value' => '', 'type' => 'string', 'group' => 'analytics'],
            ['key' => 'ga4_id',           'value' => '', 'type' => 'string', 'group' => 'analytics'],

            // Payments
            ['key' => 'yookassa_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'payments'],
        ];

        foreach ($settings as $data) {
            Setting::updateOrCreate(['key' => $data['key']], $data);
        }
    }
}
