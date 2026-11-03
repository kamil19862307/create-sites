<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettingsService
{
    public function get(): ?array
    {
        return Cache::rememberForever('site_settings', function () {
            return SiteSetting::first()?->toArray();
        });
    }
}
