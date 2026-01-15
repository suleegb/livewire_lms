<?php

use Illuminate\Support\Facades\Route;


use App\Livewire\Posts;

Route::get('/posts',Posts::class);


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
