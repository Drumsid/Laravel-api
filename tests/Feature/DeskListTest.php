<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\DeskList;
use Illuminate\Http\Response;

class DeskListTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DeskList::factory()->count(2)->make();
    }

    public function testIndex(): void
    {
        $this->json('get', 'api/deskList')
                ->assertStatus(Response::HTTP_OK)
                ->assertJsonStructure(
                    [
                        "data" => [
                            "*" => [
                                "id",
                                "name",
                                "created_at",
                                "cards"
                            ]
                        ]
                    ]
                );
    }
}
