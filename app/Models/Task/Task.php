<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'employee_id',
        'project_id',
        'task_type_id',
        'task_detail',
        'date',
        'number_of_hour',
        'comment'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee\Employee');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project\Project');
    }

    public function task_type()
    {
        return $this->belongsTo('App\Models\Task\TaskType');
    }

}
