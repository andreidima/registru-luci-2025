<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membru;

class MembruSeeder extends Seeder
{
    public function run()
    {
        Membru::factory()->count(100)->create();
    }
}
