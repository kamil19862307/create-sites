<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});



Route::get('/', function () {
    return inertia('Home', [
        'title' => 'Титл разработака сайтов',
        'message' => 'Message Первый экран нашего нового сайта.'
    ]);
});
