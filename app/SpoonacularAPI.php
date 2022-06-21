<?php

namespace App;

use Illuminate\Support\Facades\Http;

class SpoonacularAPI
{
    const BASE_URL = 'https://api.spoonacular.com/';
    const API_KEY = '5613efb8396e4f989b5e61ac57866a48';

    public function getRandomRecipes(int $limit = 10): array
    {
        return $this->executeRequest('GET', 'recipes/random', [
            'limitLicense' => 'true',
            'number' => min($limit, 100)
        ])['recipes'];
    }

    private function executeRequest(string $method, string $endpoint, array $parameters): array
    {
        $parameters['apiKey'] = self::API_KEY;

        $url = self::BASE_URL . $endpoint;

        if ($method === 'GET') {
            $url .= '?' . http_build_query($parameters);
            $parameters = [];
        }

        $response = Http::send($method, $url, $parameters);

        return json_decode($response->body(), true);
    }
}
