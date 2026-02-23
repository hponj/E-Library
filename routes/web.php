<?php

use App\Http\Controllers\HallController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home', ['title' => 'Homepage']);
});

Route::get('/hall', [HallController::class,'index']);

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/hall', [HallController::class,'index']);
Route::get('/hall/category/{category:slug}', [HallController::class,'getByCategory']);
Route::get('/hall/book/{book:slug}', [HallController::class,'SingleBook']);
Route::get('/hall/author/{author:slug}', [HallController::class,'getByAuthor']);
