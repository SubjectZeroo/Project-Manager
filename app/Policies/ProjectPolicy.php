<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Project $project)
    {
        return $user->is($project->owner);
    }
}
