<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\CodeProject\Entities\Project::truncate();
        factory(\CodeProject\Entities\Project::class)->create([
           "name"=>"Teste Project",
           "description"=>"Description",
           "progress"=> 0,
           "status"=> 0,
           "due_date"=> time(),
           "created_at"=>time(),
           "updated_at"=>time(),
           "owner_id"=> 1,
           "client_id"=> 1
        ]);
        factory(\CodeProject\Entities\Project::class, 10)->create();
    }
}
