<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Filesystem\Filesystem;

class RecipeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recipes = Recipe::all();
        return view('admin.recipes.index', [
            'recipes' => $recipes
        ]);
    }

    public function view($slug = '')
    {
        $recipe = Recipe::where('slug', $slug)->first();
        if ($recipe === null || !$recipe->active) {
            abort(404);
        }

        return view('recipes.view', [
            'recipe' => $recipe
        ]);
    }
}
