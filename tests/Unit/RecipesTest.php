<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeComment;
use App\Models\User;
use Tests\TestCase;

class RecipesTest extends TestCase
{
    public function test_place_recipes_in_category()
    {
        $user = new User();
        $user->role = 1;
        $user->name = 'Youness Test';
        $user->email = 'youness-test-' . date('Y-m-d-H-i-s') . ' - ' . rand(). '@gmail.com';
        $user->is_admin = 1;

        $user->save();

        $recipe = new Recipe();
        $recipe->user_id = $user->id;
        $recipe->title = 'Test recipe - ' . date('Y-m-d-H-i-s') . ' - ' . rand();
        $recipe->description = 'Test description';

        $recipe->save();

        $category = new Category();
        $category->name = 'Test category - ' . date('Y-m-d-H-i-s') . ' - ' . rand();
        $category->content = 'Test content';
        $category->active = true;

        $category->save();

        $recipeCategory = new RecipeCategory();
        $recipeCategory->recipe_id = $recipe->id;
        $recipeCategory->category_id = $category->id;

        $recipeCategory->save();

        $found = false;
        foreach ($recipe->categories() as $currentCategory) {
            if ($category->id === $currentCategory->id) {
                $found = true;
                break;
            }
        }

        self::assertTrue($found);

        $recipeCategory->delete();
        $category->delete();
        $recipe->delete();
        $user->delete();
    }

    public function test_post_comments_under_recipe()
    {
        $user = new User();
        $user->role = 1;
        $user->name = 'Youness Test';
        $user->email = 'youness-test-' . date('Y-m-d-H-i-s') . ' - ' . rand(). '@gmail.com';
        $user->is_admin = 1;

        $user->save();

        $recipe = new Recipe();
        $recipe->user_id = $user->id;
        $recipe->title = 'Test recipe - ' . date('Y-m-d-H-i-s') . ' - ' . rand();
        $recipe->description = 'Test description';

        $recipe->save();

        $recipeComment = new RecipeComment();
        $recipeComment->recipe_id = $recipe->id;
        $recipeComment->user_id = $user->id;
        $recipeComment->content = 'Test message';

        $recipeComment->save();

        $found = false;
        foreach ($recipe->recipeComments()->getResults() as $currentRecipeComment) {
            if ($recipeComment->id === $currentRecipeComment->id) {
                $found = true;
                break;
            }
        }

        self::assertTrue($found);

        $recipeComment->delete();
        $recipe->delete();
        $user->delete();
    }
}
