<?php

namespace Database\Seeders;

use App\Models\Submenu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Submenu::factory()->count(25)->create();
    }
}
