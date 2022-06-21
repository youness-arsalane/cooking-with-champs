<?php

namespace App\Http\Controllers;

use App\Adapters\SpoonacularAdapter;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpoonacularController extends Controller
{
    public function recipes()
    {
        $SpoonacularAdapter = new SpoonacularAdapter();

        $spoonacularRecipes = $SpoonacularAdapter->getRandomRecipes(100);

        shuffle($spoonacularRecipes);
        return response()->json($spoonacularRecipes);
    }

    public function sync(Request $request)
    {
        foreach ($request->post('spoonacularRecipes') as $spoonacularRecipe) {
            $isNew = false;
            $recipe = Recipe::where('spoonacular_id', $spoonacularRecipe['id'])->first();

            if ($recipe === null) {
                $isNew = true;
                $recipe = new Recipe();
            }

            $imageContents = file_get_contents($spoonacularRecipe['image']);
            file_put_contents(public_path('images/' .basename($spoonacularRecipe['image'])), $imageContents);

            $formFields = [
                'user_id' => $request->post('user_id'),
                'title' => $spoonacularRecipe['title'],
                'description' => $spoonacularRecipe['instructions'],
                'logo' => basename($spoonacularRecipe['image'])
            ];

            if ($isNew) {
                Recipe::create($formFields);
            } else {
                $recipe->update($formFields);
            }
        }
    }
}
