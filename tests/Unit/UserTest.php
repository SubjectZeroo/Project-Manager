<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
     function test_a_user_has_projects()
    {
       $user =  User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

     /** @test */
     function test_a_user_has_accessible_projects()
     {
        $john = $this->signIn();

        $project = ProjectFactory::ownedBy($john)->create();

        $this->assertCount( 1,$john->accessibleProjects());

        $sally = User::factory()->create();
        $admin = User::factory()->create();

        $sallyProject = ProjectFactory::ownedBy($sally)->create();
        $sallyProject->invite($admin);

        $this->assertCount( 1,$john->accessibleProjects());

        $sallyProject->invite($john);

        $this->assertCount( 2,$john->accessibleProjects());
     }
}
