<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ingredients')->insert([
            'nom' => 'Tomate',
            'quantite' => '3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('ingredients')->insert([
            'nom' => 'Oignon',
            'quantite' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('ingredients')->insert([
            'nom' => 'Fromage',
            'quantite' => '200g',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}