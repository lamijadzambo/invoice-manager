<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project1 = new Project();
        $project1->name = 'Atemschutzmasken';
        $project1->save();

        $project2 = new Project();
        $project2->name = 'Flip Flop';
        $project2->save();
    }
}
