<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

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

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioProjectImage::class)
            ->orderBy('sort_order');
    }

    public function toCard(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'cover_image' => $this->cover_image
                ? Storage::disk('public')->url($this->cover_image)
                : null,
        ];
    }
}
