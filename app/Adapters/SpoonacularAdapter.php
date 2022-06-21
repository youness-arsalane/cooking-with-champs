<?php

namespace App\Adapters;

use App\Adapters\Models\SpoonacularModel;
use App\Adapters\Models\SpoonacularRecipe;
use App\Models\Recipe;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class SpoonacularAdapter
{
    const BASE_URL = 'https://api.spoonacular.com/';
    const INSTANCE_RECIPE = 'RECIPE';

    /**
     * @param int $limit
     * @return SpoonacularRecipe[]
     */
    public function getRandomRecipes(int $limit = 10, bool $cached = true): array
    {
        if ($cached) {
            $results = json_decode(file_get_contents(base_path('random-recipes.json')), true);
        } else {
            $results = $this->executeRequest('GET', 'recipes/random', [
                'limitLicense' => 'true',
                'number' => min($limit, 100)
            ])['recipes'];
        }

        return $this->translateResults($results, self::INSTANCE_RECIPE);
    }

    /**
     * @param SpoonacularModel $spoonacularModel
     * @param Model $model
     * @return void
     * @throws Exception
     */
    public static function populateModelBySpoonacularModel(SpoonacularModel $spoonacularModel, Model &$model): void
    {
        switch (true) {
            case $spoonacularModel instanceof SpoonacularRecipe:
                if (!$model instanceof Recipe) {
                    throw new Exception('Model [' . get_class($model) . '] is not compatible with Spoonacular Model [' . get_class($spoonacularModel) . '].');
                }

                $imageFilename = '';

                if (!empty($spoonacularModel->getImage())) {
                    $imageContents = file_get_contents($spoonacularModel->getImage());

                    if (!empty($imageContents)) {
                        file_put_contents(public_path('images/' . basename($spoonacularModel->getImage())), $imageContents);
                        $imageFilename = basename($spoonacularModel->getImage());
                    }
                }

                $model->title = $spoonacularModel->getTitle();
                $model->description = $spoonacularModel->getInstructions();
                $model->logo = $imageFilename;
                break;
        }
    }

    public function translateResults(array $results, string $instance): array
    {
        switch ($instance) {
            case self::INSTANCE_RECIPE:
                $results = $this->translateRecipeResults($results);
                break;
        }

        return $results;
    }

    private function translateRecipeResults(array $results): array
    {
        $finalResults = [];
        foreach ($results as $result) {
            $recipe = new SpoonacularRecipe();
            $recipe->setVegetarian($result['vegetarian']);
            $recipe->setVegan($result['vegan']);
            $recipe->setGlutenFree($result['glutenFree']);
            $recipe->setDairyFree($result['dairyFree']);
            $recipe->setVeryHealthy($result['veryHealthy']);
            $recipe->setCheap($result['cheap']);
            $recipe->setVeryPopular($result['veryPopular']);
            $recipe->setSustainable($result['sustainable']);
            $recipe->setLowFodmap($result['lowFodmap']);
            $recipe->setWeightWatcherSmartPoints($result['weightWatcherSmartPoints']);
            $recipe->setGaps($result['gaps']);
            $recipe->setPreparationMinutes($result['preparationMinutes']);
            $recipe->setCookingMinutes($result['cookingMinutes']);
            $recipe->setAggregateLikes($result['aggregateLikes']);
            $recipe->setHealthScore($result['healthScore']);
            $recipe->setCreditsText($result['creditsText']);
            $recipe->setLicense($result['license'] ?? '');
            $recipe->setSourceName($result['sourceName']);
            $recipe->setPricePerServing($result['pricePerServing']);
            $recipe->setExtendedIngredients($result['extendedIngredients']);
            $recipe->setId($result['id']);
            $recipe->setTitle($result['title']);
            $recipe->setReadyInMinutes($result['readyInMinutes']);
            $recipe->setServings($result['servings']);
            $recipe->setSourceUrl($result['sourceUrl']);
            $recipe->setOpenLicense($result['openLicense']);
            $recipe->setImage($result['image'] ?? '');
            $recipe->setImageType($result['imageType'] ?? '');
            $recipe->setSummary($result['summary']);
            $recipe->setCuisines($result['cuisines']);
            $recipe->setDishTypes($result['dishTypes']);
            $recipe->setDiets($result['diets']);
            $recipe->setOccasions($result['occasions']);
            $recipe->setInstructions($result['instructions']);
            $recipe->setAnalyzedInstructions($result['analyzedInstructions']);
            $recipe->setOriginalId($result['originalId']);
            $recipe->setSpoonacularSourceUrl($result['spoonacularSourceUrl']);

            $finalResults[] = $recipe;
        }

        return $finalResults;
    }

    private function executeRequest(string $method, string $endpoint, array $parameters): array
    {
        $parameters['apiKey'] = env('SPOONACULAR_API_KEY');

        $url = self::BASE_URL . $endpoint;

        if ($method === 'GET') {
            $url .= '?' . http_build_query($parameters);
            $parameters = [];
        }

        $response = Http::send($method, $url, $parameters);

        return json_decode($response->body(), true);
    }
}
