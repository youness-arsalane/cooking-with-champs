<?php

namespace App\Http\Controllers;

use App\Adapters\SpoonacularAdapter;
use App\Models\Recipe;

class DebugController extends Controller
{
    public function index()
    {
        $SpoonacularAdapter = new SpoonacularAdapter();

//        $spoonacularRecipes = $SpoonacularAdapter->getRandomRecipes(100);
//        file_put_contents(base_path('random-recipes.json'), json_encode($spoonacularRecipes));
//
//        return;
        $spoonacularRecipes = json_decode(file_get_contents(base_path('random-recipes.json')), true);


        foreach ($spoonacularRecipes as $spoonacularRecipe) {
            $isNew = false;
            $recipe = Recipe::where('spoonacular_id', $spoonacularRecipe['id'])->first();

            if ($recipe === null) {
                $isNew = true;
                $recipe = new Recipe();
            }

            $imageContents = file_get_contents($spoonacularRecipe['image']);
            file_put_contents(public_path('images/' .basename($spoonacularRecipe['image'])), $imageContents);

            $formFields = [
                'user_id' => '1',
                'title' => $spoonacularRecipe['title'],
                'description' => $spoonacularRecipe['instructions'],
                'logo' => basename($spoonacularRecipe['image'])
            ];

            if ($isNew) {
                Recipe::create($formFields);
            } else {
                $recipe->update($formFields);
            }

            break;
        }
    }
}
