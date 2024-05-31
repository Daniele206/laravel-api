<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class ProjectTecnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array to store used combinations
        $usedCombinations = [];

        for ($i = 0; $i < 60; $i++) {
            do {
                $project = Project::inRandomOrder()->first();
                $technology_id = Technology::inRandomOrder()->first()->id;

                // Generate a unique key for the combination
                $combinationKey = $project->id . '-' . $technology_id;
            } while (isset($usedCombinations[$combinationKey]));

            // Store the combination as used
            $usedCombinations[$combinationKey] = true;

            // Attach flavour to wine
            $project->technologies()->attach($technology_id);
        }
    }
}
