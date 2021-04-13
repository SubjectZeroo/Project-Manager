<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

 /** @test */
    function test_it_belongs_to_a_project()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }


    /** @test */
    function test_has_a_path()
    {
        $task = Task::factory()->create();

        $this->assertEquals('/projects/' . $task->project->id . '/tasks/' . $task->id, $task->path());
    }


     /** @test */
     function test_it_can_be_completed()
     {

         $task = Task::factory()->create();

         $this->assertFalse($task->completed);

         $task->complete();

         $this->assertTrue($task->fresh()->completed);

     }

      /** @test */
      function test_it_can_be_marked_as_incompleted()
      {

          $task = Task::factory()->create(['completed' => true]);

          $this->assertTrue($task->completed);

          $task->incomplete();

          $this->assertFalse($task->fresh()->completed);

      }
}
