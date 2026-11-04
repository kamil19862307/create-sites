<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettingsService
{
    public function get(): ?array
    {
        return Cache::rememberForever('site_settings', function () {
            $settings = SiteSetting::first();

            if (!$settings) {
                return null;
            }

            $data = $settings->toArray();

            $data['about_photo_url'] = $settings->about_photo
                ? asset('storage/' . $settings->about_photo)
                : null;

            return $data;
        });
    }
}
