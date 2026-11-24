<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use HTMLPurifier;
use HTMLPurifier_Config;

class PortfolioProjectController extends Controller
{
    public function show(PortfolioProject $portfolioProject): Response
    {
        abort_unless($portfolioProject->is_published, 404);

        $portfolioProject->load('images');

        $config = HTMLPurifier_Config::createDefault();

        // Только основные элементы форматирования
        $config->set(
            'HTML.Allowed',
            'p,br,h2,h3,h4,strong,b,em,i,u,ul,ol,li,a[href|title],blockquote,pre,code'
        );

        $purifier = new HTMLPurifier($config);

        $description = $portfolioProject->description
            ? $purifier->purify($portfolioProject->description)
            : null;

        return Inertia::render('Portfolio/Show', [
            'project' => [
                'id' => $portfolioProject->id,
                'title' => $portfolioProject->title,
                'slug' => $portfolioProject->slug,
                'short_description' => $portfolioProject->short_description,
                'description' => $description,
                'cover_image' => $portfolioProject->cover_image
                    ? Storage::disk('public')->url($portfolioProject->cover_image)
                    : null,
                'technologies' => $portfolioProject->technologies,
                'website_url' => $portfolioProject->website_url,
                'github_url' => $portfolioProject->github_url,
                'images' => $portfolioProject->images->map(fn ($image) => [
                    'id' => $image->id,
                    'image_path' => Storage::disk('public')->url($image->image_path),
                    'image_type' => $image->image_type,
                    'sort_order' => $image->sort_order,
                ]),
            ],

            // Блок «Другие проекты»: до 3 опубликованных проектов, кроме текущего.
            // Порядок поменять можно (например, ->orderBy('sort_order')).
            'related' => PortfolioProject::query()
                ->where('is_published', true)
                ->whereKeyNot($portfolioProject->id)
                ->latest()
                ->take(3)
                ->get()
                ->map->toCard()
                ->values(),
        ]);
    }
}
