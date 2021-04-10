<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $touches =['projects'];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }



    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
