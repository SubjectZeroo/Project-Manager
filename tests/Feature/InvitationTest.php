<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    function test_non_owners_may_not_invite_users()
    {
        $project = ProjectFactory::create();

        $user = User::factory()->create();



        $this->actingAs($user)
            ->post($project->path() . '/invitations')
            ->assertStatus(403);

        $project->invite($user);

        $this->actingAs($user)
            ->post($project->path() . '/invitations')
            ->assertStatus(403);
    }

    /** @test */
    function test_a_project_owner_can_invite_a_user()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $userToInvite = User::factory()->create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => $userToInvite->email
        ])
        ->assertRedirect($project->path()); // invite user


        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    function test_email_address_must_be_associated_with_a_valid_account()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'notauser@example.com'
        ])
        ->assertSessionHasErrors([
            'email' => 'El usuario que estas invitando debe tener una cuenta en la plataforma'
        ]);
    }


    /** @test */
    function test_invited_users_may_updated_project_details()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = User::factory()->create());


        $this->signIn($newUser);

        $this->post(action('App\Http\Controllers\ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);

    }
}
