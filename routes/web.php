<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('buku', BookController::class)->except(['show']);
Route::get('/buku/{id}', [BookController::class, 'show']);

Route::resource('kategori', CategoryController::class)->except('show');
Route::resource('penerbit', PublisherController::class)->except('show');