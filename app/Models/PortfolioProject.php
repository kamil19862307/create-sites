<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioProject extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'cover_image',
        'technologies',
        'website_url',
        'github_url',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'is_published' => 'boolean',
        ];
    }
}
