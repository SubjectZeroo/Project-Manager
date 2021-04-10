<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

      /** @test */
      public function test_a_guest_cannot_manage_projects()
      {
          $project = Project::factory()->create();

          $this->get('/projects')->assertRedirect('login');
          $this->get('/projects/create')->assertRedirect('login');
          $this->get($project->path())->assertRedirect('login');
          $this->post('/projects',  $project->toArray())->assertRedirect('login');
      }

    /** @test */
    public function test_a_user_can_create_a_project()

    {
        $this->withoutExceptionHandling();


        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function test_a_user_can_view_their_project()
    {

        $this->be(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }


    /** @test */
    public function test_an_authenticated_user_cannot_view_their_projects_of_others()
    {

        $this->be(User::factory()->create());

        //   $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);

    }

    /** @test */
    public function test_a_project_require_a_title()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');

    }


     /** @test */
     public function test_a_project_require_a_description()
     {
        $this->actingAs(User::factory()->create());
         $attributes = Project::factory()->raw(['description' => '']);
         $this->post('/projects',  $attributes)->assertSessionHasErrors('description');

     }






}
