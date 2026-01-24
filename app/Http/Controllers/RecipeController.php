<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    // عرض جميع الوصفات
    public function index(Request $request)
    {
        $query = Recipe::with('user');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        $recipes = $query->latest()->paginate(9);
        
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
            'cooking_time' => 'required|integer|min:1',
            'category' => 'required|in:Dessert,Plat principal,Entrée,Boisson'
        ]);

        Recipe::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'cooking_time' => $request->cooking_time,
            'category' => $request->category,
        ]);

        return redirect()->route('recipes.index')
            ->with('success', 'La recette a été ajoutée avec succès! 🎉');
    }

    public function show(Recipe $recipe)
    {
        $recipe->load('user');
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }

        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
            'cooking_time' => 'required|integer|min:1',
            'category' => 'required|in:Dessert,Plat principal,Entrée,Boisson'
        ]);

        $recipe->update($validated);

        return redirect()->route('recipes.index')
            ->with('success', 'La recette a été modifiée avec succès! ✅');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'La recette a été supprimée avec succès! 🗑️');
    }
}