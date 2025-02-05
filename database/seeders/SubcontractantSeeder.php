<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcontractant;

class SubcontractantSeeder extends Seeder
{
    public function run()
    {
        Subcontractant::factory()->count(100)->create();
    }
}
