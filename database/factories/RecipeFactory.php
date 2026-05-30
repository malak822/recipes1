<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'ingredients' => "200 g de farine\n3 œufs\n1 pincée de sel",
            'instructions' => "Mélanger les ingrédients\nCuire 20 minutes",
            'prep_time' => fake()->numberBetween(5, 30),
            'cook_time' => fake()->numberBetween(10, 60),
            'category' => fake()->randomElement([
                'Desserts',
                'Plats principaux',
                'Entrées & Salades',
                'Cuisine algérienne',
            ]),
            'difficulty' => fake()->randomElement(['سهل', 'متوسط', 'صعب']),
            'image' => null,
        ];
    }
}
