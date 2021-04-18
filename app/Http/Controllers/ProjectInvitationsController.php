<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('manage', $project);

        request()->validate([
            'email' => ['required', 'exists:users,email']
        ], [
            'email.exists' => 'El usuario que estas invitando debe tener una cuenta en la plataforma'
        ]);

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());

    }
}
