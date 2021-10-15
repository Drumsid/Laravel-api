<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Desk;

class DeskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Desk::factory()->count(20)->create();
    }
}
