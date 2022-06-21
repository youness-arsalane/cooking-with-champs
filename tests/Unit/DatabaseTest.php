<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_connection(): void
    {
        assertEquals(true, true);
    }
}
