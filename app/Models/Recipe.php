<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tags', 'logo', 'user_id'];
    public $categoryIds;

    public function recipeSteps()
    {
        return $this->hasMany(RecipeStep::class)->orderBy('position');
    }

    public function recipeComments()
    {
        return $this->hasMany(RecipeComment::class)->with('user');
    }

    public function categories()
    {
        $categories = [];

        $recipeCategories = $this->hasMany(RecipeCategory::class)->orderBy('position')->getResults();
        foreach ($recipeCategories as $recipeCategory) {
            $currentCategories = $recipeCategory->hasMany(Category::class, 'id', 'category_id')->getResults();
            foreach ($currentCategories as $category) {
                if (!isset($categories[$category->id])) {
                    $categories[] = $category;
                }
            }
        }

        return $categories;
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relate recipe to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getImageURL(): string
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/no-image.png');
    }
}
