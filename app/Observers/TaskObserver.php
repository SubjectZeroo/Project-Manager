<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        // Activity::create([
        //     'project_id'  => $task->project->id,
        //     'description' => 'created_task'
        // ]);


        $task->recordActivity('created_task');

    }


    public function updating(Task $task)
    {
        $task->old =$task->getOriginal();
    }

    /**
     * Handle the Task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {

    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        // Activity::create([
        //     'project_id'  => $task->project->id,
        //     'description' => 'deleted_task'
        // ]);
        $task->project->recordActivity('deleted_task');
    }

    /**
     * Handle the Task "restored" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
