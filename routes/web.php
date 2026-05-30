<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ═══════════════════════════════════════════════════════════════
//  التسجيل والدخول
// ═══════════════════════════════════════════════════════════════

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
require __DIR__ . '/auth.php';

// ═══════════════════════════════════════════════════════════════
//  الصفحة الرئيسية
// ═══════════════════════════════════════════════════════════════

Route::get('/', fn () => redirect()->route('recipes.index'))->name('home');
Route::view('/about', 'about')->name('about');

// ═══════════════════════════════════════════════════════════════
//  وصفات — إنشاء / تعديل / حذف (للمستخدمين المسجلين فقط)
//  مُسجّلة أولاً حتى لا يُفسَّر /recipes/create كمعرّف وصفة
// ═══════════════════════════════════════════════════════════════

Route::middleware('auth')->group(function () {
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    Route::get('/recipes/trashed', [RecipeController::class, 'trashed'])->name('recipes.trashed');
    Route::patch('/recipes/{recipe}/restore', [RecipeController::class, 'restore'])->name('recipes.restore');
    Route::delete('/recipes/{recipe}/force-delete', [RecipeController::class, 'forceDelete'])->name('recipes.forceDelete');
});

// ═══════════════════════════════════════════════════════════════
//  وصفات — عرض القائمة وعرض وصفة واحدة (للجميع بدون تسجيل)

Route::resource('recipes', RecipeController::class)->only(['index', 'show']);

// ═══════════════════════════════════════════════════════════════
//  لوحة التحكم والملف الشخصي (للمستخدمين المسجلين فقط)


Route::middleware(['auth', 'verified'])->get('/dashboard', function (Request $request) {
    return view('dashboard', ['user' => $request->user()]);
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
