<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_all_movies()
    {
        $response = $this->get('/api/v1/movies');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'movies' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'poster',
                ],
            ],
        ]);
    }
}
