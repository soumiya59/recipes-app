<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientRecipeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ingredient_recipe')->insert([
            'ingredient_id' => 1,
            'recipe_id' => 1,
            'quantite' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('ingredient_recipe')->insert([
            'ingredient_id' => 2,
            'recipe_id' => 1,
            'quantite' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('ingredient_recipe')->insert([
            'ingredient_id' => 3,
            'recipe_id' => 2,
            'quantite' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}