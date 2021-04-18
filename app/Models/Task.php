<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $old = [];

    protected $guarded = [];

    protected $touches =['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    // protected static function boot()
    // {
    //     parent::boot();


    //     static::updated(function($task) {

    //         if (! $task->completed) return;
    //         Activity::create([
    //             'project_id'  => $task->project->id,
    //             'description' => 'completed_task'
    //         ]);
    //     });


    //     static::updated(function($task) {

    //         if (! $task->completed) return;

    //     });

    // }

    public function complete()
    {
        $this->update(['completed' => true]);

        // Activity::create([
        //     'project_id'  => $this->project->id,
        //     'description' => 'completed_task'
        // ]);

        $this->recordActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);

        // Activity::create([
        //     'project_id'  => $this->project->id,
        //     'description' => 'incompleted_task'
        // ]);

        $this->recordActivity('incompleted_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }



    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

/**
 * Record activity for a project
 *
 * @param string $description
 *
 */

    // public function recordActivity($description)
    // {

    //     $this->activity()->create([
    //         'project_id' => $this->project_id,
    //         'description' => $description
    //     ]);
    //     // Activity::create([
    //     //     'project_id' => $this->id,
    //     //     'description' => $type
    //     // ]);
    // }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'user_id' => $this->activityOwner()->id,
            'project_id' => $this->project_id,
            'description' => $description
        ]);
    }


    protected function activityOwner()
    {
        if(auth()->check())
        {
            return auth()->user();
        }

        if(class_basename($this) === 'Project') {
            return $this->owner;
        }

        return $this->project->owner;
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
}
