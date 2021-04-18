<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $old = [];


    public function path()
    {
        return "/projects/{$this->id}";
    }


    public function owner()
    {
      return  $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));

        // Activity::create([
        //     'project_id' => $this->id,
        //     'description' => 'created_task'
        // ]);
    }

    public function recordActivity($description)
    {

        $this->activity()->create([
            'user_id' => $this->activityOwner()->id,
            'description' => $description,
            'changes' =>$this->activityChanges($description)

        ]);
        // Activity::create([
        //     'project_id' => $this->id,
        //     'description' => $type
        // ]);
    }

    protected function activityChanges($description)
    {
        if ($description == 'updated') {
            return [
                'before' => array_diff($this->old,$this->getAttributes()),
                'after'  =>array_diff($this->getAttributes(),$this->old) // []
            ];

        }
    }


    protected function activityOwner()
    {
        // if(auth()->check())
        // {
        //     return auth()->user();
        // }

        // if(class_basename($this) === 'Project') {
        //     return $this->owner;
        // }

        // return $this->project->owner;

        $project = $this->project ?? $this;
        return $project->owner;
    }

    public function activity()
    {
       return $this->hasMany(Activity::class)->latest();
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }

    public function members()
    {
        // es verdad un proyecto puede tener muchos miembros
        // tambien es verdad un miembro puede tener muchos proyectos

     return   $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }
}
