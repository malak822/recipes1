<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

// Home -> redirect to recipes index
Route::get('/', function () {
    return redirect()->route('recipes.index');
})->name('home');

// Resourceful routes for recipes
Route::resource('recipes', RecipeController::class);

Route::middleware('auth')->group(function () {
    Route::get('/recipes/trashed', [RecipeController::class, 'trashed'])->name('recipes.trashed');
    Route::patch('/recipes/{recipe}/restore', [RecipeController::class, 'restore'])->name('recipes.restore');
    Route::delete('/recipes/{recipe}/force-delete', [RecipeController::class, 'forceDelete'])->name('recipes.forceDelete');
});

// Dashboard (protected) ← تم تعديله ليرسل $user
Route::get('/dashboard', function (Request $request) {
    return view('dashboard', [
        'user' => $request->user(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (from Breeze) - protected
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (login/register/etc.)
require __DIR__ . '/auth.php';