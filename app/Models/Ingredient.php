<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['nom', 'quantite'];
    
    public function recipes()
    {
    return $this->belongsToMany(Recipe::class)->withPivot('quantite');
    }
}