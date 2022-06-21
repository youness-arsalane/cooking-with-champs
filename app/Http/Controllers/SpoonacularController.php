<?php

namespace App\Http\Controllers;

use App\Adapters\Models\SpoonacularRecipe;
use App\Adapters\SpoonacularAdapter;
use App\Models\Recipe;
use Illuminate\Http\Request;

class SpoonacularController extends Controller
{
    public function recipes()
    {
        $SpoonacularAdapter = new SpoonacularAdapter();

        $spoonacularRecipes = $SpoonacularAdapter->getRandomRecipes(100);

        shuffle($spoonacularRecipes);
        return response()->json($spoonacularRecipes);
    }

    public function sync(Request $request): void
    {
        foreach ((array)$request->post('spoonacularRecipes') as $spoonacularRecipe) {
            $spoonacularRecipe = new SpoonacularRecipe((array)$spoonacularRecipe);
            Recipe::saveBySpoonacularRecipe($spoonacularRecipe, $request->post('user_id'));
        }
    }
}
