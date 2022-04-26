<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function recipeSteps()
    {
        return $this->hasMany(RecipeStep::class)->orderBy('position');
    }

    public function recipeComments()
    {
        return $this->hasMany(RecipeComment::class);
    }
}
