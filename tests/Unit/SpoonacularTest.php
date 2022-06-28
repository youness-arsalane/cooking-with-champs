<?php

namespace Tests\Unit;

use App\Adapters\SpoonacularAdapter;
use Exception;
use Tests\TestCase;

class SpoonacularTest extends TestCase
{
    public function test_api_connection()
    {
        try {
            $limit = 100;
            $SpoonacularAdapter = new SpoonacularAdapter();
            $spoonacularRecipes = $SpoonacularAdapter->getRandomRecipes($limit);
            $this->assertEquals($limit, count($spoonacularRecipes));

        } catch (Exception $e) {
            self::assertFalse(true);
        }
    }
}
