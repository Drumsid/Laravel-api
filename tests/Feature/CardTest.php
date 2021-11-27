<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Card;
use Illuminate\Http\Response;

class CardTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Card::factory()->count(2)->make();
    }

    public function testIndex(): void
    {
        $this->json('get', 'api/card')
                ->assertStatus(Response::HTTP_OK)
                ->assertJsonStructure(
                    [
                        "data" => [
                            "*" => [
                                "id",
                                "name",
                                "created_at",
                                "tasks"
                            ]
                        ]
                    ]
                );
    }
}
