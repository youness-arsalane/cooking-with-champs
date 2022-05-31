<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tags', 'logo', 'user_id'];

    public function recipeSteps()
    {
        return $this->hasMany(RecipeStep::class)->orderBy('position');
    }

    public function recipeComments()
    {
        return $this->hasMany(RecipeComment::class);
    }

    public function scopeFilter($query, array $filters){
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relate recipe to user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
