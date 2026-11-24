<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::get('/portfolio/{portfolioProject:slug}', [PortfolioProjectController::class, 'show'])
    ->name('portfolio.show');
