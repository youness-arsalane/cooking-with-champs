<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Recipe extends Model
{
    protected $fillable = ['title', 'slug', 'image_filename', 'introduction', 'content', 'active', 'in_spotlight'];

    use HasFactory;

    public function recipeSteps()
    {
        return $this->hasMany(RecipeStep::class)->orderBy('position');
    }

    public function recipeComments()
    {
        return $this->hasMany(RecipeComment::class);
    }

    public function getURL()
    {
        return URL::to('recipes/' . $this->slug);
    }

    public function imageURL()
    {
        return (!empty($this->image_filename))
            ? URL::to('images/recipes') . '/' . $this->id . '/' . $this->image_filename
            : URL::to('images/no-image.png');
    }
}
