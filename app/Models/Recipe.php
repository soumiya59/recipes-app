<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['titre', 'description', 'duree', 'difficulte', 'user_id', 'category_id'];

    // Relation Many-to-One avec Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation Many-to-Many avec Ingredient
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantite');
    }

    // Relation Many-to-One avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}