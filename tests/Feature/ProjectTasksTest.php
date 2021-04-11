<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function test_guest_cannot_add_tasks_to_projects()
    {
        $project = Project::factory()->create();

        $this->post($project->path(). '/tasks')->assertRedirect('login');
    }


    /** @test */
    public function test_only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path(). '/tasks', ['body' => 'Test Task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }


     /** @test */
     public function test_only_the_owner_of_a_project_may_update_tasks()
     {
         $this->signIn();

         $project = Project::factory()->create();

         $task = $project->addTask('test task');

         $this->patch($task->path(), ['body' => 'changed'])
            ->assertStatus(403);

         $this->assertDatabaseMissing('tasks', ['body' => 'changer']);
     }


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
    public function test_a_task_can_be_update()
    {


       $project = app(ProjectFactory::class)
       ->ownedBy($this->signIn())
       ->withTasks(1)
       ->create();


      $this->patch($project->path() . '/tasks/' . $project->tasks[0]->id, [
        'body' => 'changed',
        'completed' => true
      ]);


      $this->assertDatabaseHas('tasks', [
        'body' => 'changed',
        'completed' => true
      ]);

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
