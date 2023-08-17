<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskTypeCollection extends ResourceCollection
{
    public static $wrap = 'task_type_list';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'task_type_list'=> TaskTypeResource::collection($this->collection)
        ];
    }

}
