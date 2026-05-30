<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportRecipes extends Command
{
    protected $signature = 'import:recipes';
    protected $description = 'Import recipes from JSON file';

    public function handle()
    {
        $recipes = json_decode(file_get_contents(base_path('recipes_export.json')), true);
        
        foreach ($recipes as $r) {
            DB::table('recipes')->insert([
                'title' => $r['title'],
                'ingredients' => $r['ingredients'],
                'instructions' => $r['instructions'],
                'prep_time' => $r['prep_time'],
                'cook_time' => $r['cook_time'] ?? null,
                'category' => $r['category'],
                'difficulty' => $r['difficulty'],
                'image' => $r['image'],
                'views_count' => 0,
                'likes_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        $this->info('Recipes imported successfully!');
    }
}
