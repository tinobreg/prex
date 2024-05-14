<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GiphyTest extends TestCase
{

    public function test_search_gifs(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ])->get('/api/gifs/search?q=dog');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
            ],
            'meta' => [
                'status',
                'msg',
            ]
        ]);
    }

    public function test_view_gif(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ])->get('/api/gifs/3o7527pa7qs9kCG78A');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
            ],
            'meta' => [
                'status',
                'msg',
            ]
        ]);
    }

    public function test_wrong_view_gif(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ])->get('/api/gifs/3o7527pa7qs9kCG71A');

        $response->assertStatus(404);
    }
}
