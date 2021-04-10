<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function test_a_project_can_have_taks()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();

       $project = Project::factory()->create(['owner_id' => auth()->id()]);

       $this->post($project->path() . '/tasks', ['body' => 'Test task']);

       $this->get($project->path())
            ->assertSee('Test task');
    }


    /** @test */
    public function test_a_task_require_a_body()
    {
        $this->signIn();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
