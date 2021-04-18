<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_it_has_a_path()
    {
        $project = Project::factory()->create();

       $this->assertEquals('/projects/'. $project->id, $project->path());
    }



    /** @test */
    public function test_it_belongs_to_an_owner()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf('App\Models\User', $project->owner);
    }


    /** @test */
    public function test_it_can_add_a_task()
    {
        $project = Project::factory()->create();

        $tasks = $project->addTask('Test task');

        $this->assertCount(1,$project->tasks);
        $this->assertTrue($project->tasks->contains($tasks));
    }


    /** @test */

    function it_can_invite_a_user()
    {
        $project = Project::factory()->create();

        $project->invite($user = User::factory()->create());

       $this->assertTrue( $project->members->contains($user));
    }
}
