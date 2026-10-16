<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
        'name' => 'Александр',
        'avatar' => '/images/testimonials/kamil.webp',
        'meta' => 'printerimfu.ru',
        'content' => 'Отличный сайт! Всё работает быстро и удобно.',
        'rating' => 5,
        'status' => true,
        ]);

        Testimonial::create([
            'name' => 'Мария',
            'avatar' => '/images/testimonials/kamil.webp',
            'meta' => 'printerimfu.ru',
            'content' => 'Работа выполнена качественно. Спасибо!',
            'rating' => 5,
            'status' => true,
        ]);

        Testimonial::create([
            'name' => 'Дмитрий',
            'avatar' => '/images/testimonials/kamil.webp',
            'meta' => 'printerimfu.ru',
            'content' => 'Хороший результат, всё соответствует ожиданиям.',
            'rating' => 4,
            'status' => true,
        ]);
    }
}
