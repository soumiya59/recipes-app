<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('recipes')->insert([
            'titre' => 'Salade César',
            'description' => 'Une délicieuse salade César avec de la laitue, du poulet et de la sauce César.',
            'duree' => 20,
            'difficulte' => 'Facile',
            'user_id' => 1,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('recipes')->insert([
            'titre' => 'Pâtes Carbonara',
            'description' => 'Des pâtes avec une sauce à base de crème, de lardons et de parmesan.',
            'duree' => 30,
            'difficulte' => 'Moyen',
            'user_id' => 2,
            'category_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}