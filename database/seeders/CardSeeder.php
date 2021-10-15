<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\DeskList;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::factory()->count(20)
                ->state(new Sequence(
                    fn ($sequence) => ['desk_list_id' => DeskList::all()->random()->id],
                ))->create();
    }
}
