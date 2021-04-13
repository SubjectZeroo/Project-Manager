<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
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

        Activity::create([
            'project_id'  => $this->project->id,
            'description' => 'completed_task'
        ]);
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);

        Activity::create([
            'project_id'  => $this->project->id,
            'description' => 'incompleted_task'
        ]);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }



    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
