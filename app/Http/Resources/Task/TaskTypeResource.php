<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskTypeResource extends JsonResource
{
    public static $wrap = 'task_type';

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
            'type_name'=> $this->type_name,
            'type_color'=> $this->type_color
        ];
    }
}
