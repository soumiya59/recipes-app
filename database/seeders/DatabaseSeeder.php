<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Database\Seeders\UsersTableSeeder;
// use Database\Seeders\RecipesTableSeeder;
// use Database\Seeders\CategoriesTableSeeder;
// use Database\Seeders\IngredientsTableSeeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'somaya',
            'email' => 'somaya@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
                $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            IngredientsTableSeeder::class,
            RecipesTableSeeder::class,
            IngredientRecipeTableSeeder::class,
        ]);
    }
}