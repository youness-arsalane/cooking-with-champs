<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeComment;
use App\Models\RecipeStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        // without pagination use get instead of pagination
        return response()->json([
            'recipes' => Recipe::latest()->paginate(),
            'user' => Auth::user()
        ], 200);
    }

    public function filter($name)
    {
        // without pagination use get instead of pagination
        return response()->json([
            'recipes' => Recipe::latest()->where('title', 'like', '%' . $name . '%')->paginate(6)
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'recipes' => Recipe::with('recipeComments')->get()->find($id)
        ], 200);
    }

    public function categories($id)
    {
        return response()->json([
            'categories' => Recipe::find($id)->categories()
        ]);
    }

    public function getComment($id)
    {
        return response()->json([
            'message' => RecipeComment::get()->find($id)
        ], 200);
    }

    public function editComment(Request $request, RecipeComment $comment)
    {

        $formFields = $request->validate([
            'content' => 'required'
        ]);

        $comment->update($formFields);

        return response()->json('Comment updated successfully!');
    }

    public function create(Request $request)
    {
        $formFields = $request->validate([
            'title' => ['required', Rule::unique('recipes', 'title')],
            'tags' => 'required',
            'description' => 'required',
            'logo' => 'required',
        ]);

        Storage::disk('public')->put($request->get('logo'), $request->file('logo'));

        $formFields['user_id'] = $request->get('user_id');

        Recipe::create($formFields);

        return response()->json('Recipe successfully added!');
    }

    public function addComment(Request $request, $id)
    {
        $formFields = $request->validate([
            'content' => 'required'
        ]);

        $formFields['user_id'] = $request->get('user_id');

        $formFields['recipe_id'] = $id;

        RecipeComment::create($formFields);

        return response()->json('Recipe comment successfully added!');
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', ['recipe' => $recipe]);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $formFields = $request->validate([
            'title' => ['required'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $recipe->update($formFields);

        $recipeCategories = Recipe::where('recipe_id', $recipe->id);
        foreach ($recipeCategories as $recipeCategory) {
            $recipeCategory->delete();
        }

        $categoryIds = (array)$request->all()['categoryIds'];
        foreach (array_values($categoryIds) as $i => $categoryId) {
            $formFields = [
                'recipe_id' => $recipe->id,
                'category_id' => $categoryId,
                'position' => $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            RecipeCategory::create($formFields);
        }

        return response()->json('Recipe update successfully!');
    }

    public function destroy(Recipe $recipe, $id)
    {
//        if($recipe->user_id != auth()->id()){
//            abort('403', 'Unauthorized action');
//        }
        $recipe->findOrFail($id)->delete();

        return response()->json([
            'recipes' => 'Successfully destroyed!'
        ], 200);
    }

    public function manage()
    {
        $user = Auth::user();
        return view('/recipes.manage', [
            'recipes' => $user->recipes
        ]);
    }
}
