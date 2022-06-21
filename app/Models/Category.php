<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image_filename'];

    use HasFactory;

    public function recipes()
    {
        $recipes = [];

        $recipeCategories = $this->hasMany(RecipeCategory::class)->orderBy('position')->getResults();
        foreach ($recipeCategories as $recipeCategory) {
            $currentRecipes = $recipeCategory->hasMany(Recipe::class, 'id', 'recipe_id')->getResults();
            foreach ($currentRecipes as $recipe) {
                if (!isset($recipes[$recipe->id])) {
                    $recipes[] = $recipe;
                }
            }
        }

        return $recipes;
    }
}
