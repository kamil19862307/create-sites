<?php

use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
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
    ]);
});
