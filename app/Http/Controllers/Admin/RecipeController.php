<?php

namespace App\Http\Controllers\Admin;

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

    public function add()
    {
        $recipe = new Recipe();
        return view('admin.recipes.form', [
            'recipe' => $recipe
        ]);
    }

    public function edit($id = '')
    {
        $recipe = Recipe::where('id', $id)->first();
        if (empty($id) || $recipe === null) {
            abort(404);
        }

        return view('admin.recipes.form', [
            'recipe' => $recipe
        ]);
    }

    public function save($id = '')
    {
        if (empty($id)) {
            $recipe = new Recipe();
        } else {
            $recipe = Recipe::where('id', $id)->first();
        }

        $attributes = \request()->validate([
            'title' => 'required|max:255',
            'slug' => empty($id) ? 'required|max:255|unique:recipes,slug' : 'required|max:255'
        ]);

        $recipe->title = $attributes['title'];
        $recipe->slug = mb_strtolower($attributes['slug']);
        $recipe->active = \request()->input('active');
        $recipe->introduction = \request()->input('introduction');
        $recipe->content = \request()->input('content');

        if (empty($id)) {
            $id = Recipe::create($attributes)->id;
        } else {
            $recipe->save();
        }

        return redirect('/admin/recipes/edit/' . $id);
    }

    public function saveImage($id = '')
    {
        $recipe = Recipe::where('id', $id)->first();

        if (!empty(\request()->image)) {
            \request()->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = new Filesystem();
            $file->cleanDirectory('images/recipes/' . $recipe->id);

            $imageName = time() . '.' . \request()->image->getClientOriginalExtension();
            \request()->image->move(public_path('images/recipes') . '/' . $recipe->id, $imageName);

            $recipe->image_filename = $imageName;
            $recipe->save();
        }

        return redirect('admin/recipes/edit/' . $recipe->id);
    }

    public function deleteImage($id = '')
    {
        $recipe = Recipe::where('id', $id)->first();

        $recipe->image_filename = '';
        $recipe->save();

        return redirect('admin/recipes/edit/' . $recipe->id);
    }

    public function delete($id = '')
    {
        $recipe = Recipe::where('id', $id);
        $recipe->delete();

        return redirect('admin/recipes');
    }
}
