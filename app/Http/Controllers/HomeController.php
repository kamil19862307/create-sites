<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __invoke()
    {
        return inertia('Home', [
            'title' => 'Современные сайты для бизнеса, Создание сайтов',
            'message' => 'Разрабатываю современные сайты для бизнеса',

            'testimonials' => Testimonial::query()
                ->where('status', true)
                ->latest()
                ->get([
                    'id',
                    'name',
                    'avatar',
                    'meta',
                    'content',
                    'rating',
                ]),

            'projects' => PortfolioProject::query()
                ->where('is_published', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get([
                    'id',
                    'title',
                    'slug',
                    'short_description',
                    'cover_image',
                    'website_url',
                ])
                ->map(fn (PortfolioProject $project) => [
                    'id' => $project->id,
                    'title' => $project->title,
                    'text' => $project->short_description,
                    'image' => $project->cover_image
                        ? Storage::disk('public')->url($project->cover_image)
                        : null,
                    'href' => $project->website_url ?: '#',
                ]),
        ]);
    }
}
