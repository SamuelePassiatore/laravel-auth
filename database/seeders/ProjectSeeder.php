<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $projectsConfig = config('projects');
        foreach ($projectsConfig as $projectConfig) {
            $project = new Project();
            $project->title = $projectConfig['title'];
            $project->description = $projectConfig['description'];
            $project->image = "https://picsum.photos/id/" . $faker->numberBetween(1, 50) . "/200";
            $project->slug = Str::slug($project->title, '-');
            $project->url = $projectConfig['url'];
            $project->save();
        }
    }
}
