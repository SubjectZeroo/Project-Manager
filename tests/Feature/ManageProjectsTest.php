<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Facades\Tests\Setup\ProjectFactory;
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
          $this->get($project->path().'/edit')->assertRedirect('login');
          $this->get($project->path())->assertRedirect('login');
          $this->post('/projects',  $project->toArray())->assertRedirect('login');
      }

    /** @test */
    public function test_a_user_can_create_a_project()

    {

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        // $attributes = [
        //     'title' => $this->faker->sentence,
        //     'description' => $this->faker->sentence,
        //     'notes' => 'General notes here.'
        // ];

        $attributes = Project::factory()->raw(['owner_id' => auth()->id()]);

        $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();



        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }


    /** @test */
    function test_a_user_can_see_all_projects_they_have_been_invited_to_on_their_dashboard()
    {
        $user = $this->signIn();

        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $project->invite($user);

        $this->get('/projects')
            ->assertSee($project->title);
    }

    /** @test */
    public function test_a_guest_cannnot_delete_projects()
    {


        $project = ProjectFactory::create();

        $this->delete($project->path())
            ->assertRedirect('/login');

        // $this->signIn();
        $user = $this->signIn();

        $this->delete($project->path())->assertStatus(403);

        $project->invite($user);

        $this->actingAs($user)->delete($project->path())->assertStatus(403);


    }

    /** @test */
    public function test_a_user_can_delete_a_project()
    {

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test */
    public function test_a_user_can_update_a_project()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->patch($project->path(), [
            'title' => 'Changed',
            'description' => 'Changed',
            'notes' => 'Changed'
        ])->assertRedirect($project->path());


        $this->get($project->path().'/edit')->assertStatus(200);

        $this->assertDatabaseHas('projects', ['notes' => 'Changed']);
    }

    function test_a_user_can_update_a_projects_general_notes()
    {

        // $this->signIn();
        // $project = Project::factory()->create(['owner_id' => auth()->id()]);

        // $this->patch($project->path(), ['notes' => 'Changed']);


        // $this->get($project->path().'/edit')->assertStatus(200);

        // $this->assertDatabaseHas('projects', ['notes' => 'Changed']);

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = ['notes' => 'Changed']);

        $this->assertDatabaseHas('projects', $attributes);

    }

     /** @test */
     public function test_a_user_can_view_their_project()
     {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
             ->get($project->path())
             ->assertSee($project->title);
            // ->assertSee($project->description);


         // $this->be(User::factory()->create());

         // $project = Project::factory()->create(['owner_id' => auth()->id()]);

         // $this->get($project->path())
         //     ->assertSee($project->title)
         //     ->assertSee($project->description);
     }

    /** @test */
    public function test_an_authenticated_user_cannot_view_their_projects_of_others()
    {

        $this->signIn();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);

    }


    /** @test */
    public function test_an_authenticated_user_cannot_update_the_projects_of_others()
    {

        $this->signIn();

        $project = Project::factory()->create();

        $this->patch($project->path(), [])->assertStatus(403);

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
