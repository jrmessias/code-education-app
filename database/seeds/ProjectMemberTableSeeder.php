<?php

use Illuminate\Database\Seeder;
use JrMessias\Entities\ProjectMember;

class ProjectMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectMember::truncate();
        factory(ProjectMember::class, 10)->create();
    }
}
