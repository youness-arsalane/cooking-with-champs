<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_id', 'category_id', 'position', 'created_at', 'updated_at'];

    protected $table = 'recipes_categories';

    private function setRecipeCategoryId($foo)
    {
        $this->attributes['id'] = $foo;
    }

    private function getRecipeCategoryId()
    {
        return $this->attributes['id'];
    }

    protected function recipeCategoryId(): Attribute
    {
        return new Attribute('getRecipeCategoryId', 'setRecipeCategoryId',);
    }
}
