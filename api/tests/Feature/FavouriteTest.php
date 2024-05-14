<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavouriteTest extends TestCase
{

    public function test_correctly_add_favourite(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ])->post('/api/gifs/fav', [
            'gif_id' => '3o7527pa7qs9kCG78A',
            'alias' => 'AliasUnoDosTres'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'user_id',
                'gif_id',
            ],
            'meta' => [
                'status',
                'msg'
            ]
        ]);
    }

    public function test_null_id_add_favourite(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ])->post('/api/gifs/fav', [
            'gif_id' => null,
            'alias' => 'AliasUnoDosTres'
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'gif_id' => [
                ]
            ]
        ]);
    }

    public function test_null_alias_add_favourite(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ])->post('/api/gifs/fav', [
            'gif_id' => '3o7527pa7qs9kCG78A',
            'alias' => null
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'alias' => [
                ]
            ]
        ]);
    }
}
