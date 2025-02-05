<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Proiect;
use App\Models\Membru;
use App\Models\Subcontractant;

class ProiectPivotSeeder extends Seeder
{
    public function run()
    {
        // Retrieve all projects
        $proiecte = Proiect::all();

        foreach ($proiecte as $proiect) {
            // Attach between 2 and 4 membri for each proiect
            $numMembri = rand(2, 4);
            // Get a random collection of membri
            $membri = Membru::inRandomOrder()->limit($numMembri)->get();

            foreach ($membri as $membru) {
                DB::table('membru_proiect')->insert([
                    'membru_id'    => $membru->id,
                    'proiect_id'   => $proiect->id,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }

            // Attach between 2 and 4 subcontractanti for each proiect
            $numSubcontractanti = rand(2, 4);
            $subcontractanti = Subcontractant::inRandomOrder()->limit($numSubcontractanti)->get();

            foreach ($subcontractanti as $subcontractant) {
                DB::table('proiect_subcontractant')->insert([
                    'subcontractant_id' => $subcontractant->id,
                    'proiect_id'        => $proiect->id,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }
        }
    }
}
