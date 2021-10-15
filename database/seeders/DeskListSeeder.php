<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeskList;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Desk;

class DeskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeskList::factory()->count(20)
                ->state(new Sequence(
                    fn ($sequence) => ['desk_id' => Desk::all()->random()->id],
                ))->create();
    }
}
