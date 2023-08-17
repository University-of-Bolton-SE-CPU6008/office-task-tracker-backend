<?php

namespace App\Http\Resources\Designation;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignationResource extends JsonResource
{
    public static $wrap = 'designation_type';

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
            'designation_name'=> $this->designation_name
        ];
    }

}
