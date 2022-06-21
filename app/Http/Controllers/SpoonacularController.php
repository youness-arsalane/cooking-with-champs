<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpoonacularController extends Controller
{
    public function recipes()
    {
        $spoonacularRecipes = json_decode(file_get_contents(base_path('random-recipes.json')), true);
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
