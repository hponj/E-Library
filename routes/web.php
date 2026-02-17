<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home', ['title' => 'Homepage']);
});

Route::get('/hall', function () {
    return view('hall', ['title' => 'Hall']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});
