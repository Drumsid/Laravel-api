<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::factory()->count(20)
                ->state(new Sequence(
                    fn ($sequence) => ['card_id' => Card::all()->random()->id],
                ))->create();
    }
}
