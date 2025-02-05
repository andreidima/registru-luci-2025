<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proiect;

class ProiectSeeder extends Seeder
{
    public function run()
    {
        // Generate 100 fake Proiect records
        Proiect::factory()->count(1000)->create();
    }
}
