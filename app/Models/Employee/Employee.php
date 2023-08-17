<?php

namespace App\Models\Employee;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'designation_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User\User');
    }

    public function designation()
    {
        return $this->belongsTo('App\Models\Designation\Designation');
    }


    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'employee_projects');
    }

}
