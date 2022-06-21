<?php

namespace App\Adapters;

use Illuminate\Support\Facades\Http;

class SpoonacularAdapter
{
    const BASE_URL = 'https://api.spoonacular.com/';

    public function getRandomRecipes(int $limit = 10): array
    {
        return $this->executeRequest('GET', 'recipes/random', [
            'limitLicense' => 'true',
            'number' => min($limit, 100)
        ])['recipes'];
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
