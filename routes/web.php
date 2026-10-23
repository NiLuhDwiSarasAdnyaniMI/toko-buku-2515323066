<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BookController::class, 'index']);
Route::get('/buku/{id}', [BookController::class, 'show']);

Route::resource('kategori', CategoryController::class)->except('show');
Route::resource('penerbit', PublisherController::class)->except('show');