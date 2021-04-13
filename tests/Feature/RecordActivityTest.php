<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordActivityTest extends TestCase
{
   use RefreshDatabase;

    /** @test */
    function creating_a_project_()
    {

        $project = ProjectFactory::create();

        $this->assertCount(1,$project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    function updating_a_project()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);

        $this->assertEquals('updated', $project->activity->last()->description);
    }

    /** @test */
    function creating_a_new_task()
    {
        $project = ProjectFactory::create();
        $project->addTask('Some task');
        $this->assertCount(2, $project->activity);
    }

    /** @test */
    function completing_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
        ->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(3, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);
    }

     /** @test */
     function incompleting_a_task()
     {
         $project = ProjectFactory::withTasks(1)->create();

         $this->actingAs($project->owner)
         ->patch($project->tasks[0]->path(), [
             'body' => 'foobar',
             'completed' => true
         ]);


         $this->patch($project->tasks[0]->path(), [
             'body' => 'foobar',
             'completed' => false
         ]);

    // dd($project->fresh()->activity->toArray());

        $project->refresh();

         $this->assertCount(4, $project->activity);
         $this->assertEquals('incompleted_task', $project->activity->last()->description);
     }

     /** @test */

     function deleting_a_task()
     {
         $project = ProjectFactory::withTasks(1)->create();

         $project->tasks[0]->delete();

         $this->assertCount(3, $project->activity);
     }
}
