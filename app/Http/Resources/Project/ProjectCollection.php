<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Employee\EmployeeResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    public static $wrap = 'project_list';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'project_list'=> ProjectResource::collection($this->collection)
        ];
    }
}
