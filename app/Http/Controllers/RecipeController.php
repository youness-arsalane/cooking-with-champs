<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index(){
        // without pagination use get instead of pagination
        return response()->json([
            'recipes'=> Recipe::latest()->paginate(6)
        ], 200);
    }

    public function filter($name){
        // without pagination use get instead of pagination
        return response()->json([
            'recipes'=> Recipe::latest()->where('title', 'like', '%' . $name . '%')->paginate(6)
        ], 200);
    }
  
    public function show($id){
        return response()->json([
            'recipes'=> Recipe::find($id)
        ], 200);
    }
  
    public function create(Request $request){
        $formFields = $request->validate([
            'title' => ['required', Rule::unique('recipes', 'title')],
            'tags' => 'required',
            'description' => 'required'

        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = 1;

        Recipe::create($formFields);

        return response()->json('Artikel succesvol toegevoegd!');
    }

    public function edit(Recipe $recipe){
        return view('recipes.edit', ['recipe' => $recipe]);
    }

    public function update(Request $request, Recipe $recipe){

//        if($recipe->user_id != auth()->id()){
//            abort('403', 'Unauthorized action');
//        }
        
        $formFields = $request->validate([
            'title' => ['required'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        $recipe->update($formFields);

        return response()->json('Recipe update successfully!');
    }

    public function destroy(Recipe $recipe, $id){
//        if($recipe->user_id != auth()->id()){
//            abort('403', 'Unauthorized action');
//        }
        $recipe->findOrFail($id)->delete();

        return response()->json([
            'recipes'=> 'Successfully destroyed!'
        ], 200);
    }

    public function manage(){
        $user = Auth::user();  
        return view('/recipes.manage', [
            'recipes' => $user->recipes
        ]);
    }
}
