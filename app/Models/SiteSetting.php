<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'about_description',
        'about_photo',
        'contact_email',
        'contact_phone',
        'contact_telegram',
        'contact_whatsapp',
    ];
}
