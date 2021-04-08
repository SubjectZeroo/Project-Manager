<?php

namespace Tests\Unit;

use App\Models\Project;
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
}
