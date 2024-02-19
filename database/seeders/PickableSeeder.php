<?php

namespace Database\Seeders;

use App\Models\Pickable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PickableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pickable::factory(5)->create();
    }
}
