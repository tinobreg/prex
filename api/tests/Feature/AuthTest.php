<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_correctly_login(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'tinobreg@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'access_token',
                'token_type',
                'expires_at',
            ],
            'meta' => [
                'status',
                'msg'
            ]
        ]);
    }

    public function test_wrong_login(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'tinobreg@gmail.com',
            'password' => '123456234234'
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure([
            'data' => [],
            'meta' => [
                'status',
                'msg'
            ]
        ]);
    }
}
