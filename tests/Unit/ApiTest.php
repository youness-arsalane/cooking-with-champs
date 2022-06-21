<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_connection(): void
    {
        $ch = curl_init('http://127.0.0.1:8000/api/categories');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        assertEquals(200, $httpCode);
    }
}
