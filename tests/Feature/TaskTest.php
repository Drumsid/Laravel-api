<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Card;
use App\Models\DeskList;
use App\Models\Desk;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TaskTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Task::factory()->count(2)->make();
    }

    public function testIndex(): void
    {
        $this->json('get', 'api/task')
                ->assertStatus(Response::HTTP_OK)
                ->assertJsonStructure(
                    [
                        "data" => [
                            "*" => [
                                "id",
                                "name",
                                "created_at",
                            ]
                        ]
                    ]
                );
    }
    
    public function testStore()
    {
        $payload =  Task::factory()->count(1)
                    ->state(new Sequence(
                        fn ($sequence) => ['card_id' => Card::all()->random()->id],
                    ))->create()->toArray()[0];

        $this->json('post', 'api/task', $payload)
             ->assertStatus(Response::HTTP_CREATED)
             ->assertJsonStructure(
                 [
                     'data' => [
                        "id",
                        "name",
                        "created_at",
                     ]
                 ]
             );
        $this->assertDatabaseHas('tasks', $payload);
    }

    public function testShow()
    {
        $desk = Desk::create(
            [
                'name' => 'Desk test',
            ]
        );
        $deskList = DeskList::create(
            [
                'name' => 'DeskList test',
                'desk_id' => $desk->id
            ]
        );
        $card = Card::create(
            [
                'name' => 'Card test',
                'desk_list_id' => $deskList->id
            ]
        );
        $task = Task::create(
            [
                'name' => 'Task test',
                'card_id'  => $card->id,
            ]
        );
        $this->json('get', "api/task/$task->id")
                ->assertStatus(Response::HTTP_OK)
                ->assertExactJson(
                    [
                        'data' => [
                            'id'   => $task->id,
                            'name' => $task->name,
                            'created_at' => $task->created_at
                        ]
                    ]
                );

    }
}
