<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\HomeController;

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentification (gérée par Laravel Breeze, Jetstream, ou Laravel UI)
Auth::routes();

// Routes protégées (accessibles uniquement aux utilisateurs connectés)
Route::middleware('auth')->group(function () {

    // Gestion des recettes
    Route::resource('recipes', RecipeController::class);
    Route::delete('/recipes/{recipe}/ingredients/{ingredient}', [RecipeController::class, 'destroyIngredient'])->name('recipes.ingredient.destroy');

    // Gestion des catégories (optionnel, si vous voulez permettre aux utilisateurs de créer des catégories)
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Gestion des ingrédients (optionnel, si vous voulez permettre aux utilisateurs de créer des ingrédients)
    Route::resource('ingredients', IngredientController::class)->except(['show']);

    // Recherche de recettes
    Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
});

// Routes publiques (accessibles à tous)
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/ingredients/{ingredient}', [IngredientController::class, 'show'])->name('ingredients.show');