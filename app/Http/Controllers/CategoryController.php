<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // without pagination use get instead of pagination
        return response()->json([
            'categories' => Category::latest()->paginate(6),
            'user' => Auth::user()
        ], 200);
    }

    public function filter($name)
    {
        // without pagination use get instead of pagination
        return response()->json([
            'categories' => Category::latest()->where('title', 'like', '%' . $name . '%')->paginate(6)
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'categories' => Category::find($id)
        ], 200);
    }

    public function create(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'active' => 'required'
        ]);

        if ($request->hasFile('image_filename')) {
            $formFields['image_filename'] = $request->file('image_filename')->store('logos', 'public');
        }

        Category::create($formFields);

        return response()->json('Category successfully added!');
    }

    public function addComment(Request $request, $id)
    {
        $formFields = $request->validate([
            'content' => 'required'

        ]);

        $formFields['user_id'] = $request->get('user_id');

        $formFields['category_id'] = $id;

        $formFields['parent_id'] = 1;

        CategoryComment::create($formFields);

        return response()->json('Category comment successfully added!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'active' => 'required'
        ]);

        if ($request->hasFile('image_filename')) {
            $formFields['image_filename'] = $request->file('image_filename')->store('logos', 'public');
        }

        $category->update($formFields);

        return response()->json('Category update successfully!');
    }

    public function destroy(Category $category, $id)
    {
//        if($category->user_id != auth()->id()){
//            abort('403', 'Unauthorized action');
//        }
        $category->findOrFail($id)->delete();

        return response()->json([
            'categories' => 'Successfully destroyed!'
        ], 200);
    }

    public function manage()
    {
        $user = Auth::user();
        return view('/categories.manage', [
            'categories' => $user->categories
        ]);
    }
}
