<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard'); // File dashboard Ari
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::get('/explore', function () {
    return view('explore');
});

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/community', function () {
    return view('community');
})->name('community');

Route::get('/pantry', function () {
    return view('pantry');
})->name('pantry');


Route::post('/generate-recipe', [RecipeController::class, 'generate'])->name('recipe.generate');

require __DIR__.'/auth.php';
