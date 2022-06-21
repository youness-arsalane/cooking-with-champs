<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeComment;
use App\Models\RecipeStep;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        // without pagination use get instead of pagination
        return response()->json([
            'recipes' => Recipe::latest()->paginate(6),
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
            'description' => 'required'

        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

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

//        if($recipe->user_id != auth()->id()){
//            abort('403', 'Unauthorized action');
//        }

        $formFields = $request->validate([
            'title' => ['required'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $recipe->update($formFields);

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
