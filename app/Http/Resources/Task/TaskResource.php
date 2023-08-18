<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Designation\Designation;
use App\Models\Employee\Employee;
use App\Models\Project\Project;
use App\Models\Task\TaskType;
use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public static $wrap = 'task';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $employee = Employee::find($this->employee_id);
        return [
            'id'=>$this->id,
            'date'=> $this->date,
            'task_detail'=> $this->task_detail,
            'number_of_hour'=> $this->number_of_hour,
            'comment'=> $this->comment,
            'user' => User::find($employee->user_id),
            'employee'=> $employee,
            "designation_name" => Designation::select('designation_name')->find($employee->designation_id),
        'task_type'=> TaskType::find($this->task_type_id),
            'project' => Project::find($this->project_id)
        ];
    }
}
