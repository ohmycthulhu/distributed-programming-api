<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();
         User::factory(1, ['access_level' => 'ADMIN', 'email' => 'admin@email.com'])->create();
         $tags = Tag::factory(20)->create();

         foreach (User::all() as $user) {
           $this->generateProjects($user, $tags);
         }
    }

    protected function generateProjects(User $user, $tags) {
      $projects = Project::factory(4, ['user_id' => $user->id])->create();

      foreach ($projects as $project) {
        $project->tags()->attach($tags->shuffle()->take(3));
      }
    }
}
