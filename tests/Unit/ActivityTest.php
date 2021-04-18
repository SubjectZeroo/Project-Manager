<?php

namespace Tests\Unit;

use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
use RefreshDatabase;

/** @test */
function it_has_a_user()
{

    $user = $this->signIn();

    // $project = Project::factory()->create();

   $project = ProjectFactory::ownedBy($user)->create();

    $this->assertEquals($user->id, $project->activity->first()->user->id);
}
}
