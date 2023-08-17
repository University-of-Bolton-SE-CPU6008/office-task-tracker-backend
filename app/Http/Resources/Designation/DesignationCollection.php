<?php

namespace App\Http\Resources\Designation;

use App\Http\Resources\Task\TaskTypeResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DesignationCollection extends ResourceCollection
{
    public static $wrap = 'designation_list';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'designation_list'=> DesignationResource::collection($this->collection)
        ];
    }
}
