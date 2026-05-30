<?php

use App\Models\Recipe;
use App\Models\User;

function validRecipePayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Salade fraîche',
        'ingredients' => "Tomates\nConcombre\nHuile d'olive",
        'instructions' => "Laver les légumes\nMélanger et servir",
        'prep_time' => 15,
        'cook_time' => 0,
        'category' => 'Entrées & Salades',
        'difficulty' => 'سهل',
    ], $overrides);
}

test('guests can browse the recipes index', function () {
    Recipe::factory()->count(2)->create();

    $response = $this->get(route('recipes.index'));

    $response->assertOk();
    $response->assertSee(Recipe::first()->title, false);
});

test('guests can view a single recipe', function () {
    $recipe = Recipe::factory()->create(['title' => 'Couscous royal']);

    $response = $this->get(route('recipes.show', $recipe));

    $response->assertOk();
    $response->assertSee('Couscous royal', false);
});

test('home redirects to recipes index', function () {
    $response = $this->get(route('home'));

    $response->assertRedirect(route('recipes.index'));
});

test('guests cannot access the create recipe form', function () {
    $response = $this->get(route('recipes.create'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can create a recipe', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('recipes.store'), validRecipePayload([
        'title' => 'Gâteau au chocolat',
    ]));

    $response->assertRedirect(route('recipes.index'));
    $this->assertDatabaseHas('recipes', [
        'title' => 'Gâteau au chocolat',
        'user_id' => $user->id,
    ]);
});

test('authenticated users can update a recipe', function () {
    $user = User::factory()->create();
    $recipe = Recipe::factory()->for($user)->create(['title' => 'Ancien titre']);

    $response = $this->actingAs($user)->put(
        route('recipes.update', $recipe),
        validRecipePayload(['title' => 'Nouveau titre'])
    );

    $response->assertRedirect(route('recipes.index'));
    $this->assertDatabaseHas('recipes', [
        'id' => $recipe->id,
        'title' => 'Nouveau titre',
    ]);
});

test('authenticated users can delete a recipe', function () {
    $user = User::factory()->create();
    $recipe = Recipe::factory()->for($user)->create();

    $response = $this->actingAs($user)->delete(route('recipes.destroy', $recipe));

    $response->assertRedirect(route('recipes.index'));
    $this->assertSoftDeleted('recipes', ['id' => $recipe->id]);
});

test('recipes index can be filtered by search', function () {
    Recipe::factory()->create(['title' => 'Smoothie fraise']);
    Recipe::factory()->create(['title' => 'Pizza maison']);

    $response = $this->get(route('recipes.index', ['search' => 'Smoothie']));

    $response->assertOk();
    $response->assertSee('Smoothie fraise', false);
    $response->assertDontSee('Pizza maison', false);
});

test('recipes index can be filtered by category', function () {
    Recipe::factory()->create(['title' => 'Tarte aux pommes', 'category' => 'Desserts']);
    Recipe::factory()->create(['title' => 'Soupe de légumes', 'category' => 'Soupes']);

    $response = $this->get(route('recipes.index', ['category' => 'Desserts']));

    $response->assertOk();
    $response->assertSee('Tarte aux pommes', false);
    $response->assertDontSee('Soupe de légumes', false);
});

test('recipe creation requires valid data', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('recipes.store'), []);

    $response->assertSessionHasErrors(['title', 'ingredients', 'instructions', 'prep_time', 'category', 'difficulty']);
});
