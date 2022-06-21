<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Filesystem\Filesystem;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function add()
    {
        $category = new Category();
        return view('admin.categories.form', [
            'category' => $category
        ]);
    }

    public function edit($id = '')
    {
        $category = Category::where('id', $id)->first();
        if (empty($id) || $category === null) {
            abort(404);
        }

        return view('admin.categories.form', [
            'category' => $category
        ]);
    }

    public function save($id = '')
    {
        if (empty($id)) {
            $category = new Category();
        } else {
            $category = Category::where('id', $id)->first();
        }

        $attributes = \request()->validate([
            'name' => 'required|max:255',
        ]);

        $category->name = $attributes['name'];

        if (empty($id)) {
            $id = Category::create($attributes)->id;
        } else {
            $category->save();
        }

        return redirect('/admin/categories/edit/' . $id);
    }

    public function saveImage($id = '')
    {
        $category = Category::where('id', $id)->first();

        if (!empty(\request()->image)) {
            \request()->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = new Filesystem();
            $file->cleanDirectory('images/categories/' . $category->id);

            $imageName = time() . '.' . \request()->image->getClientOriginalExtension();
            \request()->image->move(public_path('images/categories') . '/' . $category->id, $imageName);

            $category->image_filename = $imageName;
            $category->save();
        }

        return redirect('admin/categories/edit/' . $category->id);
    }

    public function deleteImage($id = '')
    {
        $category = Category::where('id', $id)->first();

        $category->image_filename = '';
        $category->save();

        return redirect('admin/categories/edit/' . $category->id);
    }

    public function delete($id = '')
    {
        $category = Category::where('id', $id);
        $category->delete();

        return redirect('admin/categories');
    }
}
