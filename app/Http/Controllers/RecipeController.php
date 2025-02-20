<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('category', 'ingredients')->get();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('recipes.create', compact('categories', 'ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'duree' => 'required|integer',
            'difficulte' => 'required',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'required|array',
            'ingredients.*.nom' => 'required|string',
            'ingredients.*.quantite' => 'required|string',
        ]);

        // Créer la recette
        $recipe = Recipe::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'duree' => $request->duree,
            'difficulte' => $request->difficulte,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        foreach ($request->ingredients as $ingredientData) {
            $ingredient = Ingredient::firstOrCreate(['nom' => $ingredientData['nom']], ['quantite' => $ingredientData['quantite']]);
            $recipe->ingredients()->attach($ingredient->id, ['quantite' => $ingredientData['quantite']]);
        }

        return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recette créée avec succès.');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('recipes.edit', compact('recipe', 'categories', 'ingredients'));
    }

public function update(Request $request, Recipe $recipe)
{
    $request->validate([
        'titre' => 'required',
        'description' => 'required',
        'duree' => 'required|integer',
        'difficulte' => 'required',
        'category_id' => 'required|exists:categories,id',
        'ingredients' => 'required|array',
        'ingredients.*.nom' => 'required|string',
        'ingredients.*.quantite' => 'required|string',
    ]);

    // Mettre à jour la recette
    $recipe->update([
        'titre' => $request->titre,
        'description' => $request->description,
        'duree' => $request->duree,
        'difficulte' => $request->difficulte,
        'category_id' => $request->category_id,
    ]);

    // Préparer les ingrédients à synchroniser
    $ingredientsToSync = [];

    foreach ($request->ingredients as $ingredientData) {
        // Trouver ou créer l'ingrédient
        $ingredient = Ingredient::firstOrCreate(['nom' => $ingredientData['nom']], ['quantite' => $ingredientData['quantite']]);
        // Ajouter l'ingrédient avec sa quantité
        $ingredientsToSync[$ingredient->id] = ['quantite' => $ingredientData['quantite']];
    }

    // Synchroniser les ingrédients (met à jour les existants et ajoute les nouveaux)
    $recipe->ingredients()->sync($ingredientsToSync);

    return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recette mise à jour avec succès.');
}

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recette supprimée avec succès.');
    }

    public function search(Request $request)
    {
    $query = $request->input('query');
    $category_id = $request->input('category_id');
    $ingredient_id = $request->input('ingredient_id');

    $recipes = Recipe::query()
        ->when($query, function ($q) use ($query) {
            return $q->where('titre', 'like', "%$query%");
        })
        ->when($category_id, function ($q) use ($category_id) {
            return $q->where('category_id', $category_id);
        })
        ->when($ingredient_id, function ($q) use ($ingredient_id) {
            return $q->whereHas('ingredients', function ($q) use ($ingredient_id) {
                $q->where('ingredients.id', $ingredient_id);
            });
        })
        ->paginate(10);

    $categories = Category::all();
    $ingredients = Ingredient::all();

    return view('recipes.search', compact('recipes', 'categories', 'ingredients'));
    }
public function destroyIngredient(Recipe $recipe, Ingredient $ingredient)
{
    // Détacher l'ingrédient de la recette
    $recipe->ingredients()->detach($ingredient->id);

    // Rediriger avec un message de succès
    return redirect()->route('recipes.edit', $recipe->id)->with('success', 'Ingrédient supprimé avec succès.');
}
}