<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home', [
        'title' => 'КМ Разработка Сайтов',
        'message' => 'Разрабатываю современные сайты для бизнеса',
    ]);
});
