<?php

namespace App\Http\Resources\Employee;

use App\Http\Resources\Project\ProjectResource;
use App\Models\Designation\Designation;
use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public static $wrap = 'employer';

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
            'user'=> User::find($this->user_id),
            'status'=> $this->status,
            'designation'=> Designation::find($this->designation_id),
            'projects'=> ProjectResource::collection($this->projects),
        ];
    }
}
