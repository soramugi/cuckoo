<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SetupTest extends TestCase
{
    /**
     * @test
     */
    public function 未設定(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('setup');
    }
}
