<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Designation\Designation;
use App\Models\Project\Project;
use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public static $wrap = 'project';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=> $this->name,
            'status'=> $this->status,
//            'employees' => EmployeeResource::collection($this->employees),
        ];
    }
}
